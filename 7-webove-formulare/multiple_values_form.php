<?php
//7-4,7-5 - Elementy formuláře obsahující více hodnot, přístup k více hodnotám
?>
<!DOCTYPE html>
<html>
<body>
<form method="post" action="multiple_values_form.php">
<select name="lunch[]" multiple>
<option value="pork">BBQ Pork Bun</option>
Accessing Form Parameters | 125
<option value="chicken">Chicken Bun</option>
<option value="lotus">Lotus Seed Bun</option>
<option value="bean">Bean Paste Bun</option>
<option value="nest">Bird/Nest Bun</option>
</select>
<input type="submit" value="Submit">

<p>Selected Buns:<br>
<?php
  if(isset($_POST['lunch'])){
	  foreach($_POST['lunch'] as $lunch){
		  print "You want a $lunch bun"."<br>";
	  }
  }
?>

</p>
</form>
</body>



