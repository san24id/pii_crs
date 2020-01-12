$(document).ready(function(){

	$('#forexcel').hide();
	$('#forpdf').hide();
	$('#forword').hide();
	$('#choosetype').hide();

	
	$('#periodreport').change(function(){
		var prefix = $("option:selected", this).attr('data-prefix');
		var period = $('#periodreport').val();
    	$("input[name=periode]").attr('value', prefix);
    	if(period == '-'){
			$('#choosetype').hide();
		}else{
			$('#choosetype').show();
		}
	});


	$('#typereport').change(function(){	
		var typereport = $('#typereport').val();
		if(typereport === 'excel'){
			$('#forexcel').show();
			$('#forpdf').hide();
			$('#forword').hide();
		}else if(typereport === 'pdf'){
			$('#forexcel').hide();
			$('#forpdf').show();
			$('#forword').hide();
		}else if(typereport === 'word'){
			$('#forexcel').hide();
			$('#forpdf').hide();
			$('#forword').show();
		}else{
			$('#forexcel').hide();
			$('#forpdf').hide();
			$('#forword').hide();			
		}				
	});
});