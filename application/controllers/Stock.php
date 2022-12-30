<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_data');
		check_not_login();
	}

	public function template($view, $data)
	{
		$this->load->view('frontend/tanggal_indo');
		$this->load->view('frontend/head');
		$this->load->view('frontend/side', $data);
		$this->load->view($view, $data);
		$this->load->view('frontend/footer');
	}

	public function in_stock()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$stock = $this->m_data->getCondition_3join('t_stock', ['type' => 'in'], 'p_item', 'p_item.id_item=t_stock.id_item', 'supplier', 'supplier.id_supplier=t_stock.id_supplier', 'user', 'user.id_user=t_stock.id_user');
		$data = [
			'title' => 'Stock in',
			'text'	=> '',
			'icon'  => 'shopping-cart',
			'sess'	=> $query,
			'stock' => $stock
		];
		$this->template('content/manage_stock/list_stock', $data);
	}

	public function out_stock()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$stock = $this->m_data->getCondition_3join('t_stock', ['type' => 'out'], 'p_item', 'p_item.id_item=t_stock.id_item', 'supplier', 'supplier.id_supplier=t_stock.id_supplier', 'user', 'user.id_user=t_stock.id_user');
		$data = [
			'title' => 'Stock out',
			'text'	=> '',
			'icon'  => 'shopping-cart',
			'sess'	=> $query,
			'stock' => $stock
		];
		$this->template('content/manage_stock/list_stock', $data);
	}

	public function add_stock_in()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$supplier = $this->m_data->get_all('supplier');
		$item = $this->m_data->get_2join('p_item', 'p_category', 'p_category.id_category=p_item.id_category', 'p_unit', 'p_unit.id_unit=p_item.id_unit', 'id_item', 'asc');
		$supplier = $this->m_data->get_all('supplier');
		$data = [
			'title'     => 'Stock in',
			'text'	    => '',
			'icon'      => 'shopping-cart',
			'sess'	    => $query,
			'supplier'  => $supplier,
			'item'	    => $item,
			'supplier'	=> $supplier
		];
		$this->template('content/manage_stock/add_stock_in_out', $data);
	}

	public function add_stock_out()
	{
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$supplier = $this->m_data->get_all('supplier');
		$item = $this->m_data->getResultCondition_2join('p_item', ['stock > ' => '0'], 'p_category', 'p_category.id_category=p_item.id_category', 'p_unit', 'p_unit.id_unit=p_item.id_unit', 'id_item', 'asc');
		$supplier = $this->m_data->get_all('supplier');
		$data = [
			'title'     => 'Stock out',
			'text'	    => '',
			'icon'      => 'shopping-cart',
			'sess'	    => $query,
			'supplier'  => $supplier,
			'item'	    => $item,
			'supplier'	=> $supplier
		];
		$this->template('content/manage_stock/add_stock_in_out', $data);
	}

	public function processSave()
	{
		$post = $this->input->post(null, true);
		$item = $this->m_data->get_condition('p_item', ['id_item' => $post['id_item']]);
		$stock_awal = $item['stock'];
		
		if ($post['type'] == 'in') {
			$stock = $stock_awal + $post['qty'];
		} elseif ($post['type'] == 'out') {
			if ($post['qty'] <= 0 || $post['qty'] > $stock_awal) {
				$this->session->set_flashdata('failed', 'Qty over in stock');
				redirect('stock-out/add');
			}
			$stock = $stock_awal - $post['qty'];
		}
		
		$data_stock = [
			'id_item'       => $post['id_item'],
			'type'			=> $post['type'],
			'detail'		=> $post['detail'],
			'id_supplier'	=> ($post['id_supplier'] == '' ? NULL : $post['id_supplier']),
			'qty'		    => $post['qty'],
			'date'			=> $post['date'],
			'id_user'	    => $this->session->userdata('id_user')
		];
		$data_item = [
			'stock'	=> $stock
		];

		$this->m_data->save('t_stock', $data_stock);
		$this->m_data->update('p_item', $data_item, ['id_item' => $post['id_item']]);

		if ($post['type'] == 'in') {
			$this->session->set_flashdata('success', 'Add Stock In Successfully');
			redirect('stock-in');
		} elseif ($post['type'] == 'out') {
			$this->session->set_flashdata('success', 'Add Stock Out Successfully');
			redirect('stock-out');
		}
		
	}

	public function delete($id_stock, $id_item, $type)
	{
		$stock = $this->m_data->get_condition('t_stock', ['id_stock' => $id_stock]);
		$item = $this->m_data->get_condition('p_item', ['id_item' => $id_item]);

		$data_tStock = $stock['qty'];
		$data_tItem = $item['stock'];


		if ($type == 'in') {
			$stock = $data_tItem - $data_tStock;
			if ($stock < 0) {
				$stock = 0;
			}
		} elseif ($type == 'out') {
			if ($data_tItem == 0) {
				$stock = 0;
			} else {
				$stock = $data_tItem + $data_tStock;
			}
		}

		$data_item = [
			'stock' => $stock
		];

		$this->m_data->delete('t_stock', ['id_stock' => $id_stock]);
		$this->m_data->update('p_item', $data_item, ['id_item' => $id_item]);
		$this->session->set_flashdata('success', 'Delete Successfully');
		if ($type == 'in') {
			redirect('stock-in');
		} elseif ($type == 'out') {
			redirect('stock-out');
		}
	}
}
