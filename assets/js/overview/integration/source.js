

var getSource = function (src) {
	
	var data = generatedata(250);
	
	var source =
	{
	    localdata: data,
	    datafields:
	    [
	        { name: 'name', 		type: 'string' },
	        { name: 'productname', 	type: 'string' },
	        { name: 'available', 	type: 'bool' },
	        { name: 'date', 		type: 'date' },
	        { name: 'quantity', 	type: 'number' },
	        { name: 'price', 		type: 'number' }
	    ],
	    datatype: "array"
	};

	
	return new $.jqx.dataAdapter(source);

};

var getSource2 = function (src) {
	
		var data = [
		{ "CompanyName": "Alfreds Futterkiste", "ContactName": "Maria Anders", "ContactTitle": "Sales Representative", "Address": "Obere Str. 57", "City": "Berlin", "Country": "Germany" }, 
		{ "CompanyName": "Ana Trujillo Emparedados y helados", "ContactName": "Ana Trujillo", "ContactTitle": "Owner", "Address": "Avda. de la Constitucin 2222", "City": "Mxico D.F.", "Country": "Mexico" }, 
		{ "CompanyName": "Antonio Moreno Taquera", "ContactName": "Antonio Moreno", "ContactTitle": "Owner", "Address": "Mataderos 2312", "City": "Mxico D.F.", "Country": "Mexico" }, 
		{ "CompanyName": "Around the Horn", "ContactName": "Thomas Hardy", "ContactTitle": "Sales Representative", "Address": "120 Hanover Sq.", "City": "London", "Country": "UK" }, 
		{ "CompanyName": "Berglunds snabbkp", "ContactName": "Christina Berglund", "ContactTitle": "Order Administrator", "Address": "Berguvsvgen 8", "City": "Lule", "Country": "Sweden" }, 
		{ "CompanyName": "Blauer See Delikatessen", "ContactName": "Hanna Moos", "ContactTitle": "Sales Representative", "Address": "Forsterstr. 57", "City": "Mannheim", "Country": "Germany" } 
		];

		 var url = '/assets/sampledata/sample_with_pr_de.csv';
		 
		 // Bestellnummer;Bestelldatum;Anzahl;E-Mail;Vorname;Nachname;Produkt-SKU;Produktname;Produkt-URL;Produkt-GTIN
        // prepare the data
        

        var source =
        {
            datatype: "csv",
            datafields: [
                { name: 'ordernumber', type: 'string' },
                { name: 'orderdate', type: 'string' },
                { name: 'receiveddaysafter', type: 'string' },
                { name: 'emailofseller', type: 'string' },
                { name: 'nameofseller', type: 'string' },
                { name: 'secondnameofseller', type: 'string' },
                { name: 'product_sku', type: 'string' },
                { name: 'productname', type: 'string' },
                { name: 'producturl', type: 'string' },
                { name: 'product_gtin', type: 'string' }
            ],
            url: url,
            //localdata: data,
            updaterow: function (rowid, rowdata, commit) {
                commit(true);
            }
        };
        
        return new $.jqx.dataAdapter(source);

};
      