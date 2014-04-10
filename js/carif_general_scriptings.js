$('#patient-display-table tr').hover(function() {
    $(this).addClass('hover');
}, function() {
    $(this).removeClass('hover');
});

function auto_calculate_total_siblings(evt)
{
	evt = evt || window.event;
    var charCode = evt.keyCode || evt.which;
    var charStr = String.fromCharCode(charCode);
	var charInt = parseInt(charStr);
    var idName = $(evt.target).attr("id")
	
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
	var total_male_sibs = 0;
	var total_female_sibs = 0;
	if(idName == "total_no_of_male_siblings")
	{
		total_male_sibs = charInt;
		var val = iframeDoc.getElementById("total_no_of_female_siblings").value;
		
		if(!val)
			val = 0;
			
		total_female_sibs = parseInt(val);
	}
	else if(idName == "total_no_of_female_siblings")
	{
		total_female_sibs = charInt;
		var val = iframeDoc.getElementById("total_no_of_male_siblings").value;
		
		if(!val)
			val = 0;
			
		total_male_sibs = parseInt(val);
	}
	
	
	var total = total_male_sibs + total_female_sibs;
	iframeDoc.getElementById("total_no_of_siblings").value = total; 
}

function auto_calculate_bmi(evt)
{
	evt = evt || window.event;
   /*  var charCode = evt.keyCode || evt.which;
    var charStr = String.fromCharCode(charCode);
	var charFloat = parseFloat(charStr); */
	var charStr = $(evt.target).val();
	var charFloat = parseFloat(charStr); 
    var idName = $(evt.target).attr("id")
	
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
	var height = 0;
	var weight = 0;
	if(idName == "height")
	{
		height = charFloat;
		var val = iframeDoc.getElementById("weight").value;
		
		if(!val)
			val = 0;
			
		weight = parseFloat(val);
	}
	else if(idName == "weight")
	{
		weight = charFloat;
		var val = iframeDoc.getElementById("height").value;
		
		if(!val)
			val = 0;
			
		height = parseFloat(val);
	}
	
	//height = height / 100;
	var total = (weight / (height * height));
	iframeDoc.getElementById("BMI").value = total; 
}