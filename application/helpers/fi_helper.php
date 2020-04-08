<?php
function fi_auth_protection()
{
    $ci = get_instance();
    $segment = $ci->uri->segment(1);
    $email = $ci->session->userdata('email');
    if ($email) {
        $user = $ci->db->get_where('user', ['email' => $email])->row_array();
        $role_id = $user['role_id'];
        if ($segment == 'auth') {
            if ($role_id == 1) {
                redirect('admin');
            } else {
                redirect('user');
            }
        }
        if ($segment == 'admin' && $role_id != 1) {
            redirect('auth/forbidden');
        }
    } else {
        if ($segment != 'auth') {
            redirect('auth');
        }
    }
}
