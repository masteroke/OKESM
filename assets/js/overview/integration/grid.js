

function loadGrid(id) {
	$(id).jqxGrid(
	{
	    width: getWidth('grid'),
	    source: getSource(),
	    showfilterrow: true,
	    filterable: true,
	    pageable: true,
	    autoheight: true,
	    editable: true,
	    localization: getLocalization('de'),
	    selectionmode: 'singlecell',
	    columns: [
	      { text: 'Name', columntype: 'textbox', filtertype: 'textbox', datafield: 'name', width: 180 },
	      { text: 'Produkt', filtertype: 'textbox', datafield: 'productname', width: 220 },
	      { text: 'Datum', datafield: 'date', columntype: 'datetimeinput', filtertype: 'date', width: 210, cellsalign: 'right', cellsformat: 'd' },
	      { text: 'Qt.', datafield: 'quantity', columntype: 'numberinput', filtertype: 'textbox', cellsalign: 'right', width: 60 },
	      { text: 'Preis', datafield: 'price', columntype: 'numberinput', filtertype: 'textbox', cellsformat: "c2", cellsalign: 'right' }
	    ]
	});
}

function loadGrid2(id) {

	$(id).jqxGrid(
	{
	    width: '100%',
	    height: '100%',
	    theme: 'metro',
	    source: getSource2(),
	    showtoolbar: true,
	    toolbarheight: 40,
	    renderstatusbar: function (statusbar) {
	    	getToolbar(statusbar, id);
	    },
	    columnsresize: true,
	    columns: [
	        { text: 'Bestellnummer', 		datafield: 'ordernumber', width: 200 },
	        { text: 'Bestelldatum', 		datafield: 'orderdate', width: 120 },
	        { text: 'AnLT', 				datafield: 'receiveddaysafter', width: 50 },
	        { text: 'Verk-EMail', 			datafield: 'emailofseller', width: 220 },
	        { text: 'Verk-Vorname', 		datafield: 'nameofseller', width: 100 },
	        { text: 'Verk-Nachnahme', 		datafield: 'secondnameofseller', width: 100 },
	        { text: 'Prod-SKU', 			datafield: 'product_sku', width: 80 },
	        { text: 'Prod-Name', 			datafield: 'productname', width: 120 },
	        { text: 'Prod-URL', 			datafield: 'producturl', width: 120 },
	        { text: 'Prod-GTIN', 			datafield: 'product_gtin', width: 120 }
	    ]
	}); 
	
	$("#Save").click(function () {
	    var row = $(id).jqxGrid('getselectedrowindex');
	    var rowid = $(id).jqxGrid('getrowid', row);
	    var data = { 
	    	ordernumber: $("#ordernumber").val(), 
	    	orderdate: $("#orderdate").val(), 
	    	receiveddaysafter: $("#receiveddaysafter").val(), 
	    	emailofseller: $("#emailofseller").val(), 
	    	nameofseller: $("#nameofseller").val(),
	    	secondnameofseller: $("#secondnameofseller").val(), 
	    	product_sku: $("#product_sku").val(), 
	    	productname: $("#productname").val(), 
	    	producturl: $("#producturl").val(), 
	    	product_gtin: $("#product_gtin").val()  
	    	};
	    $(id).jqxGrid('updaterow', rowid, data);
	});
	
	
	
}     