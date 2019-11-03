<?php

//4. cvičení

$us_state_abbrevs_names = array(
	'AL'=>'ALABAMA',
	'AK'=>'ALASKA',
	'AS'=>'AMERICAN SAMOA',
	'AZ'=>'ARIZONA',
	'AR'=>'ARKANSAS',
	'CA'=>'CALIFORNIA',
	'CO'=>'COLORADO',
	'CT'=>'CONNECTICUT',
	'DE'=>'DELAWARE',
	'DC'=>'DISTRICT OF COLUMBIA',
	'FM'=>'FEDERATED STATES OF MICRONESIA',
	'FL'=>'FLORIDA',
	'GA'=>'GEORGIA',
	'GU'=>'GUAM GU',
	'HI'=>'HAWAII',
	'ID'=>'IDAHO',
	'IL'=>'ILLINOIS',
	'IN'=>'INDIANA',
	'IA'=>'IOWA',
	'KS'=>'KANSAS',
	'KY'=>'KENTUCKY',
	'LA'=>'LOUISIANA',
	'ME'=>'MAINE',
	'MH'=>'MARSHALL ISLANDS',
	'MD'=>'MARYLAND',
	'MA'=>'MASSACHUSETTS',
	'MI'=>'MICHIGAN',
	'MN'=>'MINNESOTA',
	'MS'=>'MISSISSIPPI',
	'MO'=>'MISSOURI',
	'MT'=>'MONTANA',
	'NE'=>'NEBRASKA',
	'NV'=>'NEVADA',
	'NH'=>'NEW HAMPSHIRE',
	'NJ'=>'NEW JERSEY',
	'NM'=>'NEW MEXICO',
	'NY'=>'NEW YORK',
	'NC'=>'NORTH CAROLINA',
	'ND'=>'NORTH DAKOTA',
	'MP'=>'NORTHERN MARIANA ISLANDS',
	'OH'=>'OHIO',
	'OK'=>'OKLAHOMA',
	'OR'=>'OREGON',
	'PW'=>'PALAU',
	'PA'=>'PENNSYLVANIA',
	'PR'=>'PUERTO RICO',
	'RI'=>'RHODE ISLAND',
	'SC'=>'SOUTH CAROLINA',
	'SD'=>'SOUTH DAKOTA',
	'TN'=>'TENNESSEE',
	'TX'=>'TEXAS',
	'UT'=>'UTAH',
	'VT'=>'VERMONT',
	'VI'=>'VIRGIN ISLANDS',
	'VA'=>'VIRGINIA',
	'WA'=>'WASHINGTON',
	'WV'=>'WEST VIRGINIA',
	'WI'=>'WISCONSIN',
	'WY'=>'WYOMING',
	'AE'=>'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST',
	'AA'=>'ARMED FORCES AMERICA (EXCEPT CANADA)',
	'AP'=>'ARMED FORCES PACIFIC'
);

function generate_states_option($name){
	print "<select name=\"$name\">";
	foreach ($GLOBALS['us_state_abbrevs_names'] as $shortcut=>$state){
		print "<option value=\"$shortcut\">$state</option>";
	}
	print "</select>";
}

function show_form($errors = null){
	if($errors){
		print "<ul><li>";
		print implode("</li><li>", $errors);
		print "</li><ul>";	
	} else {
	print <<<_HTML_
<form method="POST" action="{$_SERVER['PHP_SELF']}">
<table>
<tr><td>Sender name</td><td><input type="text" size="10" name="address_sender_name"></td></tr>
<tr><td>Street </td><td><input type="text" size="10" name="address_sender_street"></tr>
<tr><td>City </td><td><input type="text" size="10" name="address_sender_city"></tr>
_HTML_;
print "<tr><td>State</td><td>";
generate_states_option("address_sender_state");
print "</td></tr>";
print<<<_HTML_
<tr><td>ZIP </td><td><input type="text" size="10" name="address_sender_zip"></tr>
<tr><td colspan="2"><td><tr>
<tr><td>Receiver name</td><td><input type="text" size="10" name="address_receiver_name"></td></tr>
<tr><td>Street </td><td><input type="text" size="10" name="address_receiver_street"></tr>
<tr><td>City </td><td><input type="text" size="10" name="address_receiver_city"></tr>
_HTML_;

print "<tr><td>State</td><td>";
generate_states_option("address_receiver_state");
print "</td></tr>";
print<<<_HTML_
<tr><td>ZIP </td><td><input type="text" size="10" name="address_receiver_zip"></tr>
<tr><td colspan="2">    <td><tr>
<tr><td>Width</td><td><input type="text" size="10" name="width"></td></tr>
<tr><td>Height</td><td><input type="text" size="10" name="height"></td></tr>
<tr><td>Depth </td><td><input type="text" size="10" name="depth"></td></tr>
<tr><td>Weight </td><td><input type="text" size="10" name="weight"</td><tr>
</table>
<input type="submit" name="count" value="Send">
</form>		
_HTML_;
}
}

function validate_form(){
	    $errors = array();	
				
		$input['address_sender_name'] = $_POST['address_sender_name'] ?? '';		
		if(!strlen($input['address_sender_name'])>0){
			$errors[] = 'You must enter name of sender';
		}
		
		$input['address_sender_street'] = $_POST['address_sender_street'] ?? '';
		if(!strlen($input['address_sender_street'])>0){
			$errors[] = 'You must enter sender street';
		}
		
		$input['address_sender_city'] = $_POST['address_sender_city'] ?? '';
		if(!strlen($input['address_sender_city'])>0){
			$errors[] = 'You must enter sender city';
		}
		
		$input['address_sender_zip'] = filter_input(INPUT_POST,'address_sender_zip', FILTER_VALIDATE_FLOAT);			
		if(is_null($input['address_sender_zip']) || ($input['address_sender_zip']===false) || (strlen((string)$input['address_sender_zip'])!=5)){
			$errors[] = 'You must enter number for zip with 5 digits.';
		}
		
		$input['address_sender_state'] = trim($_POST['address_sender_state']) ?? '';		
		if(!array_key_exists($input['address_sender_state'], $GLOBALS['us_state_abbrevs_names'])){
			$errors[] = 'You must enter valid US state.';
		}
		
		$input['address_receiver_name'] = $_POST['address_receiver_name'] ?? '';		
		if(!strlen($input['address_receiver_name'])>0){
			$errors[] = 'You must enter name of receiver';
		}
		
		$input['address_receiver_street'] = $_POST['address_receiver_street'] ?? '';
		if(!strlen($input['address_receiver_street'])>0){
			$errors[] = 'You must enter receiver street';
		}
		
		$input['address_receiver_city'] = $_POST['address_receiver_city'] ?? '';
		if(!strlen($input['address_receiver_city'])>0){
			$errors[] = 'You must enter receiver city';
		}
		
		$input['address_receiver_zip'] = filter_input(INPUT_POST,'address_receiver_zip', FILTER_VALIDATE_FLOAT);			
		if(is_null($input['address_receiver_zip']) || ($input['address_receiver_zip']===false) || (strlen((string)$input['address_receiver_zip'])!=5)){
			$errors[] = 'You must enter number for zip with 5 digits.';
		}
		
		$input['address_receiver_state'] = trim($_POST['address_receiver_state']) ?? '';		
		if(!array_key_exists($input['address_receiver_state'], $GLOBALS['us_state_abbrevs_names'])){
			$errors[] = 'You must enter valid US state.';
		}
		
		
		$input['width'] = filter_input(INPUT_POST,'width', FILTER_VALIDATE_FLOAT);
		$input['height'] = filter_input(INPUT_POST,'height', FILTER_VALIDATE_FLOAT);
		$input['depth'] = filter_input(INPUT_POST,'depth', FILTER_VALIDATE_FLOAT);			
		$input['weight'] = filter_input(INPUT_POST,'weight', FILTER_VALIDATE_FLOAT);
				
		if(is_null($input['width']) || ($input['width']===false) || ($input['width']<=0 && $input['height']>91.5)){
			$errors[] = 'You must enter number for width greater than 0 and less than 91.5 cm.';
		}
		
		if(is_null($input['height']) || ($input['height']===false) || ($input['height']<=0 && $input['height']>91.5)){
			$errors[] = 'You must enter number for height greater than 0 and less than 91.5 cm.';
		}
				
		if(is_null($input['depth']) || ($input['depth']===false) || ($input['depth']<=0 && $input['height']>91.5)){
			$errors[] = 'You must enter number for depth greater than 0 and less than 91.5 cm.';
		}   
		
		if(is_null($input['weight']) || ($input['weight']===false) || ($input['weight']<=0 && $input['weight']>68.2)){
			$errors[] = 'You must enter number for weight greater than 0 and less than 68.2 kg';
		}   
		
		return array($errors, $input);
}

function process_form($input){
	printf("<strong>Sender:</strong> %s, %s, %s, %s, %s",  $input['address_sender_name'], $input['address_sender_street'], $input['address_sender_city'], $input['address_sender_zip'], $GLOBALS['us_state_abbrevs_names'][$input['address_sender_state']] );
	print "<br>";
	printf("<strong>Receiver:</strong> %s, %s, %s, %s, %s",  $input['address_receiver_name'], $input['address_receiver_street'], $input['address_receiver_city'], $input['address_receiver_zip'], $GLOBALS['us_state_abbrevs_names'][$input['address_receiver_state']]);
	print "<br>";
	printf("<strong>Package:</strong> width %0.2f cm, height %0.2f cm, depth %0.2f cm and weight %0.2f kg", $input['width'], $input['height'], $input['depth'], $input['weight']);
}

function parcel(){
	$errors = array();
	$input = array();
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		list($errors, $input) = validate_form();	
		if($errors){
		   show_form($errors);
		} else {
		   process_form($input);
		}					
	} else {
	   show_form();		
	}	
}

print "<h1>Cvičení 4</h1>";
parcel();


?>