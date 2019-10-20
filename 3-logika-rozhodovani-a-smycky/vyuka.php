<?php

//hodnoty 0, 0.0, "", "0", null a false jsou vždy false ostatní jsou vždy true v PHP 

//3-1
$logged_in = true;
if($logged_in){
	print "Welcome aboard, trusted user.<br /><br />";
}

//3-2 if
print "This is always printed.<br />";
if($logged_in){
	print "Welcome aboard, trusted user.<br />";
	print 'This is only printed if $logged_ in is true.<br />';
}

print "This is always printed.<br /><br />";

//3-3 if, else
$logged_in = false;
if($logged_in){
	print "Welcome aboard, trusted user.<br />";
} else {
	print "Howdy, stranger<br /><br />";
}

//3-4 - elseif
$emergency = true;
$new_message = false;
$logged_in = false;

if($logged_in){
	print "Welcome aboard, trusted user.<br />";
} elseif($new_message){
	print "Dear stranger there is a new message.";
} elseif($emergency) {
	print "Dear stranger there are no new messages, but there is an emergency.";
}

//3-5 - else if not true in any case - default
$emergency = false;
$new_message = false;
$logged_in = false;
print "<br /><br />";
if($logged_in){
	print "Welcome aboard, trusted user.<br />";
} elseif($new_message){
	print "Dear stranger there is a new message.";
} elseif($emergency) {
	print "Dear stranger there are no new messages, but there is an emergency.";
} else {
	print "I do not know, you have no messages, and there's no emergency.";
}

//Sestavování složitých rozhodnutí
$new_messages = 10;
print "<br /><br />";
if($new_messages == 10){
	print "You have ten new messages.";
}

print "<br /><br />";
$max_messages = 10;
if($new_messages == $max_messages){
	print "You have the maximu number of messages.";
}

print "<br /><br />";
$dinner = 'Braised Scallops';
if($dinner == 'Braised Scallops'){
	print "Yum! I love seafood.";
}

