<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the Tank Auth library and the session library
        $this->load->library('tank_auth');
        $this->load->library('session');
    }

    // Show login page
    public function login() {
        // Check if the user is already logged in
        if ($this->tank_auth->is_logged_in()) {
            redirect('dashboard');
        }
        // Load the login view
        $this->load->view('auth/login');
    }

    // Process login
    public function login_process() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
    
        // Check if the user exists and is approved
        $user = $this->db->get_where('users', array('email' => $email))->row();
    
        if ($user) {
            // Check if the user is approved
            if ($user->status == 'approved') {
                // Attempt to log in using Tank Auth
                if ($this->tank_auth->login($email, $password)) {
                    // Redirect to dashboard if login is successful
                    redirect('dashboard');
                } else {
                    // Set flashdata message for invalid login credentials
                    $this->session->set_flashdata('error', 'Invalid email or password');
                    redirect('auth/login');
                }
            } else {
                // Set flashdata message if the user is not approved
                $this->session->set_flashdata('error', 'Your account hasn\'t been approved yet');
                redirect('auth/login');
            }
        } else {
            // Set flashdata message if the user does not exist
            $this->session->set_flashdata('error', 'No account found with that email address');
            redirect('auth/login');
        }
    }
    
    // Show registration page
    public function register() {
         // Check if the user is already logged in
         if ($this->tank_auth->is_logged_in()) {
            redirect('dashboard');
        }
        // Load the registration view
        $this->load->view('auth/register');
    }

    // Process registration
    public function register_process() {
    $username = $this->input->post('username');
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $response = $this->tank_auth->create_user($username, $email, $password);
    
    if ($response['status'] === 'success') {
        $this->session->set_flashdata('success', $response['message']);
        redirect('auth/login');
    } else {
        $this->session->set_flashdata('error', $response['message']);
        redirect('auth/register');
    }
}

    // Logout the user
    public function logout() {
        // Log the user out
        $this->tank_auth->logout();
        // Redirect to login page
        redirect('auth/login');
    }
}
