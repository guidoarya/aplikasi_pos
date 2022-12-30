<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Info_app extends CI_Controller
{

    public function index()
    {
        $this->load->view('info_app');
    }

}