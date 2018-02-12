<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Request extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
    }
    
    public function index()
    {

    }
    
    public function load(){
        
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        
        $data = $this->input->post('data');
        
        
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
}