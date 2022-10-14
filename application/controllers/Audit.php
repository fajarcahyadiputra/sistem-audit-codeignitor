<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Audit extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		$this->load->model('prosesAudit_model');
		$this->load->model('bagian_model');
		$this->load->model('document_model');
		$this->load->library('genpdf');
		$this->load->model('document_audit');
	}

	public function index()
	{
		$this->data['page'] = 'audit';
		$this->data['addon'] = '';
		$this->data['audits'] = $this->db->select('a.tahapan,a.start_date,a.id, a.end_date, a.kisi_kisi, a.status, a.pesan_kesalahan, b.nama,d.file_url, c.first_name, c.last_name')
        ->from('proses_audit a')
        ->join('bagian b',"a.bagian_id = b.id","left")
        ->join('users c','a.user_id = c.id',"left")
        ->join('document d','d.id = a.document_id',"left")
		->order_by("a.id", 'DESC')
        ->get()->result();
		// var_dump($this->session->userdata());
		if($this->session->userdata()['group_name'] == 'auditor'){
			$this->data['audits'] = $this->db->select('a.tahapan,a.start_date,a.id, a.end_date, a.kisi_kisi, a.status, a.pesan_kesalahan, b.nama,d.file_url, c.first_name, c.last_name')
			->from('proses_audit a')
			->join('bagian b',"a.bagian_id = b.id","left")
			->join('users c','a.user_id = c.id',"left")
			->join('document d','d.id = a.document_id',"left")
			->where('c.username', $this->session->userdata()['username'])
			->order_by("a.id", 'DESC')
			->get()->result();
		}


		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->load->view('layout', $this->data);
	}
	

	public function tambah()
	{
		$this->form_validation->set_rules('start_date', 'start_date', 'trim|required');
		$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
		$this->form_validation->set_rules('bagian_id', 'bagian_id', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = [
				'start_date' => $this->input->post('start_date'),
				'user_id' => $this->input->post('user_id'),
				'bagian_id' => $this->input->post('bagian_id'),
				'status' => "menunggu kisi-kisi",
			];
            $data['status'] = "on progress";
			if ($this->prosesAudit_model->insert($data)) {
				$this->session->set_flashdata('message', 'Insert data audit berhasil.');
				// redirect(base_url('audit'));
				$user = $this->ion_auth->user($this->input->post('user_id'))->row();
				$bagian = $this->bagian_model->get_where(['id' => $this->input->post('bagian_id')]);
				echo json_encode([
					'status' => 'success',
					'phone' => $user->phone,
					'nama'  => $user->first_name.' '.$user->last_name,
					'start_date' => $this->input->post('start_date'),
					"nama_bagian" => $bagian->nama
				]);
			}
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            $this->data['bagians'] = $this->bagian_model->get();
            $this->data['users'] = $this->db->select("a.first_name, a.last_name, a.id")->from('users a')->join('users_groups b','a.id = b.user_id','left')->where('b.group_id', 3)->get()->result();
            $this->data['documents'] = $this->document_model->get();
            
			$this->data['page'] = 'audit/tambah';
			$this->data['addon'] = '';

			$this->load->view('layout', $this->data);
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		if (isset($_POST) && !empty($_POST)) {

			if ($this->form_validation->run() === TRUE) {
				$data = [
					'nama' => $this->input->post('nama'),
					'description' => $this->input->post('description')
				];

				if ($this->prosesAudit_model->update($data, ['id' => $id])) {
					$this->session->set_flashdata('message', 'Update data audit berhasil.');
					redirect(base_url('audit/edit/' . $id));
				} else {
					$this->session->set_flashdata('message', 'Update gagal, silakan coba lagi.');
					redirect(base_url('audit/edit/' . $id));
				}
			}
		}

		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

		$this->data['data'] = $this->prosesAudit_model->get_where(['id' => $id]);
		$this->data['page'] = 'audit/edit';
        $this->data['documents'] = $this->document_model->get("status=1");
		$this->data['addon'] = '';

		$this->load->view('layout', $this->data);
	}

	public function delete($id)
	{
		if ($this->prosesAudit_model->delete(['id' => $id])) {
			$this->session->set_flashdata('message', 'Delete data audit berhasil.');
			redirect(base_url('audit'));
		} else {
			$this->session->set_flashdata('message', 'Delete gagal, silakan coba lagi.');
			redirect(base_url('audit'));
		}
	}
    public function kisi_kisi($id){
        $this->form_validation->set_rules('kisi_kisi', 'kisi_kisi', 'required');
		if (isset($_POST) && !empty($_POST)) {

			if ($this->form_validation->run() === TRUE) {
				$data = [
					'kisi_kisi' => $this->input->post('kisi_kisi'),
					"status" => "check document",
					'tahapan' => 3,
				];
				if ($this->prosesAudit_model->update($data, ['id' => $id])) {
					$this->session->set_flashdata('message', 'Berhasil menambahkan kisi-kisi.');
					redirect(base_url('audit/edit/' . $id));
				} else {
					$this->session->set_flashdata('message', 'Gagal, silakan coba lagi.');
					redirect(base_url('audit/edit/' . $id));
				}
			}
    }

    $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
    $this->data['data'] = $this->prosesAudit_model->get_where(['id' => $id]);
    $this->data['page'] = 'audit/kisi_kisi';
    $this->data['addon'] = '';

    $this->load->view('layout', $this->data);
}
public function pilih_document($id){
    // $this->form_validation->set_rules('document_id', 'document_id', 'required');
    if (isset($_POST) && !empty($_POST)) {
		// $category = 
            $data = [
				"status" => "finish check document",
                'tahapan' => 4,
            ];
            if ($this->prosesAudit_model->update($data, ['id' => $id])) {
				foreach($this->input->post('document_id') as $docId){
					$this->document_audit->insert([
						'document_id' => $docId,
						'audit_id'=> $id
					]);
				}
                $this->session->set_flashdata('message', 'Berhasil menambahkan document.');
                redirect(base_url('audit/edit/' . $id));
            } else {
                $this->session->set_flashdata('message', 'Gagal, silakan coba lagi.');
                redirect(base_url('audit/edit/' . $id));
            }
}

$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
$this->data['data'] = $this->prosesAudit_model->get_where(['id' => $id]);
$this->data['page'] = 'audit/pilih_document';
$this->data['addon'] = '';
$this->data['documents'] = $this->document_model->get("status=1");
$this->load->view('layout', $this->data);
}
public function pesan_kesalahan($id){
    $this->form_validation->set_rules('pesan_kesalahan', 'pesan_kesalahan', 'required');
    if (isset($_POST) && !empty($_POST)) {

        if ($this->form_validation->run() === TRUE) {
            $data = [
                'pesan_kesalahan' => $this->input->post('pesan_kesalahan'),
				"status" => "menunggu balasan kesalahan",
                'tahapan' => 5,
            ];
            if ($this->prosesAudit_model->update($data, ['id' => $id])) {
                $this->session->set_flashdata('message', 'Berhasil menambahkan Ringkasan Audit/Temuan.');
                redirect(base_url('audit/edit/' . $id));
            } else {
                $this->session->set_flashdata('message', 'Gagal, silakan coba lagi.');
                redirect(base_url('audit/edit/' . $id));
            }
        }
}

$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
$this->data['data'] = $this->prosesAudit_model->get_where(['id' => $id]);
$this->data['page'] = 'audit/pesan_kesalahan';
$this->data['addon'] = '';

$this->load->view('layout', $this->data);
}
public function close($id){
	$dataAudit = $this->prosesAudit_model->get_where(['id' => $id]);
	$this->document_model->update(['status' => 0], ['id' => $dataAudit->document_id]);
        $data = [
            'status' => 'close',
            'end_date' => date("Y-m-d"),
        ];
        if ($this->prosesAudit_model->update($data, ['id' => $id])) {
            $this->session->set_flashdata('message', 'Berhasil....');
            redirect(base_url('audit'));
        } else {
            $this->session->set_flashdata('message', 'Gagal, silakan coba lagi.');
            redirect(base_url('audit'));
        }
}
public function balasan_kesalahan($id){
    $this->form_validation->set_rules('balasan_kesalahan', 'balasan_kesalahan', 'required');
    if (isset($_POST) && !empty($_POST)) {

        if ($this->form_validation->run() === TRUE) {
            $data = [
                'balasan_kesalahan' => $this->input->post('balasan_kesalahan'),
                'document_kesalahan_id' => $this->input->post('document_id'),
				"status" => "menunggu auditor untuk di close",
                'tahapan' => 6,
            ];
            if ($this->prosesAudit_model->update($data, ['id' => $id])) {
                $this->session->set_flashdata('message', 'Berhasil menambahkan pesan kesalahan.');
                redirect(base_url('audit/edit/' . $id));
            } else {
                $this->session->set_flashdata('message', 'Gagal, silakan coba lagi.');
                redirect(base_url('audit/edit/' . $id));
            }
        }
}

$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
$this->data['data'] = $this->prosesAudit_model->get_where(['id' => $id]);
$this->data['page'] = 'audit/balasan_kesalahan';
$this->data['documents'] = $this->document_model->get("status=1");
$this->data['addon'] = '';

$this->load->view('layout', $this->data);
}
public function detail($id){
$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
$this->data['data'] = $this->db->select('a.*, b.nama as nama_bagian,e.file_url as file_url_kesalahan, c.first_name, c.last_name')
->from('proses_audit a')
->join('bagian b',"a.bagian_id = b.id","left")
->join('users c','a.user_id = c.id',"left")
->join('document e','e.id = a.document_kesalahan_id',"left")
->where("a.id", $id)
->get()->row();

$this->data['documents'] = $this->db->select('b.file_url')
->from('document_audit a')
->join('document b',"a.document_id = b.id","left")
->get()->result();


$this->data['page'] = 'audit/detail';
$this->data['addon'] = '';

$this->load->view('layout', $this->data);
}
public function laporanAkhir($id)
{
	 // title dari pdf
	 $this->data['title_pdf'] = 'Laporan Akhir Audit';
	 $this->data['data'] = $this->db->select('a.*, b.nama as nama_bagian,d.file_url,e.file_url as file_url_kesalahan, c.first_name, c.last_name')
						->from('proses_audit a')
						->join('bagian b',"a.bagian_id = b.id","left")
						->join('users c','a.user_id = c.id',"left")
						->join('document d','d.id = a.document_id',"left")
						->join('document e','e.id = a.document_kesalahan_id',"left")
						->where("a.id", $id)
						->get()->row();
						
	$this->data['document_audit'] = $this->db->select('a.*, b.description, b.nama')
	->from('document_audit a')
	->where('audit_id' , $this->data['data']->id)
	->join('document b','b.id = a.document_id','left')
	->get()->result();
	$text = "";
	// echo "<pre>";
	// var_dump($this->data['document_audit']);
	// echo "</pre>";
	// die();
	foreach($this->data['document_audit'] as $index => $doc_audit){
		$index = $index+1;
		$text .= "<p>{$index}. <b>$doc_audit->nama</b></p>";
		$text .= "<p>$doc_audit->description</p>";
	 } 
	 $this->data['text'] = $text;
	 // filename dari pdf ketika didownload
	//  $file_pdf = 'report-akhir-audit';
	//  // setting paper
	//  $paper = 'A4';
	//  //orientasi paper potrait / landscape
	//  $orientation = "portrait";
	//  $html = $this->load->view('audit/laporan_akhir',$this->data, true);	    
	//  // run dompdf
	//  $this->genpdf->generate($html, $file_pdf,$paper,$orientation);
// 	$this->data['page'] = 'audit/laporan_akhir';
// $this->data['addon'] = '';

$this->load->view('audit/laporan_akhir', $this->data);
}
}
