<?php

defined('BASEPATH') OR exit('No direct script access allowed' );

    class Euromap extends CI_Controller {

        public function __construct(){
            parent::__construct();
        }
    
        public function index()
        {
    
        }

        public function insert_param_data_act(){
            $data = $this->input->post('data');           
            $this -> euromap_model -> insert_param_act($data);
        }
        
        public function truncate_param_act(){
            $data = $this->input->post('data');           
            $this -> euromap_model -> truncate_param_act($data);
        }
        
        // Test
        public function select_param_data_mapping_act(){
            $records = $this->euromap_model->select_param_data_mapping_act();  
            echo json_encode($records);  
        }

}
?>
