<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		$this->load->model('userGroupModel');
		$this->load->model('model_group');
		$this->load->model('pengaturan_model');
		$this->load->model('bagian_model');
		
	}

	public function index()
	{
		$this->data['page'] = 'pengguna';
		$this->data['addon'] = '<a href="'.base_url('pengguna/tambah').'" class="btn btn-primary">Tambah Pengguna</a>';
		// $this->data['pengguna'] = $this->ion_auth->users()->result();
		$this->data['pengguna'] = $this->db->select("a.*, c.name as nama_group")->from('users a')->join('users_groups b','a.id = b.user_id','left')->join('groups c','c.id = b.group_id','left')->get()->result();
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->load->view('layout', $this->data);
	}

	public function tambah()
	{
		$tables = $this->config->item('tables', 'ion_auth');
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$email = strtolower($this->input->post('email'));
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$additional_data = [
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'phone' => $this->input->post('phone'),
				"group_id" => $this->input->post("group_id"),
				'bagian_id' => @$this->input->post("bagian_id")
			];
			// if($this->input->post("bagian_id")){
			// 	array_push($additional_data, ['bagian_id' => $this->input->post("bagian_id")]);
			// }
		}
		if ($this->form_validation->run() === TRUE && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			$this->session->set_flashdata('message', $this->ion_auth->messages());

			redirect(base_url('pengguna'));
		}
		else
		{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['page'] = 'pengguna/tambah';
			$this->data['addon'] = '';
			$this->data['groups'] = $this->model_group->get();
			$this->data['bagian'] = $this->bagian_model->get();

			$this->load->view('layout', $this->data);
		}
	}

	public function edit($id)
	{
		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result_array();
		$userGroup = $this->userGroupModel->get_where("user_id = $user->id");
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required');
		$this->form_validation->set_rules('email', $this->lang->line('edit_user_validation_email_label'), 'trim|required');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = [
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
				];

				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				if ($this->ion_auth->update($user->id, $data))
				{
					$this->db->where('user_id', $id);
					$this->db->update('users_groups',['group_id' =>  $this->input->post("group_id")]);
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect(base_url('pengguna/edit/'.$id));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect(base_url('pengguna/edit/'.$id));
				}

			}
		}

		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['pengguna'] = $user;
		$this->data['groups'] = $this->model_group->get();
		$this->data['currentGroups'] = $currentGroups;
		$this->data['page'] = 'pengguna/edit';
		$this->data['userGroup'] = $userGroup;
		$this->data['addon'] = '';
		$this->load->view('layout', $this->data);
	}

	public function delete($id)
	{
		if ($this->ion_auth->delete_user($id)) {
			$this->session->set_flashdata('message', 'Delete data pengguna berhasil.');
			redirect(base_url('pengguna'));
		} else {
			$this->session->set_flashdata('message', 'Delete gagal, silakan coba lagi.');
			redirect(base_url('pengguna'));
		}
	}
	public function getDetailUser($id)
	{
		$user = $this->ion_auth->user($id)->row();
		echo json_encode($user);
	}
}
