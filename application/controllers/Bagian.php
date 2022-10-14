<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bagian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		$this->load->model('bagian_model');
	}

	public function index()
	{
		$this->data['page'] = 'bagian';
		$this->data['addon'] = '<a href="' . base_url('bagian/tambah') . '" class="btn btn-primary">Tambah Bagian</a>';
		$this->data['bagian'] = $this->bagian_model->get();
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->load->view('layout', $this->data);
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = [
				'nama' => $this->input->post('nama'),
				'description' => $this->input->post('description')
			];
			// if($this->input->post('description')){
			// 	$data
			// }
			if ($this->bagian_model->insert($data)) {
				$this->session->set_flashdata('message', 'Insert berhasil.');
				redirect(base_url('bagian'));
			}
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

			$this->data['page'] = 'bagian/tambah';
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

				if ($this->bagian_model->update($data, ['id' => $id])) {
					$this->session->set_flashdata('message', 'Update berhasil.');
					redirect(base_url('bagian/edit/' . $id));
				} else {
					$this->session->set_flashdata('message', 'Update gagal, silakan coba lagi.');
					redirect(base_url('bagian/edit/' . $id));
				}
			}
		}

		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

		$this->data['data'] = $this->bagian_model->get_where(['id' => $id]);
		$this->data['page'] = 'bagian/edit';
		$this->data['addon'] = '';

		$this->load->view('layout', $this->data);
	}

	public function delete($id)
	{
		if ($this->bagian_model->delete(['id' => $id])) {
			$this->session->set_flashdata('message', 'Delete data bagian berhasil.');
			redirect(base_url('bagian'));
		} else {
			$this->session->set_flashdata('message', 'Delete gagal, silakan coba lagi.');
			redirect(base_url('bagian'));
		}
	}

}
