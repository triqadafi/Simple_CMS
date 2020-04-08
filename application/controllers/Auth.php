<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        fi_auth_protection();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/templates/header');
            $this->load->view('auth/login');
            $this->load->view('auth/templates/footer');
        } else {
            $this->login();
        }
    }

    private function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                            Wrong password!
                        </div>'
                    );
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                        This Email is not activated!
                    </div>'
                );
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                    Email is not registered!
                </div>'
            );
        }
        $data = array(
            'errors' => validation_errors(),
            'email' => $email
        );

        $this->load->view('auth/templates/header');
        $this->load->view('auth/login', $data);
        $this->load->view('auth/templates/footer');
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/templates/header');
            $this->load->view('auth/registration');
            $this->load->view('auth/templates/footer');
        } else {
            $email = $this->input->post('email');
            $data = [
                'name' => htmlspecialchars($this->input->post('name')),
                'lastname' => htmlspecialchars($this->input->post('lastname')),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);


            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'action' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user_token', $user_token);
            $this->sendEmail($email, $token, 'verify');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    Congratulation your account has been created. Please check your email!
                </div>'
            );
            redirect('auth');
        }
    }

    private function sendEmail($email, $token, $type)
    {
        $this->load->library('email');
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'YOURGMAIL';
        $config['smtp_pass'] = 'YOURPASSWORD';
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");


        $this->email->from('jumperputus@gmail.com', 'Jumper Putus');
        $this->email->to($email);
        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $url = base_url() . 'auth/verify?token=' . urlencode($token);
            $this->email->message('Click this link to verify your account <a href="' . $url . '">' . $url . '</a>');
        } else if ($type == 'recovery') {
            $this->email->subject('Account Recovery');
            $url = base_url() . 'auth/verify?token=' . urlencode($token);
            $this->email->message('Click this link to recover your account <a href="' . $url . '">' . $url . '</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function verify()
    {
        $token = $this->input->get('token');

        $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
        $email = $user_token['email'];
        $action = $user_token['action'];

        if ($user_token) {
            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            if ($user) {
                if (time() - $user_token['date_created'] < (60 * 60 * 1)) {

                    if ($action == 1) {
                        $this->db->set('is_active', 1);
                        $this->db->where('email', $email);
                        $this->db->update('user');

                        $this->db->delete('user_token', ['email' => $email]);

                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-success" role="alert">
                            Account with ' . $email . ' activated! You can login now.
                        </div>'
                        );
                        redirect('auth');
                    } else if ($action == 2) {
                        echo "test";
                        $this->session->set_userdata('reset_email', $email);

                        $this->recoveryAction();
                    }
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                        Authentification failed! Token expired!
                    </div>'
                    );
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                        Authentification failed! Wrong email!
                    </div>'
                );
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                    Authentification failed! Token invalid.
                </div>'
            );
            redirect('auth');
        }
    }

    public function recovery()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/templates/header');
            $this->load->view('auth/recovery');
            $this->load->view('auth/templates/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            if ($user) {
                if ($user['is_active'] == 1) {
                    $token = base64_encode(random_bytes(32));
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'action' => 2,
                        'date_created' => time()
                    ];
                    $this->db->insert('user_token', $user_token);
                    $this->sendEmail($email, $token, 'recovery');

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                            Check your email to reset the password!
                        </div>'
                    );
                    redirect('auth');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                            This Email is not activated!
                        </div>'
                    );
                    redirect('auth/recovery');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                        Email is not registered!
                    </div>'
                );
                redirect('auth/recovery');
            }
        }
    }

    public function recoveryAction()
    {
        $reset_email = $this->session->userdata('reset_email');

        if (!$reset_email) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'New Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/templates/header');
            $this->load->view('auth/recovery-password');
            $this->load->view('auth/templates/footer');
        } else {
            $password_new = $this->input->post('password1');
            $password_hash = password_hash($password_new, PASSWORD_DEFAULT);
            $this->db->set('password', $password_hash);
            $this->db->where('email', $reset_email);
            $this->db->update('user');

            $this->db->delete('user_token', ['email' => $reset_email]);
            $this->session->unset_userdata('reset_email', $reset_email);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    Password has been change! You can login now!
                </div>'
            );
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
                You have been logged out!
            </div>'
        );
        redirect('auth');
    }


    public function forbidden()
    {
        $this->load->view('auth/templates/header');
        $this->load->view('forbidden');
        $this->load->view('auth/templates/footer');
    }
}
