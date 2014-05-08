$( document ).ready(function() {
			// Handler for .ready() called.
			$("#personal-details-form").validate({
				rules: {
					//added FK - azie 5 mac 2014
					IC_no: {
						required: true,
						number: true,
						maxlength: 12
					},
					studies_name : {	
						required: true
					},
				},
				messages: {
                                    studies_name: {
                                        required: 'Please select studies name'
                                        },
                                        IC_no: {
                                        required: 'Please select IC No'
                                        }
				    
				}
			});
			
			$("#family-details-form").validate({
				rules: {
					family_no : {	
						required: true
					},
					IC_no: {
						required: true,
						number: true,
						minlength: 12,
						maxlength: 12
					},
                                        relative_is_cancer_diagnosed : {
						required: true
					},
					mother_fullname : {
						required: true
					},
					father_fullname : {
						required: true
					},
					//added FK - azie 5 mac 2014
					father_relative_id : {
						required: true
					}
					
				},
				messages: {
				   IC_no: "Please enter a valid IC no.",
                                   relative_is_cancer_diagnosed: "Please select.",
				   //added FK - azie 5 mac 2014
				   family_no: "Please enter a valid family no.",
				   father_relative_id: "Please insert a valid relative id."
				   
				}
			});
			
			$("#diagnosis-treatment-details-form").validate({
				rules: {
					IC_no : {	
						required: true,
						number: true,
						minlength: 12,
						maxlength: 12
					},
					studies_name: {
						required: true
					},
					//added FK - azie 5 mac 2014
					studies_id : {	
						required: true
					},
					patient_studies_id : {	
						required: true
					},
					treatment_id : {	
						required: true
					},
					patient_cancer_id :{
						required: true
					},
					diagnosis_id: {
						required: true
					}
					
				},
				messages: {
				   IC_no: "Please enter a valid IC no.",
				    //added FK - azie 5 mac 2014
				   studies_id: "Please enter a valid studies id.",
				   patient_studies_id: "Please enter a valid patient studies id.",
				   treatment_id: "Please enter a valid treatment id.",
				   patient_cancer_id: "Please enter a valid patient cancer id.",
				   diagnosis_id: "Please enter a valid diagnosis id."
				   
				}
			});
			
			$("#screenings-details-form").validate({
				rules: {
					IC_no : {	
						required: true,
						number: true,
						minlength: 12,
						maxlength: 12
					},
					studies_name: {
						required: true
					},
					//added FK - azie 5 mac 2014
					studies_id : {	
						required: true
					},
					patient_studies_id : {	
						required: true
					},
					patient_breast_screening_id : {	
						required: true
					}	
					
				},
				messages: {
				   IC_no: "Please enter a valid IC no.",
				   //added FK - azie 5 mac 2014
				   studies_id: "Please enter a valid studies id.",
				   patient_studies_id: "Please enter a valid patient studies id.",
				   patient_breast_screening_id: "Please enter a valid patient breast screening id.",
				}
			});
			
			$("#mutation-analysis-details-form").validate({
				rules: {
					IC_no : {	
						required: true,
						number: true,
						minlength: 12,
						maxlength: 12
					},
					studies_name: {
						required: true
					},
					//added FK - azie 5 mac 2014
					studies_id : {	
						required: true
					},
					patient_studies_id : {	
						required: true
					}	
				},
				messages: {
				   IC_no: "Please enter a valid IC no.",
				   //added FK - azie 5 mac 2014
				   studies_id: "Please enter a valid studies id.",
				   patient_studies_id: "Please enter a valid patient studies id."
				}
			});
			
			$("#risk-assessment-details-form").validate({
				rules: {
					IC_no : {	
						required: true,
						number: true,
						minlength: 12,
						maxlength: 12
					}				
				},
				messages: {
				   IC_no: "Please enter a valid IC no."
				}
			});
			
			$("#lifestyle-details-form").validate({
				rules: {
					IC_no : {	
						required: true,
						number: true,
						minlength: 12,
						maxlength: 12
					},
					studies_name: {
						required: true
					},
					//added FK - azie 5 mac 2014
					studies_id : {	
						required: true
					},
					patient_studies_id : {	
						required: true
					},
					patient_lifestyle_factors_id : {	
						required: true
					},
					treatment_id : {	
						required: true
					},
					patient_parity_table_id : {	
						required: true
					}
				},
				messages: {
				   IC_no: "Please enter a valid IC no.",
				   //added FK - azie 5 mac 2014
				   studies_id: "Please enter a valid studies id.",
				   patient_studies_id: "Please enter a valid patient studies id.",
				   patient_lifestyle_factors_id: "Please enter a valid patient lifestyle factors id.",
				   treatment_id: "Please enter a valid treatment id.",
				   patient_parity_table_id: "Please enter a valid patient parity table id."
				}
			});
			
			$("#interview-details-form").validate({
				rules: {
					IC_no : {	
						required: true,
						number: true,
						minlength: 12,
						maxlength: 12
					}				
				},
				messages: {
				   IC_no: "Please enter a valid IC no."
				}
			});
		});