<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DataProcessModel');
        $this->load->library('tank_auth'); // Load the Tank_auth library
        $this->load->helper('url'); // Load URL helper for redirects
    }

    // Dashboard page - Only accessible if logged in
    public function index() { 
		
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login'); // If not logged in, redirect to login page
        }
        $user_id = $this->session->userdata('user_id');
        $user_details = $this->tank_auth->get_user_details(); // Get user details from session
        $data['username'] = $user_details->username;
        $data['email'] = $user_details->email;
        $data['files'] = $this->FileModel->get_files_by_user($user_id);
		$data['process_data'] = $this->DataProcessModel->get_process_data_by_user($user_id);
        //var_dump($data['process_data']);die;
		
       $this->template->set('page_title', 'Dashboard');
       $this->template->load('dashboard', 'dashboard',$data);
    }


    // Logout functionality
    public function logout() {
        $this->tank_auth->logout();
        redirect('auth/login'); // Redirect to login page after logout
    }
}
