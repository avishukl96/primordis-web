<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Insert file data into the database
    public function insert_file($data) {
        return $this->db->insert('uploaded_files', $data);
    }

    // Get files uploaded by a specific user
    public function get_files_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('uploaded_files')->result();
    }

    public function get_file_by_id($file_id) {

        $this->db->where('id', $file_id);
        $query = $this->db->get('uploaded_files'); // Replace 'files' with the name of your file table
        $this->db->where('is_deleted', 0);
        return $query->row_array();

    }

    // public function delete_file($file_id) {
    //     $this->db->where('id', $file_id);
    //     return $this->db->delete('uploaded_files'); // Replace 'files' with the name of your file table
    // }

    public function delete_file($file_id) {
        $data = ['is_deleted' => 1]; // Set current timestamp
        $this->db->where('id', $file_id);
        return $this->db->update('uploaded_files', $data);
    }
}
