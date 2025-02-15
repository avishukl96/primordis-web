<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->helper('url');
    }

    /**
     * Test Database Connection
     */
    public function test_db_connection() {
        if ($this->db->conn_id) {
            echo "Database connection successful.";
        } else {
            echo "Database connection failed.";
        }
    }

    /**
     * Seed Default Admin
     */
    public function seed_default_admin() {
        $data = [
            'admin_name' => 'Admin',
            'admin_email' => 'admin@primordis.tech',
            'password'   => password_hash('Admin@primordis.tech', PASSWORD_BCRYPT), // Secure password hash
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        try {
            $inserted = $this->Admin_model->insert_admin($data);
            if ($inserted) {
                echo "Default admin has been successfully created.";
            } else {
                echo "Failed to insert default admin.";
            }
        } catch (Exception $e) {
            log_message('error', 'Error seeding default admin: ' . $e->getMessage());
            echo "An error occurred while creating the default admin.";
        }
    }

    /**
     * Process Admin Login
     */
    public function login_process() {
        if ($this->session->userdata('admin_id')) {
            redirect('cp/admin/');
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Query the database to get the admin data by email
        $admin = $this->Admin_model->login($email);

        if ($admin && password_verify($password, $admin['password'])) {
            // If admin exists and the password matches
            $this->session->set_userdata('admin_id', $admin['id']);
            redirect('cp/admin/');
        } else {
            // Invalid email or password
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('cp/admin/login');
        }
    }

    /**
     * Admin Login Page
     */
    public function login() {
        if ($this->session->userdata('admin_id')) {
            redirect('cp/admin/dashboard');
        }
        $this->load->view('cp/login');
    }

    /**
     * Admin Dashboard
     */
    public function index($status = null) {

        //var_dump($status);
        $this->is_logged_in();
        $data['total_users'] = $this->Admin_model->count_users();
        $data['pending_users'] = $this->Admin_model->count_users('pending');
        $data['approved_users'] = $this->Admin_model->count_users('approved');
        $data['rejected_users'] = $this->Admin_model->count_users('rejected');
        $data['get_all_users'] = $this->Admin_model->get_all_users($status);
        //$data['Contact_leads'] = $this->Admin_model->get_count_contact_leads();
        $data['selected_status'] = $status;
        $this->load->view('cp/header', $data);
        $this->load->view('cp/dashboard', $data);
        $this->load->view('cp/footer', $data);
    }

    //Contact Leads
    public function contact_leads($status = null) {
        $this->is_logged_in();
        $data['Contact_leads_count'] = $this->Admin_model->get_count_contact_leads();
        $data['get_new_contacts'] = $this->Admin_model->get_new_contacts();
        $data['get_already_contacted'] = $this->Admin_model->get_already_contacted();
        $data['get_spam_contacts'] = $this->Admin_model->get_spam_contacts();
        $data['Contact_leads'] = $this->Admin_model->get_contact_leads($status);
        $data['selected_status'] = $status;
            $this->load->view('cp/header', $data);
        $this->load->view('cp/contact_leads', $data);
        $this->load->view('cp/footer', $data);
    }


     //Processsed Data
     public function processed_data($status = null) {
        $this->is_logged_in();
        $data['total_count'] = $this->Admin_model->get_count_Process_data();
        // $data['get_new_contacts'] = $this->Admin_model->get_new_contacts();
        // $data['get_already_contacted'] = $this->Admin_model->get_already_contacted();
        // $data['get_spam_contacts'] = $this->Admin_model->get_spam_contacts();
        $data['Process_data'] = $this->Admin_model->get_Process_data($status);
        $data['selected_status'] = $status;
        $this->load->view('cp/header', $data);
        $this->load->view('cp/process_data', $data);
        $this->load->view('cp/footer', $data);
    }
        

    /**
     * List of Pending Users
     */
    public function pending_users() {
        $this->is_logged_in();
        $data['users'] = $this->Admin_model->get_users_by_status('pending');
        $this->load->view('cp/pending_users', $data);
    }

    /**
     * Approve User
     */
    // public function approve($id) {
    //     $this->is_logged_in();
    //     try {
    //         $this->Admin_model->update_user_status($id, 'approved');
    //         $this->session->set_flashdata('message', 'User approved successfully.');
    //     } catch (Exception $e) {
    //         log_message('error', 'Error approving user: ' . $e->getMessage());
    //         $this->session->set_flashdata('error', 'An error occurred while approving the user.');
    //     }
    //     redirect('cp/pending_users');
    // }

    // /**
    //  * Reject User
    //  */
    // public function reject($id) {
    //     $this->is_logged_in();
    //     try {
    //         $this->Admin_model->update_user_status($id, 'rejected');
    //         $this->session->set_flashdata('message', 'User rejected successfully.');
    //     } catch (Exception $e) {
    //         log_message('error', 'Error rejecting user: ' . $e->getMessage());
    //         $this->session->set_flashdata('error', 'An error occurred while rejecting the user.');
    //     }
    //     redirect('cp/pending_users');
    // }

    /**
     * Change User Status (approved/rejected/pending)
     */
    public function change_status($id) {
        $this->is_logged_in();
        $new_status = $this->input->post('status');
        
        try {
            if ($new_status) {
                $this->Admin_model->update_user_status($id, $new_status);
                $this->session->set_flashdata('message', 'User status updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Invalid status provided.');
            }
        } catch (Exception $e) {
            log_message('error', 'Error updating user status: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'An error occurred while updating the user status.');
        }
        redirect('cp/pending_users');
    }

    /**
     * Logout Admin
     */
    public function logout() {
        $this->session->unset_userdata('admin_id');
        redirect('cp/admin/login');
    }

    /**
     * Check if Admin is Logged In
     */
    private function is_logged_in() {
        if (!$this->session->userdata('admin_id')) {
            redirect('cp/admin/login');
        }
    }

    /**
     * Handle the Admin Profile Page
     */
    public function profile() {
        $this->is_logged_in();
        $data['admin'] = $this->Admin_model->get_admin_profile($this->session->userdata('admin_id'));
        $this->load->view('cp/profile', $data);
    }

    /**
     * Change Admin Password
     */
    public function change_password() {
        $this->is_logged_in();
        $this->load->view('cp/change_password');
    }

    /**
     * Process Password Change
     */
    public function update_password() {
        $this->is_logged_in();
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        $admin = $this->Admin_model->get_admin_profile($this->session->userdata('admin_id'));

        if (password_verify($current_password, $admin['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $this->Admin_model->update_password($this->session->userdata('admin_id'), $hashed_password);
                $this->session->set_flashdata('message', 'Password updated successfully.');
                redirect('cp/profile');
            } else {
                $this->session->set_flashdata('error', 'New passwords do not match.');
            }
        } else {
            $this->session->set_flashdata('error', 'Current password is incorrect.');
        }

        redirect('cp/change_password');
    }


    // Controller: AdminController.php

public function change_user_status($status,$user_id) {
 
    // Validate the status
    $valid_statuses = ['pending', 'approved', 'rejected'];
    
    if (in_array($status, $valid_statuses)) {
        // Call the model function to change the status
        $update_success = $this->Admin_model->change_user_status($user_id, $status);
        
        if ($update_success) {
            // Set success message and redirect
            $this->session->set_flashdata('success', 'User status updated successfully.');
            
        } else {
            // Set failure message and redirect
            $this->session->set_flashdata('error', 'Failed to update user status.');
        }
    } else {
        // Invalid status, show error
        $this->session->set_flashdata('error', 'Invalid status.');
    }

    redirect('cp/admin/index');  // Redirect to dashboard or relevant page
}


public function change_contact_status($status,$contact_id) {
 
    // Validate the status
    $valid_statuses = ['0', '1', '2']; 
    
    if (in_array($status, $valid_statuses)) {
        // Call the model function to change the status
        $update_success = $this->Admin_model->change_contact_status($contact_id, $status);
        
        if ($update_success) {
            // Set success message and redirect
            $this->session->set_flashdata('success', 'User status updated successfully.');
            
        } else {
            // Set failure message and redirect
            $this->session->set_flashdata('error', 'Failed to update user status.');
        }
    } else {
        // Invalid status, show error
        $this->session->set_flashdata('error', 'Invalid status.');
    }

    redirect('cp/admin/contact_leads');  // Redirect to dashboard or relevant page
}

}
