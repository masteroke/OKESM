

$("#ordernumber").jqxInput({width: '100%', height: 20});
$("#orderdate").jqxInput({ width: '100%', height: 20});
$("#receiveddaysafter").jqxInput({ width: '100%', height: 20});
$("#emailofseller").jqxInput({ width: '100%', height: 20});
$("#nameofseller").jqxInput({ width: '100%', height: 20, theme: 'metro'});
$("#secondnameofseller").jqxInput({width: '100%', height: 20, theme: 'metro'});
$("#product_sku").jqxInput({ width: '100%', height: 20});
$("#productname").jqxInput({ width: '100%', height: 20});
$("#producturl").jqxInput({ width: '100%', height: 20});
$("#product_gtin").jqxInput({ width: '100%', height: 20, theme: 'metro'});
$("#Save").jqxButton({  width: 150, height: 20 });

// clear filters.

function loadGridToolbarCntrl(id) {
	

	$(id).on('rowselect', function (event) {
	    // event arguments.
	    var args = event.args;
	    // selected row.
	    var row = event.args.row;
	    // update inputs.
	    $("#ordernumber").val(row.ordernumber);
	    $("#orderdate").val(row.orderdate);
	    $("#receiveddaysafter").val(row.receiveddaysafter);
	    $("#emailofseller").val(row.emailofseller);
	    $("#nameofseller").val(row.nameofseller);
	    $("#secondnameofseller").val(row.secondnameofseller);
	    $("#product_sku").val(row.product_sku);
	    $("#productname").val(row.productname);
	    $("#producturl").val(row.producturl);
	    $("#product_gtin").val(row.product_gtin);
	    
	});
	
    // create jqxWindows.
    $("#windowSearch").jqxWindow({ resizable: false,  autoOpen: false, width: 210, height: 180 });
    $("#windowLoad").jqxWindow({ resizable: false,  autoOpen: false, width: 500, height: 500, isModal: true, modalZIndex: 99999, position: 'center'});
    
    // create find and clear buttons.
    $("#findButton").jqxButton({ width: 70});
    $("#clearButton").jqxButton({ width: 70});
    // create dropdownlist.
    $("#dropdownlist").jqxDropDownList({ autoDropDownHeight: true, selectedIndex: 0, width: 200, height: 23, 
        source: [
            'ordernumber', 'orderdate'
        ]
    });
    if (theme != "") {
        $("#inputField").addClass('jqx-input-' + theme);
    }
	$("#clearButton").click(function () {
	    $(id).jqxGrid('clearfilters');
	});
	
	// find records that match a criteria.
	$("#findButton").click(function () {
	    $(id).jqxGrid('clearfilters');
	    var searchColumnIndex = $("#dropdownlist").jqxDropDownList('selectedIndex');
	    var datafield = "";
	    switch (searchColumnIndex) {
	        case 0:
	            datafield = "ordernumber";
	            break;
	        case 1:
	            datafield = "orderdate";
	            break;
	    }
	    var searchText = $("#inputField").val();
	    var filtergroup = new $.jqx.filter();
	    var filter_or_operator = 1;
	    var filtervalue = searchText;
	    var filtercondition = 'contains';
	    var filter = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
	    filtergroup.addfilter(filter_or_operator, filter);
	    $(id).jqxGrid('addfilter', datafield, filtergroup);
	    // apply the filters.
	    $(id).jqxGrid('applyfilters');
	});
};

