<?php

$page = file_get_contents('page-template.html');

$page = str_replace('{page_title}','Welcome',$page);

if(date('H') > 12){
	$page = str_replace('{color}','blue',$page);
} else {
	$page = str_replace('{color}','green',$page);
}

$_SESSION['username'] = "Martin v souboru";
$page = str_replace('{name}',$_SESSION['username'], $page);

file_put_contents('page.html', $page);
print "Page is saved to file page.html";

?>
