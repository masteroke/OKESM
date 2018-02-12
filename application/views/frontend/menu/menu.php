
<?php
    $user_id=$this->session->userdata('id');
    if(!$user_id){
      redirect('user/login');
    }
?>

<?php $this->load->view('includes/overview/header_menu'); ?>

<body style="background-color: #A9ACB4; margin-top:-15px;padding: 1px; height: 100%;">

    <div id="container" class="container-fluid">
        <div class="well">
        <div class="row">
        <div id='jqxMenu' style="border: 1px solid #3E3E42; border-radius: 0px;" class="jqx-menu-header">
            
            <div class="vcenter">
            <ul style="margin-top: 0.4em;">
                
                <li style="margin-left:1.4em;">
                    <p><span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-right:0.3em; font-size: 25px;"></span>
                        <a href="#frontend_home_mainpage:1">Hauptseite</a>
                    </p>
                </li>
                <li style="margin-left:1.4em;">
                    <p><span class="glyphicon glyphicon-th-list" aria-hidden="true" style="margin-right:0.3em; font-size: 25px;"></span>
                        <a href="#frontend_overview_base:1">Overview</a>
                    </p>
                </li>
                <li style="margin-left:1.4em;">
                    <p><span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="margin-right:0.3em; font-size: 25px;"></span>
                        <a href="#frontend_quality_base:2">Quality</a>
                    </p>
                </li>
                <li style="margin-left:1.4em;">
                    <p><span class="glyphicon glyphicon-stats" aria-hidden="true" style="margin-right:0.3em; font-size: 25px;"></span>
                        <a href="#frontend_statistics_base:1">Statistics</a>
                    </p>
                </li>
                <li style="margin-left:1.4em;">
                    <p><span class="glyphicon glyphicon-dashboard" aria-hidden="true" style="margin-right:0.3em; font-size: 25px;"></span>
                        <a href="#frontend_dashboard_base:1">Dashboard</a>
                    </p>
                </li>
                <li style="margin-left:1.4em;">
                    <p><span class="glyphicon glyphicon-wrench" aria-hidden="true" style="margin-right:0.3em; font-size: 25px;"></span>
                        <a href="#frontend_settings_base:1">Settings</a>
                    </p>
                </li>
                <li style="margin-left:1.4em;">
                    <p><span class="glyphicon glyphicon-user" aria-hidden="true" style="margin-right:0.3em; font-size: 25px;"></span>
                        <a href="#userprofile:1">Benutzer</a>
                    </p>
                </li>  
                <li style="margin-left:1.4em;">
                    <p><span class="glyphicon glyphicon-import" aria-hidden="true" style="margin-right:0.3em; font-size: 25px;"></span>
                        <a href="#csvupload_dashboard">Import</a>
                    </p>
                </li> 
                <li style="margin-left:1.4em;">
                    <p><span class="glyphicon glyphicon-off" aria-hidden="true" style="margin-right:0.3em; font-size: 25px;"></span>
                        <a href="<?php echo base_url('user/user_logout');?>">Abmeldung</a>
                    </p>
                </li>  

            </ul>
            </div>
        </div> 
        </div>

                <!--<iframe id="mainframe" data-src="#" src="about:blank" scrolling="no" style="border: 1px solid #3E3E42; margin-top: 0.4em;"></iframe>-->
                  
                <!--<div id="mainframe" style="margin-top: 0.4em; height: 100%; width: 100%;"></div>-->

        <div class="row">
            <iframe id="mainframe" data-src="#" src="about:blank" scrolling="yes" style="border: 0px;  margin-top: 0.1em;"></iframe>
            <!--
            <div class="sidebar col-xs-1" style="width: 6%; margin-top: 0.1em; height: 100%;">
                     <div class="well" style="width: 100px;">
                     <table height="100%" width="100%">
                        <tr><td><input style="height: 60px; width: 60px;" id="monitor" type="image" alt="Monitor" src="<?php echo base_url(); ?>assets/images/frontend/work-productivity/png/monitor.png"></td></tr>
                        <tr><td><input style="height: 60px; width: 60px;" id="archive" type="image" alt="archive" src="<?php echo base_url(); ?>assets/images/frontend/work-productivity/png/archive.png"></td></tr>
                        <tr><td><input style="height: 60px; width: 60px;" id="analytics" type="image" alt="analytics" src="<?php echo base_url(); ?>assets/images/frontend/work-productivity/png/analytics.png"></td></tr>
                        <tr><td><input style="height: 60px; width: 60px;" id="search" type="image" alt="search" src="<?php echo base_url(); ?>assets/images/frontend/work-productivity/png/search.png"></td></tr>
                        <tr><td><input style="height: 60px; width: 60px;" id="team" type="image" alt="team" src="<?php echo base_url(); ?>assets/images/frontend/work-productivity/png/team.png"></td></tr>
                        <tr><td><input style="height: 60px; width: 60px;" id="laptop" type="image" alt="laptop" src="<?php echo base_url(); ?>assets/images/frontend/work-productivity/png/laptop.png"></td></tr>
                    </table>            
                    </div>
           </div>                
            <div class= "main col-xs-9" style="width: 94%;">
                    <iframe id="mainframe" data-src="#" src="about:blank" scrolling="yes" style="border-left: 1px solid #aaa; border-right: 0px; border-top: 0px; border-bottom: 0px;  margin-top: 0.1em;"></iframe>              
            </div> 
            -->
        </div>
        
        
    </div>

    </div>
    
    <script>
        var base_url = '<?=base_url()?>';
        var controller_view = base_url + 'viewloader/get_view_ajax';
    </script>
</body>
</html>