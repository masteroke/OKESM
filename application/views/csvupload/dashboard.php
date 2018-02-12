
<?php $this->load->view('csvupload/header'); ?>

<div id="page-heading">
  <h3 align="center">Select Category</h3>
</div>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
  <tr>
    <th rowspan="3" class="sized"><img src="<?php echo base_url('assets/images/shared/side_shadowleft.jpg'); ?>" width="20" height="300" alt="" /></th>
    <th class="topleft"></th>
    <td id="tbl-border-top">&nbsp;</td>
    <th class="topright"></th>
    <th rowspan="3" class="sized"><img src="<?php echo base_url('assets/images/shared/side_shadowright.jpg'); ?>" width="20" height="300" alt="" /></th>
  </tr>
  <tr>
    <td id="tbl-border-left"></td>
    <td><div id="content-table-inner">
        <div id="table-content" align="center">
          <a href="<?php echo base_url('csvupload/import_details'); ?>"><button class="pure-button pure-button-xlarge" style="width:200px;margin-top:100px;">View Data</button></a>
          <a href="<?php echo base_url('csvupload/upload_update_csv'); ?>"><button class="pure-button pure-button-xlarge" style="width:200px;margin-top:100px;margin-left:50px;">Upload CSV</button></a>
        </div>
      </div></td>
    <td id="tbl-border-right"></td>
  </tr>
  <tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
  </tr>
</table>

<?php $this->load->view('csvupload/footer'); ?>


