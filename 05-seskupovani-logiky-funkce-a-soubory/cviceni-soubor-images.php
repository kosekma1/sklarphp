<?php

// 2. cvičení
$addr_images = "/images/";
function image_html3($file_name, $alt='',$height='', $width=''){
	$url = '.'.$GLOBALS['addr_images'].$file_name;
	return '<img src="'.$url.'" alt="'.$alt.'" height="'.$height.'" width="'.$width.'" />';
}

?>
