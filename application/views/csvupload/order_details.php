<?php include('header.php'); ?>

<div align="center"><a href="<?php echo $url; ?>">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $url; ?>csvupload/upload_csv">CSV Upload</a></div>
<div id="page-heading">
  <h3>Order Details</h3>
</div>
<div align="center">
<form action="<?php echo $url; ?>csvupload/search" method="post">
  <input type="text" name="search"  />
  <input type="submit" value="Search" class="pure-button pure-button-xlarge"/>
</form>
</div>
<table border="0" width="100%"cellpadding="0" cellspacing="0" id="content-table">
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
        <div id="table-content">
        <?php if(empty($records)){ ?><h1 align="center" style="color:#CC0000;font-size:36px;">No record</h1><?php  }else{  ?>
          <form id="mainform" action="">
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
              <tr>
                <th class="table-header-repeat line-left minwidth-1"><a href="<?php echo $url; ?>csvupload/<?php echo $sort_id; ?>">Ordernumber</a> </th>
                <th class="table-header-repeat line-left minwidth-1"><a href="<?php echo $url; ?>csvupload/<?php echo $sort_fname; ?>">First Name</a></th>
                <th class="table-header-repeat line-left"><a href="<?php echo $url; ?>csvupload/<?php echo $sort_lname; ?>">Last Name</a></th>
                <th class="table-header-repeat line-left"><a href="<?php echo $url; ?>csvupload/<?php echo $sort_country; ?>">Productname</a></th>
                <th class="table-header-repeat line-left"><a href="<?php echo $url; ?>csvupload/<?php echo $total; ?>">Orderdate</a></th>
                <th class="table-header-options line-left"><a href="#">Options</a></th>
              </tr>
             <?php $count = 1; ?>
              <?php foreach($records as $data){ ?>
              <tr> 	
                <td><?php echo $data->ordernumber; ?></td>
                <td><?php echo $data->nameofseller; ?></td>
                <td><?php echo $data->secondnameofseller; ?></td>
                <td><?php echo $data->productname; ?></td>
                <td><?php echo $data->orderdate; ?></td>
                <td class="options-width"><a href="<?php echo $url; ?>csvupload/edit_order/<?php echo $data->ordernumber; ?>" title="Edit" class="icon-1 info-tooltip"></a> 
                    <a href="<?php echo $url; ?>csvupload/view_order/<?php echo $data->ordernumber; ?>" title="View" class="icon-5 info-tooltip"></a> 
                </td>
              </tr>
              <?php } ?>
            </table>
          </form>
          <?php } ?>
          <?php echo $this->pagination->create_links();?>
        </div>
        <div class="clear"></div>
      </div></td>
    <td id="tbl-border-right"></td>
  </tr>

</table>

<?php include('footer.php'); ?>
