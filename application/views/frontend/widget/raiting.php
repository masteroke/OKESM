

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="jQuery Rating, jqxRating, Rating Widget" /> 
    <meta name="description" content="The jqxRating control represents a widget that allows you to choose a rating." />
    <title id='Description'>The jqxRating control represents a widget that allows you to choose a rating. You can configure the rating item's size, image and the number of displayed items.</title>
    <link rel="stylesheet" href="../../jqwidgets/styles/jqx.base.css" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />	
    <link rel="stylesheet" href="/assets/js/lib/jqwidgets/styles/jqx.arctic.css" type="text/css" />
    <script type="text/javascript" src="/assets/js/lib/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/assets/js/lib/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="/assets/js/lib/jqwidgets/jqxrating.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Create jqxRating
            $("#jqxRating").jqxRating({ width: 350, height: 35, theme: 'classic'});
            $("#jqxRating").on('change', function (event) {
                $("#rate").find('span').remove();
                $("#rate").append('<span>' + event.value + '</span');
            });
        });
    </script>
</head>
<body class='default'>
    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana;">
        <div id='jqxRating'></div>
        <div style='margin-top:10px;'>
           <div style='float: left;'>Rating:</div> <div style='float: left;' id='rate'></div>
        </div>
  </div>
  </body>
</html>