<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileUploadController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load the file model and libraries
        $this->load->model('FileModel');
        $this->load->library('form_validation');
        $this->load->library('upload');
        
        // Check if the user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    // Show the file upload form and list the user's uploaded files
    public function index() {

        $user_id = $this->session->userdata('user_id');
        // Get files uploaded by the user from the database
        $data['files'] = $this->FileModel->get_files_by_user($user_id);

        //var_dump($data);die;
        // Set the page title (this will be passed to the header view)
        $this->template->set('page_title', 'Files');
        // Load the dashboard view using template library and pass the data
        $this->template->load('file_upload_view', 'file_upload_view', $data);
    }

    public function upload() {
        // Set form validation rules for file title and description
        $this->form_validation->set_rules('file_title', 'File Title', 'required');
        $this->form_validation->set_rules('file_desc', 'File Description', 'required');
      
        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the page
            $this->index();  // Show the form again with errors
        } else {
            // Handle file upload
            $config['upload_path'] = FCPATH . 'public/uploads/';
            $config['allowed_types'] = 'xlsx|xls|csv|mat';
            $config['max_size'] = 10240;  // 10MB max size
    
            // Initialize upload library
            $this->upload->initialize($config);
    
            try {
                if (!$this->upload->do_upload('file_upload')) {
                    // Upload failed
                    throw new Exception($this->upload->display_errors());
                } else {
                    // Upload successful
                    $file_data = $this->upload->data();
    
                    // Prepare data to insert into the database
                    $file_info = array(
                        'file_title' => $this->input->post('file_title'),
                        'file_desc' => $this->input->post('file_desc'),
                        'file_path' => 'uploads/' . $file_data['file_name'],
                        'user_id' => $this->session->userdata('user_id'),
                    );
    
                    // Insert the file data into the database
                    if ($this->FileModel->insert_file($file_info)) {
                        $this->session->set_flashdata('success', 'File uploaded successfully!');
                    } else {
                        $this->session->set_flashdata('error', 'Failed to upload the file.');
                    }
    
                    redirect('fileupload');
                }
            } catch (Exception $e) {
                //var_dump($e);die;
                // Log the error message
                //log_message('error', 'File upload error: ' . $e->getMessage());
                
                // Display the error message in session flash data
                $this->session->set_flashdata('error', 'File upload failed: ' . $e->getMessage());
                $this->index();  // Reload the form with errors
            }
        }
    }


    public function delete($file_id) {
    try {

        
        // 1. Fetch file details from the database
        $file_info = $this->FileModel->get_file_by_id($file_id);

        //var_dump($file_info);die;
        if (!$file_info) {
            throw new Exception('File not found in the database.');
        }

        //2. Get the file path
       $file_path = FCPATH .'public/'. $file_info['file_path'];
       // var_dump($file_path);die;
        

        // 3. Check if the file exists
        if (!file_exists($file_path)) {
            throw new Exception('File does not exist on the server.');
        }

        // 4. Delete the file from the server
        // if (!unlink($file_path)) {
        //     throw new Exception('Failed to delete the file from the server.');
        // }

        // 5. Delete the file record from the database
        if (!$this->FileModel->delete_file($file_id)) {
            throw new Exception('Failed to delete the file from the database.');
        }

        // 6. Set success message
        $this->session->set_flashdata('success', 'File deleted successfully.');
    } catch (Exception $e) {
        //var_dump($e);die;
        // Log the error and set error message for the user
        log_message('error', 'File delete error: ' . $e->getMessage());
        $this->session->set_flashdata('error', 'File deletion failed: ' . $e->getMessage());
    }

    // Redirect to the file list page or the same page
    redirect('fileupload');
}
    
}
