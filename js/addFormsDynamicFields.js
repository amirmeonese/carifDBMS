// ========= ADD RELATIVE ========= //
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
		"<legend>Relative " + "#" + (relativeCounter - 2) + "</legend>" +
		"<input type='button' value='Delete' onClick='window.parent.deleteInput(" + relativeCounter + ");'>" +
		"<table>" + 
		"<tr>" +
		"<td>Paternal/Maternal status: " + 
		"<select name='relationship_status" + relativeCounter + "'>" +
			"<option value=''></option>" +
			"<option value=\"Paternal\">Paternal</option>" +
			"<option value=\"Maternal\">Maternal</option>" +
		"</select> " +
		"</td>" +
		"<td>Relationship:" +
		"<select name='relativeTypeLists" + relativeCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Brother'>Brother</option>" +
			"<option value='Sister'>Sister</option>" +
			"<option value='Stepbrother'>Stepbrother</option>" +
			"<option value='Stepsister'>Stepsister</option>" +
			"<option value='Son'>Son</option>" +
			"<option value='Daughter'>Daughter</option>" +
			"<option value='Uncle'>Uncle</option>" +
			"<option value='Aunt'>Aunt</option>" +
			"<option value='Grandmother'>Grandmother</option>" +
			"<option value='Grandfather'>Grandfather</option>" +
			"<option value='Cousin'>Cousin</option>" +
		"</select> " +
		"</td>" +
		"<td>Degree of relativeness:" +
		"<select name='degreeOfRelativeness" + relativeCounter + "'>" +
			"<option value=''></option>" +
			"<option value='1stDegree'>1st degree</option>" +
			"<option value='2ndDegree'>2nd degree</option>" +
			"<option value='3rdDegree'>3rd degree</option>" +
		"</select> " +
		"</td>" +
		"</tr>" +
		"<tr>" +
		"<td>Fullname:<input type='text' name='fullname" + relativeCounter + "' value=''/></td>" + 
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
			"<option value=''></option>" +
			"<option value=\"Male\">Male</option>" +
			"<option value=\"Female\">Female</option>" +
		"</select> " +
		"</td>" +
		"<td>Date of death:<input type='text' name='DOD" + relativeCounter + "' value=''/></td>" +
		"<td>Is diagnosed with cancer?:<input type='checkbox' name='is_cancer_diagnosed" + relativeCounter + "' value='no'/></td>" +
		"</tr>" + 
		"<tr>" +
		"<td>Date of diagnosis:<input type='text' name='date_of_diagnosis" + relativeCounter + "' value=''/></td>" +
		"<td>Type of cancer:" +
		"<select name='relative_cancer_name" + relativeCounter + "'>" +
			"<option value=''></option>" +
			"<option value='None'>None</option>" +	
			"<option value='Breast'>Breast</option>" +
			"<option value='Ovaries'>Ovaries</option>" +
			"<option value='Prostate'>Prostate</option>" +
			"<option value='Cervical'>Cervical</option>" +
			"<option value='Lung'>Lung</option>" +
			"<option value='Colorectal'>Colorectal</option>" +
			"<option value='Uterine'>Uterine</option>" +
			"<option value='Peritaneum'>Peritaneum</option>" +
			"<option value='Pancreatic'>Pancreatic</option>" +
			"<option value='Nasopharyngeal'>Nasopharyngeal</option>" +
			"<option value='Liver'>Liver</option>" +
			"<option value='Gastric'>Gastric</option>" +
			"<option value='Others'>Others</option>" +
		"</select> </td>" +
		"<td>Other cancer type:<input type='text' name='relative_other_cancer_name" + relativeCounter + "' value=''/></td>" + 
		"<td>Age of diagnosis: <input type='text' name='age_of_diagnosis" + relativeCounter + "' value=''/></td>" + 
		"</tr>" + 
		"<tr>" +
		"<td>Vital status: <br /><input type='text' name='vital_status" + relativeCounter + "' value=''/></td>" +
		"<td>Comment:<textarea name='relative_comment" + breastSiteCounter + "' cols='7' rows='3' id='relative_comment' ></textarea></td>" + 
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
	relativeCounter--;
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
		"<select name='mammo_left_right_breast_side" + breastSiteCounter + "'>" +
			"<option value=''></option>" +
			"<option value='left'>Left</option>" +
			"<option value='right'>Right</option>" +
		"</select> " +
		"</td>" +
		"<td>Upper/below breast side:" +
		"<select name='mammo_upper_below_breast_side" + breastSiteCounter + "'>" +
			"<option value=''></option>" +
			"<option value='upper'>Upper</option>" +
			"<option value='below'>Below</option>" +
		"</select> " +
		"</td>" +
		"<td>Is abnormality detected? :<input type='checkbox' name='mammo_is_abnormality_detected" + breastSiteCounter + "' value=''/></td>" +
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
	breastSiteCounter--;
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
		"<td>Ultrasound date:<input type='text' name='mammo_ultrasound_date" + ultrasoundCounter + "' value=''/></td>" + 
		"<td>Is abnormality detected? :<input type='checkbox' name='mammo_ultrasound_is_abnormality_detected" + ultrasoundCounter + "' value=''/></td>" +
		"<td>Comment:<textarea name='mammo_ultrasound_details" + ultrasoundCounter + "' cols='7' rows='3' id='mammo_ultrasound_details' ></textarea></td>" + 
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
	ultrasoundCounter--;
}

// ==== MRI ====
var MRICounter = 2;
var limit = 10;

function addMRIDetailsInput(divName)
{
	if (MRICounter == limit)  {
		alert("You have reached the limit of adding " + MRICounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="mammo_MRI_second_section_" + MRICounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>MRI date:<input type='text' name='mammo_MRI_date" + MRICounter + "' value=''/></td>" + 
		"<td>Is abnormality detected? :<input type='checkbox' name='mammo_MRI_is_abnormality_detected" + MRICounter + "' value=''/></td>" +
		"<td>Comment:<textarea name='mammo_MRI_details" + MRICounter + "' cols='7' rows='3' id='mammo_MRI_details' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteMRIDetailsInput(" + MRICounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		MRICounter++;
	}
}

function deleteMRIDetailsInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('mammo_MRI_second_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('mammo_MRI_second_section_' + divCounterName));
	window.parent.calcHeight();
	MRICounter--;
}


// ==== NON CANCER SURGERY ====
var nonCancerSurgeryCounter = 2;
var limit = 10;

function addNonCancerSurgeryDetailsInput(divName)
{
	if (nonCancerSurgeryCounter == limit)  {
		alert("You have reached the limit of adding " + nonCancerSurgeryCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="mammo_non_cancer_surgery_section_" + nonCancerSurgeryCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Surgery type:<input type='text' name='non_cancer_surgery_type" + nonCancerSurgeryCounter + "' value=''/></td>" + 
		"<td>Reason for surgery:<input type='text' name='reason_for_non_cancer_surgery" + nonCancerSurgeryCounter + "' value=''/></td>" + 
		"<td>Date of surgery:<input type='text' name='date_of_non_cancer_surgery" + nonCancerSurgeryCounter + "' value=''/></td>" + 
		"<td>Age at surgery:<input type='text' name='age_at_non_cancer_surgery" + nonCancerSurgeryCounter + "' value=''/></td>" + 
		"</tr><tr><td>Comment:<textarea name='non_cancer_surgery_comments" + nonCancerSurgeryCounter + "' cols='7' rows='3' id='non_cancer_surgery_comments' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteNonCancerSurgeryDetailsInput(" + nonCancerSurgeryCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		nonCancerSurgeryCounter++;
	}
}

function deleteNonCancerSurgeryDetailsInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('mammo_non_cancer_surgery_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('mammo_non_cancer_surgery_section_' + divCounterName));
	window.parent.calcHeight();
	nonCancerSurgeryCounter--;
}

// ==== BENIGN LUMP & CYSTS SURGERY ====
var lumpCystCounter = 2;
var limit = 10;

function addLumpCystDetailsInput(divName)
{
	if (lumpCystCounter == limit)  {
		alert("You have reached the limit of adding " + lumpCystCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="mammo_fifth_section_" + lumpCystCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Comment:<textarea name='mammo_benign_lump_cyst_details" + lumpCystCounter + "' cols='7' rows='3' id='mammo_benign_lump_cyst_details' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteLumpCystDetailsInput(" + lumpCystCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		lumpCystCounter++;
	}
}

function deleteLumpCystDetailsInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('mammo_fifth_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('mammo_fifth_section_' + divCounterName));
	window.parent.calcHeight();
	lumpCystCounter--;
}

// ==== OTHER SCREENINGS ====
var otherScreeningCounter = 2;
var limit = 10;

function addScreeningDetailsInput(divName)
{
	if (otherScreeningCounter == limit)  {
		alert("You have reached the limit of adding " + otherScreeningCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="mammo_other_screenings_section_" + otherScreeningCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Screening type: <br />" +
		"<select name='screening_name" + otherScreeningCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Pap Smear'>Pap Smear</option>" +
			"<option value='Chest XRay'>Chest XRay</option>" +
			"<option value='Prostate Specific Antigen (PSA)'>Prostate Specific Antigen (PSA)</option>" +
			"<option value='Colonoscopy'>Colonoscopy</option>" +
			"<option value='Fecal Occult Blood Test (FOBT)'>Fecal Occult Blood Test (FOBT)</option>" +
			"<option value='Sigmoidoscopy'>Sigmoidoscopy</option>" +
			"<option value='Double Contrast Berium Enema (DCBE)'>Double Contrast Berium Enema (DCBE)</option>" +
		"</select> </td>" +
		"<td>Age at screening:<input type='text' name='age_at_screening" + otherScreeningCounter + "' value=''/></td>" +
		"<td>Screening centre: <input type='text' name='place_of_screening" + otherScreeningCounter + "' value=''/>	</td></tr>" +
		"<tr><td>Screening results: <textarea name='screening_results" + otherScreeningCounter + "' cols='7' rows='3' id='screening_results' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteScreeningDetailsInput(" + otherScreeningCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		otherScreeningCounter++;
	}
}

function deleteScreeningDetailsInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('mammo_other_screenings_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('mammo_other_screenings_section_' + divCounterName));
	window.parent.calcHeight();
	otherScreeningCounter--;
}

// ==== CANCER SITES ====
var cancerSitesCounter = 2;
var limit = 10;

function addCancerDetailsInput(divName)
{
	if (cancerSitesCounter == limit)  {
		alert("You have reached the limit of adding " + cancerSitesCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="cancer_section_" + cancerSitesCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Select site:" +
		"<select name='cancer_site" + cancerSitesCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Left Breast'>Left Breast</option>" +
			"<option value='Right Breast'>Right Breast</option>" +
			"<option value='Left Ovary'>Left Ovary</option>" +
			"<option value='Right Ovary'>Right Ovary</option>" +
		"</select> " +
		"<tr><td>Details: <textarea name='cancer_site_details" + cancerSitesCounter + "' cols='7' rows='3' id='cancer_site_details' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteCancerDetailsInput(" + cancerSitesCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		cancerSitesCounter++;
	}
}

function deleteCancerDetailsInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('cancer_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('cancer_section_' + divCounterName));
	window.parent.calcHeight();
	cancerSitesCounter--;
}

// ===== BREAST CANCER DIAGNOSIS ===
var limit = 30;
var breastCancerDiagnosisCounter = 2;

function addBreastCancerDiagnosis(divName)
{
	if (breastCancerDiagnosisCounter == limit)  {
		alert("You have reached the limit of adding " + breastCancerDiagnosisCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="breast_cancer_section_" + breastCancerDiagnosisCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr> <td id=\"label1\">Diagnosis " + breastCancerDiagnosisCounter + "</td>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteBreastCancerDiagnosis(" + breastCancerDiagnosisCounter + ");'></td>" +
		"<tr>" +
		"<td>Select site:" +
		"<select name='cancer_site" + breastCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Left'>Left</option>" +
			"<option value='Right'>Right</option>" +
		"</select> </td>" +
		"<td>Cancer type (invasive/non-invasive):" +
		"<select name='cancer_invasive_type" + breastCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Invasive'>Invasive</option>" +
			"<option value='Non-invasive'>Non-invasive</option>" +
		"</select> </td>" +
		"<td>Is primary diagnosis?:<input type='checkbox' name='primary_diagnosis" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Date of diagnosis: <input type='text' name='date_of_diagnosis" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Age of diagnosis:<input type='text' name='age_of_diagnosis" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Diagnosis centre:<input type='text' name='cancer_diagnosis_center" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Doctor's name: <input type='text' name='cancer_doctor_name" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Detected by:" +
		"<select name='detected_by" + breastCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='At a screening (mammography/ultrasound/MRI)'>At a screening (mammography/ultrasound/MRI)</option>" +
			"<option value='I felt a lump'>I felt a lump</option>" +
			"<option value='My doctor felt a lump'>My doctor felt a lump</option>" +
			"<option value='Other'>Other</option>" +
		"</select> </td>" +
		"<td>Other:<input type='text' name='detected_by_other_details" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr>" + 
		"<tr>" + 
		"<td>Bilateral: <br /><input type='text' name='cancer_is_bilateral" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Recurrent: <br /><input type='text' name='cancer_is_recurrent" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr>" +
		"</table>" +
		"<div id=\"add_breast_cancer_treatment_div_" + breastCancerDiagnosisCounter + "\" >" +
		"<table id=\"breast_cancer_treatment_" + breastCancerDiagnosisCounter + "\">" + 
		"<td>Treatment name:" +
		"<select name='patient_cancer_treatment_name" + breastCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Lumpectomy'>Lumpectomy</option>" +
			"<option value='Mastectomy'>Mastectomy</option>" +
			"<option value='Healthy Breast Removed'>Healthy Breast Removed</option>" +
			"<option value='Hysterectomy'>Hysterectomy</option>" +
			"<option value='Oophorectomy'>Oophorectomy</option>" +
			"<option value='Radiotherapy'>Radiotherapy</option>" +
			"<option value='Chemotherapy'>Chemotherapy</option>" +
			"<option value='Tamoxifen'>Tamoxifen</option>" +			
			"<option value='Other Hormonal Treatment'>Other Hormonal Treatment</option>" +
			"<option value='Transplantation'>Transplantation</option>" +
			"<option value='Neo Adjurant'>Neo Adjurant</option>" +
			"<option value='Tubal Ligation'>Tubal Ligation</option>" +
			"<option value='Unilateral Salpingo Oophorectomy'>Unilateral Salpingo Oophorectomy</option>" +
			"<option value='Bilateral Salpingo Oophorectomy'>Bilateral Salpingo Oophorectomy</option>" +
			"<option value='TAHBSO'>TAHBSO</option>" +			
			"<option value='None'>None</option>" +
		"</select> </td>" +
		"<td>Treatment start date: <input type='text' name='treatment_start_date" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Treatment end date:<input type='text' name='treatment_end_date" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Treatment duration:<input type='text' name='treatment_duration" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Comments: <textarea name='breast_cancer_treatment_comments" + breastCancerDiagnosisCounter + "' cols='7' rows='10' id='breast_cancer_treatment_comments'></textarea></td>" +
		"<td><input type='button' value='Add treatment' onClick='window.parent.addCancerTreatmentInput(\"add_breast_cancer_treatment_div_" + breastCancerDiagnosisCounter + "\"); window.parent.calcHeight();'></td>" +
		"</tr></table></div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		breastCancerDiagnosisCounter++;
	}
}

function deleteBreastCancerDiagnosis(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('breast_cancer_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('breast_cancer_section_' + divCounterName));
	window.parent.calcHeight();
	breastCancerDiagnosisCounter--;
}

// ===== OVARY CANCER DIAGNOSIS ===
var limit = 30;
var ovaryCancerDiagnosisCounter = 2;

function addOvaryCancerDiagnosis(divName)
{
	if (ovaryCancerDiagnosisCounter == limit)  {
		alert("You have reached the limit of adding " + ovaryCancerDiagnosisCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="ovary_cancer_section_" + ovaryCancerDiagnosisCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr> <td id=\"label1\">Diagnosis " + ovaryCancerDiagnosisCounter + "</td>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOvaryCancerDiagnosis(" + ovaryCancerDiagnosisCounter + ");'></td>" +
		"<tr>" +
		"<td>Select site:" +
		"<select name='ovary_cancer_site" + ovaryCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Left'>Left</option>" +
			"<option value='Right'>Right</option>" +
		"</select> </td>" +
		"<td>Cancer type (invasive/non-invasive):" +
		"<select name='ovary_cancer_invasive_type" + ovaryCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Invasive'>Invasive</option>" +
			"<option value='Non-invasive'>Non-invasive</option>" +
		"</select> </td>" +
		"<td>Is primary diagnosis?:<input type='checkbox' name='ovary_primary_diagnosis" + ovaryCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Date of diagnosis: <input type='text' name='ovary_date_of_diagnosis" + ovaryCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Age of diagnosis:<input type='text' name='ovary_age_of_diagnosis" + ovaryCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Diagnosis centre:<input type='text' name='ovary_cancer_diagnosis_center" + ovaryCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Doctor's name: <input type='text' name='ovary_cancer_doctor_name" + ovaryCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Detected by:" +
		"<select name='ovary_detected_by" + ovaryCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='At a screening (mammography/ultrasound/MRI)'>At a screening (mammography/ultrasound/MRI)</option>" +
			"<option value='I felt a lump'>I felt a lump</option>" +
			"<option value='My doctor felt a lump'>My doctor felt a lump</option>" +
			"<option value='Other'>Other</option>" +
		"</select> </td>" +
		"<td>Other:<input type='text' name='ovary_detected_by_other_details" + ovaryCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr>" + 
		"<tr>" + 
		"<td>Bilateral: <br /><input type='text' name='ovary_cancer_is_bilateral" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Recurrent:<br /><input type='text' name='ovary_cancer_is_recurrent" + breastCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr>" +
		"</table>" +
		"<div id=\"add_ovary_cancer_treatment_div_" + ovaryCancerDiagnosisCounter + "\" >" +
		"<table id=\"ovary_cancer_treatment_" + ovaryCancerDiagnosisCounter + "\">" + 
		"<td>Treatment name:" +
		"<select name='ovary_patient_cancer_treatment_name" + ovaryCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Lumpectomy'>Lumpectomy</option>" +
			"<option value='Mastectomy'>Mastectomy</option>" +
			"<option value='Healthy Breast Removed'>Healthy Breast Removed</option>" +
			"<option value='Hysterectomy'>Hysterectomy</option>" +
			"<option value='Oophorectomy'>Oophorectomy</option>" +
			"<option value='Radiotherapy'>Radiotherapy</option>" +
			"<option value='Chemotherapy'>Chemotherapy</option>" +
			"<option value='Tamoxifen'>Tamoxifen</option>" +			
			"<option value='Other Hormonal Treatment'>Other Hormonal Treatment</option>" +
			"<option value='Transplantation'>Transplantation</option>" +
			"<option value='Neo Adjurant'>Neo Adjurant</option>" +
			"<option value='Tubal Ligation'>Tubal Ligation</option>" +
			"<option value='Unilateral Salpingo Oophorectomy'>Unilateral Salpingo Oophorectomy</option>" +
			"<option value='Bilateral Salpingo Oophorectomy'>Bilateral Salpingo Oophorectomy</option>" +
			"<option value='TAHBSO'>TAHBSO</option>" +			
			"<option value='None'>None</option>" +
		"</select> </td>" +
		"<td>Treatment start date: <input type='text' name='ovary_treatment_start_date" + ovaryCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Treatment end date:<input type='text' name='ovary_treatment_end_date" + ovaryCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Treatment duration:<input type='text' name='ovary_treatment_duration" + ovaryCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Comments: <textarea name='ovary_cancer_treatment_comments" + ovaryCancerDiagnosisCounter + "' cols='7' rows='10' id='ovary_cancer_treatment_comments'></textarea></td>" +
		"<td><input type='button' value='Add treatment' onClick='window.parent.addOvaryCancerTreatmentInput(\"add_ovary_cancer_treatment_div_" + ovaryCancerDiagnosisCounter + "\"); window.parent.calcHeight();'></td>" +
		"</tr></table></div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		ovaryCancerDiagnosisCounter++;
	}
}

function deleteOvaryCancerDiagnosis(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('ovary_cancer_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('ovary_cancer_section_' + divCounterName));
	window.parent.calcHeight();
	ovaryCancerDiagnosisCounter--;
}

// ==== OVARY CANCER TREATMENT ====
var ovaryCancerTreatmentCounter = 2;
var limit = 30;

function addOvaryCancerTreatmentInput(divName)
{
	if (ovaryCancerTreatmentCounter == limit)  {
		alert("You have reached the limit of adding " + ovaryCancerTreatmentCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="ovary_cancer_treatment_" + ovaryCancerTreatmentCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Treatment name:" +
		"<select name='ovary_patient_cancer_treatment_name" + ovaryCancerTreatmentCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Lumpectomy'>Lumpectomy</option>" +
			"<option value='Mastectomy'>Mastectomy</option>" +
			"<option value='Healthy Breast Removed'>Healthy Breast Removed</option>" +
			"<option value='Hysterectomy'>Hysterectomy</option>" +
			"<option value='Oophorectomy'>Oophorectomy</option>" +
			"<option value='Radiotherapy'>Radiotherapy</option>" +
			"<option value='Chemotherapy'>Chemotherapy</option>" +
			"<option value='Tamoxifen'>Tamoxifen</option>" +
			"<option value='Other Hormonal Treatment'>Other Hormonal Treatment</option>" +
			"<option value='Transplantation'>Transplantation</option>" +
			"<option value='Neo Adjurant'>Neo Adjurant</option>" +
			"<option value='Sterilisation'>Sterilisation</option>" +
			"<option value='Tubal Ligation'>Tubal Ligation</option>" +
			"<option value='Unilateral Salpingo Oophorectomy'>Unilateral Salpingo Oophorectomy</option>" +
			"<option value='Bilateral Salpingo Oophorectomy'>Bilateral Salpingo Oophorectomy</option>" +
			"<option value='TAHBSO'>TAHBSO</option>" +
			"<option value='None'>None</option>" +
		"</select> " +
		"<td>Treatment start date: <input type='text' name='ovary_treatment_start_date" + ovaryCancerTreatmentCounter + "' value=''/></td>" +
		"<td>Treatment end date:<input type='text' name='ovary_treatment_end_date" + ovaryCancerTreatmentCounter + "' value=''/></td>" +
		"<td>Treatment duration:<input type='text' name='ovary_treatment_duration" + ovaryCancerTreatmentCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Comments: <textarea name='ovary_cancer_treatment_comments" + ovaryCancerTreatmentCounter + "' cols='7' rows='10' id='ovary_cancer_treatment_comments'></textarea></td>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOvaryCancerTreatmentInput(" + ovaryCancerTreatmentCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		ovaryCancerTreatmentCounter++;
	}
}

function deleteOvaryCancerTreatmentInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('ovary_cancer_treatment_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('ovary_cancer_treatment_' + divCounterName));
	window.parent.calcHeight();
	ovaryCancerTreatmentCounter--;
}

// ===== OTHER CANCER DIAGNOSIS ===
var limit = 30;
var otherCancerDiagnosisCounter = 2;

function addOtherCancerDiagnosis(divName)
{
	if (otherCancerDiagnosisCounter == limit)  {
		alert("You have reached the limit of adding " + otherCancerDiagnosisCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="other_cancer_section_" + otherCancerDiagnosisCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr> <td id=\"label1\">Diagnosis " + otherCancerDiagnosisCounter + "</td>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOtherCancerDiagnosis(" + otherCancerDiagnosisCounter + ");'></td>" +
		"<tr>" +
		"<td>Cancer type: " +
		"<select name='other_cancer_type" + otherCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='None'>None</option>" +	
			"<option value='Breast'>Breast</option>" +
			"<option value='Ovaries'>Ovaries</option>" +
			"<option value='Prostate'>Prostate</option>" +
			"<option value='Cervical'>Cervical</option>" +
			"<option value='Lung'>Lung</option>" +
			"<option value='Colorectal'>Colorectal</option>" +
			"<option value='Uterine'>Uterine</option>" +
			"<option value='Peritaneum'>Peritaneum</option>" +
			"<option value='Pancreatic'>Pancreatic</option>" +
			"<option value='Nasopharyngeal'>Nasopharyngeal</option>" +
			"<option value='Liver'>Liver</option>" +
			"<option value='Gastric'>Gastric</option>" +
			"<option value='Others'>Others</option>" +
		"</select> </td>" +
		"<td>Date of diagnosis: <input type='text' name='other_date_of_diagnosis" + otherCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Age of diagnosis:<input type='text' name='other_age_of_diagnosis" + otherCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Diagnosis centre:<input type='text' name='other_cancer_diagnosis_center" + otherCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Doctor's name: <input type='text' name='other_cancer_doctor_name" + otherCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Comments: <textarea name='other_cancer_comments" + otherCancerDiagnosisCounter + "' cols='7' rows='10' id='other_cancer_comments'></textarea></td>" +
		"</tr></table>" +
		"<div id=\"add_other_cancer_treatment_div_" + otherCancerDiagnosisCounter + "\" >" +
		"<table id=\"other_cancer_treatment_" + otherCancerDiagnosisCounter + "\">" + 
		"<td>Treatment name:" +
		"<select name='other_patient_cancer_treatment_name" + otherCancerDiagnosisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Lumpectomy'>Lumpectomy</option>" +
			"<option value='Mastectomy'>Mastectomy</option>" +
			"<option value='Healthy Breast Removed'>Healthy Breast Removed</option>" +
			"<option value='Hysterectomy'>Hysterectomy</option>" +
			"<option value='Oophorectomy'>Oophorectomy</option>" +
			"<option value='Radiotherapy'>Radiotherapy</option>" +
			"<option value='Chemotherapy'>Chemotherapy</option>" +
			"<option value='Tamoxifen'>Tamoxifen</option>" +			
			"<option value='Other Hormonal Treatment'>Other Hormonal Treatment</option>" +
			"<option value='Transplantation'>Transplantation</option>" +
			"<option value='Neo Adjurant'>Neo Adjurant</option>" +
			"<option value='Tubal Ligation'>Tubal Ligation</option>" +
			"<option value='Unilateral Salpingo Oophorectomy'>Unilateral Salpingo Oophorectomy</option>" +
			"<option value='Bilateral Salpingo Oophorectomy'>Bilateral Salpingo Oophorectomy</option>" +
			"<option value='TAHBSO'>TAHBSO</option>" +			
			"<option value='None'>None</option>" +
		"</select> </td>" +
		"<td>Treatment start date: <input type='text' name='other_treatment_start_date" + otherCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Treatment end date:<input type='text' name='other_treatment_end_date" + otherCancerDiagnosisCounter + "' value=''/></td>" +
		"<td>Treatment duration:<input type='text' name='other_treatment_duration" + otherCancerDiagnosisCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Comments: <textarea name='other_cancer_treatment_comments" + otherCancerDiagnosisCounter + "' cols='7' rows='10' id='other_cancer_treatment_comments'></textarea></td>" +
		"<td><input type='button' value='Add treatment' onClick='window.parent.addOtherCancerTreatmentInput(\"add_other_cancer_treatment_div_" + otherCancerDiagnosisCounter + "\"); window.parent.calcHeight();'></td>" +
		"</tr></table></div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		otherCancerDiagnosisCounter++;
	}
}

function deleteOtherCancerDiagnosis(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('other_cancer_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('other_cancer_section_' + divCounterName));
	window.parent.calcHeight();
	otherCancerDiagnosisCounter--;
}

// ==== OTHER CANCER TREATMENT ====
var otherCancerTreatmentCounter = 2;
var limit = 30;

function addOtherCancerTreatmentInput(divName)
{
	if (otherCancerTreatmentCounter == limit)  {
		alert("You have reached the limit of adding " + otherCancerTreatmentCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="other_cancer_treatment_" + otherCancerTreatmentCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Treatment name:" +
		"<select name='other_patient_cancer_treatment_name" + otherCancerTreatmentCounter + "'>" +	
			"<option value=''></option>" +
			"<option value='Lumpectomy'>Lumpectomy</option>" +
			"<option value='Mastectomy'>Mastectomy</option>" +
			"<option value='Healthy Breast Removed'>Healthy Breast Removed</option>" +
			"<option value='Hysterectomy'>Hysterectomy</option>" +
			"<option value='Oophorectomy'>Oophorectomy</option>" +
			"<option value='Radiotherapy'>Radiotherapy</option>" +
			"<option value='Chemotherapy'>Chemotherapy</option>" +
			"<option value='Tamoxifen'>Tamoxifen</option>" +
			"<option value='Other Hormonal Treatment'>Other Hormonal Treatment</option>" +
			"<option value='Transplantation'>Transplantation</option>" +
			"<option value='Neo Adjurant'>Neo Adjurant</option>" +
			"<option value='Sterilisation'>Sterilisation</option>" +
			"<option value='Tubal Ligation'>Tubal Ligation</option>" +
			"<option value='Unilateral Salpingo Oophorectomy'>Unilateral Salpingo Oophorectomy</option>" +
			"<option value='Bilateral Salpingo Oophorectomy'>Bilateral Salpingo Oophorectomy</option>" +
			"<option value='TAHBSO'>TAHBSO</option>" +
			"<option value='None'>None</option>" +
		"</select> " +
		"<td>Treatment start date: <input type='text' name='other_treatment_start_date" + otherCancerTreatmentCounter + "' value=''/></td>" +
		"<td>Treatment end date:<input type='text' name='other_treatment_end_date" + otherCancerTreatmentCounter + "' value=''/></td>" +
		"<td>Treatment duration:<input type='text' name='other_treatment_duration" + otherCancerTreatmentCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Comments: <textarea name='other_cancer_treatment_comments" + otherCancerTreatmentCounter + "' cols='7' rows='10' id='other_cancer_treatment_comments'></textarea></td>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOtherCancerTreatmentInput(" + otherCancerTreatmentCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		otherCancerTreatmentCounter++;
	}
}

function deleteOtherCancerTreatmentInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('other_cancer_treatment_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('other_cancer_treatment_' + divCounterName));
	window.parent.calcHeight();
	otherCancerTreatmentCounter--;
}

// ==== CANCER TREATMENT ====
var cancerTreatmentCounter = 2;
var limit = 30;

function addCancerTreatmentInput(divName)
{
	if (cancerTreatmentCounter == limit)  {
		alert("You have reached the limit of adding " + cancerTreatmentCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="breast_cancer_treatment_" + cancerTreatmentCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Treatment name:" +
		"<select name='patient_cancer_treatment_name" + cancerTreatmentCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Lumpectomy'>Lumpectomy</option>" +
			"<option value='Mastectomy'>Mastectomy</option>" +
			"<option value='Healthy Breast Removed'>Healthy Breast Removed</option>" +
			"<option value='Hysterectomy'>Hysterectomy</option>" +
			"<option value='Oophorectomy'>Oophorectomy</option>" +
			"<option value='Radiotherapy'>Radiotherapy</option>" +
			"<option value='Chemotherapy'>Chemotherapy</option>" +
			"<option value='Tamoxifen'>Tamoxifen</option>" +
			"<option value='Other Hormonal Treatment'>Other Hormonal Treatment</option>" +
			"<option value='Transplantation'>Transplantation</option>" +
			"<option value='Neo Adjurant'>Neo Adjurant</option>" +
			"<option value='Sterilisation'>Sterilisation</option>" +
			"<option value='Tubal Ligation'>Tubal Ligation</option>" +
			"<option value='Unilateral Salpingo Oophorectomy'>Unilateral Salpingo Oophorectomy</option>" +
			"<option value='Bilateral Salpingo Oophorectomy'>Bilateral Salpingo Oophorectomy</option>" +
			"<option value='TAHBSO'>TAHBSO</option>" +
			"<option value='None'>None</option>" +
		"</select> " +
		"<td>Treatment start date: <input type='text' name='treatment_start_date" + cancerTreatmentCounter + "' value=''/></td>" +
		"<td>Treatment end date:<input type='text' name='treatment_end_date" + cancerTreatmentCounter + "' value=''/></td>" +
		"<td>Treatment duration:<input type='text' name='treatment_duration" + cancerTreatmentCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Comments: <textarea name='breast_cancer_treatment_comments" + cancerTreatmentCounter + "' cols='7' rows='10' id='breast_cancer_treatment_comments'></textarea></td>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteCancerTreatmentInput(" + cancerTreatmentCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		cancerTreatmentCounter++;
	}
}

function deleteCancerTreatmentInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('breast_cancer_treatment_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('breast_cancer_treatment_' + divCounterName));
	window.parent.calcHeight();
	cancerTreatmentCounter--;
}

// ==== CANCER RECURRENCE TREATMENT ====
var cancerRecurrenceCounter = 2;
var limit = 10;

function addCancerRecurrenceInput(divName)
{
	if (cancerRecurrenceCounter == limit)  {
		alert("You have reached the limit of adding " + cancerRecurrenceCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="cancer_second_section_five_" + cancerRecurrenceCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Treatment for recurrence:" +
		"<select name='patient_cancer_recurrence_treatment_name" + cancerRecurrenceCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Lumpectomy'>Lumpectomy</option>" +
			"<option value='Mastectomy'>Mastectomy</option>" +
			"<option value='Healthy Breast Removed'>Healthy Breast Removed</option>" +
			"<option value='Hysterectomy'>Hysterectomy</option>" +
			"<option value='Oophorectomy'>Oophorectomy</option>" +
			"<option value='Radiotherapy'>Radiotherapy</option>" +
			"<option value='Chemotherapy'>Chemotherapy</option>" +
			"<option value='Tamoxifen'>Tamoxifen</option>" +
			"<option value='Other Hormonal Treatment'>Other Hormonal Treatment</option>" +
			"<option value='Transplantation'>Transplantation</option>" +
			"<option value='Neo Adjurant'>Neo Adjurant</option>" +
			"<option value='Sterilisation'>Sterilisation</option>" +
			"<option value='Tubal Ligation'>Tubal Ligation</option>" +
			"<option value='Unilateral Salpingo Oophorectomy'>Unilateral Salpingo Oophorectomy</option>" +
			"<option value='Bilateral Salpingo Oophorectomy'>Bilateral Salpingo Oophorectomy</option>" +
			"<option value='TAHBSO'>TAHBSO</option>" +
			"<option value='None'>None</option>" +
		"</select> " +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteCancerRecurrenceInput(" + cancerRecurrenceCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		cancerRecurrenceCounter++;
	}
}

function deleteCancerRecurrenceInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('cancer_second_section_five_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('cancer_second_section_five_' + divCounterName));
	window.parent.calcHeight();
	cancerRecurrenceCounter--;
}

// ======== OTHER DISEASES ==============
var otherdiseasesCounter = 2;
var limit = 10;

function addOtherDisease(divName)
{
	if (otherdiseasesCounter == limit)  {
		alert("You have reached the limit of adding " + otherdiseasesCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="other_disease_diagnosis_section" + otherdiseasesCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = " <div height=\"30px\">&nbsp;</div><table><tr><td id=\"label1\">Disease " + otherdiseasesCounter + "</td><td><input type='button' value='Delete Disease' onClick='window.parent.deleteOtherDisease(" + otherdiseasesCounter + ");'></td></tr><tr>" +
		"<td>Type of diseases:" + 
		"<select name='diagnosis_name" + otherdiseasesCounter + "'>" +
			"<option value=''></option>" +
			"<option value='None'>None</option>" +
			"<option value='Diabetes'>Diabetes</option>" +
			"<option value='Hypertension'>Hypertension</option>" +
			"<option value='Thyroid'>Thyroid</option>" +
			"<option value='Cardiovaskular Disease'>Cardiovaskular Disease</option>" +
			"<option value='Endochrine'>Endochrine</option>" +
			"<option value='Congenital'>Congenital</option>" +
			"<option value='Mental Disorder'>Mental Disorder</option>" +
		"</select> " +
		"</td>" +
		"<td>Date of diagnosis: <input type='text' name='year_of_diagnosis" + otherdiseasesCounter + "' value=''/></td>" +
		"<td> Age at diagnosis:<input type='text' name='diagnosis_age" + otherdiseasesCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Diagnosis center:<input type='text' name='diagnosis_center" + otherdiseasesCounter + "' value=''/></td>" +
		"<td> Diagnosis doctor's name: <input type='text' name='diagnosis_doctor_name" + otherdiseasesCounter + "' value=''/></td>" +
		"</tr></table>" +
		"<div id=\"add_record_form_section_other_disease_diagnosis_medication" + otherdiseasesCounter + "\">" +
		"<table id=\"other_disease_medication_section" + otherdiseasesCounter + "\"><tr>" +
		"<td>Is on medication?: <input type='text' name='is_on_medication_flag" + otherdiseasesCounter + "' value=''/></td>" +
		"<td>Type of medication: <input type='text' name='medication_type_name" + otherdiseasesCounter + "' value=''/></td>" +
		"<td>Medication start date:<input type='text' name='medication_start_date" + otherdiseasesCounter + "' value=''/></td>" +
		"<td>Medication end date:<input type='text' name='medication_end_date" + otherdiseasesCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Medication duration:<input type='text' name='medication_duration" + otherdiseasesCounter + "' value=''/></td>" +
		"<td>Comment: <textarea name='medication_comments" + otherdiseasesCounter + "' cols='7' rows='10' id='medication_comments'></textarea></td>" +
		"<td><input type='button' value='Add medication' onClick='window.parent.addOtherDiseasesMedication(\"add_record_form_section_other_disease_diagnosis_medication" + otherdiseasesCounter + "\"); window.parent.calcHeight();'></td>" +
		"</tr></table></div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		otherdiseasesCounter++;
	}
}

function deleteOtherDisease(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('other_disease_diagnosis_section' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('other_disease_diagnosis_section' + divCounterName));
	window.parent.calcHeight();
	otherdiseasesCounter--;
}

// ======= OTHER DISEASES MEDICATION ==============

var otherdiseasesMedicationCounter = 2;
var limit = 10;

function addOtherDiseasesMedication(divName)
{
	if (otherdiseasesMedicationCounter == limit)  {
		alert("You have reached the limit of adding " + otherdiseasesMedicationCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="other_disease_medication_section" + otherdiseasesMedicationCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Type of medication: <input type='text' name='medication_type_name" + otherdiseasesMedicationCounter + "' value=''/></td>" +
		"<td>Medication start date:<input type='text' name='medication_start_date" + otherdiseasesMedicationCounter + "' value=''/></td>" +
		"<td>Medication end date:<input type='text' name='medication_end_date" + otherdiseasesMedicationCounter + "' value=''/></td>" +
		"<td>Medication duration:<input type='text' name='medication_duration" + otherdiseasesMedicationCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Comment: <textarea name='medication_comments" + otherdiseasesMedicationCounter + "' cols='7' rows='10' id='medication_comments'></textarea></td>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOtherDiseasesMedication(" + otherdiseasesMedicationCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		otherdiseasesMedicationCounter++;
	}
}

function deleteOtherDiseasesMedication(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('other_disease_medication_section' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('other_disease_medication_section' + divCounterName));
	window.parent.calcHeight();
	otherdiseasesMedicationCounter--;
}

// ==== PATIENT INTERVIEW MANAGER ====
var interviewNoteCounter = 2;
var limit = 10;

function addInterviewNoteInput(divName)
{
	if (interviewNoteCounter == limit)  {
		alert("You have reached the limit of adding " + interviewNoteCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="add_interview_form_section_" + interviewNoteCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<fieldset><legend>Interview Note " + interviewNoteCounter + "</legend>" +
		"<table>" +
		"<tr>" +
		"<td>Interview date: <input type='text' name='interview_date" + interviewNoteCounter + "' value=''/></td></tr>" +
		"<tr><td>Setup next interview date:<input type='text' name='interview_next_date" + interviewNoteCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<tr><td>Send email reminder to officer?:<input type='checkbox' name='is_send_email_reminder" + interviewNoteCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<tr><td>Set officer email addresses:<input type='text' name='officer_email_addresses" + interviewNoteCounter + "' value=''/></td>" +
		"</tr><tr>" +
		"<td>Interview note: <textarea name='interview_note" + interviewNoteCounter + "' cols='7' rows='10' id='interview_note'></textarea></td>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteInterviewNoteInput(" + interviewNoteCounter + ");'></td>" +
		"</tr></table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		interviewNoteCounter++;
	}
}

function deleteInterviewNoteInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('add_interview_form_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('add_interview_form_section_' + divCounterName));
	window.parent.calcHeight();
	interviewNoteCounter--;
}

// ==== PREGNANCY DETAILS ====
var pregnancyDetailsCounter = 1;
var limit = 10;

function addPregnancyInput(divName)
{
	if (pregnancyDetailsCounter == limit)  {
		alert("You have reached the limit of adding " + pregnancyDetailsCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="pregnancy_section_" + pregnancyDetailsCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<div height=\"30px\">&nbsp;</div>" + 
		"<table>" +
		"<tr>" +
		"<td>" + pregnancyDetailsCounter + ")Pregnancy type:" +
		"<select name='pregnancy_type" + pregnancyDetailsCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Child'>Child</option>" +
			"<option value='Stillborn'>Stillborn</option>" +
			"<option value='Miscarriage'>Miscarriage</option>" +
		"</select> " +
		"</td>" +
		"<td>Gender: " +
		"<select name='child_gender" + pregnancyDetailsCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Male'>Male</option>" +
			"<option value='Female'>Female</option>" +
		"</select> " +
		"<td>Date of birth<input type='text' name='child_birthyear" + pregnancyDetailsCounter + "' value=''/></td>" +
		"</tr>" +
		"<tr><td>Year of birth<input type='text' name='child_birthyear" + pregnancyDetailsCounter + "' value=''/></td>" +
		"<td>Age child at consent<input type='text' name='child_age_at_consent" + pregnancyDetailsCounter + "' value=''/></td>" +
		"<td>Birthweight<input type='text' name='child_birthweight" + pregnancyDetailsCounter + "' value=''/></td>" +
		"<td>Duration of breastfeeding<input type='text' name='child_breastfeeding_duration" + pregnancyDetailsCounter + "' value=''/></td>" +
		"</tr>" +
		"<tr>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deletePregnancyInput(" + pregnancyDetailsCounter + ");'></td>" +
		"<tr>" +
		"</table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		pregnancyDetailsCounter++;
	}
}

function deletePregnancyInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('pregnancy_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('pregnancy_section_' + divCounterName));
	window.parent.calcHeight();
	pregnancyDetailsCounter--;
}


// ==== SURVIVAL STATU DETAILS ====
var survivalStatusCounter = 2;
var limit = 20;

function addSurvivalStatusInput(divName)
{
	if (survivalStatusCounter == limit)  {
		alert("You have reached the limit of adding " + survivalStatusCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att2 = document.createAttribute("id");
		att2.value="survival_section_" + survivalStatusCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table>" +
		"<tr>" +
		"<td>Source:" +
		"<select name='status_source" + survivalStatusCounter + "'>" +
			"<option value=''></option>" +
			"<option value='JPN'>JPN</option>" +
			"<option value='Others'>Others</option>" +
			"<option value='Unknown'>Unknown</option>" +
		"</select> " +
		"</td>" +
		"<td>Status: " +
		"<select name='alive_status" + survivalStatusCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Alive'>Alive</option>" +
			"<option value='Dead'>Dead</option>" +
			"<option value='Unknown'>Unknown</option>" +
		"</select> </td>" +
		"<td> Status collected on: <input type='text' name='status_gathered_date" + survivalStatusCounter + "' value=''/></td>" +
		"<td><input type='button' value='Delete' onClick='window.parent.deleteSurvivalStatusInput(" + survivalStatusCounter + ");'></td>" +
		"<tr>" +
		"</table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		survivalStatusCounter++;
	}
}

function deleteSurvivalStatusInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('survival_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('survival_section_' + divCounterName));
	window.parent.calcHeight();
	survivalStatusCounter--;
}

// ===== ADD HOSPITAL NO =============== //
var hospitalNoCounter = 2;
var limit = 20;

function addHospitalNoInput(divName)
{
	if (hospitalNoCounter == limit)  {
		alert("You have reached the limit of adding " + hospitalNoCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="hospital_no_section_" + hospitalNoCounter;
		newdiv.setAttributeNode(att2);
		
		//class="container" id="add_record_form_section_1
		var formInputHTML = "<div height=\"30px\">&nbsp;</div>" + 
		"<table>" + 
		"<tr>" +
		"<td>Hospital No.:<input type='text' name='fullname" + hospitalNoCounter + "' value=''/></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteHospitalNoInput(" + hospitalNoCounter + ");'></td>" +
		"</tr>" + 
		"</table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		hospitalNoCounter++;
	}
}

function deleteHospitalNoInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('hospital_no_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('hospital_no_section_' + divCounterName));
	window.parent.calcHeight();
	hospitalNoCounter--;
}

// ===== ADD PRIVATE PATIENT NO =============== //
var privateNoCounter = 2;
var limit = 20;

function addPatientPrivateNoInput(divName)
{
	if (privateNoCounter == limit)  {
		alert("You have reached the limit of adding " + privateNoCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="add_private_patient_no_section_" + privateNoCounter;
		newdiv.setAttributeNode(att2);
		
		//class="container" id="add_record_form_section_1
		var formInputHTML = "<div height=\"30px\">&nbsp;</div>" + 
		"<table>" + 
		"<tr>" +
		"<td>Patient No.:<input type='text' name='fullname" + privateNoCounter + "' value=''/></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deletePatientPrivateNoInput(" + privateNoCounter + ");'></td>" +
		"</tr>" + 
		"</table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		privateNoCounter++;
	}
}

function deletePatientPrivateNoInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('add_private_patient_no_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('add_private_patient_no_section_' + divCounterName));
	window.parent.calcHeight();
	privateNoCounter--;
}

// ===== ADD BREAST CANCER PATHOLOGY STAINING STATUS =============== //
var breastStainingStatusCounter = 2;
var limit = 20;

function addBreastCancerStainingStatusInput(divName)
{
	if (breastStainingStatusCounter == limit)  {
		alert("You have reached the limit of adding " + breastStainingStatusCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="breast_cancer_staining_status_section_1" + breastStainingStatusCounter;
		newdiv.setAttributeNode(att2);
		
		//class="container" id="add_record_form_section_1
		var formInputHTML = "<div height=\"30px\">&nbsp;</div>" + 
		"<table>" + 
		"<tr>" +
		"<td> ER status:<br /><input type='text' name='breast_pathology_ER_status" + breastStainingStatusCounter + "' value=''/></td>" + 
		"<td>PR status:<br /><input type='text' name='breast_pathology_PR_status" + breastStainingStatusCounter + "' value=''/></td>" + 
		"<td>HER2 status:<br /><input type='text' name='breast_pathology_HER2_status" + breastStainingStatusCounter + "' value=''/></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteBreastCancerStainingStatusInput(" + breastStainingStatusCounter + ");'></td>" +
		"</tr>" + 
		"</table>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		breastStainingStatusCounter++;
	}
}

function deleteBreastCancerStainingStatusInput(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('breast_cancer_staining_status_section_1' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('breast_cancer_staining_status_section_1' + divCounterName));
	window.parent.calcHeight();
	breastStainingStatusCounter--;
}

// ===== ADD BREAST CANCER PATHOLOGY =============== //
var breastCancerPathologyCounter = 2;
var limit = 20;

function addBreastCancerPathology(divName)
{
	if (breastCancerPathologyCounter == limit)  {
		alert("You have reached the limit of adding " + breastCancerPathologyCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="breast_cancer_pathology_section" + breastCancerPathologyCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = " <div height=\"30px\">&nbsp;</div><table><tr><td id=\"label1\">Breast Cancer Tumor Pathology " + breastCancerPathologyCounter + "</td><td><input type='button' value='Delete Pathology' onClick='window.parent.deleteBreastCancerPathology(" + breastCancerPathologyCounter + ");'></td></tr><tr>" +
		"<td>Site:<br />" +
		"<select name='breast_pathology_tissue_site" + breastCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Left'>Left</option>" +
			"<option value='Right'>Right</option>" +
		"</select> " +
		"</td>" +
		"<td>Type of report:<br />" +
		"<select name='breast_pathology_path_report_type" + breastCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Pathology'>Pathology</option>" +
			"<option value='FNAC'>FNAC</option>" +
			"<option value='Core biopsy'>Core biopsy</option>" +
			"<option value='Stereostatic biopsy'>Stereostatic biopsy</option>" +
		"</select> " +
		"</td>" +
		"<td>Date of report:<br /><input type='text' name='breast_pathology_path_report_date" + breastCancerPathologyCounter + "' value=''/></td>" + 
		"</tr><tr>" +
		"<td>Pathology lab:<br /><input type='text' name='breast_pathology_lab" + breastCancerPathologyCounter + "' value=''/></td>" + 
		"<td>Name of doctor:<br /><input type='text' name='breast_pathology_doctor" + breastCancerPathologyCounter + "' value=''/></td>" + 
		"</tr><tr>" +
		"<td>Morphology:<br />" +
		"<select name='breast_pathology_morphology" + breastCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='DCIS'>DCIS</option>" +
			"<option value='LCIS'>LCIS</option>" +
			"<option value='IDC'>IDC</option>" +
			"<option value='ILC'>ILC</option>" +
			"<option value='IPC'>IPC</option>" +
			"<option value='Intraductal papillary carcinoma'>Intraductal papillary carcinoma</option>" +
			"<option value='Tubular carcinoma'>Tubular carcinoma</option>" +
			"<option value='Cribiform carcinoma'>Cribiform carcinoma</option>" +
			"<option value='Medullary carcinoma'>Medullary carcinoma</option>" +
		"</select> " +
		"</td>" +
		"<td> T Staging:<br />" +
		"<select name='breast_pathology_tissue_tumour_stage" + breastCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='T0'>T0</option>" +
			"<option value='T1'>T1</option>" +
			"<option value='T2'>T2</option>" +
			"<option value='T3'>T3</option>" +
			"<option value='T4'>T4</option>" +
			"<option value='Tx'>Tx</option>" +
		"</select> " +
		"</td>" +
		"<td> N staging:<br />" +
		"<select name='breast_pathology_node_stage" + breastCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='N0'>N0</option>" +
			"<option value='N1'>N1</option>" +
			"<option value='N2'>N2</option>" +
			"<option value='N3'>N3</option>" +
			"<option value='Nx'>Nx</option>" +
		"</select> " +
		"</td>" +
		"</tr><tr>" +
		"<td> M staging:<br />" +
		"<select name='breast_pathology_metastasis_stage" + breastCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='M0'>M0</option>" +
			"<option value='M1'>M1</option>" +
			"<option value='Mx'>Mx</option>" +
		"</select> " +
		"</td>" +
		"<td> Tumour stage:<br />" +
		"<select name='breast_pathology_tumour_stage" + breastCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='0'>0</option>" +
			"<option value='1'>1</option>" +
			"<option value='2a'>2a</option>" +
			"<option value='2b'>2b</option>" +
			"<option value='3a'>3a</option>" +
			"<option value='4'>4</option>" +
			"<option value='Not stated'>Not stated</option>" +
		"</select> " +
		"</td>" +
		"<td> Tumour grade:<br />" +
		"<select name='breast_pathology_tumour_grade" + breastCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='1: Well differentiated'>1: Well differentiated</option>" +
			"<option value='2: Moderately differentiated'>2: Moderately differentiated</option>" +
			"<option value='3: Poorly/un-differentiated'>3: Poorly/un-differentiated</option>" +
			"<option value='High'>High</option>" +
			"<option value='Low'>Low</option>" +
		"</select> " +
		"</td>" +
		"</tr><tr>" +
		"<td> No. of lymph nodes:<br /><input type='text' name='breast_pathology_total_lymph_nodes" + breastCancerPathologyCounter + "' value=''/></td>" + 
		"<td>Size of tumor:<br /><input type='text' name='breast_pathology_tumour_size" + breastCancerPathologyCounter + "' value=''/></td>" + 
		"</tr>" + 
		"</table>" +
		"<div id=\"breast_cancer_staining_status_div_" + breastCancerPathologyCounter + "\">" +
		"<table id=\"breast_cancer_staining_status_section_" + breastCancerPathologyCounter + "\"><tr>" +
		"<td> ER status:<br /><input type='text' name='breast_pathology_ER_status" + breastCancerPathologyCounter + "' value=''/></td>" + 
		"<td>PR status:<br /><input type='text' name='breast_pathology_PR_status" + breastCancerPathologyCounter + "' value=''/></td>" + 
		"<td>HER2 status:<br /><input type='text' name='breast_pathology_HER2_status" + breastCancerPathologyCounter + "' value=''/></td>" + 
		"<td><input type='button' value='Add staining status' onClick='window.parent.addBreastCancerStainingStatusInput(\"breast_cancer_staining_status_div_" + breastCancerPathologyCounter + "\"); window.parent.calcHeight();'></td>" +
		"</tr>" + 
		"</table></div>" +
		"<table><tr>" +
		"<td>Comment:<textarea name='ovary_pathology_tissue_path_comments" + ovaryCancerPathologyCounter + "' cols='7' rows='3' id='ovary_pathology_tissue_path_comments' ></textarea></td>" + 
		"<td>&nbsp;</td><td>&nbsp;</td>" +
		"</tr></table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		breastCancerPathologyCounter++;
	}
}

function deleteBreastCancerPathology(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('breast_cancer_pathology_section' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('breast_cancer_pathology_section' + divCounterName));
	window.parent.calcHeight();
	breastCancerPathologyCounter--;
}


// ===== ADD OVARY CANCER PATHOLOGY =============== //
var ovaryCancerPathologyCounter = 2;
var limit = 20;

function addOvaryCancerPathology(divName)
{
	if (ovaryCancerPathologyCounter == limit)  {
		alert("You have reached the limit of adding " + ovaryCancerPathologyCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="ovary_cancer_pathology_section" + ovaryCancerPathologyCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = " <div height=\"30px\">&nbsp;</div><table><tr><td id=\"label1\">Ovarian Cancer Tumor Pathology " + ovaryCancerPathologyCounter + "</td><td><input type='button' value='Delete Pathology' onClick='window.parent.deleteOvaryCancerPathology(" + ovaryCancerPathologyCounter + ");'></td></tr><tr>" +
		"<td>Site: <br />" +
		"<select name='ovary_pathology_tissue_site" + ovaryCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Left'>Left</option>" +
			"<option value='Right'>Right</option>" +
		"</select> " +
		"</td>" +
		"<td>Type of report:<br />" +
		"<select name='ovary_pathology_path_report_type" + ovaryCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Pathology'>Pathology</option>" +
			"<option value='FNAC'>FNAC</option>" +
			"<option value='Core biopsy'>Core biopsy</option>" +
			"<option value='Stereostatic biopsy'>Stereostatic biopsy</option>" +
		"</select> " +
		"</td>" +
		"<td>Date of report:<br /><input type='text' name='ovary_pathology_path_report_date" + ovaryCancerPathologyCounter + "' value=''/></td>" + 
		"</tr><tr>" +
		"<td>Pathology lab:<br /><input type='text' name='ovary_pathology_lab" + ovaryCancerPathologyCounter + "' value=''/></td>" + 
		"<td>Name of doctor:<br /><input type='text' name='ovary_pathology_doctor" + ovaryCancerPathologyCounter + "' value=''/></td>" + 
		"</tr><tr>" +
		"<td>Morphology:<br />" +
		"<select name='ovary_pathology_morphology" + ovaryCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='DCIS'>DCIS</option>" +
			"<option value='LCIS'>LCIS</option>" +
			"<option value='IDC'>IDC</option>" +
			"<option value='ILC'>ILC</option>" +
			"<option value='IPC'>IPC</option>" +
			"<option value='Intraductal papillary carcinoma'>Intraductal papillary carcinoma</option>" +
			"<option value='Tubular carcinoma'>Tubular carcinoma</option>" +
			"<option value='Cribiform carcinoma'>Cribiform carcinoma</option>" +
			"<option value='Medullary carcinoma'>Medullary carcinoma</option>" +
		"</select> " +
		"</td>" +
		"<td>Stage classification:<br />" +
		"<select name='ovary_stage_classification" + ovaryCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='SEER'>SEER</option>" +
			"<option value='FIGO'>FIGO</option>" +
		"</select> " +
		"</td>" +
		"<td> Tumour stage:<br />" +
		"<select name='ovary_pathology_tumour_stage" + ovaryCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='0'>0</option>" +
			"<option value='1'>1</option>" +
			"<option value='2a'>2a</option>" +
			"<option value='2b'>2b</option>" +
			"<option value='3a'>3a</option>" +
			"<option value='4'>4</option>" +
			"<option value='Not stated'>Not stated</option>" +
		"</select> " +
		"</td>" +
		"</tr><tr>" +
		"<td> Tumour grade:<br />" +
		"<select name='ovary_pathology_tumour_grade" + ovaryCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='1: Well differentiated'>1: Well differentiated</option>" +
			"<option value='2: Moderately differentiated'>2: Moderately differentiated</option>" +
			"<option value='3: Poorly/un-differentiated'>3: Poorly/un-differentiated</option>" +
			"<option value='High'>High</option>" +
			"<option value='Low'>Low</option>" +
		"</select> " +
		"</td>" +
		"<td>Size of tumor:<br /><input type='text' name='ovary_pathology_tumour_size" + ovaryCancerPathologyCounter + "' value=''/></td>" + 
		"</tr><tr>" +
		"<td>Comment:<br /><textarea name='ovary_pathology_tissue_path_comments" + ovaryCancerPathologyCounter + "' cols='7' rows='3' id='ovary_pathology_tissue_path_comments' ></textarea></td>" + 
		"<td>&nbsp;</td><td>&nbsp;</td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		ovaryCancerPathologyCounter++;
	}
}

function deleteOvaryCancerPathology(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('ovary_cancer_pathology_section' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('ovary_cancer_pathology_section' + divCounterName));
	window.parent.calcHeight();
	ovaryCancerPathologyCounter--;
}


// ===== ADD OTHER CANCER PATHOLOGY =============== //
var otherCancerPathologyCounter = 2;
var limit = 20;

function addOtherCancerPathology(divName)
{
	if (otherCancerPathologyCounter == limit)  {
		alert("You have reached the limit of adding " + otherCancerPathologyCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="other_cancer_pathology_section" + otherCancerPathologyCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = " <div height=\"30px\">&nbsp;</div><table><tr><td id=\"label1\">Other Cancer Tumor Pathology " + otherCancerPathologyCounter + "</td><td><input type='button' value='Delete Pathology' onClick='window.parent.deleteOtherCancerPathology(" + otherCancerPathologyCounter + ");'></td></tr><tr>" +
		"<td>Site: <br />" +
		"<select name='other_pathology_tissue_site" + otherCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Left'>Left</option>" +
			"<option value='Right'>Right</option>" +
		"</select> " +
		"</td>" +
		"<td>Type of report:<br />" +
		"<select name='other_pathology_path_report_type" + otherCancerPathologyCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Pathology'>Pathology</option>" +
			"<option value='FNAC'>FNAC</option>" +
			"<option value='Core biopsy'>Core biopsy</option>" +
			"<option value='Stereostatic biopsy'>Stereostatic biopsy</option>" +
		"</select> " +
		"</td>" +
		"<td>Date of report:<br /><input type='text' name='other_pathology_path_report_date" + otherCancerPathologyCounter + "' value=''/></td>" + 
		"</tr><tr>" +
		"<td>Pathology lab:<br /><input type='text' name='other_pathology_lab" + otherCancerPathologyCounter + "' value=''/></td>" + 
		"<td>Name of doctor:<br /><input type='text' name='other_pathology_doctor" + otherCancerPathologyCounter + "' value=''/></td>" + 
		"</tr><tr>" +
		"<td>Comment:<br /><textarea name='other_pathology_tissue_path_comments" + otherCancerPathologyCounter + "' cols='7' rows='3' id='other_pathology_tissue_path_comments' ></textarea></td>" + 
		"<td>&nbsp;</td><td>&nbsp;</td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		otherCancerPathologyCounter++;
	}
}

function deleteOtherCancerPathology(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('other_cancer_pathology_section' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('other_cancer_pathology_section' + divCounterName));
	window.parent.calcHeight();
	otherCancerPathologyCounter--;
}


// ===== ADD MUTATION ANALYSIS =============== //
var mutationAnalysisCounter = 2;
var limit = 20;

function addMutationAnalysis(divName)
{
	if (mutationAnalysisCounter == limit)  {
		alert("You have reached the limit of adding " + mutationAnalysisCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="mutation_section_" + mutationAnalysisCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = " <div height=\"30px\">&nbsp;</div><table><tr><td id=\"label1\">Analysis " + mutationAnalysisCounter + "</td><td><input type='button' value='Delete Mutation Analysis' onClick='window.parent.deleteMutationAnalysis(" + mutationAnalysisCounter + ");'></td></tr><tr>" +
		"<td>Date test ordered:<br /><input type='text' name='date_test_ordered" + mutationAnalysisCounter + "' value=''/></td>" + 
		"<td>Ordered by:<br /><input type='text' name='test_ordered_by" + mutationAnalysisCounter + "' value=''/></td>" + 
		"<td>Request for result notification?: <input type='checkbox' name='testing_results_notification_flag" + mutationAnalysisCounter + "' value='1' checked='checked'/></td>" +
		"</tr><tr>" +
		"<td>Service provider:<br />" +
		"<select name='investigation_project_name" + mutationAnalysisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='GTG'>GTG</option>" +
			"<option value='Sequenom'>Sequenom</option>" +
			"<option value='BGI'>BGI</option>" +
		"</select> " +
		"</td>" +
		"<td>Testing batch:<br /><input type='text' name='investigation_project_batch" + mutationAnalysisCounter + "' value=''/></td>" + 
		"<td>Testing date:<br /><input type='text' name='investigation_project_date" + mutationAnalysisCounter + "' value=''/></td>" + 
		"<td>Gene tested:<br />" +
		"<select name='investigation_gene_tested" + mutationAnalysisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='APC'>APC</option>" +
			"<option value='ATM'>ATM</option>" +
			"<option value='PALB2'>PALB2</option>" +
			"<option value='BRCA1'>BRCA1</option>" +
			"<option value='BRCA2'>BRCA2</option>" +
			"<option value='TP5 3'>TP5 3</option>" +
			"<option value='BRCX'>BRCX</option>" +
			"<option value='APOE'>APOE</option>" +
			"<option value='Others'>Others</option>" +
		"</select> " +
		"</td>" +
		"</tr><tr>" +
		"<td>Other:<br /><input type='text' name='investigation_gene_tested_other" + mutationAnalysisCounter + "' value=''/></td>" + 
		"<td>Types of testing:<br />" +
		"<select name='investigation_test_type" + mutationAnalysisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Full analysis'>Full analysis</option>" +
			"<option value='MLPA'>MLPA</option>" +
			"<option value='Genotyping'>Genotyping</option>" +
			"<option value='Predictive testing'>Predictive testing</option>" +
		"</select> " +
		"</td>" +
		"<td>Sample type:<br />" +
		"<select name='investigation_sample_type" + mutationAnalysisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='DNA'>DNA</option>" +
			"<option value='Serum'>Serum</option>" +
			"<option value='Plasma'>Plasma</option>" +
		"</select> " +
		"</td>" +
		"</tr><tr>" +
		"<td>Test reason:<br /><textarea name='investigation_test_reason" + mutationAnalysisCounter + "' cols='7' rows='3' id='investigation_test_reason' ></textarea></td>" + 
		"<td>Is new mutation?: <input type='checkbox' name='investigation_new_mutation_flag" + relativeCounter + "' value='1'/></td>" +
		"</tr><tr>" +
		"<td> Test results:<br />" +
		"<select name='investigation_test_results" + mutationAnalysisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='AA changes'>AA changes</option>" +
			"<option value='Exon details'>Exon details</option>" +
			"<option value='Other details'>Other details</option>" +
		"</select> " +
		"</td>" +
		"<td>Other details:<br /><textarea name='investigation_test_results_other_details" + mutationAnalysisCounter + "' cols='7' rows='3' id='investigation_test_results_other_details' ></textarea></td>" + 
		" <td>&nbsp;</td>" +
		"</tr><tr>" +
		"<td> Mutation pathogenicity:<br />" +
		"<select name='investigation_mutation_pathogenicity" + mutationAnalysisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Del'>Del</option>" +
			"<option value='VUS'>VUS</option>" +
			"<option value='SNP'>SNP</option>" +
		"</select> " +
		"</td>" +
		"<td> Mutation nomenclature:<br />" +
		"<select name='investigation_mutation_nomenclature" + mutationAnalysisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='BIC'>BIC</option>" +
			"<option value='HGVC'>HGVC</option>" +
			"<option value='aa'>aa</option>" +
		"</select> " +
		"</td>" +
		"<td>Mutation type:<br /><input type='text' name='investigation_mutation_type" + mutationAnalysisCounter + "' value=''/></td>" + 
		"<td>Exon:<br /><input type='text' name='investigation_exon" + mutationAnalysisCounter + "' value=''/></td>" + 
		"</tr><tr>" +
		"<td>Carrier status:<br />" +
		"<select name='investigation_carrier_status" + mutationAnalysisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Affected carrier'>Affected carrier</option>" +
			"<option value='Unaffected carrier'>Unaffected carrier</option>" +
			"<option value='Affected non carrier'>Affected non carrier</option>" +
			"<option value='Unaffected non carrier'>Unaffected non carrier</option>" +
		"</select> " +
		"</td>" +
		"<td>Report date:<br /><input type='text' name='investigation_report_date" + mutationAnalysisCounter + "' value=''/></td>" + 
		"<td>Date client notified:<br /><input type='text' name='investigation_date_notified" + mutationAnalysisCounter + "' value=''/></td>" + 
		"<td>Counselling: <input type='checkbox' name='mutation_is_counselling_flag" + relativeCounter + "' value='1'/></td>" +
		"</tr><tr>" +
		"<td>Comments:<br /><textarea name='investigation_test_comment" + mutationAnalysisCounter + "' cols='7' rows='3' id='investigation_test_comment' ></textarea></td>" + 
		"<td>Attach conformation?: <input type='checkbox' name='investigation_conformation_attachment" + mutationAnalysisCounter + "' value='1'/></td>" +
		"<td><input type=\"file\" name=\"userfile\" size=\"100000\" /></td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		mutationAnalysisCounter++;
	}
}

function deleteMutationAnalysis(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('mutation_section_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('mutation_section_' + divCounterName));
	window.parent.calcHeight();
	mutationAnalysisCounter--;
}


// ===== ADD OVARIAN PHYSICAL SCREENINGS INFO =============== //
var ovarianPhysicalExamsCounter = 2;
var limit = 20;

function addOvarianScreeningPhycialExamsInfo(divName)
{
	if (ovarianPhysicalExamsCounter == limit)  {
		alert("You have reached the limit of adding " + ovarianPhysicalExamsCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="physical_flag_table_" + ovarianPhysicalExamsCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Ovarian screening type:" +
		"<select name='ovarian_screening_type_name" + mutationAnalysisCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Physical pelvic examinations'>Physical pelvic examinations</option>" +
			"<option value='Abdominal ultrasound'>Abdominal ultrasound</option>" +
			"<option value='Trans-vaginal ultrasound'>Trans-vaginal ultrasound</option>" +
			"<option value='CA125 blood test'>CA125 blood test</option>" +
			"<option value='Biopsy'>Biopsy</option>" +
		"</select> " +
		"</td>" +
		"<td>Date:<input type='text' name='physical_exam_date" + ovarianPhysicalExamsCounter + "' value=''/></td>" + 
		"<td>Is abnormality detected?: <input type='checkbox' name='physical_exam_is_abnormality_detected" + ovarianPhysicalExamsCounter + "' value='1'/></td>" +
		"</tr><tr>" +
		"<td>Additional Info:<br /><textarea name='physical_exam_additional_info" + ovarianPhysicalExamsCounter + "' cols='7' rows='3' id='physical_exam_additional_info' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOvarianScreeningPhycialExamsInfo(" + ovarianPhysicalExamsCounter + ");'></td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		ovarianPhysicalExamsCounter++;
	}
}

function deleteOvarianScreeningPhycialExamsInfo(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('physical_flag_table_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('physical_flag_table_' + divCounterName));
	window.parent.calcHeight();
	ovarianPhysicalExamsCounter--;
}

// ===== ADD OVARIAN ABDOMINAL ULTRASOUND INFO =============== //
var ovarianAbdominalUltrasoundCounter = 2;
var limit = 20;

function addOvarianScreeningAbdominalUltrasoundInfo(divName)
{
	if (ovarianAbdominalUltrasoundCounter == limit)  {
		alert("You have reached the limit of adding " + ovarianAbdominalUltrasoundCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="abdominal_ultrasound_flag_table_" + ovarianAbdominalUltrasoundCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Date:<input type='text' name='abdominal_ultrasound_date" + ovarianAbdominalUltrasoundCounter + "' value=''/></td>" + 
		"<td>Is abnormality detected?: <input type='checkbox' name='abdominal_ultrasound_is_abnormality_detected" + ovarianAbdominalUltrasoundCounter + "' value='1'/></td>" +
		"<td>Additional Info:<textarea name='abdominal_ultrasound_additional_info" + ovarianAbdominalUltrasoundCounter + "' cols='7' rows='3' id='abdominal_ultrasound_additional_info' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOvarianScreeningAbdominalUltrasoundInfo(" + ovarianAbdominalUltrasoundCounter + ");'></td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		ovarianAbdominalUltrasoundCounter++;
	}
}

function deleteOvarianScreeningAbdominalUltrasoundInfo(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('abdominal_ultrasound_flag_table_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('abdominal_ultrasound_flag_table_' + divCounterName));
	window.parent.calcHeight();
	ovarianAbdominalUltrasoundCounter--;
}

// ===== ADD OVARIAN TRANSVAGINAL ULTRASOUND INFO =============== //
var ovarianTransvaginalUltrasoundCounter = 2;
var limit = 20;

function addOvarianScreeningTransvaginalUltrasoundInfo(divName)
{
	if (ovarianTransvaginalUltrasoundCounter == limit)  {
		alert("You have reached the limit of adding " + ovarianTransvaginalUltrasoundCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="transvaginal_ultrasound_flag_table_" + ovarianTransvaginalUltrasoundCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Date:<input type='text' name='transvaginal_ultrasound_date" + ovarianTransvaginalUltrasoundCounter + "' value=''/></td>" + 
		"<td>Is abnormality detected?: <input type='checkbox' name='transvaginal_ultrasound_is_abnormality_detected" + ovarianTransvaginalUltrasoundCounter + "' value='1'/></td>" +
		"<td>Additional Info:<textarea name='transvaginal_ultrasound_additional_info" + ovarianTransvaginalUltrasoundCounter + "' cols='7' rows='3' id='transvaginal_ultrasound_additional_info' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOvarianScreeningTransvaginalUltrasoundInfo(" + ovarianTransvaginalUltrasoundCounter + ");'></td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		ovarianTransvaginalUltrasoundCounter++;
	}
}

function deleteOvarianScreeningTransvaginalUltrasoundInfo(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('transvaginal_ultrasound_flag_table_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('transvaginal_ultrasound_flag_table_' + divCounterName));
	window.parent.calcHeight();
	ovarianTransvaginalUltrasoundCounter--;
}


// ===== ADD CA125 BLOOD TEST INFO =============== //
var ovarianCA125bloodtestCounter = 2;
var limit = 20;

function addOvarianScreeningCA125BloodtestInfo(divName)
{
	if (ovarianCA125bloodtestCounter == limit)  {
		alert("You have reached the limit of adding " + ovarianCA125bloodtestCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="CA125_blood_test_flag_table_" + ovarianCA125bloodtestCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Date:<input type='text' name='CA125_blood_test_date" + ovarianCA125bloodtestCounter + "' value=''/></td>" + 
		"<td>Is abnormality detected?: <input type='checkbox' name='CA125_blood_test_is_abnormality_detected" + ovarianCA125bloodtestCounter + "' value='1'/></td>" +
		"<td>Additional Info:<textarea name='CA125_blood_test_additional_info" + ovarianCA125bloodtestCounter + "' cols='7' rows='3' id='CA125_blood_test_additional_info' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOvarianScreeningCA125BloodtestInfo(" + ovarianCA125bloodtestCounter + ");'></td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		ovarianCA125bloodtestCounter++;
	}
}

function deleteOvarianScreeningCA125BloodtestInfo(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('CA125_blood_test_flag_table_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('CA125_blood_test_flag_table_' + divCounterName));
	window.parent.calcHeight();
	ovarianCA125bloodtestCounter--;
}


// ===== ADD BIOPSY INFO =============== //
var ovarianBiopsyCounter = 2;
var limit = 20;

function addOvarianScreeningBiopsyInfo(divName)
{
	if (ovarianBiopsyCounter == limit)  {
		alert("You have reached the limit of adding " + ovarianBiopsyCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="biopsy_flag_table_" + ovarianBiopsyCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Date:<input type='text' name='biopsy_date" + ovarianBiopsyCounter + "' value=''/></td>" + 
		"<td>Is abnormality detected?: <input type='checkbox' name='biopsy_is_abnormality_detected" + ovarianBiopsyCounter + "' value='1'/></td>" +
		"<td>Additional Info:<textarea name='biopsy_additional_info" + ovarianBiopsyCounter + "' cols='7' rows='3' id='biopsy_additional_info' ></textarea></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteOvarianScreeningBiopsyInfo(" + ovarianBiopsyCounter + ");'></td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		ovarianBiopsyCounter++;
	}
}

function deleteOvarianScreeningBiopsyInfo(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('biopsy_flag_table_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('biopsy_flag_table_' + divCounterName));
	window.parent.calcHeight();
	ovarianBiopsyCounter--;
}


// ===== ADD RISK REDUCING SURGERY - BENIGN INFO=============== //
var riskReducingSurgeryCounter = 2;
var limit = 20;

function addRiskReducingSurgeryBenignInfo(divName)
{
	if (riskReducingSurgeryCounter == limit)  {
		alert("You have reached the limit of adding " + riskReducingSurgeryCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="non_cancerous_benign_info_table_" + riskReducingSurgeryCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Select site:" +
		"<select name='non_cancerous_benign_site" + riskReducingSurgeryCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Left Breast'>Left Breast</option>" +
			"<option value='Right Breast'>Right Breast</option>" +
			"<option value='Left Ovary'>Left Ovary</option>" +
			"<option value='Right Ovary'>Right Ovary</option>" +
			"<option value='Uterus'>Uterus</option>" +
		"</select> " +
		"<td>Date:<input type='text' name='non_cancerous_benign_date" + riskReducingSurgeryCounter + "' value=''/></td>" + 
		"<td><input type='button' value='Delete' onClick='window.parent.deleteRiskReducingSurgeryBenignInfo(" + riskReducingSurgeryCounter + ");'></td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		riskReducingSurgeryCounter++;
	}
}

function deleteRiskReducingSurgeryBenignInfo(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('non_cancerous_benign_info_table_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('non_cancerous_benign_info_table_' + divCounterName));
	window.parent.calcHeight();
	riskReducingSurgeryCounter--;
}


// ===== ADD RISK REDUCING SURGERY - COMPLETE REMOVAL =============== //
var riskReducingSurgeryCompleteRemovalCounter = 2;
var limit = 20;

function addRiskReducingSurgeryCompleteRemovalInfo(divName)
{
	if (riskReducingSurgeryCompleteRemovalCounter == limit)  {
		alert("You have reached the limit of adding " + riskReducingSurgeryCompleteRemovalCounter + " inputs");
	}
	else 
	{
		var newdiv = document.createElement('div');
		
		var att1 = document.createAttribute("class");
		att1.value="container";
		newdiv.setAttributeNode(att1);
		
		var att2 = document.createAttribute("id");
		att2.value="non_cancerous_complete_removal_info_table_" + riskReducingSurgeryCompleteRemovalCounter;
		newdiv.setAttributeNode(att2);
		
		var formInputHTML = "<table><tr>" +
		"<td>Select site:" +
		"<select name='non_cancerous_complete_removal_site" + riskReducingSurgeryCompleteRemovalCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Left Breast'>Left Breast</option>" +
			"<option value='Right Breast'>Right Breast</option>" +
			"<option value='Left Ovary'>Left Ovary</option>" +
			"<option value='Right Ovary'>Right Ovary</option>" +
			"<option value='Uterus'>Uterus</option>" +
		"</select> " +
		"<td>Date:<input type='text' name='non_cancerous_complete_removal_date" + riskReducingSurgeryCompleteRemovalCounter + "' value=''/></td>" + 
		"<td>Reason:" +
		"<select name='non_cancerous_complete_removal_reason" + riskReducingSurgeryCompleteRemovalCounter + "'>" +
			"<option value=''></option>" +
			"<option value='Prevention of cancer'>Prevention of cancer</option>" +
			"<option value='Treatment of cancer'>Treatment of cancer</option>" +
			"<option value='Other medical treatment'>Other medical treatment</option>" +
		"</select> " +"<td><input type='button' value='Delete' onClick='window.parent.deleteRiskReducingSurgeryCompleteRemovalInfo(" + riskReducingSurgeryCompleteRemovalCounter + ");'></td>" +
		"</tr>" + 
		"</table>" +
		"</div>";
		
		newdiv.innerHTML = formInputHTML;
		
		var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
		
		iframeDoc.getElementById(divName).appendChild(newdiv);
		riskReducingSurgeryCompleteRemovalCounter++;
	}
}

function deleteRiskReducingSurgeryCompleteRemovalInfo(divCounterName) 
{
	var iframeDoc = document.getElementById('iframe_record_home').contentWindow ? document.getElementById('iframe_record_home').contentWindow.document : document.getElementById('iframe_record_home').contentDocument;
	
	iframeDoc.getElementById('non_cancerous_complete_removal_info_table_' + divCounterName).parentNode.removeChild(iframeDoc.getElementById('non_cancerous_complete_removal_info_table_' + divCounterName));
	window.parent.calcHeight();
	riskReducingSurgeryCompleteRemovalCounter--;
}