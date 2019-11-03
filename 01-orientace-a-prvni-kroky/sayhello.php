<?php

if(isset($_POST['user'])){
	print("Hello ");
	print $_POST['user'];
	print "!";
} else {
	print("You did not enter any name. Try it again.");
}

?>
