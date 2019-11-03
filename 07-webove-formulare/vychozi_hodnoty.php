<?php

//7-23 - sesstavení pole výchozích hodnot
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$default = $_POST;
} else {
	$defaults = array('delivery' => 'yes',
					  'size' => 'medium',
					  'main_dish' => array('taro','tripe'),
					  'sweet' => 'cake');					  
}

//7-24 - nastavení výchozí hodnoty do textového elementu
$defaults['my_name'] = "vychozi jmeno";
print '<input type="text" name="my_name" value="'.htmlentities($defaults['my_name']).'">';

//7-25 - nastavení výchozí hodnoty do víceřádkové textové oblasti
$defaults['comments'] = "vychozi komentar";
print '<textarea name="comments">';
print htmlentities($defaults['comments']);
print '</textarea>';

//7-26 - Nastavení výchozí hodnoty do menu <select>
//$defaults['sweet'] = 'cake';
$sweets = array('puff' => 'Sesame Seed Puff',
				'square' => 'Coconut Milk Gelatin Square',
				'cake' => 'Brown Sugar Cake',
				'ricemeat' => 'Sweet Rice and Meat');

print '<select name="sweet">';
foreach($sweets as $option=>$label){
	print '<option value="'.$option.'"';
	if($option == $defaults['sweet']){
		print ' selected';
	}
	print "> $label </option>\n";
}
print '</select>';

//7-27 - nastavení výchozích hodnot do menu <select>, z něhož lze vybrat více položek
$main_dishes = array('cuke' => 'Braised Sea Cucumber',
					 'stomach' => "Sauteed Pig's Stomach",
					 'tripe' => 'Sauteed Tripe with Wine Sauce',
					 'taro' => 'Stewed Pork with Taro',
					 'giblets' => 'Baked Giblets with Salt',
					 'abalone' => 'Abalone with Marrow and Duck Feet'
					);
					
print '<select name="main_dish[]" multiple>';
//$defaults['main_dish'] = array('cuke', 'tripe');
$selected_options = array();
foreach($defaults['main_dish'] as $option){	
	$selected_options[$option] = true;		
}

foreach($main_dishes as $option=>$label){
	print '<option value="'.htmlentities($option).'"';
	if(array_key_exists($option, $selected_options)){
		print ' selected';
	}
	print '>'.htmlentities($label).'</option>\n';
}
print '</select>';

//7-28 - nastavení výchozích hodnot pro zaškrtávací políčka a přepínače
print '<input type="checkbox" name="delivery" value="yes"';
if($defaults['delivery'] == 'yes' ) {print ' checked' ;}
print '> Delivery';

$checkbox_options = array('small' => 'Small',
				          'medium' => 'Medium',
						  'large' => 'Large',
						  );
foreach($checkbox_options as $value=>$label) {
	print '<input type="radio" name="size" value="'.$value.'"';
	if ($defaults['size'] == $value) { print ' checked';}
	print "> $label ";
}						  
						  
						 
?>