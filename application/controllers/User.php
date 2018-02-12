<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    private $LEVEL;

    public function __construct() {

        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> helper('form');
        $this -> load -> model('user_model');
        $this -> load -> library('session');
        
        $this->LEVEL = array(
            1 => 'Full Access',
            2 => 'Project Manager',
            3 => 'Developer'
        );
        
    }

    public function index() {
        $this -> login();
    }
    
    public function user_register() {
        //$this -> load -> view("register");
        echo $this->load->templateA('register', '', TRUE);
    }
    
    public function user_forgot() {
        //$this -> load -> view("forgot");
        echo $this->load->templateA('forgot', '', TRUE);
    }
    
    public function user_profile() {
        $this -> load -> view('userprofile');
    }

    public function user_logout() {
        $this -> session -> sess_destroy();
        redirect(site_url().'user/login/');
    }
    
    public function login() {
        //$this -> load -> view("login");
        echo $this->load->templateA('login', '', TRUE);
    }
    
    public function help() {
        $this->load->view('help');
    }


    public function register_user() {
        
        $user = array(
            'name'      => $this -> input -> post('name'), 
            'email'     => $this -> input -> post('email'), 
            'password'  => md5($this -> input -> post('password')),
            'lastname'  => $this -> input -> post('lastname'), 
            'username'  => $this -> input -> post('username')
        );
        
        if(!isset($user['email']) OR empty($user['email']) OR !isset($user['password']) OR empty($user['password']))
        {
            redirect('user/register');
        }
        
        $confirm = md5($this -> input -> post('confirm'));
        
        if((!isset($user['username']) OR empty(trim($user['username']))) && isset($user['name']) && isset($user['lastname']))
        {
            $user['username'] = $user['name'] . '.' . $user['lastname'];
        }
  
        $err_txt = '<h4>Error occured</h4>';
        
        $check = true;
        
        // set validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric|min_length[4]|is_unique[tr_user.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tr_user.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        
        
        if($this->form_validation->run() == FALSE)
        {
            $err_txt .= '<div class="alert alert-danger">'.validation_errors().'</div>';

            $check = false;
        }
        else {
            if($user['password'] === $confirm)
            {
                if($this -> user_model -> user_db_exists($user)){
                    
                    $err_txt .= '<div class="alert alert-danger"><h4>User already exists.</h4></div>';
                    
                    $check = false;
                }                
            }
            else {
                    $err_txt .= '<div class="alert alert-danger"><h4>The passwords do not match.</h4></div>';
                    
                    $check = false;
            }
        }
        
        if ($check) {
            $this -> user_model -> register_user($user);
            $this -> session -> set_flashdata('success_msg', 'Registered successfully. Now login to your account.');
            redirect('user/login');

        } else {
            $this -> session -> set_flashdata('error_msg', $err_txt);
            redirect('user/register');
        }

    }

    public function register(){
             
        $this->form_validation->set_rules('name', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');    
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');    
                   
        if ($this->form_validation->run() == FALSE) {   
            echo $this->load->templateA('register', '', TRUE);
        }
        else{                
            if($this->user_model->isDuplicate($this->input->post('email'))){
                $this->session->set_flashdata('flash_message', 'User email already exists');
                redirect(site_url().'user/login');
            }
            else{
                
                $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                
                if((!isset($clean['username']) OR empty(trim($clean['username']))) && isset($clean['name']) && isset($clean['lastname']))
                {
                    $clean['username'] = $clean['name'] . '.' . $clean['lastname'];
                }

/*
                echo '<pre>';
                print_r($clean);
                echo  '</pre>';
                
                exit;
*/                
                $id = $this->user_model->insertUser($clean); 
                
                $token = $this->user_model->insertToken($id);                                        
                
                $qstring = $this->base64url_encode($token);                    
                $url = site_url() . 'user/complete/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>'; 
                           
                $message = '';                     
                $message .= '<strong>You have signed up with our website</strong><br>';
                $message .= '<strong>Please click:</strong> ' . $link;                          
                
                echo $message; //send this in email
                

                //$this -> send_mail($this->input->post('email'), $message);
                
                exit;
                 
                
            };              
        }
    }

    public function complete()
    {                                   
        $token = base64_decode($this->uri->segment(4));       
        
        $cleanToken = $this->security->xss_clean($token);
        
        $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();           
        
        if(!$user_info){
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            redirect(site_url().'user/login');
        }            
        
        $data = array(
            'name'=> $user_info->name, 
            'email'=>$user_info->email, 
            'user_id'=>$user_info->id, 
            'token'=>$this->base64url_encode($token)
        );
       
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');              
        
        if ($this->form_validation->run() == FALSE) { 
            $this->load->view('complete', $data);
        }
        else{
            
            $this->load->library('password');                 
            $post = $this->input->post(NULL, TRUE);
            
            $cleanPost = $this->security->xss_clean($post);
            
            $hashed = $this->password->create_hash($cleanPost['password']);     
          
            $cleanPost['password'] = $hashed;
            
            unset($cleanPost['passconf']);
            
            $userInfo = $this->user_model->updateUserInfo($cleanPost);
            
            if(!$userInfo){
                $this->session->set_flashdata('flash_message', 'There was a problem updating your record');
                redirect(site_url().'user/login');
            }
            
            unset($userInfo->password);
            
            foreach($userInfo as $key=>$val){
                $this->session->set_userdata($key, $val);
            }
            
            //redirect(site_url().'user/');
            
            
            redirect(site_url().'products/');

            
        }
    }

    function login_user() {
        
        $user_login = array('email' => $this -> input -> post('email'), 'password' => $this -> input -> post('password'));

        if(!isset($user_login['email']) OR empty($user_login['email']) OR !isset($user_login['password']) OR empty($user_login['password']))
        {
            redirect('user/login');
        }
        
        
        $check = $this -> user_model -> checkLogin($user_login);
        
        if($check != FALSE)
        {
            $userdata = $this -> user_model -> userInfo($user_login['email']);
        }


        //login_user
        
        if (isset($userdata)) {
            
            $this -> session -> set_userdata('id', $userdata['id']);
            $this -> session -> set_userdata('name', $userdata['name']);
            $this -> session -> set_userdata('lastname', $userdata['lastname']);
            $this -> session -> set_userdata('email', $userdata['email']);
            $this -> session -> set_userdata('username', $userdata['username']);

            //$this -> load -> view('user_profile');
            $this -> load_main();

        } else {
            
            $this -> session -> set_flashdata('error_msg', 'Error occured,Try again.');
            
            $this -> load -> view("login");

        }
    }

    public function forgot()
    {
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
        
        if($this->form_validation->run() == FALSE) {
            echo $this->load->templateA('forgot', '', TRUE);
        }
        else{
            
            $email = $this->input->post('email');  
            
            $clean = $this->security->xss_clean($email);
            
            $userInfo = $this->user_model->getUserInfoByEmail($clean);
            
            if(!$userInfo){
                $this->session->set_flashdata('flash_message', 'We cant find your email address');
                redirect(site_url().'user/login');
            }   
            
            //if($userInfo->status != $this->status[1]){ //if status is not approved
                //$this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                //redirect(site_url().'user/login');
            //}
            
            //build token 
            
            $token = $this->user_model->insertToken($userInfo->id);   
                             
            $qstring = $this->base64url_encode($token);    
                              
            $url = site_url() . 'user/reset_password/token/' . $qstring;
            
            $link = '<a href="' . $url . '">' . $url . '</a>'; 
            
            $message = '';              
                   
            $message .= '<strong>A password reset has been requested for this email account</strong><br>';
            
            $message .= '<strong>Please click:</strong> ' . $link;    
       
            echo $message; //send this through mail

            //$this -> send_mail($email, $message);
                           
            exit;
            
        }
        
    }

    public function send_mail($to, $message) {
        
        
        $from_email = 'admin@trusted-ratings.de'; 
        
        $config = Array(
            'protocol'      => 'smtp',
            'smtp_host'     => 'smtp.googlemail.com',
            //'smtp_host' => 'smtp.oke',
            'smtp_port'     => '465',
            'smtp_crypto'   => 'ssl',
            //'smtp_timeout'  => '7',
            'smtp_user'     => 'dimitrilanglitz@gmail.com', // change it to yours
            'smtp_pass'     => 'dila06!!', // change it to yours
            'mailtype'      => 'html',
            'charset'       => 'iso-8859-1',
            'wordwrap'      => TRUE
            //'validate'      => TRUE,
            //'crlf'          => '\r\n'
        ); 

        
        //Load email library 
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->initialize($config);
            

        $this->email->from($from_email, 'Your Administrator');
        $this->email->to($to);
        $this->email->subject('Your Trusted-Ratings Team'); 
        $this->email->message($message); 
           
        //Send mail 
        
        $path = $this -> config -> item('server_root');

        if ($this->email->send()) {
            $data['message_display'] = 'Email Successfully Send !';
            redirect(site_url().'user/login'); 
        } else {
            $data['message_display'] =  '<p class="error_msg">Invalid Gmail Account or Password !</p>';
            show_error($this->email->print_debugger());
        }



    } 
   

    public function reset_password() {
        $token = $this->base64url_decode($this->uri->segment(4));    
                      
        $cleanToken = $this->security->xss_clean($token);
        
        $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();               
        
        if(!$user_info){
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            redirect(site_url().'user/login');
        }      
              
        $data = array(
            'firstName'=> $user_info->name, 'email'=>$user_info->email, 
//                'user_id'=>$user_info->id, 
            'token'=>$this->base64url_encode($token)
        );
       
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');              
        
        if ($this->form_validation->run() == FALSE) {   
            echo $this->load->templateA('reset_password', $data, TRUE);
        }
        else{
                            
            $this->load->library('password');                 
            $post = $this->input->post(NULL, TRUE);                
            $cleanPost = $this->security->xss_clean($post);                
            $hashed = $this->password->create_hash($cleanPost['password']);                
            $cleanPost['password'] = $hashed;
            $cleanPost['user_id'] = $user_info->id;
            unset($cleanPost['passconf']);                
            if(!$this->user_model->updatePassword($cleanPost)){
                $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
            }else{
                $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
            }
            redirect(site_url().'user/login');                
        }
    }

    public function base64url_encode($data) { 
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
    } 
    
    public function base64url_decode($data) { 
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
    }

    /*
     * Check the Session status
     * if session exist return true
     * else return false
     * */

    public function session_check()
    {
        if($this->session->userdata('id') != null)
            return TRUE;
        else
            return FALSE;
    }

    function load_main() {
        $this -> load -> view('frontend/menu/menu');
    }
    
    protected function _islocal(){
            return strpos($_SERVER['HTTP_HOST'], 'local');
    }

}
?>