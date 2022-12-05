<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_data');
	}

	public function login()
	{
		check_already_login();
		$this->load->view('auth/login');
	}

	public function cek_login()
	{
		
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			redirect('auth/login');
		} else {
			$this->_process_login();
		}
	}

	private function _process_login()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->m_data->get_condition('user', ['username' => $post['username']]);
		if($query) {
			if(password_verify($post['password'], $query['password'])) {				
				if($query['status_active'] == 'Active') {
					$data = [
						'id_user'	=> $query['id_user'],
						'role'		=> $query['role']
					];
					$this->session->set_userdata($data);
					$this->session->set_flashdata('login_success', 'Login success :)');
					redirect('dashboard');
				}
			}
		}
		$this->session->set_flashdata('login_fail', 'Login failed, check again your username and password!');
		redirect('auth/login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}

}
