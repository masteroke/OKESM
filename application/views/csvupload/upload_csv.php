<?php include('header.php'); ?>
<main role="main" class="header-wrap container-fluid">
<div align="center"><a href="<?php echo $url; ?>csvupload/import_details_all">View Data</a></div>
<div id="page-heading">
  <h3 align="center">Map CSV Columns</h3>
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
          <?php if($page_status==1){ ?>
          <form enctype="multipart/form-data" method="post" action="<?php echo $url; ?>csvupload/upload_update_csv">
            <table>
              <tr>
                <th>Upload :&nbsp;</th>
                <td><input type="file" name="userfile" class="file_1" /></td>
                <td><div class="bubble-left"></div>
                  <div class="bubble-inner"><?php echo $error; ?></div>
                  <div class="bubble-right"></div></td>
              </tr>
              <tr>
                <th>&nbsp;</th>
                <td valign="top"><br />
                  <input type="submit" value="" name="btnUpload" class="form-submit" style="margin-left:76px;" />
                </td>
                <td></td>
              </tr>
            </table>
          </form>
          <br />
          <?php } ?>
          <?php if($page_status==2){ ?>
          <form action="<?php echo $url; ?>csvupload/upload_update_csv" method="post">
            <input type="hidden" name="hdnFile" value="<?php echo $file; ?>" />
            <table border="0" cellpadding="0" cellspacing="0"  id="id-form">

               <!--
                    $csv_header = array(
                        'ordernumber',
                        'orderdate',
                        'receiveddaysafter',
                        'emailofseller',
                        'nameofseller',
                        'secondnameofseller',
                        'product_sku',
                        'productname',
                        'producturl',
                        'product_gtin',
                        'product_img',
                        'email_sent_date1',
                        'has_been_sent1',
                        'email_sent_date2',
                        'has_been_sent2'
                    );                    
                -->
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'Bestellnummer',  'N1' => 'ordernumber',          'S1' => '',    'I2' => 'Bild-URL',  'N2' => 'product_img', 'S2' => '')); ?>
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'Bestelldatum',   'N1' => 'orderdate',            'S1' => '',    'I2' => 'E-Mail Datum1',  'N2' => 'email_sent_date1', 'S2' => '')); ?>
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'AnzLT',          'N1' => 'receiveddaysafter',    'S1' => '',    'I2' => 'Gesendet 1',  'N2' => 'has_been_sent1', 'S2' => '')); ?>
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'Verk-Email',     'N1' => 'emailofseller',        'S1' => '',    'I2' => 'E-Mail Datum2',  'N2' => 'email_sent_date2', 'S2' => '')); ?>
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'Verk-Vorname',   'N1' => 'nameofseller',         'S1' => '',    'I2' => 'Gesendet 2',  'N2' => 'has_been_sent2', 'S2' => '')); ?>
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'Verk-Nachname',  'N1' => 'secondnameofseller',   'S1' => '',    'I2' => 'attr6',  'N2' => 'attr6', 'S2' => '')); ?>
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'Prod-SKU',       'N1' => 'product_sku',          'S1' => '',    'I2' => 'attr7',  'N2' => 'attr7', 'S2' => '')); ?>
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'Prod-Name',      'N1' => 'productname',          'S1' => '',    'I2' => 'attr8',  'N2' => 'attr8', 'S2' => '')); ?>
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'Prod-URL',       'N1' => 'producturl',           'S1' => '',    'I2' => 'attr9',  'N2' => 'attr9', 'S2' => '')); ?>
            <?php $this->load->view('csvupload/upload_item_tr', Array('I1' => 'Prod-GTIN',      'N1' => 'product_gtin',         'S1' => '',    'I2' => 'attr10', 'N2' => 'attr10', 'S2' => '')); ?>

              <tr>
                <th>&nbsp;</th>
                <td valign="top"><br />
                  <input type="submit" value="Save Mapping" name="btnUpdate" class="form-submit" style="margin-left:150px;" />
                </td>
                <td></td>
              </tr>
            </table>
          </form>
          <?php } ?>
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
</main>
<?php include('footer.php'); ?>
