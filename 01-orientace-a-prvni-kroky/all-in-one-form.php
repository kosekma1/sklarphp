<?php

if(isset($_POST['user'])){
	print("Hello ");
	print $_POST['user'];
	print "!";
} else {
print <<<_HTML_
	<form action="$_SERVER[PHP_SELF]" method="post">
     Your name <input name="user" type="text">
     <button type="submit">Say hello</button>
     </form>
_HTML_;
}

?>