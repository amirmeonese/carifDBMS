$( document ).ready(function() {
	
	if (!window.location.origin)
		window.location.origin = window.location.protocol+"//"+window.location.host;
   
   // =================================================== //
   // ================ FORMS SETUP ====================== //
   // == FIlls in dropdowns with values from json file == //
   // =================================================== //
	$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
	{	
		var vals = [];
		
		$.each(data, function(key, value){
			
			vals = value.split(",");
			var $secondChoice = $("#" + key);
			$secondChoice.empty();
			$.each(vals, function(index, value) {
				$secondChoice.append("<option>" + value + "</option>");
			});
		});
	});
	
	// ======================== //
	//== ADMIN PANEL SETUPS ==//
	// ======================== //
	$("#first-choice").change(function() {
		var $dropdown = $(this);
		var key = $dropdown.val();
		
		$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) {

			var vals = [];
								
			switch(key) {
				case 'nationality':
					vals = data.nationality.split(",");
					break;
				case 'gender':
					vals = data.gender.split(",");
					break;
				case 'marital_status':
					vals = data.marital_status.split(",");
					break;
				case 'COGS_study_id':
					vals = data.COGS_study_id.split(",");
					break;
				case 'income_level':
					vals = data.income_level.split(",");
					break;
				case 'status_source':
					vals = data.status_source.split(",");
					break;
				case 'alive_status':
					vals = data.alive_status.split(",");
					break;
				case 'studies_name':
					vals = data.studies_name.split(",");
					break;
				case 'base':
					vals = ['Please choose from above'];
			}
			
			var $secondChoice = $("#second-choice");
			$secondChoice.empty();
			$.each(vals, function(index, value) {
				$secondChoice.append("<option>" + value + "</option>");
			});

		});
	});
   
	$( ".dialog-form" ).dialog({
      autoOpen: false,
      height: 200,
      width: 350,
      modal: true,
      buttons: {
        "Save changes": function() {
			var passedID = $(this).data('id');
			var selectedValue = $('#second-choice').val();
			var newItemName = rename_item_name.value;
			
			$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
			{	
				var vals = [];
				
				switch(passedID) {
					case 'nationality':
						vals = data.nationality.split(",");
						break;
					case 'gender':
						vals = data.gender.split(",");
						break;
					case 'marital_status':
						vals = data.marital_status.split(",");
						break;
					case 'COGS_study_id':
						vals = data.COGS_study_id.split(",");
						break;
					case 'income_level':
						vals = data.income_level.split(",");
						break;
					case 'status_source':
						vals = data.status_source.split(",");
						break;
					case 'alive_status':
						vals = data.alive_status.split(",");
						break;
					case 'studies_name':
						vals = data.studies_name.split(",");
						break;
				}
				
				$.each(vals, function(index, value) {
					if(value == selectedValue)
						vals[index] = newItemName;
				});
				
				var appendedText = '';
				$.each(vals, function(index, value) {
				
					appendedText = appendedText + value + ',';
				});
				
				//Call PHP to modify JSON file
				$.ajax({ url: window.location.origin + '/carifDBMS/js/plugins/dynamic-dropdown/process.php',
					 data: {action: 'dropdown',id:passedID, text: appendedText},
					 type: 'post',
					 success: function(output) {
						alert('Changes saved!');
						//Redraw dropdown
						var $secondChoice = $("#second-choice");
						$secondChoice.empty();
						$.each(vals, function(index, value) {
							$secondChoice.append("<option>" + value + "</option>");
						});
				
					  }
				});
				
			});

			$( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        
      }
    });
	
	$( ".dialog-form-add-new" ).dialog({
      autoOpen: false,
      height: 200,
      width: 350,
      modal: true,
      buttons: {
        "Save changes": function() {
			var passedID = $(this).data('id');
			var newItemName = add_item_name.value;
			
			$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
			{	
				var vals = [];
				
				switch(passedID) {
					case 'nationality':
						vals = data.nationality.split(",");
						break;
					case 'gender':
						vals = data.gender.split(",");
						break;
					case 'marital_status':
						vals = data.marital_status.split(",");
						break;
					case 'COGS_study_id':
						vals = data.COGS_study_id.split(",");
						break;
					case 'income_level':
						vals = data.income_level.split(",");
						break;
					case 'status_source':
						vals = data.status_source.split(",");
						break;
					case 'alive_status':
						vals = data.alive_status.split(",");
						break;
					case 'studies_name':
						vals = data.studies_name.split(",");
						break;
				}
				
				//Add item into end of array
				vals.push( newItemName );
				
				var appendedText = '';
				$.each(vals, function(index, value) {
				
					appendedText = appendedText + value + ',';
				});
				
				//Call PHP to modify JSON file
				$.ajax({ url: window.location.origin + '/carifDBMS/js/plugins/dynamic-dropdown/process.php',
					 data: {action: 'dropdown',id:passedID, text: appendedText},
					 type: 'post',
					 success: function(output) {
						alert('Changes saved!');
						//Redraw dropdown
						var $secondChoice = $("#second-choice");
						$secondChoice.empty();
						$.each(vals, function(index, value) {
							$secondChoice.append("<option>" + value + "</option>");
						});
				
					  }
				});
				
			});
			
			$( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
       
      }
    });

	$( ".rename" ).button().click(function() {
		
		var selectedID = $('#first-choice').val();
		var selectedValue = $('#second-choice').val();
		
		if(selectedValue == '')
			alert('Please select item to be renamed.');
		else
		{
			$("#rename_item_name").val(selectedValue);
			$( ".dialog-form" ).data('id', selectedID).dialog( "open" );
		}
	});

	$( ".add-new" ).button().click(function() {
		var selectedID = $('#first-choice').val();
		$( ".dialog-form-add-new" ).data('id', selectedID).dialog( "open" );
	});
	
	$( ".delete" ).button().click(function() {
		var selectedID = $('#first-choice').val();
		var selectedValue = $('#second-choice').val();
		
		if(selectedValue == '')
			alert('Please select item to be deleted.');
		else
			deleteItem(selectedID, selectedValue);
	});
	
	function deleteItem(passedID, selectedValue)
	{
		$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
		{	
			var vals = [];
			
			switch(passedID) {
				case 'nationality':
					vals = data.nationality.split(",");
					break;
				case 'gender':
					vals = data.gender.split(",");
					break;
				case 'marital_status':
					vals = data.marital_status.split(",");
					break;
				case 'COGS_study_id':
					vals = data.COGS_study_id.split(",");
					break;
				case 'income_level':
					vals = data.income_level.split(",");
					break;
				case 'status_source':
					vals = data.status_source.split(",");
					break;
				case 'alive_status':
					vals = data.alive_status.split(",");
					break;
				case 'studies_name':
					vals = data.studies_name.split(",");
					break;
				case 'base':
					vals = ['Please choose from above'];
			}
			
			//Delete item
			$.each(vals, function(index, value) {
					if(value == selectedValue)
						vals.splice(index,1);
				});
			
			var appendedText = '';
			$.each(vals, function(index, value) {
			
				appendedText = appendedText + value + ',';
			});
			
			//Call PHP to modify JSON file
			$.ajax({ url: window.location.origin + '/carifDBMS/js/plugins/dynamic-dropdown/process.php',
				 data: {action: 'dropdown',id:passedID, text: appendedText},
				 type: 'post',
				 success: function(output) {
					alert('Changes saved!');
					//Redraw dropdown
					var $secondChoice = $("#second-choice");
					$secondChoice.empty();
					$.each(vals, function(index, value) {
						$secondChoice.append("<option>" + value + "</option>");
					});
			
				  }
			});
			
		});
	}
	
});