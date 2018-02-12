    <?php $this->load->view('includes/login/header_login'); ?>
    
                   
    <body style="background-image: url('<?php echo base_url() ?>assets/media/background/web_smart_factory_image.jpg'); ">
                         
        <div class="container">
            <!-- background-image: url('<?php echo base_url() ?>assets/media/background/back.jpg'); -->
            <!-- background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/5908/food.png); -->

            <div style="margin-top: 1em;"> 
            
            <div class="row main">
                
                <?php $this->load->view('includes/login/title'); ?>
                
                <div class="main-login main-center" style="margin-bottom: 8em;">

                        <h3>Almost There!</h3>
                        <h4><span>Hello <?php echo $name; ?></span> </h4>
                        <h4><span>Your login email is <?php echo $email;?></span></h4>

                        <small>Please enter a password to begin using the site.</small>
                        <?php $fattr = array('class' => 'form-signin'); echo form_open(site_url().'user/complete/token/'.$token, $fattr); ?>
                        <div class="form-group">
                        <?php echo form_password(array('name'=>'password', 'id'=> 'password', 'placeholder'=>'Password', 'class'=>'form-control', 'value' => set_value('password'))); ?>
                        <?php echo form_error('password') ?>
                        </div>
                        <div class="form-group">
                        <?php echo form_password(array('name'=>'passconf', 'id'=> 'passconf', 'placeholder'=>'Confirm Password', 'class'=>'form-control', 'value'=> set_value('passconf'))); ?>
                        <?php echo form_error('passconf') ?>
                        </div>
                        <?php echo form_hidden('user_id', $user_id);?>
                        <?php echo form_submit(array('value'=>'Complete', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
                        <?php echo form_close(); ?>
                    
                    
                </div>
            </div>
        </div>
        </div>
    </body>
</html>


