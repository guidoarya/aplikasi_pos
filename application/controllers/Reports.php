<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
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

    public function sale()
    {
        $sale = $this->m_data->get_2join('t_sale', 'customer', 'customer.id_customer=t_sale.id_customer', 'user', 'user.id_user=t_sale.id_user', 'invoice_sale', 'desc');
        $customer = $this->m_data->get_all('customer');
        $query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
        $data = [
			'title' 	=> 'Sale Reports',
			'text'		=> '',
			'icon'  	=> 'pie-chart',
            'sess'		=> $query,
            'sale'      => $sale,
            'customer'  => $customer
		];
        $this->template('content/report/sale/list', $data);
    }

    public function detail_sale($invoice)
    {
        $query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
        $sales = $this->m_data->getCondition_2join('t_sale', ['invoice_sale' => $invoice], 'customer', 'customer.id_customer=t_sale.id_customer', 'user', 'user.id_user=t_sale.id_user');        
        $cart = $this->m_data->getResult_condition('cart', ['invoice_sale' => $invoice]);
        $data = [
            'title' => 'Sale Reports',
            'text'		=> '',
            'icon'  => 'pie-chart',
            'sess'		=> $query,
            'sales' => $sales,
            'cart' => $cart
        ];
        $this->template('content/report/sale/detail', $data);
    }

    public function print($invoice)
    {
        $this->cetak_struk($invoice);
    }

    private function cetak_struk($invoice)
    {
		$query = $this->m_data->get_condition('user', ['id_user' => $this->session->userdata('id_user')]);
        $sales = $this->m_data->getCondition_2join('t_sale', ['invoice_sale' => $invoice], 'customer', 'customer.id_customer=t_sale.id_customer', 'user', 'user.id_user=t_sale.id_user');        
        $cart = $this->m_data->getResult_condition('cart', ['invoice_sale' => $invoice]);
        $data = [
            'title' => 'Sale Reports',
            'text'		=> '',
            'icon'  => 'pie-chart',
            'sess'		=> $query,
            'sales' => $sales,
            'cart' => $cart
        ];
		$this->load->view('content/report/sale/cetak_struk', $data);
    }

}