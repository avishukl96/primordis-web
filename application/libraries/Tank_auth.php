<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tank_auth {

    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('Tank_auth_model');
    }

    // Register a new user
    public function create_user($username, $email, $password) {
        if ($this->CI->Tank_auth_model->username_exists($username)) {
            return array('status' => 'error', 'message' => 'Username already exists');
        }
        if ($this->CI->Tank_auth_model->email_exists($email)) {
            return array('status' => 'error', 'message' => 'Email already exists');
        }

        $result = $this->CI->Tank_auth_model->create_user($username, $email, $password);
        if ($result) {
            return array('status' => 'success', 'message' => 'User created successfully');
        } else {
            return array('status' => 'error', 'message' => 'Registration failed');
        }
    }

    // Authenticate user during login (Updated to use Email instead of Username)
    public function login($email, $password) {
        $user = $this->CI->Tank_auth_model->authenticate($email, $password);
        if ($user) {
            // Set session data for authenticated user
            $this->CI->session->set_userdata('user_id', $user->id);
            $this->CI->Tank_auth_model->create_session($user->id, $this->CI->input->ip_address(), $this->CI->input->user_agent());
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Check if the user is logged in
    public function is_logged_in() {
        return $this->CI->session->userdata('user_id') ? TRUE : FALSE;
    }

    // Get the logged-in user's ID
    public function get_user_id() {
        return $this->CI->session->userdata('user_id');
    }

    // Get the logged-in user's details
    public function get_user_details() {
        return $this->CI->Tank_auth_model->get_user_by_id($this->get_user_id());
    }

    // Logout the user
    public function logout() {
        $this->CI->Tank_auth_model->delete_session($this->CI->session->userdata('session_id'));
        $this->CI->session->sess_destroy();
    }

    // Get the username of the logged-in user
public function get_username() {
    $user_id = $this->get_user_id(); // Get the logged-in user's ID
    $user = $this->CI->Tank_auth_model->get_user_by_id($user_id); // Retrieve user details by ID

    // Check if the user exists and return their username
    return $user ? $user->username : null;
}
}
?>
