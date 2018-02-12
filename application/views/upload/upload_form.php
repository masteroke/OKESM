

<?php $this->load->view('includes/header_upload'); ?>
    
<div class="container">
        <div class="row main-center"> 

            <?php echo form_open_multipart('upload/do_upload');?>
            <?php echo "<input type='file' name='userfile' size='20' />"; ?>
            <?php echo "<input type='submit' name='submit' value='upload' /> ";?>
            <?php echo "</form>"?>
        </div>
</div>
