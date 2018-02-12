
function loadSplitter(id, num) {
	if(num === 1)
	{
    $(id).jqxSplitter({ width: '33%', height: 'auto', panels: [{ size: 300 }] });		
	}
	else if(num === 2)
	{
    $(id).jqxSplitter({ width: '100%', height: '100%', panels: [{ min: 800, size: '100%' }, { min: 400 }] });		
	}
};

function loadSplitter2(id) {
	$(id).jqxSplitter({ width: '100%', height: '100%', panels: [{ min: 800, size: '100%' }, { min: 400 }] });
};