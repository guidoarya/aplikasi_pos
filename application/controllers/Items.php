<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Items extends CI_Controller
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
		$item = $this->m_data->get_2join('p_item', 'p_category', 'p_category.id_category=p_item.id_category', 'p_unit', 'p_unit.id_unit=p_item.id_unit', 'id_item', 'asc');
		$data = [
			'title' 	=> 'Product Items',
			'text'		=> '',
			'icon'  	=> 'archive',
			'sess'		=> $query,
			'item' 		=> $item
		];
		$this->template('content/manage_item/list_items', $data);
	}

	public function add()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$unit = $this->m_data->get_all('p_unit');
		$category = $this->m_data->get_all('p_category');
		$data = [
			'title' => 'Product Items',
			'text'	=> '',
			'icon'  => 'archive',
			'sess'	=> $query,
			'unit'	=> $unit,
			'category'	=> $category
		];
		$this->template('content/manage_item/add_items', $data);
	}

	public function save()
	{
		$post = $this->input->post(null, true);
		$this->form_validation->set_rules('barcode_item', 'Barcode Item', 'required|trim|is_unique[p_item.barcode_item]');
		$this->form_validation->set_rules('name_item', 'Name Item', 'required|trim|is_unique[p_item.name_item]');
		if ($this->form_validation->run() == FALSE) {
			$err = validation_errors();
			$this->session->set_flashdata('failed', $err);
			redirect('items/add');
		} else {
			$data = [
				'barcode_item'	=> $post['barcode_item'],
				'name_item'		=> $post['name_item'],
				'id_category'	=> $post['id_category'],
				'id_unit'		=> $post['id_unit'],
				'price'			=> $post['price']
			];
			$this->m_data->save('p_item', $data);
			$this->session->set_flashdata('success', 'Create Successfully');
			redirect('items');
		}
	}

	public function edit($id)
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$item = $this->m_data->getCondition_2join('p_item', ['id_item' => $id], 'p_category', 'p_category.id_category=p_item.id_category', 'p_unit', 'p_unit.id_unit=p_item.id_unit');
		$unit = $this->m_data->get_all('p_unit');
		$category = $this->m_data->get_all('p_category');
		$data = [
			'title' => 'Product Items',
			'text'	=> '',
			'icon'  => 'archive',
			'sess'	=> $query,
			'item' 	=> $item,
			'unit'	=> $unit,
			'category'	=> $category
		];
		$this->template('content/manage_item/edit_items', $data);
	}

	private function _updateCek($new_name, $validate, $post)
	{
		if ($new_name) {
			if ($validate['barcode_item'] == $post['barcode_item'] && $validate['id_category'] == $post['id_category'] && $validate['id_unit'] == $post['id_unit'] && $validate['price'] == $post['price']) {
				$this->session->set_flashdata('failed', 'Name Item is already in use');
				redirect('items/edit/' . $post['id_item']);
			} else {
				if ($new_name['name_item'] == $validate['name_item']) {
					$this->_update($post);
					$this->session->set_flashdata('success', 'Update Successfully');
					redirect('items');
				} else {
					$this->session->set_flashdata('failed', 'Name Item is already in use');
					redirect('items/edit/' . $post['id_item']);
				}
			}
		} else {
			$this->_update($post);
			$this->session->set_flashdata('success', 'Update Successfully');
			redirect('items');
		}
	}

	private function _update($post)
	{
		$data = [
			'barcode_item'	=> $post['barcode_item'],
			'name_item'		=> $post['name_item'],
			'id_category'	=> $post['id_category'],
			'id_unit'		=> $post['id_unit'],
			'price'			=> $post['price'],
			'updated_at'	=> DATE('Y-m-d H:i:s')
		];
		$this->m_data->update('p_item', $data, ['id_item' => $post['id_item']]);
	}

	public function update()
	{
		$post = $this->input->post(null, true);
		$validate = $this->m_data->get_condition('p_item', ['id_item' => $post['id_item']]);
		$new_barcode = $this->m_data->get_condition('p_item', ['barcode_item' => $post['barcode_item']]);
		$new_name = $this->m_data->get_condition('p_item', ['name_item' => $post['name_item']]);

		if ($new_barcode) {
			if ($validate['name_item'] == $post['name_item'] && $validate['id_category'] == $post['id_category'] && $validate['id_unit'] == $post['id_unit'] && $validate['price'] == $post['price']) {
				$this->session->set_flashdata('failed', 'Barcode Item is already in use');
				redirect('items/edit/' . $post['id_item']);
			} else {
				if ($new_barcode['barcode_item'] != $validate['barcode_item']) {
					$this->session->set_flashdata('failed', 'Barcode Item is already in use');
					redirect('items/edit/' . $post['id_item']);
				} else {
					$this->_updateCek($new_name, $validate, $post);
				}
			}
		} else {
			$this->_updateCek($new_name, $validate, $post);
		}
	}

	public function delete($id)
	{
		$this->m_data->delete('p_item', ['id_item' => $id]);
		$this->session->set_flashdata('success', 'Delete Successfully');
		redirect('items');
	}

	public function barcode_generate($id)
	{
		$item = $this->m_data->get_condition('p_item', ['id_item' => $id]);
		$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		$gambar_barcode = $generator->getBarcode($item['barcode_item'], $generator::TYPE_CODE_128);

		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$item = $this->m_data->get_condition('p_item', ['id_item' => $id]);
		$data = [
			'title' => 'Product Items',
			'text'	=> '',
			'icon'  => 'archive',
			'sess'	=> $query,
			'item' 	=> $item,
			'gambar_barcode' => $gambar_barcode
		];
		$this->template('content/manage_item/barcode', $data);
	}

	public function cetak_barcode($barcode_item)
	{
		$this->load->library('pdfgenerator');
		$item = $this->m_data->get_condition('p_item', ['barcode_item' => $barcode_item]);
		$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		$gambar_barcode = $generator->getBarcode($item['barcode_item'], $generator::TYPE_CODE_128);		

		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$data = [
			'title' => 'SaiTect | Generate Barcode ' . $item['name_item'],
			'text'	=> '',
			'icon'  => 'archive',
			'sess'	=> $query,
			'item' 	=> $item,
			'gambar_barcode' => $gambar_barcode
		];
		$file_pdf = 'cetak';

		$paper = 'A7';

		$orientation = "landscape";
		$html = $this->load->view('content/manage_item/cetak', $data, true);

		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function qr($kodenya)
	{		
		qrcode::png(
			$kodenya,
			$outfile = false,
			$level = QR_ECLEVEL_H,
			$size = 6,
			$margin = 1
		);
	}
}
