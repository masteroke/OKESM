
<?php $this->load->view('includes/login/header_login'); ?>
    
    <body style="background-image: url('<?php echo base_url() ?>assets/media/background/web_smart_factory_image.jpg'); ">
                         
        <div class="container">
            <!-- background-image: url('<?php echo base_url() ?>assets/media/background/back.jpg'); -->
            <!-- background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/5908/food.png); -->

            <div style="margin-top: 1em;"> 
            
            <div class="row main">
                
            <?php $this->load->view('includes/login/title'); ?> 
 
            <div class="row">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="text-center">
                                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                                  <h2 class="text-center">Forgot Password?</h2>
                                        <p>Please enter your email address and we'll send you instructions on how to reset your password</p>
                                        <?php $fattr = array('class' => 'form-signin');
                                             echo form_open(site_url().'user/forgot/', $fattr); ?>
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                              <?php echo form_input(array(
                                                  'name'=>'email', 
                                                  'id'=> 'email', 
                                                  'placeholder'=>'Email', 
                                                  'class'=>'form-control', 
                                                  'value'=> set_value('email'))); ?>
                                              <?php echo form_error('email') ?>
                                              </div>
                                        </div>
                                        <?php echo form_submit(array('value'=>'Submit', 'class'=>'btn btn-lg btn-primary btn-block login-tr-submit-color')); ?>
                                        <?php echo form_close(); ?>    
                                    <center>
                                    <br/></b><a href="<?php echo base_url('user/help'); ?>">Need help?</a> 
                                    <br></b><a href="<?php echo base_url('user/login'); ?>">Login here</a>
                                    <br></b><a href="<?php echo base_url('user/user_register'); ?>">Register here</a>
                                    <br></b>
                                    <?php $this->load->view('includes/login/copy_login'); ?> 
                                    </center><!--for centered text-->
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </div>
        </div>
        </div>
    </body>
</html>