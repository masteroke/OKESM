<?php include('header.php'); ?>


<div align="center">&nbsp;&nbsp;<a href="<?php echo $url; ?>csvupload/upload_csv">CSV Upload</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $url; ?>csvupload/import_details">View Data</a></div>
<div id="page-heading">
  <h3 align="center">View Item</h3>
</div>
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
  <tr>
    <th rowspan="3" class="sized"><img src="<?php echo $url; ?>assets/images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
    <th class="topleft"></th>
    <td id="tbl-border-top">&nbsp;</td>
    <th class="topright"></th>
    <th rowspan="3" class="sized"><img src="<?php echo $url; ?>assets/images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
  </tr>
  <tr>
    <td id="tbl-border-left"></td>
    <td><div id="content-table-inner">
        <div id="table-content" align="center"> 
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">


              <?php $this->load->view('csvupload/view_item_tr', Array(
              'I1' => 'Bestellnummer',  'N1' => 'ordernumber',  'f1' => 'ordernumber',
              'I2' => 'Produktname',    'N2' => 'orderdate',    'f2' => 'orderdate'
              )); ?>

              <?php $this->load->view('csvupload/view_item_tr', Array(
              'I1' => 'Anzahl Tage',  'N1' => 'receiveddaysafter',  'f1' => 'receiveddaysafter',
              'I2' => 'Verk. E-Mail',    'N2' => 'emailofseller',  'f2' => 'emailofseller'
              )); ?>
              
              <?php $this->load->view('csvupload/view_item_tr', Array(
              'I1' => 'Verk. Name',  'N1' => 'nameofseller',  'f1' => 'nameofseller',
              'I2' => 'Verk. Nachname',    'N2' => 'secondnameofseller',    'f2' => 'secondnameofseller'
              )); ?>
              
              <?php $this->load->view('csvupload/view_item_tr', Array(
              'I1' => 'Produkt SKU',  'N1' => 'product_sku',  'f1' => 'product_sku',
              'I2' => 'Produktname',    'N2' => 'productname',  'f2' => 'productname'
              )); ?>

              <?php $this->load->view('csvupload/view_item_tr', Array(
              'I1' => 'Produkt URL',  'N1' => 'producturl',  'f1' => 'producturl',
              'I2' => 'Produkt GTIN',    'N2' => 'product_gtin',  'f2' => 'product_gtin'
              )); ?>
              
              <tr>
                <th>&nbsp;</th>
               <!-- <td valign="top"><br />
                  <input type="button" value="" class="form-submit" style="margin-left:-76px;" />
                </td>-->
                <td></td>
              </tr>
            </table>
      </div></td>
    <td id="tbl-border-right"></td>
  </tr>
  <tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
  </tr>
</table>

<?php include('footer.php'); ?>
