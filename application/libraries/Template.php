<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
    var $template_data = array();
    
    // Set template data (this will hold data like page title, meta tags, etc.)
    function set($name, $value) {
        $this->template_data[$name] = $value;
    }
    
    // Load the header, footer, and content dynamically
    function load($template = '', $view = '', $view_data = array(), $return = FALSE) {
        $CI =& get_instance();
        
        // Set the content variable with the view content
        $this->set('contents', $CI->load->view($view, $view_data, TRUE));
        
        // Load header, the main content view, and footer
        $output = $CI->load->view('template/header', $this->template_data, TRUE);
        $output .= $CI->load->view( $template, $this->template_data, TRUE);
        $output .= $CI->load->view('template/footer', $this->template_data, TRUE);
        
        // If $return is TRUE, return the final output, otherwise, send it directly to the browser
        if ($return) {
            return $output;
        } else {
            echo $output;
        }
    }
}

