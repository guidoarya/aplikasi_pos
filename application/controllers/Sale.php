<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sale extends CI_Controller
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

	public function cek_exp_cart($cartBefore)
	{
		foreach($cartBefore as $carts) {
			$cek_sale = $this->m_data->getResult_condition('t_sale', ['invoice_sale' => $carts->invoice_sale]);
			if (!$cek_sale) {
				$cart = $this->m_data->getResult_condition('cart', ['invoice_sale' => $carts->invoice_sale]);
				var_dump($cart);
				foreach ($cart as $del_cart) {
					echo '<br>'.$del_cart->barcode_item.'<br>';
					// $this->_remove_cart($del_cart->barcode_item);
				}
			}
		}
	}

	public function pay()
	{
		$post = $this->input->post(null, true);
		$data = [
			'invoice_sale'	=> $post['invoice'],
			'id_customer'	=> ($post['id_customer'] == '' ? NULL : $post['id_customer']),
			'sub_total'		=> $post['sub_total'],
			'grand_total'	=> $post['sub_total'],
			'cash'			=> $post['cash'],
			'remaining'		=> $post['change'],
			'note'			=> $post['note'],
			'date'			=> $post['date'],
			'id_user'		=> $post['id_user']
		];
		// var_dump($data); die;
		$this->m_data->save('t_sale', $data);
		redirect('sale');
	}

	public function index()
	{
		// $dateNow = date('Y-m-d');
		// $cartBefore = $this->m_data->getResult_condition('cart', ['date_cart !=' => $dateNow]);
		// if ($cartBefore) {
		// 	$this->cek_exp_cart($cartBefore);
		// }
		// die;
		$invoice_sale = $this->m_data->invoice_sale();
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
		$customer = $this->m_data->get_all('customer');
		$item = $this->m_data->getResultCondition_2join('p_item', ['stock >' => '0'], 'p_category', 'p_category.id_category=p_item.id_category', 'p_unit', 'p_unit.id_unit=p_item.id_unit', 'id_item', 'asc');
		$cart = $this->m_data->getResult_condition('cart', ['invoice_sale' => $invoice_sale]);
		$voucher = $this->m_data->get_all('p_voucher');
		$sub_total = $this->m_data->sum('total', 'cart', ['invoice_sale' => $invoice_sale]);
		
		$data = [
			'title' 	=> 'Sale Product',
			'text'		=> '',
			'icon'  	=> 'shopping-cart',
			'sess'		=> $query,
			'customer'	=> $customer,
			'item'		=> $item,
			'cart'		=> $cart,
			'voucher'	=> $voucher,
			'invoice'	=> $invoice_sale,
			'sub_total' => $sub_total
		];
		$this->template('content/transaction/sale', $data);
	}

	public function add_cart()
	{
		$dateNow = date('Y-m-d');
		$post = $this->input->post(null, true);
		$cek_cart = $this->m_data->get_2condition('cart', ['invoice_sale' => $post['invoice']], ['barcode_item' => $post['barcode_item']]);
		$cek_item = $this->m_data->get_condition('p_item', ['barcode_item' => $post['barcode_item']]);

		if ($post['barcode_item'] == null) {
			redirect('sale');
		} else {
			if ($post['qty'] <= $post['stock']) {
				if ($cek_cart) {
					// echo 'true'; die;
					$new_qty = $cek_cart['qty'] + $post['qty'];
					$data_cart = [
						'qty'			=> $new_qty,
						'total'			=> $post['price'] * $new_qty
					];
					$this->m_data->update('cart', $data_cart, ['barcode_item' => $post['barcode_item']]);
				} else {
					// echo 'false'; die;
					$data_cart = [
						'invoice_sale'	=> $post['invoice'],
						'barcode_item'	=> $post['barcode_item'],
						'product_item'	=> $post['product_item'],
						'price'			=> $post['price'],
						'qty'			=> $post['qty'],
						'total'			=> $post['price'] * $post['qty'],
						'date_cart'		=> $dateNow
					];
					$this->m_data->save('cart', $data_cart);
				}
				$data_stock = [
					'stock' => ($cek_item['stock'] - $post['qty'])
				];
				$this->m_data->update('p_item', $data_stock, ['barcode_item' => $post['barcode_item']]);
			}
			redirect('sale');
		}
	}

	public function del_cart($kode_item)
	{
		$this->_remove_cart($kode_item);
		redirect('sale');
	}

	private function _remove_cart($kode_item)
	{
		$cek_item = $this->m_data->get_condition('p_item', ['barcode_item' => $kode_item]);
		$cek_cart = $this->m_data->get_condition('cart', ['barcode_item' => $kode_item]);
		$data_stock = [
			'stock'	=> $cek_item['stock'] + $cek_cart['qty']
		];
		$this->m_data->update('p_item', $data_stock, ['barcode_item' => $kode_item]);
		$this->m_data->delete('cart', ['barcode_item' => $kode_item]);
	}

	public function del_sale()
	{
		$invoice_sale = $this->m_data->invoice_sale();
		$cart = $this->m_data->getResult_condition('cart', ['invoice_sale' => $invoice_sale]);
		foreach($cart as $carts) {
			$this->_remove_cart($carts->barcode_item);
		}
		redirect('sale');
	}

}