<?php
//7-2,7-3 - formulář se dvěma parametry a vytištění paramerů odeslaného formuláře
?>
<!DOCTYPE html>
<html>
<body>
<form method="post" action="catalog_form.php">
<input type="text" name="product_id">
<select name="category">
<option value="ovenmitt">Pot Holder</option>
<option value="fryingpan">Frying Pan</option>
<option value="torch">Torch</option>
</select>
<input type="submit" value="Submit">

<p>Here are the submitted values:
product_id <?php print $_POST['product_id'] ?? ''; ?><br>
category: <?php print $_POST['category'] ?? ''; ?><br>
</p>
</form>
</body>



