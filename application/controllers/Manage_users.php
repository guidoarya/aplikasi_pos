<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_data');
		check_not_login();
		check_not_admin();
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
		$user = $this->m_data->get_all('user');
		$data = [
			'title' => 'Manage User Accounts',
			'text'	=> '',
			'icon'  => 'user',
			'sess'	=> $query,
			'user'	=> $user
		];
		$this->template('content/manage_user/list_users', $data);
	}

	public function add()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$data = [
			'title' => 'Manage User Accounts',
			'text'	=> '',
			'icon'  => 'user',
			'sess'	=> $query
		];
		$this->template('content/manage_user/add_users', $data);
	}

	public function save()
	{
		$post = $this->input->post(NULL, TRUE);

		$config['upload_path']	 = './assets/media/img_user/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']		 = 5000;
		$this->upload->initialize($config);

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password_', 'Password Confirmation', 'matches[password]');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('failed', 'Check your form again');
			redirect('manage_users/add');
		} else {
			if ($_FILES['picture']['name'] != null) {
				if ($this->upload->do_upload('picture')) {

					$upload_data             = array('uploads' => $this->upload->data());
					$config['image_library'] = 'gd2';
					$config['source_image']  = './assets/media/img_user/' . $upload_data['uploads']['file_name'];
					$this->load->library('image_lib', $config);

					$data = [
						'username'	=> $post['username'],
						'password'	=> password_hash(($post['password']), PASSWORD_DEFAULT),
						'name'		=> $post['name'],
						'address'	=> $post['address'],
						'picture'	=> $upload_data['uploads']['file_name'],
						'role'		=> $post['role'],
						'status_active' => 'Active'
					];
					$this->m_data->save('user', $data);
					$this->session->set_flashdata('success', 'Create Successfully');
					redirect('manage_users');
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('failed', $error);
					redirect('manage_users/add');
				}
			} else {
				$pict = 'user.jpg';
				$data = [
					'username'	=> $post['username'],
					'password'	=> password_hash(($post['password']), PASSWORD_DEFAULT),
					'name'		=> $post['name'],
					'address'	=> $post['address'],
					'picture'	=> $pict,
					'role'		=> $post['role'],
					'status_active' => 'Active'
				];
				$this->m_data->save('user', $data);
				$this->session->set_flashdata('success', 'Create Successfully');
				redirect('manage_users');
			}
		}
	}

	public function edit($id)
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$user = $this->m_data->get_condition('user', ['id_user' => $id]);
		$data = [
			'title' => 'Manage User Accounts',
			'text'	=> '',
			'icon'  => 'user',
			'sess'	=> $query,
			'user'	=> $user
		];
		$this->template('content/manage_user/edit_users', $data);
	}

	private function _updateAll($post, $query)
	{
		if ($_FILES['picture']['name'] != null) {
			if ($this->upload->do_upload('picture')) {

				if ($query['picture'] != 'user.jpg') {
					unlink('./assets/media/img_user/' . $query['picture']);
				}

				$upload_data             = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image']  = './assets/media/img_user/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				if ($post['password'] != '') {
					$data = [
						'username'	=> $post['username'],
						'password'	=> password_hash(($post['password']), PASSWORD_DEFAULT),
						'name'		=> $post['name'],
						'address'	=> $post['address'],
						'picture'	=> $upload_data['uploads']['file_name'],
						'role'		=> $post['role']
					];
				} else {
					$data = [
						'username'	=> $post['username'],
						'name'		=> $post['name'],
						'address'	=> $post['address'],
						'picture'	=> $upload_data['uploads']['file_name'],
						'role'		=> $post['role']
					];
				}
				$this->m_data->update('user', $data, ['id_user' => $post['id_user']]);
				$this->session->set_flashdata('success', 'Update Successfully');
				redirect('manage_users');
			} else {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('failed', $error);
				redirect('manage_users/add');
			}
		} else {
			if ($post['password'] != '') {
				$data = [
					'username'	=> $post['username'],
					'password'	=> password_hash(($post['password']), PASSWORD_DEFAULT),
					'name'		=> $post['name'],
					'address'	=> $post['address'],
					'role'		=> $post['role']
				];
			} else {
				$data = [
					'username'	=> $post['username'],
					'name'		=> $post['name'],
					'address'	=> $post['address'],
					'role'		=> $post['role']
				];
			}
			$this->m_data->update('user', $data, ['id_user' => $post['id_user']]);
			$this->session->set_flashdata('success', 'Update Successfully');
			redirect('manage_users');
		}
	}

	private function _update($post, $query, $validate)
	{
		if ($_FILES['picture']['name'] != null) {
			if ($this->upload->do_upload('picture')) {

				if ($query['picture'] != 'user.jpg') {
					unlink('./assets/media/img_user/' . $query['picture']);
				}

				$upload_data             = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image']  = './assets/media/img_user/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				if ($post['password'] != '') {
					$data = [
						'name'		=> $post['name'],
						'password'	=> password_hash(($post['password']), PASSWORD_DEFAULT),
						'address'	=> $post['address'],
						'picture'	=> $upload_data['uploads']['file_name'],
						'role'		=> $post['role']
					];
				} else {
					$data = [
						'name'		=> $post['name'],
						'address'	=> $post['address'],
						'picture'	=> $upload_data['uploads']['file_name'],
						'role'		=> $post['role']
					];
				}
				$this->m_data->update('user', $data, ['id_user' => $post['id_user']]);
				if ($post['username'] == $validate['username']) {
					$this->session->set_flashdata('success', 'Update Successfully');					
				} else {
					$this->session->set_flashdata('success', 'Update Successfully, but username is already in use');
				}
				redirect('manage_users');
			} else {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('failed', $error);
				redirect('manage_users/add');
			}
		} else {
			if ($post['password'] != '') {
				$data = [
					'name'		=> $post['name'],
					'password'	=> password_hash(($post['password']), PASSWORD_DEFAULT),
					'address'	=> $post['address'],
					'role'		=> $post['role']
				];
			} else {
				$data = [
					'name'		=> $post['name'],
					'address'	=> $post['address'],
					'role'		=> $post['role']
				];
			}
			$this->m_data->update('user', $data, ['id_user' => $post['id_user']]);
			if ($post['username'] == $validate['username']) {
				$this->session->set_flashdata('success', 'Update Successfully');					
			} else {
				$this->session->set_flashdata('success', 'Update Successfully, but username is already in use');
			}
			redirect('manage_users');
		}
	}

	public function update()
	{
		$config['upload_path']	 = './assets/media/img_user/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']		 = 5000;
		$this->upload->initialize($config);

		$this->form_validation->set_rules('password', 'Password', 'trim');
		$this->form_validation->set_rules('password_', 'Password Confirmation', 'matches[password]');

		// get all username from user
		$post = $this->input->post(NULL, TRUE);
		$id = $post['id_user'];
		$username = $post['username'];
		$new_username = $this->m_data->get_condition('user', ['username' => $username]);
		$validate = $this->m_data->get_condition('user', ['id_user' => $post['id_user']]);
		$query = $this->m_data->get_condition('user', ['id_user' => $id]);

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('failed', 'Confirm Password no match');
			redirect('manage_users/edit/' . $id);
		} else {
			if ($new_username) {				
				if ($validate['name'] == $post['name'] && $post['password'] == '' && $validate['address'] == $post['address'] && $validate['role'] == $post['role'] && $_FILES['picture']['name'] == '') {
					$this->session->set_flashdata('failed', 'Username is already in use');
					redirect('manage_users/edit/' . $id);
				} else {
					// username yang sudah ada | bukan username baru
					$this->_update($post, $query, $validate);
				}
			} else {
				// username baru
				$this->_updateAll($post, $query);
			}
		}
	}

	public function non_active_account($id)
	{
		$data = [
			'status_active'	=> 'Non Active'
		];
		$this->m_data->update('user', $data, ['id_user' => $id]);
		$this->session->set_flashdata('success', 'Change to Non Active Account Success');
		redirect('manage_users');
	}

	public function active_account($id)
	{
		$data = [
			'status_active'	=> 'Active'
		];
		$this->m_data->update('user', $data, ['id_user' => $id]);
		$this->session->set_flashdata('success', 'Change to Active Account Success');
		redirect('manage_users');
	}

	public function delete($id)
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $id]);
		if ($query['picture'] != 'user.jpg') {
			unlink('./assets/media/img_user/' . $query['picture']);
		}
		$this->m_data->delete('user', ['id_user' => $id]);
		$this->session->set_flashdata('success', 'Data successfully deleted');
		redirect('manage_users');
	}
}
