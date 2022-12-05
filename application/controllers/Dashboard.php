<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_data');
		check_not_login();
	}
	
	public function template($view, $data)
	{
		$this->load->view('frontend/head');
		$this->load->view('frontend/side', $data);
		$this->load->view($view, $data);
		$this->load->view('frontend/footer');
	}
	
	public function index()
	{		
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$data = [
			'title' => 'Dashboard',
			'text'	=> 'Control Panel',
			'icon'  => 'dashboard',
			'sess'	=> $query,
			'citem' => $this->m_data->count('p_item'),
			'csupplier' => $this->m_data->count('supplier'),
			'ccustomer' => $this->m_data->count('customer'),
			'cuser' => $this->m_data->count('user')
		];
		$this->template('content/dashboard', $data);
	}
}
