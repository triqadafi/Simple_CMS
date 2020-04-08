<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        fi_auth_protection();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('user/templates/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('user/templates/footer');
    }
}
