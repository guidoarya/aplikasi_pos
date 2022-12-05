<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
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
		$category = $this->m_data->get_all('p_category');
		$data = [
			'title' 	=> 'Product Categories',
			'text'		=> '',
			'icon'  	=> 'archive',
			'sess'		=> $query,
			'category' 	=> $category
		];
		$this->template('content/manage_category/list_categories', $data);
	}

	public function add()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$data = [
			'title' => 'Product Categories',
			'text'	=> '',
			'icon'  => 'archive',
			'sess'	=> $query
		];
		$this->template('content/manage_category/add_categories', $data);
	}

	public function save()
	{
		$post = $this->input->post(null, true);
		$this->form_validation->set_rules('name_category', 'Name Category', 'required|trim|is_unique[p_category.name_category]');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('failed', 'Name Category is has been used');
			redirect('categories/add');
		} else {
			$data = [
				'name_category'	=> $post['name_category']
			];
			$this->m_data->save('p_category', $data);
			$this->session->set_flashdata('success', 'Create Successfully');
			redirect('categories');
		}
	}

	public function edit($id)
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$category = $this->m_data->get_condition('p_category', ['id_category' => $id]);
		$data = [
			'title' => 'Product Categories',
			'text'	=> '',
			'icon'  => 'archive',
			'sess'	=> $query,
			'category' => $category
		];
		$this->template('content/manage_category/edit_categories', $data);
	}

	public function update()
	{
		$post = $this->input->post(null, true);
		$new_name = $this->m_data->get_condition('p_category', ['name_category' => $post['name_category']]);
		if ($new_name) {
			$this->session->set_flashdata('failed', 'Name Category is already in use');
			redirect('categories/edit/' . $post['id_category']);
		} else {
			$data = [
				'name_category'	=> $post['name_category']
			];
			$this->m_data->update('p_category', $data, ['id_category' => $post['id_category']]);
			$this->session->set_flashdata('success', 'Update Successfully');
			redirect('categories');
		}
	}

	public function delete($id)
	{
		$category = $this->m_data->get_condition('p_category', ['id_category' => $id]);
		$this->m_data->delete('p_category', ['id_category' => $id]);
		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('failed', $category['name_category'].' is relation to the item table');
		} else {
			$this->session->set_flashdata('success', 'Delete Successfully');
		}
		redirect('categories');
	}
}
