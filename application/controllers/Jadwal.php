<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		$this->load->model('jadwal_model');
		
	}

	public function tambah()
	{
		$data = [
			'judul' => $this->input->post('judul'),
			'mulai' => $this->input->post('mulai'),
			'selesai' => $this->input->post('selesai')
		];
		// if($this->input->post('description')){
		// 	$data
		// }
		if ($this->jadwal_model->insert($data)) {
			$this->session->set_flashdata('message', 'Insert jadwal berhasil.');
			redirect(base_url('dashboard'));
		}
	}
}