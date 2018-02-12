

$(document).ready(function () {


    $.ajax({
    	type:'POST',
        url: controller_view,
        data:  {view: 'frontend/home/mainpage', view_type: 1, debug: false},
        success: function (msg) {
            $("#mainframe").attr("srcdoc", msg);
        },
        error: function (err) {
            $("#mainframe").attr("src", 'about:blank');
        }
    }); 
      
    var fr = $("#mainframe");

    $("#jqxMenu").jqxMenu({ width: fr.height, theme:'metro'});
    
    $('#jqxMenu').bind('itemclick', function (event) {

        var menuitemText = $(args).text(), hash = event.target.hash;

        var url, view, hash_view, v_type, v_page;
        
        console.log('hash -> ', hash);
        
        if(hash.indexOf(":") > 0)
        {
        	v_page = hash.split(":")[0].trim();
        	v_type = hash.split(":")[1].trim();
        	hash = v_page;
        }
        
        if(hash)
        { 
        	hash_view = hash.substring(1);
        	
            url_view = hash_view.split("_").join("/");

            $.ajax({
            	type:'POST',
                url: controller_view,
                data:  {view: url_view, view_type: v_type, debug: false},
                success: function (msg) {
                    $("#mainframe").attr("srcdoc", msg);
                },
                error: function (err) {
                    $("#mainframe").attr("src", 'about:blank');
                }
            }); 
        }
    });
    
    
    // Fluid layout doesn't seem to support 100% height; manually set it

    $(window).resize(function(){
        $('#mainframe').height( $(window).height() - $("#jqxMenu").height() 
                        - parseInt($("#jqxMenu").css("margin-bottom"))
                        - parseInt($("#jqxMenu").css("margin-top")) 
                        - parseInt($('#mainframe').css("margin-bottom")) - 55
                        );  
   });

    fr.attr('width', '100%');
    fr.attr('height', '100%');
    
    $(window).resize();
   
});
