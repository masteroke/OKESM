<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model {

    public $user_status; 
    
    public $user_roles;
    
    // User info
    private $photo;
    
    public $USER_LEVEL_ADMIN = 1;
    public $USER_LEVEL_PM = 2;
    public $USER_LEVEL_DEV = 3;
    
    function __construct(){
        // Call the Model constructor
        parent::__construct();        
        $this->user_status = $this->config->item('user_status');
        $this->user_roles = $this->config->item('user_roles');
    }    
    
    public function register_user($user) {
        
        $user['createdAt'] = strtotime("now");
        
        $user['company_id'] = '1000000001';
        

        $this -> db -> insert('sm_user', $user);

    }

    public function userInfo($email) {

        $this -> db -> select('*');
        $this -> db -> from('sm_user');
        $this -> db -> where('email', $email);

        if ($query = $this -> db -> get()) {
            return $query -> row_array();
        } else {
            return false;
        }
    }
    
    /**
     * get_user_id_from_username function.
     * 
     * @access public
     * @param mixed $username
     * @return int the user id
     */
    public function get_user_id_from_username($username) {
        
        $this->db->select('id');
        $this->db->from('sm_user');
        $this->db->where('username', $username);
        return $this->db->get()->row('id');
        
    }
    
    /**
     * get_user function.
     * 
     * @access public
     * @param mixed $user_id
     * @return object the user object
     */
    public function get_user($user_id) {
        
        $this->db->from('sm_user');
        $this->db->where('id', $user_id);
        return $this->db->get()->row();
        
    }
    
    /**
     * hash_password function.
     * 
     * @access private
     * @param mixed $password
     * @return string|bool could be a string on success, or bool false on failure
     */
    private function hash_password($password) {
        
        return password_hash($password, PASSWORD_BCRYPT);
        
    }
    
    /**
     * verify_password_hash function.
     * 
     * @access private
     * @param mixed $password
     * @param mixed $hash
     * @return bool
     */
    private function verify_password_hash($password, $hash) {
        
        return password_verify($password, $hash);
        
    }
    
    /**
     * resolve_user_login function.
     * 
     * @access public
     * @param mixed $username
     * @param mixed $password
     * @return bool true on success, false on failure
     */
    public function resolve_user_login($username, $password) {
        
        $this->db->select('password');
        $this->db->from('sm_user');
        $this->db->where('username', $username);
        $hash = $this->db->get()->row('password');
        
        return $this->verify_password_hash($password, $hash);
        
    }

    /**
     * resolve_user_login function.
     * 
     * @access public
     * @param mixed $user object
     * @return bool true on success, true if user already exists 
     */
    public function user_db_exists($user) {

        $this -> db -> select('*');
        $this -> db -> from('sm_user');
        $this -> db -> where('username', $user['username']);
        $this -> db -> or_where('email', $user['email']);
        $query = $this -> db -> get();

        if ($query -> num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getUserInfoByEmail($email)
    {
        $q = $this->db->get_where('sm_user', array('email' => $email), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$email.')');
            return false;
        }
    }
    
    public function getUserInfo($id)
    {
        $q = $this->db->get_where('sm_user', array('id' => $id), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$id.')');
            return false;
        }
    }
    
    public function isDuplicate($email)
    {     
        $this->db->get_where('sm_user', array('email' => $email), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }
    
    public function insertToken($user_id)
    {   
        $token = substr(sha1(rand()), 0, 30); 
        
        $date = date('Y-m-d');
        
        $string = array(
                'token'=> $token,
                'user_id'=>$user_id,
                'created'=>$date
            );
            
        $query = $this->db->insert_string('tokens',$string);
        
        $this->db->query($query);
        
        return $token . $user_id;
        
    }
    
    public function insertUser($d)
    {  
            $string = array(
                'name'=>$d['name'],
                'lastname'=>$d['lastname'],
                'email'=>$d['email'],
                'username'=>$d['username'],
                'createdAt' => date('Y-m-d h:i:s A'),
                'role'=>$this->user_roles, 
                'status'=>$this->user_status
            );
            
            $q = $this->db->insert_string('sm_user',$string); 
                        
            $this->db->query($q);
            
            return $this->db->insert_id();
    }
    
    public function isTokenValid($token)
    {
       $tkn = substr($token,0,30);
       
       $uid = substr($token,30);      
       
        $q = $this->db->get_where('tokens', array('tokens.token' => $tkn, 'tokens.user_id' => $uid), 1);                         
               
        if($this->db->affected_rows() > 0){
            
            $row = $q->row();             
            
            $created = $row->created;
            
            $createdTS = strtotime($created);
            
            $today = date('Y-m-d'); 
            
            $todayTS = strtotime($today);
            
            if($createdTS != $todayTS){
                return false;
            }
            
            $user_info = $this->getUserInfo($row->user_id);
            
            return $user_info;
            
        }
        else{
            return false;
        }
        
    }    
    
    public function checkLogin($post)
    {
        $this->load->library('password');       
        $this->db->select('*');
        $this->db->where('email', $post['email']);
        $query = $this->db->get('sm_user');
        $userInfo = $query->row();
        
        if(!isset($userInfo))
        {
            return false;    
        }
        
        if(!$this->password->validate_password($post['password'], $userInfo->password)){
            error_log('Unsuccessful login attempt('.$post['email'].')');
            return false; 
        }
        
        $this->updateLoginTime($userInfo->id);
        
        unset($userInfo->password);
        
        return $userInfo; 
    }
    
    public function updateLoginTime($id)
    {
        $this->db->where('id', $id);
        $this->db->update('sm_user', array('lastLoginAt' => date('Y-m-d h:i:s A')));
        return;
    }
    
    public function updatePassword($post)
    {   
        $this->db->where('id', $post['user_id']);
        $this->db->update('sm_user', array('password' => $post['password'])); 
        $success = $this->db->affected_rows(); 
        
        if(!$success){
            error_log('Unable to updatePassword('.$post['user_id'].')');
            return false;
        }        
        return true;
    } 
    
    public function updateUserInfo($post)
    {
        $data = array(
               'password' => $post['password'],
               'modifiedAt' => date('Y-m-d h:i:s A'), 
               'status' => $this->user_status
            );
        $this->db->where('id', $post['user_id']);
        $this->db->update('sm_user', $data); 
        $success = $this->db->affected_rows(); 
        
        if(!$success){
            error_log('Unable to updateUserInfo('.$post['user_id'].')');
            return false;
        }

        
        $user_info = $this->getUserInfo($post['user_id']); 
        return $user_info; 
    }
    
    public function getTimestamp(){
        $date = new DateTime();
        return $date->getTimestamp();
    }
    
    public function upload_photo()
    {
        $this->load->library('upload');

        $config = array(
            'allowed_types' => 'gif|png|jpg|jpeg',
            'upload_path' => getcwd().'/upload/profile/'.$this->session->userdata('user'),
            'max_size' => 2048,
            'overwrite' => true
        );
        $this->upload->initialize($config);

        // Create path
        if(is_dir($config['upload_path'])) {
            
            $objects = scandir($config['upload_path']);
            foreach ($objects as $object)
            {
                if($object != '.' AND $object != '..')
                {
                    unlink($config['upload_path'].'/'.$object);
                }
            }
            
        } else {
            
            if(!mkdir($config['upload_path'], 0755, true)){
                $this->error = 'An error occurred while we uploaded your picture.';
                return false;
            }
            
        }

        // Run the upload
        if (!$this->upload->do_upload('photo')) {
            // Problem in upload
            $this->error = $this->upload->display_errors();
            return false;
        }

        // Resize images
        $upload_data = $this->upload->data();
        if(!$this->user_model->prepare_image($upload_data)){
            return false;
        }

        $this->photo = $upload_data['file_name'];
        
        return true;
    }

    public function prepare_image($data)
    {
        // Make it square - Crop
        if($data['image_width'] > $data['image_height'])
            $size = $data['image_height'];
        else
            $size = $data['image_width'];
        
        $config = array(
            'source_image'   => $data['full_path'],
            'maintain_ratio' => false,
            'width'          => $size,
            'height'         => $size
        );
        
        $this->load->library('image_lib'); 

        $this->image_lib->clear();
        $this->image_lib->initialize($config); 
        if(!$this->image_lib->crop()){
            $this->error = $this->image_lib->display_errors();
            return false;
        }
        
        // Resize in three different sizes
        $target = array(
            0 => array('name' => 'large', 'width' => 128, 'height' => 128),
            1 => array('name' => 'medium', 'width' => 64, 'height' => 64),
            2 => array('name' => 'thumb', 'width' => 32, 'height' => 32)
        );
        
        for($i = 0; $i < count($target); $i++) {
            // Image library settings
            // Resize
            $config = array(
                'source_image' => $data['full_path'],
                'new_image'    => $data['file_path'].$target[$i]['name'].$data['file_name'],
                'width'        => $target[$i]['width'],
                'height'       => $target[$i]['height'],
                'master_dim'   => (($data['image_width'] / $data['image_height']) >= ($target[$i]['width'] / $target[$i]['height']))?'height':'width'
            );

            $this->image_lib->clear();
            $this->image_lib->initialize($config); 
            if(!$this->image_lib->resize()){
                $this->error = $this->image_lib->display_errors();
                return false;
            }
            
        }
        
        return true;
    }
    
    function get_photo()
    {
        return $this->photo;
    }

}
?>