
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

 public function index()
    {
      $this->load->helper('url');
      $this->load->view('index');
    }

 public function full_name()
    {
      $fname = $this->input->post('fname');
      echo 'Hello... '.$fname;
    }
}

?>