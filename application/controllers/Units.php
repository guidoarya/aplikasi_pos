<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Units extends CI_Controller
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
		$unit = $this->m_data->get_all('p_unit');
		$data = [
			'title' 	=> 'Product Units',
			'text'		=> '',
			'icon'  	=> 'archive',
			'sess'		=> $query,
			'unit' 		=> $unit
		];
		$this->template('content/manage_unit/list_units', $data);
	}

	public function add()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$data = [
			'title' => 'Product Units',
			'text'	=> '',
			'icon'  => 'archive',
			'sess'	=> $query
		];
		$this->template('content/manage_unit/add_units', $data);
	}

	public function save()
	{
		$post = $this->input->post(null, true);
		$this->form_validation->set_rules('name_unit', 'Name Unit', 'required|trim|is_unique[p_unit.name_unit]');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('failed', 'Name Unit is has been used');
			redirect('units/add');
		} else {
			$data = [
				'name_unit'	=> $post['name_unit']
			];
			$this->m_data->save('p_unit', $data);
			$this->session->set_flashdata('success', 'Create Successfully');
			redirect('units');
		}
	}

	public function edit($id)
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$unit = $this->m_data->get_condition('p_unit', ['id_unit' => $id]);
		$data = [
			'title' => 'Product Unit',
			'text'	=> '',
			'icon'  => 'archive',
			'sess'	=> $query,
			'unit' => $unit
		];
		$this->template('content/manage_unit/edit_units', $data);
	}

	public function update()
	{
		$post = $this->input->post(null, true);
		$new_name = $this->m_data->get_condition('p_unit', ['name_unit' => $post['name_unit']]);
		if ($new_name) {
			$this->session->set_flashdata('failed', 'Name Unit is already in use');
				redirect('units/edit/'.$post['id_unit']);
		} else {
			$data = [
				'name_unit'	=> $post['name_unit']
			];
			$this->m_data->update('p_unit', $data, ['id_unit' => $post['id_unit']]);
			$this->session->set_flashdata('success', 'Update Successfully');
			redirect('units');
		}
	}

	public function delete($id)
	{
		$unit = $this->m_data->get_condition('p_unit', ['id_unit' => $id]);
		$this->m_data->delete('p_unit', ['id_unit' => $id]);
		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('failed', $unit['name_unit'].' is relation to the item table');
		} else {
			$this->session->set_flashdata('success', 'Delete Successfully');
		}
		redirect('units');
	}
}
