<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataProcessModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Insert file data into the database
    public function insert_file($data) {
        return $this->db->insert('process_data', $data);
    }

    // Get files uploaded by a specific user
    public function get_files_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('process_data')->result();
    }
    

    // Get files uploaded by a specific user
    public function get_process_data_by_user($user_id) {
        try {
           
            $this->db->select('pd.*, uf.file_title, uf.file_path');
            $this->db->from('process_data  pd');
            $this->db->join('uploaded_files  uf', 'pd.battery_cycle_file_id = uf.id', 'left');
            $this->db->where('pd.created_by', $user_id);
            $this->db->group_by('pd.process_data_id'); // Replace 'id' with the primary key column of 'process_data'
            $this->db->order_by('pd.process_data_id','DESC'); 
            $query = $this->db->get();

          //  var_dump($this->db->last_query());die;
            $data = $query->result_array();
            return $data;
        
        } catch (Exception $e) {
            // Step 6: Handle unexpected errors
            log_message('error', 'Exception in get_process_data_by_user: ' . $e->getMessage());
            return [];
        }
    }


    public function get_process_data_by_process_id($process_data_id) {
      
    
        try {
           
            $this->db->select('pd.*, uf.file_title, uf.file_path');
            $this->db->from('process_data  pd');
            $this->db->join('uploaded_files  uf', 'pd.battery_cycle_file_id = uf.id', 'left');
            $this->db->where('pd.process_data_id', $process_data_id);
            $this->db->group_by('pd.process_data_id'); // Replace 'id' with the primary key column of 'process_data'
            $query = $this->db->get();
            $data = $query->row_array();
            return $data;
        
        } catch (Exception $e) {
            // Step 6: Handle unexpected errors
            log_message('error', 'Exception in get_process_data_by_user: ' . $e->getMessage());
            return [];
        }
    }
    

    public function get_file_by_id($file_id) {
        $this->db->where('id', $file_id);
        $query = $this->db->get('process_data'); // Replace 'files' with the name of your file table
        return $query->row_array();
    }

    public function delete_file($file_id) {
        $this->db->where('id', $file_id);
        return $this->db->delete('process_data'); // Replace 'files' with the name of your file table
    }
}

