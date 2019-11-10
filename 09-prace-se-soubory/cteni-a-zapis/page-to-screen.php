<?php

$_SESSION['username'] = 'Martin';

$page = file_get_contents("page-template.html");

$page = str_replace('{page_title}', 'Welcome', $page);

//stranka bude modra odpoledne, zelena dopoledne
if(date('H') >= 12) {
	$page = str_replace('{color}', 'blue', $page);
} else {
    $page = str_replace('{color}', 'green', $page);
}

$page = str_replace('{name}', $_SESSION['username'], $page);

print $page;

?>