<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends CI_Controller
{

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
		$customer = $this->m_data->get_all('customer');
		$data = [
			'title' 	=> 'Customers',
			'text'		=> '',
			'icon'  	=> 'users',
			'sess'		=> $query,
			'customer' 	=> $customer
		];
		$this->template('content/manage_customer/list_customers', $data);
	}

	public function add()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$data = [
			'title' => 'Customers',
			'text'	=> '',
			'icon'  => 'users',
			'sess'	=> $query
		];
		$this->template('content/manage_customer/add_customers', $data);
	}

	public function save()
	{
		$post = $this->input->post(null, true);
		$data = [
			'name_customer'	=> $post['name_customer'],
			'gender'		=> $post['gender'],
			'phone'			=> $post['phone'],
			'address'		=> $post['address']
		];
		$this->m_data->save('customer', $data);
		$this->session->set_flashdata('success', 'Create Successfully');
		redirect('customers');
	}

	public function edit($id)
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$customer = $this->m_data->get_condition('customer', ['id_customer' => $id]);
		$data = [
			'title' => 'Customers',
			'text'	=> '',
			'icon'  => 'truck',
			'sess'	=> $query,
			'customer' => $customer
		];
		$this->template('content/manage_customer/edit_customers', $data);
	}

	public function update()
	{
		$post = $this->input->post(null, true);
		$data = [
			'name_customer'	=> $post['name_customer'],
			'gender'		=> $post['gender'],
			'phone'			=> $post['phone'],
			'address'		=> $post['address'],
			'updated_at'	=> DATE('Y-m-d H:i:s')
		];
		$this->m_data->update('customer', $data, ['id_customer' => $post['id_customer']]);
		$this->session->set_flashdata('success', 'Update Successfully');
		redirect('customers');
	}

	public function delete($id)
	{
		$this->m_data->delete('customer', ['id_customer' => $id]);
		$this->session->set_flashdata('success', 'Delete Successfully');
		redirect('customers');
	}
}
