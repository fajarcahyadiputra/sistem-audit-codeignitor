<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		$this->load->model('document_model');
	}

	public function index()
	{
		$this->data['page'] = 'document';
		$this->data['addon'] = '<a href="' . base_url('document/tambah') . '" class="btn btn-primary">Tambah document</a>';
		$this->data['document'] = $this->document_model->get("status=1");
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->load->view('layout', $this->data);
	}

	public function arsip_document()
	{
		$this->data['document'] = $this->document_model->get();
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->data['page'] = 'document/arsip';
		$this->data['addon'] = '';

		$this->load->view('layout', $this->data);
	}

	public function tambah()
	{

		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = [
				'nama' => $this->input->post('nama'),
				'status' => 1,
				'description' => $this->input->post('description')
			];
		

                // the user id contain dot, so we must remove it
                $config['upload_path']          = FCPATH.'/upload/documents/';
                $config['allowed_types']        = 'pdf|doc|docx|xlsx';
                $config['overwrite']            = true;
                $config['max_size']             = 111024; // 100mb
                $config['max_width']            = 1080;
                $config['max_height']           = 1080;
                $config['file_name'] = date("now")."_".$_FILES['file_doc']['name']; 

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_doc')) {
                    // var_dump($this->upload->display_errors());
                    $this->session->set_flashdata('message', 'Insert data document berhasil.');
				    redirect(base_url('document'));
                } else {
                  $uploaded_data = $this->upload->data();
                  $data['file_url'] = "/upload/documents/".$uploaded_data['file_name'];
                  if ($this->document_model->insert($data)) {
                    $this->session->set_flashdata('message', 'Insert data document berhasil.');
                    redirect(base_url('document'));
                }
                }
                
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

			$this->data['page'] = 'document/tambah';
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
                // the user id contain dot, so we must remove it
                $config['upload_path']          = FCPATH.'/upload/documents/';
                $config['allowed_types']        = 'pdf|doc|docx|xlsx';
                $config['overwrite']            = true;
                $config['max_size']             = 111024; // 100mb
                $config['max_width']            = 1080;
                $config['max_height']           = 1080;
                $config['file_name'] = date("now")."_".$_FILES['file_doc']['name']; 

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_doc')) {
                    var_dump($this->upload->display_errors());
                    // $this->session->set_flashdata('message', 'Insert data document berhasil.');
				    // redirect(base_url('document'));
                } else {
                  $uploaded_data = $this->upload->data();
                  $data['file_url'] = "/upload/documents/".$uploaded_data['file_name'];
                }
				if ($this->document_model->update($data, ['id' => $id])) {
					$this->session->set_flashdata('message', 'Update data document berhasil.');
					redirect(base_url('document/edit/' . $id));
				} else {
					$this->session->set_flashdata('message', 'Update gagal, silakan coba lagi.');
					redirect(base_url('document/edit/' . $id));
				}
			}
		}

		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

		$this->data['data'] = $this->document_model->get_where(['id' => $id]);
		$this->data['page'] = 'document/edit';
		$this->data['addon'] = '';

		$this->load->view('layout', $this->data);
	}

	public function delete($id)
	{
		if ($this->document_model->delete(['id' => $id])) {
			$this->session->set_flashdata('message', 'Delete data document berhasil.');
			redirect(base_url('document'));
		} else {
			$this->session->set_flashdata('message', 'Delete gagal, silakan coba lagi.');
			redirect(base_url('document'));
		}
	}

	public function detail($id)
	{
		$this->data['data'] = $this->document_model->get_where(['id' => $id]);
		$this->data['page'] = 'document/detail';
		$this->data['addon'] = '';

		$this->load->view('layout', $this->data);
	}

}
