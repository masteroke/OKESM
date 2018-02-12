<?php
    $user_id=$this->session->userdata('id');
    
    redirect("user/login", base_url());

    if($user_id){return TRUE;} else {return FALSE;}
?>
