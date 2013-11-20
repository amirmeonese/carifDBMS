Integration steps for dynamic dropdown

1) Insert the code inside the form (e.g. add_personal_record_details.php).Make sure to define the ID. This ID will be used in other pages as an identifier.
Example:<?php echo form_dropdown('marital_status', $marital_status_lists, NULL, 'id="marital_status"'); ?>

2) Insert the dropdown list items in data.json. Use the ID defined in step#1 ad the key item.
Example:"marital_status":"Single,Married"

3)Add the ID inside the switch-case in process.php
Example:case 'marital_status':
		$data['marital_status'] = $text;
		break;

4) Add the ID handler inside dropdown_lists.js. The handler needs to be added in several places in this file. Just add where you see other ID.

5) Change the dropdown definition in record_model.php to 'Dynamic Dropdown'. (If necessary)

