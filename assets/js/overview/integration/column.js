

function createColumnModel(col_header_names, col_header_width)
{
	var colModel 	= new Array();
	var colNames 	= new Array();
	var colFields 	= new Array();
	var colID 		= new Array();
	var colType 	= new Array();
	var colWidth 	= new Array();
	
	var view = getData('csvupload', 'import_files_columns'); 
	
	console.log('view',view); 	
	
	/*
	 * Get view data requested from database
	 */
	if(view) {
		for(var i=0; i < view.length; i++){						
			if(col_header_names && typeof col_header_names[i] !== 'undefined' && col_header_names[i] !== null && col_header_names[i].length){
				colID.push(i);			
				colFields.push(view[i]['column_name']);
				colNames.push(col_header_names[i]);
				//type: number, date, string, float
				
				if(view[i]['data_type'] === 'int'){
					colType.push('number');
				} else if(view[i]['data_type'] === 'timestamp')
				{
					colType.push('number');
				} else if(view[i]['data_type'] === 'date')
				{
					colType.push('date');
				} else
				{
					colType.push('string');
				}
				
				if(col_header_width && typeof col_header_width[i] !== 'undefined' && col_header_width[i] !== null){
					colWidth.push(col_header_width[i]);
				}
				else {
					colWidth.push((100/view.length).toFixed(0) + '%');
				}
			}
			else {
				//colNames.push(view[i]['column_name']);
			}			
		}
	}
	
	/*
	 * Create Column Model
	 */
	for(var i=0; i < colNames.length; i++){
		
		colModel.push({text:colNames[i], dataField:colFields[i], type:colType[i], width:colWidth[i]});
		
		//console.log(i + ' datafield ' + colNames[i] + ' type: ' + colType[i]);
	}
	
	return colModel;

}