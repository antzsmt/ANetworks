<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

    public function index()
    {
        $this->load->model('user/user_model');
        $this->load->model('admin_model');
        if (!$this->m_data->isLoggedIn())
        redirect(base_url(),'refresh');
        if ($this->m_data->getPermission($this->session->userdata('ac_sess_username')) != 3)  # Rank for Administrator
          redirect(base_url(),'refresh');
        $this->load->view('header_admin');
        $this->load->view('dashboard');
        $this->load->view('footer_admin');
    }




}
