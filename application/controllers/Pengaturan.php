<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		$this->load->model('pengaturan_model');
	}

	public function index()
	{
		$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim|required');
		$this->form_validation->set_rules('alamat_perusahaan', 'alamat perusahaan', 'trim|required');
		$this->form_validation->set_rules('telp_perusahaan', 'no.telp perusahaan', 'trim|required');
		$this->form_validation->set_rules('email_perusahaan', 'email perusahaan', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = [
				'nama_perusahaan' => $this->input->post('nama_perusahaan'),
				'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
				'telp_perusahaan' => $this->input->post('telp_perusahaan'),
				'email_perusahaan' => $this->input->post('email_perusahaan'),
				'penanggungjawab' => $this->input->post('penanggungjawab'),
			];
			foreach ($data as $key => $value) {
				$check = $this->pengaturan_model->get_where("$key IS NOT NULL", 'pengaturan_umum');
				if ($check) {
					$this->pengaturan_model->update($data, "$key IS NOT NULL", 'pengaturan_umum');
				} else {
					$this->pengaturan_model->insert($data, 'pengaturan_umum');
				}
			}
			$this->session->set_flashdata('message', 'Pengaturan umum berhasil disimpan.');
			redirect(base_url('pengaturan'));
		} else {
			$this->data['title'] = 'Pengaturan Umum';
			$this->data['page'] = 'pengaturan/umum';
			$this->data['addon'] = '';
			$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			$data = [
				'nama_perusahaan',
				'alamat_perusahaan',
				'telp_perusahaan',
				'email_perusahaan',
				'penanggungjawab',
			];
			foreach ($data as $key) {
				$this->data['data'] = $this->pengaturan_model->get_where("$key IS NOT NULL", 'pengaturan_umum');
			}
			$this->load->view('layout', $this->data);
		}
	}

	public function produk()
	{
		$this->form_validation->set_rules('mata_uang', 'mata uang', 'trim|required');
		$this->form_validation->set_rules('satuan_berat', 'satuan berat', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = [
				'mata_uang' => $this->input->post('mata_uang'),
				'satuan_berat' => $this->input->post('satuan_berat')
			];
			foreach ($data as $key => $value) {
				$check = $this->pengaturan_model->get_where("$key IS NOT NULL", 'pengaturan_produk');
				if ($check) {
					$this->pengaturan_model->update($data, "$key IS NOT NULL", 'pengaturan_produk');
				} else {
					$this->pengaturan_model->insert($data, 'pengaturan_produk');
				}
			}
			$this->session->set_flashdata('message', 'Pengaturan produk berhasil disimpan.');
			redirect(base_url('pengaturan/produk'));
		} else {
			$this->data['title'] = 'Pengaturan Produk';
			$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			$this->data['page'] = 'pengaturan/produk';
			$this->data['addon'] = '';
			$data = [
				'mata_uang',
				'satuan_berat'
			];
			foreach ($data as $key) {
				$this->data['data'] = $this->pengaturan_model->get_where("$key IS NOT NULL", 'pengaturan_produk');
			}
			$this->load->view('layout', $this->data);
		}
	}
}
