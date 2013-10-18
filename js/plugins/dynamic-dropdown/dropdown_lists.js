$( document ).ready(function() {
	if (!window.location.origin)
		window.location.origin = window.location.protocol+"//"+window.location.host;
   
	$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
	{	
		//var key = $dropdown.val();
		var vals = [];
							
		// switch(key) {
			// case 'beverages':
				// vals = data.beverages.split(",");
				// break;
			// case 'snacks':
				// vals = data.snacks.split(",");
				// break;
			// case 'base':
				// vals = ['Please choose from above'];
		// }
		
		vals = data.nationalities.split(",");
		var $secondChoice = $("#nationality");
		$secondChoice.empty();
		$.each(vals, function(index, value) {
			$secondChoice.append("<option>" + value + "</option>");
		});
		
		vals = data.gender.split(",");
		$secondChoice = $("#gender");
		$secondChoice.empty();
		$.each(vals, function(index, value) {
			$secondChoice.append("<option>" + value + "</option>");
		});
	});
	
	//== EDIT DROPDOWN LISTS==//
	$( ".dialog-form" ).dialog({
      autoOpen: false,
      height: 200,
      width: 350,
      modal: true,
      buttons: {
        "Save changes": function() {
			var passedID = $(this).data('id');
			var selectedValue = $('#' + passedID).val();
			var newItemName = rename_item_name.value;
			
			$.getJSON(window.location.origin + "/carifDBMS/js/plugins/dynamic-dropdown/data.json", function(data) 
			{	
				var vals = [];
				
				switch(passedID) {
					case 'nationality':
					{
						vals = data.nationalities.split(",");
						
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
							 data: {action: 'rename',id:passedID, text: appendedText},
							 type: 'post',
							 success: function(output) {
								alert('Changes saved!');
								//Redraw dropdown
								var $secondChoice = $("#nationality");
								$secondChoice.empty();
								$.each(vals, function(index, value) {
									$secondChoice.append("<option>" + value + "</option>");
								});
						
							  }
						});
						break;
					}
					case 'gender':
					{
						vals = data.gender.split(",");
						
						$.each(vals, function(index, value) {
							if(value == selectedValue)
								vals[index] = newItemName;
						});
						
						var appendedText = '';
						$.each(vals, function(index, value) {
						
							appendedText = appendedText + value + ',';
						});
						
						$.ajax({ url: window.location.origin + '/carifDBMS/js/plugins/dynamic-dropdown/process.php',
							 data: {action: 'rename',id:passedID, text: appendedText},
							 type: 'post',
							 success: function(output) {
								 alert('Changes saved!');
								 //Redraw dropdown
								var $secondChoice = $("#gender");
								$secondChoice.empty();
								$.each(vals, function(index, value) {
									$secondChoice.append("<option>" + value + "</option>");
								});
							  }
						});
						break;
					}
				}
				
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
		var buttonID = this.id;
		var selectedValue = $('#' + buttonID).val();
		$("#rename_item_name").val(selectedValue);
		$( ".dialog-form" ).data('id', buttonID).dialog( "open" );
	});

	$( ".add-new" ).button().click(function() {
		$( ".dialog-form-add-new" ).dialog( "open" );
	});
	
	$( ".delete" ).button().click(function() {
		var buttonID = this.id;
		var selectedValue = $('#' + buttonID).val();
	});
});