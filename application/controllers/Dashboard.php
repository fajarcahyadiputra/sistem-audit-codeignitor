<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		$this->load->model('jadwal_model');
		$this->load->model('prosesAudit_model');
		$this->load->model('userGroupModel');
	}
	public function index()
	{
		$user_id = $this->session->userdata()? $this->session->userdata()['user_id'] : '';
		$output['page'] = 'dashboard';
		$this->db->where('status', 'close');
		$output['jml_audit_close'] = $this->db->get('proses_audit')->num_rows();
		$this->db->where_not_in('status', 'close');
		$output['jml_audit_proses'] = $this->db->get('proses_audit')->num_rows();
		$output['jml_document'] = $this->db->get('document')->num_rows();
		$output['jadwal'] =$this->prosesAudit_model->get('user_id', $user_id);
		$output['jadwal'] = $this->db->select('a.tahapan,a.start_date,a.id, a.end_date, a.kisi_kisi, a.status, a.pesan_kesalahan, b.nama,d.file_url, c.first_name, c.last_name')
        ->from('proses_audit a')
        ->join('bagian b',"a.bagian_id = b.id","left")
        ->join('users c','a.user_id = c.id',"left")
        ->join('document d','d.id = a.document_id',"left")
		->order_by("a.id", 'DESC')
        ->get()->result();
		$user = $this->db->get_where('users',["id " => $this->session->userdata()['user_id']])->row();
		// var_dump($user); die();
		if($user->bagian_id != NULL){
			$output['audit_user'] = $this->db->select('a.tahapan,a.start_date,a.id, a.end_date, a.kisi_kisi, a.status, a.pesan_kesalahan, b.nama,d.file_url, c.first_name, c.last_name')
			->from('proses_audit a')
			->join('bagian b',"a.bagian_id = b.id","left")
			->join('users c','a.user_id = c.id',"left")
			->join('document d','d.id = a.document_id',"left")
			->where('a.status !=', 'close')
			->where('b.id', $user->bagian_id)
			->order_by("a.id", 'DESC')
			->get()->result();
		}
		
		// $messages = "*list audit* \n";
		// foreach($audit_user as $audit){
		// 	$messages .= "start audit: $audit->start_date \n;
		// 	  			 kisi-kisi: $audit->kisi_kisi \n;
		// 				status: $audit->status \n";
		// }
		// "kasus covid pada tanggal *${infoCovid.update.penambahan.tanggal}* \n\nTotal jumblah positif : ${infoCovid.update.penambahan.jumlah_positif}\nTotal jumblah meninggal : ${infoCovid.update.penambahan.jumlah_meninggal}\nTotal jumblah di rawat : ${infoCovid.update.penambahan.jumlah_dirawat}"
		// $messages .= "\n\n";
		// $output['message'] = $messages;
		// var_dump($messages);
		// die();
		// $output['addon'] = '<p class="stat"><span class="label label-info">'.$output['jml_penawaran'].'</span> Total Penawaran</p>
		// // <p class="stat"><span class="label label-warning">'.$pnwrn_pending.'</span> Penawaran Pending</p>
		// // <p class="stat"><span class="label label-success">'.$pnwrn_finish.'</span> Penawaran Selesai</p>';
		$this->load->view('layout', $output);
	}
    public function manipulasiTanggal($tgl,$jumlah=1,$format='days'){
		$currentDate = $tgl;
		return date('Y-m-d', strtotime($jumlah.' '.$format, strtotime($currentDate)));
	}
}
