<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    /**
     * Insert Admin
     */
    public function insert_admin($data) {
        try {
            // Check if admin already exists
            if ($this->check_admin_exists($data['admin_email'])) {
                throw new Exception('Admin with this email already exists.');
            }

            // Insert data into the 'admins' table
            if ($this->db->insert('admins', $data)) {
                // Return the last inserted ID if insert is successful
                return $this->db->insert_id();
            } else {
                // If insert fails, throw an exception
                throw new Exception("Error inserting data into the 'admins' table.");
            }
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in insert_admin: ' . $e->getMessage());
            // Return false if an exception is caught
            return false;
        }
    }

    /**
     * Admin login check by email
     */
    public function login($email) {
        try {
            // Fetch admin data by email
            $this->db->where('admin_email', $email);
            $query = $this->db->get('admins');
            
            if ($query->num_rows() > 0) {
                // Return admin details if found
                return $query->row_array();
            } else {
                // Return false if no admin is found
                throw new Exception('Admin not found');
            }
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in login: ' . $e->getMessage());
            // Return false if an exception is caught
            return false;
        }
    }

    /**
     * Get users by status (pending, approved, rejected)
     */
    public function get_users_by_status($status) {
        try {
            if (!empty($status)) {
                $this->db->where('status', $status);
                $query = $this->db->get('users');
                return $query->result_array();
            }
            return [];
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in get_users_by_status: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Update user status
     */
    public function update_user_status($user_id, $status) {
        try {
            if (!empty($user_id) && !empty($status)) {
                $this->db->where('id', $user_id);
                if ($this->db->update('users', ['status' => $status])) {
                    return true;
                } else {
                    throw new Exception('Failed to update user status.');
                }
            }
            return false;
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in update_user_status: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Count users by status
     */
    public function count_users($status = null) {
        try {
            if ($status) {
                $this->db->where('status', $status);
            }
            return $this->db->count_all_results('users');
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in count_users: ' . $e->getMessage());
            return 0;
        }
    }

    

    public function get_all_users($status = null) {
        try {
            if ($status) {
                $this->db->where('status', $status);
            }
            return $this->db->get('users')->result_array();
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in count_users: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Check if an admin exists by email
     */
    public function check_admin_exists($email) {
        try {
            $this->db->where('admin_email', $email);
            $query = $this->db->get('admins');
            return $query->num_rows() > 0;
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in check_admin_exists: ' . $e->getMessage());
            return false;
        }
    }

    public function change_user_status($id, $status) {
        try {
            // Sanitize input
            $id = (int)$id;
            $status = trim($status);
    
            // Validate the status
            $valid_statuses = ['pending', 'approved', 'rejected'];
            if (in_array($status, $valid_statuses)) {
                // Update the user's status in the database
                $this->db->where('id', $id);
                $update_data = array('status' => $status);
    
                // Execute update and return the result (true or false)
                if ($this->db->update('users', $update_data)) {
                    return true; // Return true if update is successful
                } else {
                    throw new Exception('Failed to update user status.');
                }
            } else {
                // Throw an exception if invalid status is provided
                throw new Exception('Invalid status provided.');
            }
        } catch (Exception $e) {
            // Log the error and return false
            log_message('error', 'Error in change_user_status: ' . $e->getMessage());
            return false; // Return false on error
        }
    }

    public function change_contact_status($id, $status) {
        try {
            // Sanitize input
            $id = (int)$id;
            $status = trim($status);
    
            // Validate the status
            $valid_statuses = ['0', '1', '2'];
            if (in_array($status, $valid_statuses)) {
                // Update the user's status in the database
                $this->db->where('id', $id);
                $update_data = array('status' => $status);
                // Execute update and return the result (true or false)
                if ($this->db->update('contact_us', $update_data)) {
                    return true; // Return true if update is successful
                } else {
                    throw new Exception('Failed to update user status.');
                }
            } else {
                // Throw an exception if invalid status is provided
                throw new Exception('Invalid status provided.');
            }
        } catch (Exception $e) {
            // Log the error and return false
            log_message('error', 'Error in change_user_status: ' . $e->getMessage());
            return false; // Return false on error
        }
    }



       /**
     * Count get_count_contact_leads
     */
    public function get_count_Process_data() {
        try {
            return $this->db->count_all_results('process_data');
        } catch (Exception $e) {

            log_message('error', 'Error in count_users: ' . $e->getMessage());
            return 0;
        }
    }

      /**
     * Count get_count_contact_leads
     */
    // public function get_Process_data($status = NULL ) {
    //     try {
    //         if (isset($status)) {
    //             $this->db->where('status', $status);
    //         }
    //         return $this->db->get('process_data')->result_array();
    //     } catch (Exception $e) {

    //         log_message('error', 'Error in count_users: ' . $e->getMessage());
    //         return 0;
    //     }
    // }





     /**
     * Count get_count_contact_leads
     */
    public function get_count_contact_leads() {
        try {
            return $this->db->count_all_results('contact_us');
        } catch (Exception $e) {

            log_message('error', 'Error in count_users: ' . $e->getMessage());
            return 0;
        }
    }

      /**
     * Count get_count_contact_leads
     */
    public function get_contact_leads($status = NULL ) {
        try {
            if (isset($status)) {
                $this->db->where('status', $status);
            }
            return $this->db->get('contact_us')->result_array();
        } catch (Exception $e) {

            log_message('error', 'Error in count_users: ' . $e->getMessage());
            return 0;
        }
    }

       /**
     * Count get_count_new_leads
     */
    public function get_new_contacts() {
        try {   
            $this->db->where('status',0);
            return $this->db->get('contact_us')->result_array();
        } catch (Exception $e) {

            log_message('error', 'Error in count_users: ' . $e->getMessage());
            return 0;
        }
    }

       /**
     * Count get_count_contacted_leads
     */
    public function get_already_contacted() { 
        try {   
            $this->db->where('status',1);
            return $this->db->get('contact_us')->result_array();
        } catch (Exception $e) {

            log_message('error', 'Error in count_users: ' . $e->getMessage());
            return 0;
        }
    }

       /**
     * Count get_count_spam_leads
     */
    public function get_spam_contacts() {
        try {   
            $this->db->where('status',2);
            return $this->db->get('contact_us')->result_array();
        } catch (Exception $e) {

            log_message('error', 'Error in count_users: ' . $e->getMessage());
            return 0;
        }
    }


      public function get_Process_data() {
        try {
           
            $this->db->select('pd.*, uf.file_title, uf.file_path, u.username');
            $this->db->from('process_data  pd');
            $this->db->join('uploaded_files  uf', 'pd.battery_cycle_file_id = uf.id', 'left');
            $this->db->join('users u', 'u.id = pd.created_by', 'left');
           // $this->db->where('pd.created_by', $user_id);
            $this->db->group_by('pd.process_data_id');
            $this->db->order_by('pd.process_data_id','DESC'); 
            $query = $this->db->get();

         // var_dump($this->db->last_query());die;
            $data = $query->result_array();
            return $data;
        
        } catch (Exception $e) {
            // Step 6: Handle unexpected errors
            log_message('error', 'Exception in get_process_data_by_user: ' . $e->getMessage());
            return [];
        }
    }
    
}
