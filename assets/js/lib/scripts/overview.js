function showHideDivs(div1, div2, div3, div4)
{
    'use strict';
    $('#BarGaugeLegend').css('display', 'none');

    div1.css('display', 'block');
    div2.css('display', 'block');

    if (div1 === undefined)
    {
        div1.css('display', 'inline-block');
    }
    if (div2 !== undefined)
    {
        div2.css('display', 'inline-block');
    }    
    if (div3 !== undefined)
    {
        div3.css('display', 'inline-block');
    }
    if (div4 !== undefined)
    {
        div4.css('display', 'inline-block');
    }
}

function menuData()
{
    'use strict';
    
    var viewsdata = [{
        views: ''
    }, {
        views: ''
    }];

    var source = {
        dataType: 'json',
        dataFields: [{
            name: 'views',
            type: 'string'
        }],
        localdata: viewsdata
    };
    var dataAdapter = new $.jqx.dataAdapter(source);

    $('#leftPannelDiv').jqxDataTable({
        width: '100%',
        height: '100%',
        showHeader: false,
        source: dataAdapter,
        theme: 'metro',
        ready: function ()
        {
            $('#leftPannelDiv').jqxDataTable('selectRow', 0);
        },
        columns: [

		{ text: 'Photo', align: 'center', dataField: 'views', width: 80,
			cellsRenderer: function(row, column, value, rowData) {
				var image = "<div style='margin: 5px;'>";
				var imgurl = '../../../media/misc/4.png';
				var img = '<img width="65" height="34" style="display: block;" src="' + imgurl + '"/>';
				image += img;
				image += "</div>";
				return image;
			}
		},
        {
            text: '',
            dataField: 'views',
            width: '100%'
        }]
    });
}


function InitOverviewTable(init)
{
    'use strict';
    showHideDivs($('#machineOverviewTable'),$('#2'));
	if (init)
	return;
}

$(document).ready(function ()
{
    'use strict';

    var sourceDropdownlist = {
        datatype: 'json',
        datafields: [
               { name: 'fullname', type: 'string', map: 'employeeName' },
               { name: 'picture', type: 'string', map: 'employeePhoto' },
               { name: 'CompanyId' }
        ],
        async: false,
        url: 'data.php?usedwidget=employeedropdown'
    };

    var dataAdapterHeaderDropDownList = new $.jqx.dataAdapter(sourceDropdownlist, {
        loadComplete: function () { },
        beforeLoadComplete: function () { }
    });

    $('#headerDropdownListOne').jqxDropDownList({
        width: 250,
        height: 30,
        source: dataAdapterHeaderDropDownList,
        theme: 'metrodark',
        displayMember: 'fullname',
        valueMember: 'CompanyId',
        selectedIndex: 1,
        renderer: function (index, label, value) {
            var data = dataAdapterHeaderDropDownList.getrecords();
            var datarecord = data[index];
            var imgurl = '../../../images/' + datarecord.picture;
            var img = '<img height="50" width="45" src="' + imgurl + '"/>';
            var table = '<table style="min-width: 150px;"><tr><td style="width: 55px;" rowspan="2">' + img + '</td><td>' + datarecord.fullname + ' - ID: ' + value + '</td></tr>' + '</table>';
            return table;
        }
    });

    $('#headerDropdownListTwo').jqxDropDownList({
        width: 250,
        height: 30,
        source: dataAdapterHeaderDropDownList,
        theme: 'metrodark',
        displayMember: 'fullname',
        valueMember: 'CompanyId',
        selectedIndex: 2,
        renderer: function (index, label, value) {
            var data = dataAdapterHeaderDropDownList.getrecords();
            var datarecord = data[index];
            var imgurl = '../../../images/' + datarecord.picture;
            var img = '<img height="50" width="45" src="' + imgurl + '"/>';
            var table = '<table style="min-width: 150px;"><tr><td style="width: 55px;" rowspan="2">' + img + '</td><td>' + datarecord.fullname + ' - ID: ' + value + '</td></tr>' + '</table>';
            return table;
        }
    });

    var DropDownListOneItem, DropDownListTwoItem;
    var OverviewTableAdapter;

    DropDownListOneItem = $('#headerDropdownListOne').jqxDropDownList('getSelectedItem');
    DropDownListTwoItem = $('#headerDropdownListTwo').jqxDropDownList('getSelectedItem');

    var layout = [{
        type: 'layoutGroup',
        orientation: 'horizontal',
        items: [
        {
            type: 'layoutGroup',
            orientation: 'vertical',
            width: '15%',
            items: [{
                type: 'tabbedGroup',
                height: '100%',
                items: [{
                    type: 'layoutPanel',
                    title: 'Views',
                    contentContainer: 'LeftPannel',
                    initContent: function ()
                    {
                        menuData();
                    }
                }]
            }]
        }, {
            type: 'layoutGroup',
            orientation: 'vertical',
            width: '85%',
            items: [{
                type: 'tabbedGroup',
                height: '100%',
                items: [{
                    type: 'layoutPanel',
                    title: 'Location: Goslar',
                    contentContainer: 'RightPannel',
                    initContent: function ()
                    {
                        InitOverviewTable(true);
                    }
                }]
            }]
        }]
    }];
    
    $('#jqxLayout').jqxLayout({ width: '100%', height: 882, layout: layout, contextMenu: true, resizable: false, theme: 'metro' });

    $('.buttons').on('click', function (event)
    {
        $('#firstButton').removeClass('active');
        $('#secondButton').removeClass('active');
        $('#thirdButton').removeClass('active');
        $('#' + event.target.id).addClass('active');
    });

    var updateSources = function () {    
        WhichToUpdate();
    };

    $('#headerDropdownListOne').on('select', function (event)
    {
        updateSources();
    });

    $('#headerDropdownListTwo').on('select', function (event)
    {
        updateSources();
    });


    function WhichToUpdate()
    {
        var leftEmployeeID = $('#headerDropdownListOne').jqxDropDownList('getSelectedItem');
        
        var rightEmployeeID = $('#headerDropdownListTwo').jqxDropDownList('getSelectedItem');
     
        if ($('#machineOverviewTable').css('display') === 'block'){

	        //UpdateOverviewTable();
        } 
        
    }
    
	var init = [];
	var lastIndex = -1;

    $('#leftPannelDiv').on('rowSelect', function (event)
    {
        var boundIndex = event.args.boundIndex;	
		if (lastIndex === boundIndex)
			return;
		lastIndex = boundIndex;
	    
        console.log(boundIndex);
        	
        if (boundIndex === 0)
        {
		    InitOverviewTable(init[boundIndex]);
        }
        
    	init[boundIndex] = true;
    	
        WhichToUpdate();
    });
});

