<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the Template library
        $this->load->library('template');
    }

    // Home page
    public function index() {
        // Set the page title (this will be passed to the header view)
        $this->template->set('page_title', 'Welcome to My Website');

        // Load the view for the content of the home page
        $this->template->load('home/index', 'home/index');
    }

    // About page
    public function about() {
        // Set the page title
        $this->template->set('page_title', 'About Us');

        // Load the view for the content of the about page
        $this->template->load('about', 'about/index');
    }

    // Contact page
    public function contact() {
        // Set the page title
        $this->template->set('page_title', 'Contact Us');

        // Load the view for the content of the contact page
        $this->template->load('contact', 'contact/index');
    }


   // Home page
    public function privacy() {
        // Set the page title (this will be passed to the header view)
        $this->template->set('page_title', 'Welcome to My Website');

        // Load the view for the content of the home page
        $this->template->load('home/privacy', 'home/privacy');
    }

    // Terms and condtion page
    public function terns_conditions() {
        // Set the page title
        $this->template->set('page_title', 'Terms and Conditions');
        // Load the view for the content of the contact page
        $this->template->load('home/tnc', 'home/tnc');
    }


  


    public function saveContact() {
        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('message', 'Message', 'trim');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $this->session->set_flashdata('error', validation_errors());
        } else {
            // Validation passed, save data
            $data = [
                'name'    => $this->input->post('name', true),
                'email'   => $this->input->post('email', true),
                'message' => $this->input->post('message', true),
            ];

            if ($this->db->insert('contact_us',$data)) {


                $this->session->set_flashdata('success', 'Message sent successfully!. A Primordis Executive will contact you shortly ');
            } else {
                $this->session->set_flashdata('error', 'Failed to send message.');
            }
        }

        // Redirect to the contact page
        redirect(base_url('#contact'));
    }
}
