<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('user/templates/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('user/templates/footer');
    }

    public function edit()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('user/templates/header', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('user/templates/footer');
        } else {

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'jpg|jpeg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image',  $new_image);
                } else {
                    $this->session->set_flashdata('error_msg',);
                    $this->session->set_flashdata(
                        'error_msg',
                        '<div class="alert alert-success" role="alert">
                            ' . $this->upload->display_errors() . '
                        </div>'
                    );
                }
            }

            $name = $this->input->post('name');
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    Your profile has been updated!
                </div>'
            );
            redirect('user/edit');
        }
    }

    public function password()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->form_validation->set_rules('password_current', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('password_new', 'New Password', 'required|trim|min_length[3]|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|trim|min_length[3]|matches[password_new]');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/templates/header', $data);
            $this->load->view('user/password', $data);
            $this->load->view('user/templates/footer');
        } else {
            $password_current = $this->input->post('password_current');
            $password_new = $this->input->post('password_new');
            $password_confirm = $this->input->post('password_confirm');
            if (password_verify($password_current, $data['user']['password'])) {
                if ($password_current != $password_new) {
                    $password_hash = password_hash($password_new, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                            Password successfuly changed!
                        </div>'
                    );
                    redirect('user/password');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                            New password cannot be the same as new password!
                        </div>'
                    );
                    redirect('user/password');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                        Wrong current password!
                    </div>'
                );
                redirect('user/password');
            }
        }
    }
}
