<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suppliers extends CI_Controller
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
		$supplier = $this->m_data->get_all('supplier');
		$data = [
			'title' => 'Suppliers',
			'text'	=> '',
			'icon'  => 'truck',
			'sess'	=> $query,
			'supplier' => $supplier
		];
		$this->template('content/manage_supplier/list_suppliers', $data);
	}

	public function add()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$data = [
			'title' => 'Suppliers',
			'text'	=> '',
			'icon'  => 'truck',
			'sess'	=> $query
		];
		$this->template('content/manage_supplier/add_suppliers', $data);
	}

	public function save()
	{
		$post = $this->input->post(null, true);
		$this->form_validation->set_rules('name_supplier', 'Name Supplier', 'required|trim|is_unique[supplier.name_supplier]');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('failed', 'Name Supplier is has been used');
			redirect('suppliers/add');
		} else {
			$data = [
				'name_supplier'	=> $post['name_supplier'],
				'phone'			=> $post['phone'],
				'address'		=> $post['address'],
				'description'	=> $post['description']
			];
			$this->m_data->save('supplier', $data);
			$this->session->set_flashdata('success', 'Create Successfully');
			redirect('suppliers');
		}
	}

	public function edit($id)
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$supplier = $this->m_data->get_condition('supplier', ['id_supplier' => $id]);
		$data = [
			'title' => 'Suppliers',
			'text'	=> '',
			'icon'  => 'truck',
			'sess'	=> $query,
			'supplier' => $supplier
		];
		$this->template('content/manage_supplier/edit_suppliers', $data);
	}

	public function update()
	{
		$post = $this->input->post(null, true);
		$validate = $this->m_data->get_condition('supplier', ['id_supplier' => $post['id_supplier']]);
		$new_name = $this->m_data->get_condition('supplier', ['name_supplier' => $post['name_supplier']]);
		if ($new_name) {
			if ($validate['phone'] == $post['phone'] && $validate['address'] == $post['address'] && $validate['description'] == $post['description']) {
				$this->session->set_flashdata('failed', 'Name Supplier is already in use');
				redirect('suppliers/edit/'.$post['id_supplier']);
			} else {
				$data = [
					'phone'			=> $post['phone'],
					'address'		=> $post['address'],
					'description'	=> $post['description'],
					'updated_at'	=> DATE('Y-m-d H:i:s')
				];
				$this->m_data->update('supplier', $data, ['id_supplier' => $post['id_supplier']]);
				if ($post['name_supplier'] == $validate['name_supplier']) {
					$this->session->set_flashdata('success', 'Update Successfully');
				} else {
					$this->session->set_flashdata('success', 'Update Successfully, but Name Supplier is already in use');
				}
				redirect('suppliers');
			}
		} else {
			$data = [
				'name_supplier'	=> $post['name_supplier'],
				'phone'			=> $post['phone'],
				'address'		=> $post['address'],
				'description'	=> $post['description'],
				'updated_at'	=> DATE('Y-m-d H:i:s')
			];
			$this->m_data->update('supplier', $data, ['id_supplier' => $post['id_supplier']]);
			$this->session->set_flashdata('success', 'Update Successfully');
			redirect('suppliers');
		}
	}

	public function delete($id)
	{
		$this->m_data->delete('supplier', ['id_supplier' => $id]);
		$this->session->set_flashdata('success', 'Delete Successfully');
		redirect('suppliers');
	}
}
