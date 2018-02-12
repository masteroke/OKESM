
<?php $this->load->view('includes/header_login'); ?>  
    <body>
        <div class="container">
            <div class="row main">
                <div class="panel-heading">
                   <div class="panel-title text-center">
                        <h1 class="title">Trusted-Ratings</h1>
                        <hr />
                    </div>
                </div> 
                <div class="main-login main-center">
                
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

                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="<?php echo base_url('user/login_user'); ?>">
                        
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Your Email</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
                                </div>
                            </div>
                        </div>                      

                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label">Password</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Login</button>
                        </div>

                    </form>    
                
                <center><b>Not registered ?</b> <br></b><a href="<?php echo base_url('user'); ?>">Register here</a></center><!--for centered text-->

                    
                </div>
            </div>
        </div>
    </body>
</html>