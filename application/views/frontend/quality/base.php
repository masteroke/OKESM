
<?php $this->load->view('templates/header/header_integration'); ?>
<body style="margin:0px;padding: 0px; height: 100%;">
<main role="main" class="header-wrap container-fluid">
    <div class="row">
        <div class="col-md-4">
            <p style="margin-top: 0px;"><span class="glyphicon glyphicon-transfer"></span>Quality</p>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-5 text-center">
            <ul class="list-inline" style="margin-top:1.2em;">
                
                <li><div id="headerDropdownListOne"></div></li>
                <li><div id="headerDropdownListTwo"></div></li>
                
            </ul>
         </div>
    </div>     

    <div class="row">  
              
        <div id="jqxLayout">
            <div data-container="LeftPannelTop">   
                <div id="leftPannelDivImport" style="border:none; height: 100%;" ></div>   
            </div>
            
            <div data-container="RightPannelTop" >
                
                <div id="Splitter1" style="visibility: hidden; display: none;">
                    <div id="ImportHistoryLeft" style="visibility: hidden; display: none;">
                        <div id="ImportHistoryGrid"></div>
                        <input type="button" style="margin: 20px;" id="ImportHistoryGridButton" value="Add new filter" />
                    </div>
                                       
                    <div id="ImportHistoryRight" style="visibility: hidden; display: none;"></div>
                </div>
                
                <div id="Splitter2" style="visibility: hidden; display: none;">

                    <?php $this->load->view('frontend/quality/details'); ?>
                     
                </div>
                
            </div>  
              
            <div data-container="LeftPannelBottom">   
                <div id="leftPannelDivExport" style="border:none; height: 100%;" ></div>   
            </div>
            <div data-container="RightPannelBottom">

            </div> 
              
        </div>
        
        <div class="container">
            <div class="well" style="margin-top: 20px;">

            </div>
        </div> 

    </div>
    


    
</main>

<!-- overview js-->
<script>
    var base_url = '<?=base_url()?>';

</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/overview/integration/ajax.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/overview/integration/column.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/overview/integration/source.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/overview/integration/grid.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/overview/integration/toolbar.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/overview/integration/layout.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/overview/integration/control.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/overview/integration/splitter.js') ?>"></script>
<!-- overview js-->
