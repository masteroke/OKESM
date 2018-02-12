
<?php $this->load->view('includes/login/header_login'); ?>
    
                 
    <body style="background-image: url('<?php echo base_url() ?>assets/media/background/web_smart_factory_image.jpg'); ">
                         
        <div class="container">
            <!-- background-image: url('<?php echo base_url() ?>assets/media/background/back.jpg'); -->
            <!-- background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/5908/food.png); -->

            <div style="margin-top: 1em;"> 
            
            <div class="row main">
                
                <?php $this->load->view('includes/login/title'); ?> 
                
                <div class="main-login main-center" style="margin-bottom: 8em;">

                        <h3>Reset your password</h3>
                        <h4>Hello <span><?php echo $firstName; ?></span>, Please enter your new password 2x to reset</h4>     
                        <?php $fattr = array('class' => 'form-signin'); echo form_open(site_url().'user/reset_password/token/'.$token, $fattr); ?>
                        <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                        <?php echo form_password(array('name'=>'password', 'id'=> 'password', 'placeholder'=>'Password', 'class'=>'form-control', 'value' => set_value('password'))); ?>
                        <?php echo form_error('password') ?>
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                        <?php echo form_password(array('name'=>'passconf', 'id'=> 'passconf', 'placeholder'=>'Confirm Password', 'class'=>'form-control', 'value'=> set_value('passconf'))); ?>
                        <?php echo form_error('passconf') ?>
                        </div>
                        <?php echo form_submit(array('value'=>'Reset Password', 'class'=>'btn btn-primary btn-lg btn-block login-button login-tr-submit-color')); ?>
                        <?php echo form_close(); ?>
                        </div>
                        
                        <center><b>Need help?</b> 
                            <br></b><a href="<?php echo base_url('user/login'); ?>">Login here</a>
                        </center><!--for centered text-->          

                    
                </div>
                
            </div>
        </div>
    </div>
    </body>
</html>
