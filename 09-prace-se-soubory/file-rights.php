<?php

//9-14 - Kontrola existence souboru
if(file_exists("./cteni-a-zapis/page-to-file.php")){
	print "page.php is there";
} else {
	print "No page-to-file.php file in /cteni-a-zapis/";
}

//9-15 - otestování oprávnění číst
$template_file = './cteni-a-zapis/page-template.html';
if(is_readable($template_file)){
	$template = file_get_contents($template_file);
	print $template;
} else {
	print "Can't reade template file.";
}

//9-16 - Otestování oprávnění zapisovat
$_SESSION['name'] = 'Muj user';
$log_file = 'users.log';
if(is_writable($log_file)){
	$fh = fopen($log_file,'ab');
	fwrite($fh,$_SESSION['name'].' at '.strftime('%c')."\n");
	fclose($fh);	
} else {
	print "Can't write to log file.";
}
?>