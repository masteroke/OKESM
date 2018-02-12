<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Viewloader extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper('url');

    }
    
    function get_view_ajax()
    {

       $user_id  = $this->session->userdata('id');
       $email    = $this->session->userdata('email');
       $username = $this->session->userdata('username');
       
       $data = $this->input->post();

       $debug = $data;
       $debug['UserID']   = $user_id;
       $debug['Email']    = $email;
       $debug['Username'] = $username;

       if(!$user_id){
           echo $this->load->view('redirect', $data, TRUE);
           return;
       }

       if($data['debug'] === 'true')
       {
           echo '<pre>';
           print_r($debug);
           echo  '</pre>';
       }
        
       $view_path = $data['view']; 

       if(!isset($data['view_type'])){
           echo $this->load->template($view_path, $data, TRUE);
       }
       else if (VIEW_TEMPLATE_A == $data['view_type']){
           echo $this->load->templateA($view_path, $data, TRUE);
       }
       else if (VIEW_TEMPLATE_B == $data['view_type']){
           echo $this->load->templateB($view_path, $data, TRUE);
       }
    
    }

}
?>