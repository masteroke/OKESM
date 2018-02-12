
var me = this, ImportHistoryDataTableAdapter;
var menudata = [];

function showHideDivs(div1, div2, div3, div4, div5, div6)
{
    'use strict';

	$('#Splitter1').css('display', 'none');
	$('#Splitter2').css('display', 'none');
	
	$('#ImportHistoryLeft').css('display', 'none');
	$('#ImportHistoryRight').css('display', 'none');
	$('#ImportDetailsLeft').css('display', 'none');
	$('#ImportDetailsRight').css('display', 'none');

    
    if (div1 !== undefined)
    {
        div1.css('display', 'block');
        div1.css('visibility', 'visible');
    }
    if (div2 !== undefined)
    {
        div2.css('display', 'block');
        div2.css('visibility', 'visible');
    }
    if (div3 !== undefined)
    {
    	div3.css('display', 'block');
        div3.css('visibility', 'visible');
    }
    if (div4 !== undefined)
    {
    	div4.css('display', 'block');
        div4.css('visibility', 'visible');
    }    
    if (div5 !== undefined)
    {
        div5.css('display', 'block');
        div5.css('visibility', 'visible');
    }
    if (div6 !== undefined)
    {
        div6.css('display', 'block');
        div6.css('visibility', 'visible');
    }
}

function menuImportData()
{
    'use strict';
    
    menudata = [

    {step: 'File Preview'}, 
    {step: 'Import Details'}, 
    {step: 'Entities Options'}, 
    {step: 'Sending Options'}, 
    {step: 'Tasks'}, 
    {step: 'View log'}, 
	];

    var source = {
        dataType: 'json',
        dataFields: [{
            name: 'step',
            type: 'string'
        }],
        localdata: menudata
    };
    var dataAdapter = new $.jqx.dataAdapter(source);

    $('#leftPannelDivImport').jqxDataTable({
        width: '100%',
        height: '100%',
        showHeader: false,
        source: dataAdapter,
        theme: 'metro',
        ready: function ()
        {
            $('#leftPannelDivImport').jqxDataTable('selectRow', 0);
        },
        columns: [
        {
            text: '',
            dataField: 'step',
            width: '100%'
        }]
    });
}

function menuExportData()
{
    'use strict';
    
    menudata = [{
        step: 'Step 1'
    }, {
        step: 'Export 30.12.2017 12:14'
    }];
    
    var mydata = [
    	{ "id": 1, "parentid": 2, "manually": "shop1", "task": "shop1", "custom": "shop1", "exportdate": "2018-01-01 00:00:00"},
    	{ "id": 2, "parentid": 2, "manually": "shop1", "task": "shop1", "custom": "shop1", "exportdate": "2018-01-02 00:00:00"},
    	{ "id": 3, "parentid": 2, "manually": "shop1", "task": "shop1", "custom": "shop1", "exportdate": "2018-01-03 00:00:00"},
    	{ "id": 4, "parentid": 2, "manually": "shop1", "task": "shop1", "custom": "shop1", "exportdate": "2018-01-04 00:00:00"}
    ];

    var source = {
        dataType: 'json',
        dataFields: [{
            name: 'step',
            type: 'string'
        }
        ],
        localdata: menudata
    };

    
    var dataAdapter = new $.jqx.dataAdapter(source);

    $('#leftPannelDivExport').jqxDataTable({
        width: '100%',
        height: '100%',
        showHeader: false,
        source: dataAdapter,
        theme: 'metro',
        ready: function ()
        {
            $('#leftPannelDivExport').jqxDataTable('selectRow', 0);
        },
        columns: [
        {
            text: '',
            dataField: 'step',
            width: '100%'
        }]
    });
}

function ImportHistory(init)
{
    'use strict';

	showHideDivs($('#Splitter1'), $('#ImportHistoryLeft'), $('ImportHistoryRight'));

	if (init)
	return;
	
	console.log('Init -> ImportHistory');
	loadSplitter('#Splitter1', 2);	
	ImportHistoryDataTableAdapter = new $.jqx.dataAdapter([]);
	ImportHistoryDataTable();
	ImportHistoryUpdate();

}
function ImportHistoryDataTable(){
	'use strict';
	
	var headers = [], widths = [], colModel;
	
    /*
     * Create DataTable
     * 
		sec
		user
		upload_id
		name
		ordernumber
		orderdate
		receiveddaysafter
		emailofseller
		nameofseller
		secondnameofseller
		product_sku
		productname
		producturl
		product_gtin
		product_img
		email_sent_date1
		has_been_sent1
		email_sent_date2
		has_been_sent2
		attr6
		date_created
		active
		
		sec,user,file_name,file_path,ip,alias,data_created,host,active
     */    
    headers = ['LaufNr','Benutzer', 'Dateiname', 'Verzeichnis', 'IP', '', 'Erstellt', 'Host', 'Aktiv'];
    widths = [80, 100, 200, 400, 80, 50];
    
	colModel = createColumnModel(headers, widths);
	
	console.log('Create -> ImportHistoryDataTable');
	
	var renderToolbar = $('#ImportHistoryGrid').jqxDataTable('renderToolbar'); 
	
    $("#ImportHistoryGrid").jqxDataTable(
    {
        width: '100%',
        height: '100%',
        theme: 'metro',
        showToolbar: true,
        pageable: true,
        pagerButtonsCount: 10,
        filterable: true,
        columnsResize: true,
        autoRowHeight: false,
        sortable: true,
        source: ImportHistoryDataTableAdapter,
        columns: colModel,
		renderToolbar: function (toolbar) {
	        // appends buttons to the status bar.
	        var container 	 = $("<div style='overflow: hidden; position: relative; margin: 5px;'></div>");
	        var addButton    = $("<div style='float: left; margin-left: 5px;'><div id='addButton' class='glyphicon glyphicon-plus' style='cursor:pointer; margin-top:2px;'></div><span style='margin-left: 2px; position: relative; margin-top: 4px;'>Add</span></div>");
	
	        container.append(addButton);

	        toolbar.append(container);
	
	        addButton.jqxButton	  ({  width: 100, height: 20 });
	
	        // add new row.
	        addButton.click(function (event) {
	        	
	        	var me = $("#ImportHistoryGrid");
	        	
				var selection = me.jqxDataTable('getSelection');
				
				if (selection && selection.length > 0) {
					
					console.log(selection);
					
                    var rows = me.jqxDataTable('getRows');	
                }
                
                
				
	        });
	        
	        return container;

		}

    });	
    
	$("#ImportHistoryGridButton").jqxButton({
	    theme: 'metro',
	    width: 200,
	    height: 30
	});
	$('#ImportHistoryGridButton').click(function () {
	    var filtertype = 'stringfilter';
	    // create a new group of filters.
	    var filtergroup = new $.jqx.filter();
	    var filter_or_operator = 1;
	    var filtervalue = "active";
	    var filtercondition = 'equal';
	    var filter = filtergroup.createfilter(filtertype, filtervalue, filtercondition);
	    filtergroup.addfilter(filter_or_operator, filter);
	    // add the filters.
	    $("#ImportHistoryGrid").jqxDataTable('addFilter', 'orderdate', filtergroup);
	    // apply the filters.
	    $("#ImportHistoryGrid").jqxDataTable('applyFilters');
	});
	
}
function ImportHistoryUpdate(){
    'use strict';

	console.log('Update -> ImportHistoryUpdate');
	
	var data = getData('csvupload', 'import_files'); 
	
	var source = {dataType: "json", localdata: data};
	
	ImportHistoryDataTableAdapter = new $.jqx.dataAdapter(source);
	$('#ImportHistoryGrid').jqxDataTable({ source: ImportHistoryDataTableAdapter });
	$("#ImportHistoryGrid").jqxDataTable('refresh');
	
}

function ImportDetails(init)
{
    'use strict';
    
    showHideDivs($('#Splitter2'),$('#ImportDetailsLeft'),$('#ImportDetailsRight'));

	if (init)
	return;
	
	console.log('Init -> ImportDetails');
	
    loadSplitter('#Splitter2', 2);	        
    loadGrid2('#jqxGridAdapt');
    loadGridToolbarCntrl('#jqxGridAdapt');

    
}
function ImportDetailsUpdate()
{
    'use strict';

	console.log('Update -> ImportDetailsUpdate');
}

function InitOverviewTableExport(init)
{
    'use strict';

	if (init)
	return;
}

$(document).ready(function ()
{
    'use strict';
    
    var init = [];
	
	for(var i = 0; i < 100; i++) {
    	init.push(false);
	}
	
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
            width: '10%',
            items: [
            {
                type: 'tabbedGroup',
                height: '100%',
                items: [
                {
                    type: 'layoutPanel',
                    title: 'Imports',
                    contentContainer: 'LeftPannelTop',
                    
                    initContent: function ()
                    {
                        menuImportData();
                    }
                }
                
                ]
            },
            
            {
                type: 'tabbedGroup',
                height: '100%',
                items: [
                {
                    type: 'layoutPanel',
                    title: 'Exports',
                    contentContainer: 'LeftPannelBottom',
                    
                    initContent: function ()
                    {
                        menuExportData();
                    }
                }
                
                ]
            }
            
            ]
        }, {
            type: 'layoutGroup',
            orientation: 'vertical',
            width: '90%',
            items: [
            {
                type: 'tabbedGroup',
                height: '100%',
                items: [
                {
                    type: 'layoutPanel',
                    title: 'Import Data',
                    contentContainer: 'RightPannelTop',
                    initContent: function ()
                    {
                        //ImportDetails(true);
                    }
                }               
                ]
            },
            {
                type: 'tabbedGroup',
                height: '100%',
                items: [
                {
                    type: 'layoutPanel',
                    title: 'Export Data',
                    contentContainer: 'RightPannelBottom',
                    initContent: function ()
                    {
                        InitOverviewTableExport(true);
                    }
                }               
                ]
            }
            
            ]
        }]
    }];
    
    $('#jqxLayout').jqxLayout({ width: '100%', height: 400, layout: layout, contextMenu: true, resizable: true, theme: 'metro' });

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
     
        if ($('#ImportHistoryGrid').css('display') === 'block'){

	        ImportHistoryUpdate();
        } 
        if ($('#ImportDetailsContent').css('display') === 'block'){

	        ImportDetailsUpdate();
        } 
                
    }

	var lastIndex = -1;

    $('#leftPannelDivImport').on('rowSelect', function (event)
    {
        var boundIndex = event.args.boundIndex;	
        
        console.log(boundIndex, init[boundIndex]);
        	
        if (boundIndex === 0)
        {
		    ImportHistory(init[boundIndex]);   
        }
        if (boundIndex === 1)
        {
		    ImportDetails(init[boundIndex]);
        }
        
    	init[boundIndex] = true;
    	
        WhichToUpdate();
    });
    
    $('#leftPannelDivExport').on('rowSelect', function (event)
    {
        var boundIndex = event.args.boundIndex;	

        console.log(boundIndex);
        	
        if (boundIndex === 0)
        {
		    //InitOverviewTableExport(init[boundIndex]);
        }

        
    	//init[boundIndex] = true;
    	
        //WhichToUpdate();
    });
});

