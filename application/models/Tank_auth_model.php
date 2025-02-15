<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tank_auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // User registration
    public function create_user($username, $email, $password) {
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'created_at' => date('Y-m-d H:i:s'),
        );
        return $this->db->insert('users', $data);
    }

    // Check if the username exists
    public function username_exists($username) {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->num_rows() > 0;
    }

    // Check if the email exists
    public function email_exists($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->num_rows() > 0;
    }

    // Authenticate the user using email and password
    public function authenticate($email, $password) {
        $this->db->select('id, email, password');
        $query = $this->db->get_where('users', array('email' => $email));
        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user; // Return user data if authentication is successful
            }
        }
        return FALSE;
    }

    // Get user information by ID
    public function get_user_by_id($user_id) {
        $query = $this->db->get_where('users', array('id' => $user_id));
        return $query->row();
    }

    // Create session data for the user
    public function create_session($user_id, $ip_address, $user_agent) {
        $session_data = array(
            'user_id' => $user_id,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent,
            'last_activity' => time()
        );
        $this->db->insert('users_sessions', $session_data);
    }

    // Check if user session is valid
    public function validate_session($session_id, $user_id) {
        $query = $this->db->get_where('users_sessions', array('id' => $session_id, 'user_id' => $user_id));
        return $query->num_rows() > 0;
    }

    // Update last activity time for the session
    public function update_last_activity($session_id) {
        $this->db->update('users_sessions', array('last_activity' => time()), array('id' => $session_id));
    }

    // Delete session
    public function delete_session($session_id) {
        $this->db->delete('users_sessions', array('id' => $session_id));
    }
}
