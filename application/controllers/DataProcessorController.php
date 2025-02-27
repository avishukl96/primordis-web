<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataProcessorController extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

         $this->load->model('DataProcessModel');
         $user_id = $this->session->userdata('user_id');
    }

    // Show the file upload form and list the user's uploaded files
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['files'] = $this->FileModel->get_files_by_user($user_id);
        $this->template->set('page_title', 'Battery Data ');
        $this->template->load('process/process_form', 'process/process_form', $data);
    }

    public function save_data() {
        
        // Set form validation rules for file title and description
        $this->form_validation->set_rules('battery_cycle_file_id', 'Battery Cycle File', 'required');
        $this->form_validation->set_rules('Cell_chemistry', 'Cell Chemistry', '');
        $this->form_validation->set_rules('nominal_capacity', 'Nominal Capacity', 'required|numeric|greater_than[0.5]|less_than_equal_to[5]');
        $this->form_validation->set_rules('nominal_voltage', 'Nominal Voltage', 'required|numeric|greater_than[1]|less_than_equal_to[10]');
        $this->form_validation->set_rules('cycling_parameters', 'Cycling Parameter', 'numeric|greater_than[0.5]|less_than_equal_to[5]');
        $this->form_validation->set_rules('end_of_life_criterion', 'End of life Criterion', 'numeric|greater_than_equal_to[0]|less_than_equal_to[100]');
        $this->form_validation->set_rules('current_state_of_health', 'Current state of health', 'required|numeric|greater_than_equal_to[80]|less_than_equal_to[100]');
        
      
        if ($this->form_validation->run() == FALSE) {
            $this->index();  // Show the form again with errors
        } else {
         
            try {
                
                $data = array(
                    'battery_cycle_file_id' => $this->input->post('battery_cycle_file_id'),
                    'Cell_chemistry' => $this->input->post('Cell_chemistry'),
                    'nominal_capacity' => $this->input->post('nominal_capacity'),
                    'nominal_voltage' => $this->input->post('nominal_voltage'),
                    'cycling_parameters' => $this->input->post('cycling_parameters'),
                    'end_of_life_criterion' => $this->input->post('end_of_life_criterion'),
                    'current_state_of_health' => $this->input->post('current_state_of_health'),
                    'created_by' => $this->session->userdata('user_id'),
                    'created_at' => date('Y-m-d H:i:s'), // Updated current timestamp
                );

                // Insert the file data into the database
                if ($this->DataProcessModel->insert_file($data)) {
                    $this->session->set_flashdata('success', 'Batter Data has been Added successfully!');
                } else {
                    $this->session->set_flashdata('error', validation_errors());
                }

             redirect('dashboard');

            } catch (Exception $e) {
        
                $this->session->set_flashdata('error', 'File upload failed: ' . $e->getMessage());
                $this->index();  // Reload the form with errors
                
            }
        }
    }




    public function load_model(){
            $curl = curl_init();
            // Data to send as raw JSON
            $postData = ['input_dim' => 12, 'output_dim' => 1];
            // Encode the data into JSON format
            $jsonData = json_encode($postData);
            // Set cURL options
            curl_setopt_array($curl, [
                CURLOPT_URL => "http://18.224.140.203/load_model",  // URL to hit
                CURLOPT_RETURNTRANSFER => true,                   // Return the response as a string
                CURLOPT_POST => true,                             // Use POST method
                CURLOPT_POSTFIELDS => $jsonData,                 // Send raw JSON data in the request body
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',             // Set header to JSON
                    'Content-Length: ' . strlen($jsonData)        // Set the content length for the JSON data
                ],
                CURLOPT_TIMEOUT => 30,                           // Set timeout for the request
            ]);
            // // Execute the request
            $response = curl_exec($curl);

            return true;
            // var_dump($response);die;
            // Check for errors
            if (curl_errno($curl)) {
                echo "cURL Error: " . curl_error($curl);
            } else {
                echo "\n"."Response from Server: " . $response;
            }
            // curl_close($curl);

            return true;
    }


    // public function generate_report_plots_new($battery_data_id)
    // {
    //     $process_data = $this->DataProcessModel->get_process_data_by_process_id($battery_data_id);
    
    //     if ($process_data) {
    //         $file_path = FCPATH . 'public/' . $process_data['file_path'];
    
    //         if (file_exists($file_path)) {
    //             $file_info = pathinfo($file_path);
    //             $file_extension = strtolower($file_info['extension']);
    //             $mime = mime_content_type($file_path); // Dynamically fetch MIME type
    
    //             $curl = curl_init();
    
    //             // Prepare the POST data with the file as part of the request
    //             $postData = [
    //                 'file' => new CURLFile($file_path, $mime, basename($file_path)),
    //                 'test_name' => $process_data['file_title'],
    //                 'window_size' => 4,
    //                 'nominal_capacity' => $process_data['nominal_capacity'],
    //                 'discharge_crate' => 1.0,
    //                 'nominal_voltage' => $process_data['nominal_voltage'],
    //                 'end_of_life_soh' => $process_data['end_of_life_criterion'],
    //                 'c_rate' => 3.0,
    //                 'chem'=>$process_data['cell_chemistry'],
    //                 'current_soh'=>100

    //             ];
    //             // echo "<pre>";
    //             // var_dump($postData);die;

    //             // Set cURL options
    //             curl_setopt_array($curl, [
    //                 CURLOPT_URL => "http://18.224.140.203/process_data_and_predict",  // API endpoint
    //                 CURLOPT_RETURNTRANSFER => true,                     // Return response as string
    //                 CURLOPT_POST => true,                               // Use POST method
    //                 CURLOPT_POSTFIELDS => $postData,                    // Send data
    //                 CURLOPT_HTTPHEADER => [
    //                     'Content-Type: multipart/form-data'             // Ensure multipart/form-data
    //                 ],
    //                 CURLOPT_TIMEOUT => 30,                              // Set timeout
    //             ]);
    
    //             // Execute the cURL request
    //             $response = curl_exec($curl);

    //             var_dump($response);die;

    //             return true;
    
    //             if (curl_errno($curl)) {
    //                 echo "cURL Error: " . curl_error($curl);
    //             } else {
    //                 echo "Response from Server: " . $response;
    //             }
    
    //             curl_close($curl);
    //         } else {
    //             echo "File does not exist.";
    //         }
    //     } else {
    //         echo "Process data not found.";
    //     }

    //     return true;
    // }

    public function upload_data($battery_data_id)
    {
        $process_data = $this->DataProcessModel->get_process_data_by_process_id($battery_data_id);
    
        if ($process_data) {
            $file_path = FCPATH . 'public/' . $process_data['file_path'];
    
            if (file_exists($file_path)) {
                $file_info = pathinfo($file_path);
                $file_extension = strtolower($file_info['extension']);
                $mime = mime_content_type($file_path); // Dynamically fetch MIME type
    
                $curl = curl_init();
    
                // Prepare the POST data with the file as part of the request
                $postData = [
                    'file' => new CURLFile($file_path, $mime, basename($file_path)),
                    'test_name' => $process_data['file_title'],
                    //'window_size' => 4,
                    'nominal_capacity' => $process_data['nominal_capacity'],
                    'discharge_crate' => 1.0,
                    'test_c_rate' => 1.0,
                    'chem'=> "NASA",
                    'nominal_voltage' => $process_data['nominal_voltage'],
                    'end_of_life_soh' => $process_data['end_of_life_criterion'],
                    'user_id' => $this->session->userdata('user_id'),
                    'request_id'=>$battery_data_id
                ];

             //   var_dump($postData);die;

                // Set cURL options
                curl_setopt_array($curl, [
                    CURLOPT_URL => "http://18.224.140.203/upload_data",  // API endpoint
                    CURLOPT_RETURNTRANSFER => true,                     // Return response as string
                    CURLOPT_POST => true,                               // Use POST method
                    CURLOPT_POSTFIELDS => $postData,                    // Send data
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: multipart/form-data'             // Ensure multipart/form-data
                    ],
                    CURLOPT_TIMEOUT => 30,                              // Set timeout
                ]);
    
                // Execute the cURL request
                $response = curl_exec($curl);
         //   var_dump($response,'upload_data');

                return true;
    
                if (curl_errno($curl)) {
                    echo "cURL Error: " . curl_error($curl);
                } else {
                    echo "\n"."upload_data: Response from Server: " . $response;
                }
    
                curl_close($curl);
            } else {
                echo "File does not exist.";
            }
        } else {
            echo "Process data not found.";
        }

        return true;
    }

    public function run_predictions($battery_data_id)
    {
        $process_data = $this->DataProcessModel->get_process_data_by_process_id($battery_data_id);
    
        if ($process_data) {
    
                $curl = curl_init();
                // Prepare the POST data with the file as part of the request
                $postData = [
                    'test_name' => $process_data['file_title'],
                    'nominal_capacity' => $process_data['nominal_capacity'],
                    // 'discharge_crate' => 1.0,
                    // 'nominal_voltage' => $process_data['nominal_voltage'],
                    'end_of_life_soh' => $process_data['end_of_life_criterion'],
                    'user_id' => $this->session->userdata('user_id'),
                    'request_id'=>$battery_data_id,
                    'folder_name'=> 'generated_files_'.$this->session->userdata('user_id').'_'.$battery_data_id
                ];

                $jsonData = json_encode($postData);
 
                // Set cURL options
                curl_setopt_array($curl, [
                    CURLOPT_URL => "http://18.224.140.203/process_and_predict",  // API endpoint
                    CURLOPT_RETURNTRANSFER => true,                     // Return response as string
                    CURLOPT_POST => true,                               // Use POST method
                    CURLOPT_POSTFIELDS =>    http_build_query($postData), //http_build_query($postData), //$jsonData,                    // Send data
                    CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
                    CURLOPT_TIMEOUT => 600,                              // Set timeout
                ]);  

                curl_setopt($curl, CURLOPT_VERBOSE, true);

    
                // Execute the cURL request
                $response = curl_exec($curl);

                return true;
 
                //var_dump($response);die;
    
                if (curl_errno($curl)) {
                    echo "cURL Error: " . curl_error($curl);
                } else {
                    echo "\n"."run_predictions: Response from Server: " . $response;
                }
    
                curl_close($curl);
        
        } else {
            echo "Process data not found.";
        }

        
    }




public function generate_plot($battery_data_id)
{
    // Retrieve process data by ID
    $process_data = $this->DataProcessModel->get_process_data_by_process_id($battery_data_id);
    if ($process_data) {
        $curl = curl_init();
        // Prepare the POST data with the file as part of the request
        $postData = [
            'test_name' => $process_data['file_title'],
            'nominal_capacity' => $process_data['nominal_capacity'],
            'baseline_cost' => 100.0,
            // 'nominal_voltage' => $process_data['nominal_voltage'],
            'end_of_life_soh' => $process_data['end_of_life_criterion'],
            'user_id' => $this->session->userdata('user_id'),
            'request_id'=>$battery_data_id,
            'folder_name'=> 'generated_files_'.$this->session->userdata('user_id').'_'.$battery_data_id
        ];

        $jsonData = json_encode($postData);
        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://18.224.140.203/generate_report", //"http://18.224.140.203/generate_plot",  // API endpoint
            CURLOPT_RETURNTRANSFER => true,  // Return response as string
            CURLOPT_POST => true,  // Use POST method
            CURLOPT_POSTFIELDS =>    http_build_query($postData), //http_build_query($postData), //$jsonData,                    // Send data
            CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
            CURLOPT_TIMEOUT => 600,  // Set timeout
        ]);
        // Execute the cURL request
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        $content_type = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
        header("Content-Type: " . $content_type);
        $response = curl_exec($curl);

        $response = json_decode($response, true);


        return $response;


      
        // Close cURL session

        echo "\n"."generate Report .";

        curl_close($curl);
    } else {
        echo "Process data not found.";
    }
    
        return $file_url;
}



    public function generate_report_plots($battery_data_id,$report_type="regenerate")
    {
        
         $this->load_model();
         $this->upload_data($battery_data_id);
        $this->run_predictions($battery_data_id);
        $data['process_data'] = $this->DataProcessModel->get_process_data_by_process_id($battery_data_id);
         $final_report = $this->generate_plot($battery_data_id);
        $data['response'] = $final_report['data'];
      //  var_dump($data['response']);die;
        $this->template->set('page_title', 'Battery Data Report ');
        $this->template->load('process/process_report', 'process/process_report', $data);

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
        if (!unlink($file_path)) {
            throw new Exception('Failed to delete the file from the server.');
        }

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


  // FAQ page
  public function faq() {
    // Set the page title
    $this->template->set('page_title', 'FAQ');
    // Load the view for the content of the contact page
    $this->template->load('home/faq', 'home/faq');
}
    
}
