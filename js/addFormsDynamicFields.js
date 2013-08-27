var relativeCounter = 3;
var limit = 10;

function addInput(divName)
{
	if (relativeCounter == limit)  {
		alert("You have reached the limit of adding " + relativeCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="add_record_form_section_" + relativeCounter;
		newdiv.setAttributeNode(att2);
		
		//class="container" id="add_record_form_section_1
		var formInputHTML = "<div height=\"30px\">&nbsp;</div>" + 
		"<fieldset>" + 
		"<legend>Relative " + "#" + (relativeCounter - 2) + " Details</legend>" +
		"<input type='button' value='Delete' onClick='window.parent.deleteInput(" + relativeCounter + ");'>" +
		"<table>" + 
		"<tr>" +
		"<td>Relationship:" +
		"<select name='relativeTypeLists" + relativeCounter + "'>" +
			"<option value='Brother'>Brother</option>" +
			"<option value='Sister'>Sister</option>" +
			"<option value='Children'>American</option>" +
			"<option value='1stDegree'>1st degree</option>" +
			"<option value='2ndDegree'>2nd degree</option>" +
			"<option value='3rdDegree'>3rd degree</option>" +
		"</select> " +
		"</td>" +
		"<td>Fullname:<input type='text' name='fullname" + relativeCounter + "' value=''/></td>" + 
		"<td>Surname:<input type='text' name='surname" + relativeCounter + "' value=''></td>" +
		"<td>Maiden name: <input type='text' name='maiden_name" + relativeCounter + "' value=''/></td>" +
		"</tr>" +
		"<tr>" +
		"<td>Ethnicity:<input type='text' name='ethnicity" + relativeCounter + "' value=''/></td>" +
		"<td>Town of residence:<input type='text' name='town_residence" + relativeCounter + "' value=''/></td>" + 
		"<td>Date of birth:<input type='text' name='DOB" + relativeCounter + "' value=''/></td>" +
		"<td>Is still alive?: <input type='checkbox' name='still_alive_flag" + relativeCounter + "' value='yes' checked='checked'/></td>" +
		"</tr>" + 
		"<tr>" +
		"<td>Gender: " + 
		"<select name='gender" + relativeCounter + "'>" +
			"<option value=\"Male\">Male</option>" +
			"<option value=\"Female\">Female</option>" +
		"</select> " +
		"</td>" +
		"<td>Relationship status: " + 
		"<select name='relationship_status" + relativeCounter + "'>" +
			"<option value=\"Paternal\">Paternal</option>" +
			"<option value=\"Maternal\">Maternal</option>" +
		"</select> " +
		"</td>" +
		"<td>Date of dead:<input type='text' name='DOD" + relativeCounter + "' value=''/></td>" +
		"<td>Is diagnosed with cancer?:<input type='checkbox' name='is_cancer_diagnosed" + relativeCounter + "' value='no'/></td>" +
		"</tr>" + 
		"<tr>" +
		"<td>Date of diagnosis:<input type='text' name='date_of_diagnosis" + relativeCounter + "' value=''/></td>" +
		"<td>Cancer's name: <input type='text' name='cancer_name" + relativeCounter + "' value=''/></td>" +
		"<td>Age at diagnosis: <input type='text' name='age_of_diagnosis" + relativeCounter + "' value=''/></td>" + 
		"<td>Diagnosis details: <textarea name='diagnosis_other_details" + relativeCounter + "' cols='7' rows='3' id='mother_diagnosis_other_details'></textarea></td>" +
		"</tr>" + 
		"<tr>" +
		"<td>Total no. of brothers: <input type='text' name='no_of_brothers" + relativeCounter + "' value=''/></td>" +
		"<td>Total no. of sisters: <input type='text' name='no_of_sisters" + relativeCounter + "' value=''/></td>" +
		"<td>Total no. of female children:<input type='text' name='no_female_children" + relativeCounter + "' value=''/></td>" +
		"<td>Total no. of male children: <input type='text' name='no_male_children" + relativeCounter + "' value=''/>	</td>" +
		"</tr>" +
		"<tr>" +
		"<td>Total no. of first degree: <input type='text' name='no_of_first_degree" + relativeCounter + "' value=''/></td>" +
		"<td>Total no. of second degree: <input type='text' name='no_of_second_degree" + relativeCounter + "' value=''/></td>" +
		"<td>Total no. of third degree: <input type='text' name='no_of_third_degree" + relativeCounter + "' value=''/></td>" +
		"<td>Total no. of male children:<input type='text' name='no_male_children" + relativeCounter + "' value=''/></td>" +
		"</tr>" +
		"<tr>" +
		"<td>Vital status: <input type='text' name='vital_status" + relativeCounter + "' value=''/></td>" +
		"<td>Mach score at consent:<input type='text' name='mach_score_at_consent" + relativeCounter + "' value=''/>	</td>" +
		"<td>Mach score past consent: <input type='text' name='mach_score_past_consent" + relativeCounter + "' value=''/></td>" +
		"<td>FH category:<input type='text' name='FH_category" + relativeCounter + "' value=''/></td>" +
		"</tr></table></fieldset>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		relativeCounter++;
	}
}

function deleteInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('add_record_form_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('add_record_form_section_' + divCounterName));
	window.parent.calcHeight();
}

// ====== MAMMO ==== //
var breastSiteCounter = 2;
var limit = 10;

function addBreastSiteInput(divName)
{
	if (breastSiteCounter == limit)  {
		alert("You have reached the limit of adding " + breastSiteCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="mammo_second_section_" + breastSiteCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Left/right breast side:" +
		"<select name='relativeTypeLists" + breastSiteCounter + "'>" +
			"<option value='left'>Left</option>" +
			"<option value='right'>Right</option>" +
		"</select> " +
		"</td>" +
		"<td>Upper/below breast side:" +
		"<select name='relativeTypeLists" + breastSiteCounter + "'>" +
			"<option value='upper'>Upper</option>" +
			"<option value='below'>Below</option>" +
		"</select> " +
		"</td>" +
		"<td>Other details:<textarea name='mammo_breast_other_descriptions" + breastSiteCounter + "' cols='7' rows='3' id='mammo_breast_other_descriptions' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteBreastSiteInput(" + breastSiteCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		breastSiteCounter++;
	}
}

function deleteBreastSiteInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('mammo_second_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('mammo_second_section_' + divCounterName));
	window.parent.calcHeight();
}

// ==== ULTRASOUND ====
var ultrasoundCounter = 2;
var limit = 10;

function addUltrasoundDetailsInput(divName)
{
	if (ultrasoundCounter == limit)  {
		alert("You have reached the limit of adding " + ultrasoundCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="mammo_ultrasound_second_section_" + ultrasoundCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Ultrasound details:<textarea name='mammo_ultrasound_details" + ultrasoundCounter + "' cols='7' rows='3' id='mammo_ultrasound_details' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteUltrasoundDetailsInput(" + ultrasoundCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		ultrasoundCounter++;
	}
}

function deleteUltrasoundDetailsInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('mammo_ultrasound_second_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('mammo_ultrasound_second_section_' + divCounterName));
	window.parent.calcHeight();
}