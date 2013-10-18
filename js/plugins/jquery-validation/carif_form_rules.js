$( document ).ready(function() {
			// Handler for .ready() called.
			$("#personal-details-form").validate({
				rules: {
					surname : {
						required: true
					},
					fullname : {
						required: true
					},
					family_no : {	
						required: true
					},
					IC_no: {
						required: true,
						number: true,
						minlength: 12,
						maxlength: 12
					},
					nationality : {
						required: true
					},
					gender : {
						required: true
					},
					ethinicity : {
						required: true
					},
					DOB : {
						required: true
					},
					place_of_birth :{
						required: true
					},
					email : {
						email: true
					},
					studies_name : {
						required: true
					}
				},
				messages: {
				   IC_no: "Please enter a valid IC no."
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
					mother_fullname : {
						required: true
					},
					father_fullname : {
						required: true
					}
					
				},
				messages: {
				   IC_no: "Please enter a valid IC no."
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
					}					
				},
				messages: {
				   IC_no: "Please enter a valid IC no."
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
					}					
				},
				messages: {
				   IC_no: "Please enter a valid IC no."
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
					}					
				},
				messages: {
				   IC_no: "Please enter a valid IC no."
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
					}					
				},
				messages: {
				   IC_no: "Please enter a valid IC no."
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