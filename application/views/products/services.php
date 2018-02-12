
<?php $this->load->view('templates/header/header'); ?>

<div class="row">
    <?php if(!empty($products)): foreach($products as $product): ?>
    <center>
    <div class="col-lg-12">
        <img src="<?php echo base_url().'assets/images/'.$product['image']; ?>" alt="">
        <div class="caption">
            <h4><a href="javascript:void(0);"><?php echo $product['name']; ?></a></h4>
            <h4 class="right">$<?php echo $product['price']; ?> EUR</h4>
        </div>
        <a href="<?php echo base_url().'products/buy/'.$product['id']; ?>"><img src="<?php echo base_url(); ?>assets/images/payments/PayPal-PayNow-Button.png" style="width: 150px;"></a>
    </div>
    </center>
    <?php endforeach; endif; ?>
</div>

<?php $this->load->view('templates/footer/footer'); ?>


