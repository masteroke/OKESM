

function getToolbar(statusbar, id) {
	

        // appends buttons to the status bar.
        var container 	 = $("<div style='overflow: hidden; position: relative; margin: 5px;'></div>");
        
        var loadButton   = $("<div style='float: left; margin-left: 5px;'><div id='loadButton' class='glyphicon glyphicon-download-alt' style='cursor:pointer; margin-top:2px;'></div><span style='margin-left: 2px; position: relative; margin-top: 4px;'>Load</span></div>");
        
        var addButton    = $("<div style='float: left; margin-left: 5px;'><div id='addButton' class='glyphicon glyphicon-plus' style='cursor:pointer; margin-top:2px;'></div><span style='margin-left: 2px; position: relative; margin-top: 4px;'>Add</span></div>");
        var deleteButton = $("<div style='float: left; margin-left: 5px;'><div id='delButton' class='glyphicon glyphicon-minus' style='cursor:pointer; margin-top:2px;'></div><span style='margin-left: 2px; position: relative; margin-top: 4px;'>Delete</span></div>");
        var reloadButton = $("<div style='float: left; margin-left: 5px;'><div id='reloadButton' class='glyphicon glyphicon-refresh' style='cursor:pointer; margin-top:2px;'></div><span style='margin-left: 2px; position: relative; margin-top: 4px;'>Reload</span></div>");
        var searchButton = $("<div style='float: left; margin-left: 5px;'><div id='searchButton' class='glyphicon glyphicon-search' style='cursor:pointer; margin-top:2px;'></div><span style='margin-left: 2px; position: relative; margin-top: 4px;'>Search</span></div>");
        
        container.append(loadButton);
        container.append(addButton);
        container.append(deleteButton);
        container.append(reloadButton);
        container.append(searchButton);
        
        statusbar.append(container);
        
        loadButton.jqxButton  ({  width: 100, height: 20 });
        addButton.jqxButton	  ({  width: 100, height: 20 });
        deleteButton.jqxButton({  width: 100, height: 20 });
        reloadButton.jqxButton({  width: 100, height: 20 });
        searchButton.jqxButton({  width: 100, height: 20 });
        
        // search for a record.
        loadButton.click(function (event) {
            var offset = $(id).offset();
            $("#windowLoad").jqxWindow('open');
            $("#windowLoad").jqxWindow('move');
        });
        
        // add new row.
        addButton.click(function (event) {
            var datarow = [''];
            $(id).jqxGrid('addrow', null, datarow);
        });
        // delete selected row.
        deleteButton.click(function (event) {
            var selectedrowindex = $(id).jqxGrid('getselectedrowindex');
            var rowscount = $(id).jqxGrid('getdatainformation').rowscount;
            var id = $(id).jqxGrid('getrowid', selectedrowindex);
            $(id).jqxGrid('deleterow', id);
        });
        // reload grid data.
        reloadButton.click(function (event) {
            $(id).jqxGrid({ source: getSource2() });
        });
        // search for a record.
        searchButton.click(function (event) {
            var offset = $(id).offset();
            $("#windowSearch").jqxWindow('open');
            $("#windowSearch").jqxWindow('move', offset.left + 30, offset.top + 30);
        });
        
        return container;
};

function getImportHistoryGridToolbar(statusbar, id) {
	

        // appends buttons to the status bar.
        var container 	 = $("<div style='overflow: hidden; position: relative; margin: 5px;'></div>");

        var addButton    = $("<div style='float: left; margin-left: 5px;'><div id='addButton' class='glyphicon glyphicon-plus' style='cursor:pointer; margin-top:2px;'></div><span style='margin-left: 2px; position: relative; margin-top: 4px;'>Add</span></div>");

        container.append(addButton);

        
        statusbar.append(container);

        addButton.jqxButton	  ({  width: 100, height: 20 });

        // add new row.
        addButton.click(function (event) {
            var datarow = [''];
            $(id).jqxGrid('addrow', null, datarow);
        });
        
        return container;
};