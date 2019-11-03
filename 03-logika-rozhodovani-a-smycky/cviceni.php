<?php

//cvičení 1
print "<h2>Cvičení 1</h2>";
if(100.00-100){
	print "true";
} else {
	print "false";
}

print "<br />";

if("zero"){
	print "true";
} else {
	print "false";
}

print "<br />";

if("false"){
	print "true";
} else {
	print "false";
}

print "<br />";

if(0+"true"){
	print "true";
} else {
	print "false";
}

print "<br />";

if(0.000){
	print "true";
} else {
	print "false";
}

print "<br />";

if("0.0"){
	print "true";
} else {
	print "false";
}

print "<br />";

if(strcmp("false","False")){
	print "true";
} else {
	print "false";
}

print "<br />";

if(0<=>0){  // 0=oba operandy jsou shodné; záporný, když je levý operand menší než pravý; kladný, když je pravý operand menší než levý
	print "true";
} else {
	print "false";
}

print "<br />";

//cvičení 2
print "<h2>Cvičení 2</h2>";
$age = 12;
$shoe_size = 13;
if($age > $shoe_size){
	print "Message 1";
} elseif(($shoe_size++) && ($age>20)){
	print "Message 2";
} else {
	print "Message 3";
}
print "<br />";
print "Age: $age. Shoe size: $shoe_size";

//cvičení 3
print "<h2>Cvičení 3</h2>";
$fahrenheit = -50;
print("<pre>");
while($fahrenheit<=50){
	$celsius = (($fahrenheit-32)*5)/9;
	printf("%10d F  %10.2f C\n", $fahrenheit, $celsius);
	$fahrenheit += 5;
}
print("</pre>");

//cvičení 4
print "<h2>Cvičení 4</h2>";
$fahrenheit = -50;
print("<pre>");
for($fahrenheit = -50; $fahrenheit<=50; $fahrenheit += 5){
	$celsius = (($fahrenheit-32)*5)/9;
	printf("%10d F  %10.2f C\n", $fahrenheit, $celsius);
}
print("</pre>");


?>