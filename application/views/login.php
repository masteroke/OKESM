    <?php $this->load->view('includes/login/header_login'); ?>
    
    <body style="background-image: url('<?php echo base_url() ?>assets/media/background/web_smart_factory_image.jpg'); ">
                         
        <div class="container">
            <!-- background-image: url('<?php echo base_url() ?>assets/media/background/back.jpg'); -->
            <!-- background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/5908/food.png); -->

            <div style="margin-top: 1em;"> 
            
            <div class="row main">
                
                <?php $this->load->view('includes/login/title'); ?>
                
                <div class="main-login main-center" style="margin-bottom: 8em;">
                
                    <?php
                    
                        $success_msg= $this->session->flashdata('success_msg');
                          
                        $error_msg= $this->session->flashdata('error_msg');
                        
                        if($success_msg){
                          
                        ?>
                            
                        <div class="alert alert-success">
                            
                        <?php echo $success_msg; ?>
                        </div>
                        
                        <?php
                            }
                            if($error_msg){
                        ?>
                            <div class="alert alert-danger">
                            <?php echo $error_msg; ?>
                            </div>
                            <?php
                        }
                    ?>
        
                    <form class="form-horizontal" method="post" action="<?php echo base_url('user/login_user'); ?>">
                    
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Your Email</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input 
                                    type="text" 
                                    class="form-control" 
                                    name="email" 
                                    id="email"  
                                    oninvalid="setCustomValidity('Please enter a valid email address!')" 
                                    onchange="try{setCustomValidity('')}catch(e){}" 
                                    placeholder="<?php echo $this->lang->line('email_placeholder_registration');?>"
                                    required=""
                                    />
                                </div>
                            </div>
                        </div>                      
    
                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label"><?php echo $this->lang->line('password_registration');?></label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input 
                                    type="password" 
                                    class="form-control" 
                                    name="password" 
                                    id="password" 
                                    oninvalid="setCustomValidity('Please enter your password!')"  
                                    onchange="try{setCustomValidity('')}catch(e){}" 
                                    placeholder="<?php echo $this->lang->line('password_placeholder_registration');?>
                                    required=""
                                    "/>
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button login-tr-submit-color">Login</button>
                        </div>

                    </form>  
                    <center>
                        </b><a href="<?php echo base_url('user/help'); ?>">Need help?</a> 
                        <br></b><a href="<?php echo base_url('user/user_forgot'); ?>">Forgot password</a>
                        <br></b><a href="<?php echo base_url('user/user_register'); ?>">Register here</a>
                        <br></b><a href="www.oke.de">© 2018 OKE Group</a>
   
                    </center><!--for centered text-->
                    
                    
                </div>
            </div>
        </div>
        </div>
    </body>
</html>