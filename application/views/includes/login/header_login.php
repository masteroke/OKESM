


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        
        <title><?php echo $this->lang->line('title_login');?></title>
        
        <meta name="description" content="overview &amp; stats" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <!--basic css styles-->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/lib/styles/bootstrap.min.css" />
        <!--basic css styles-->
        

        <!-- Website CSS style -->
        <!--<link rel="stylesheet" href="assets/css/font-awesome.min.css">-->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome/font-awesome-4.7.0/css/font-awesome.min.css" />
        
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/lib/styles/font-awesome.min.css" />
        
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/lib/styles/bootstrap.min.css" />
        <!-- Website CSS style -->

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin.registration.css" />
        
        <link rel="stylesheet" href="/assets/js/lib/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="/assets/js/lib/jqwidgets/styles/jqx.arctic.css" type="text/css" />
        <link rel="stylesheet" href="/assets/js/lib/jqwidgets/styles/jqx.metro.css" type="text/css" />
        <script type="text/javascript" src="/assets/js/lib/scripts/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="/assets/js/lib/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="/assets/js/lib/jqwidgets/jqxrating.js"></script>


        <!--basic js-->

        <!--basic js-->
        
        <style>
			.title-tr-raitings {

				font-family: times, Times New Roman, times-roman, georgia, serif;
				line-height: 40px;
				letter-spacing: 1px;
				/*background-color: #3E3E42;*/
                text-align: center;
                font-size: 44px;
                color: #FF9F00;
                
                text-shadow: -1px -1px 0px rgba(255, 255, 255, 0.3), 1px 1px 0px rgba(0, 0, 0, 0.8);

			}
			
			.title_deep_shadow {
                color: #e0dfdc;
                /*background-color: #333;*/
                letter-spacing: .1em;
                font-size: 46px;
                text-shadow: 
                  0 -1px 0 #fff, 
                  0 1px 0 #2e2e2e, 
                  0 2px 0 #2c2c2c, 
                  0 3px 0 #2a2a2a, 
                  0 4px 0 #282828, 
                  0 5px 0 #262626, 
                  0 6px 0 #242424, 
                  0 7px 0 #222, 
                  0 8px 0 #202020, 
                  0 9px 0 #1e1e1e, 
                  0 10px 0 #1c1c1c, 
                  0 11px 0 #1a1a1a, 
                  0 12px 0 #181818, 
                  0 13px 0 #161616, 
                  0 14px 0 #141414, 
                  0 15px 0 #121212, 
                  0 22px 30px rgba(0, 0, 0, 0.9);		    
			    
			}
			
            .title_insetshadow {
        		color: #202020;
        		background-color: #3E3E42;
        		letter-spacing: .1em;
        		text-shadow:
        		-1px -1px 1px #111,
        		2px 2px 1px #363636;
        	}
			
			.login-tr-submit-color{
			    -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.2s;
                background: #3E3E42; 
                border-color: #111111;
                color:#FCFCFC;
			}
			
			.login-tr-submit-color:hover{
                background: #3E3E42;
                color:#FCFCFC;
                opacity: 0.8;
                filter: alpha(opacity=80); /* For IE8 and earlier */
            }
            
.logo {
                opacity: 0.8;
                filter: alpha(opacity=80); /* For IE8 and earlier */
  background: #1b305a;
  font-family: 'Open Sans', sans-serif;
  color: #EEE;
  text-decoration: none;
  text-transform: uppercase;
  font-size: 30px;
  font-weight: 400;
  letter-spacing: 0px;
  line-height: 1;
  /*text-shadow: #FEFEFE 3px 2px 0;*/
  position: relative;
}
.logo:after {
  background: #1b305a;
  font-size: 40px;
  content:"OKE SMART FACTORY";
  position: absolute;
  left: 120px;
  top: 80px;
}
.logo:after {
  /*background: url(https://subtlepatterns.com/patterns/crossed_stripes.png) repeat;*/
  background-image: -webkit-linear-gradient(left top, transparent 0%, transparent 25%, #555 25%, #555 50%, transparent 50%, transparent 75%, #555 75%);
  background-size: 4px 4px;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  z-index: -5;
  display: block;
  text-shadow: none;
}
        </style>
        

        <script type="text/javascript">
            var base_url = '<?php echo base_url()?>';   
        </script>

</head>
