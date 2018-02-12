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
                        $error_msg = $this -> session -> flashdata('error_msg');
                        if ($error_msg) {
                            echo $error_msg;
                        }
                    ?>
                                
                    <form class="form-horizontal" method="post" action="<?php echo base_url('user/register'); ?>">
                        
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label"><?php echo $this->lang->line('name_registration');?></label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="name" id="name"  placeholder="<?php echo $this->lang->line('name_placeholder_registration');?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Your Email (required)</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="lastname" class="cols-sm-2 control-label">Last Name (required)</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Enter your Lastname"/>
                                </div>
                            </div>
                        </div>     
                        
                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label">User Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button login-tr-submit-color">Register</button>
                        </div>

                    </form>
                    
                        <center>
                        <b>Already registered?</b>
                        <br>
                        </b><a href="<?php echo base_url('user/login'); ?>">Login here</a>
                        <br></b><a href="<?php echo base_url('user/help'); ?>">Need help?</a> 
                        <br></b><a href="www.oke.de">© 2018 OKE Group</a>
                    </center><!--for centered text-->
                    
                </div>
            </div>
        </div>
    </div>
    </body>
</html>