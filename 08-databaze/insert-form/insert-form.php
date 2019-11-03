<form method="POST" action="<?= $form->encode($_SERVER['PHP_SELF']) ?>">
<table>
 <?php if($errors) { ?>
   <tr>
     <td>Zou need to correct the following errors:</td>
	 <td>
	   <ul>
		   <?php foreach($errors as $error) { ?>
		   <li><?= $form->encode($error) ?></li>
		   <?php } ?>
	   </ul>
	</td>
 <?php } ?>
    <tr>
		<td>Dish name:</td>
		<td><?= $form->input('text',['name' => 'dish_name']) ?></td>
	</tr>
	<tr>
		<td>Price:</td>
		<td><?= $form->input('text',['name' => 'price']) ?></td>
	</tr>
	<tr>
		<td>Spicy:</td>
		<td><?= $form->input('checkbox',['name' => 'is_spicy', 'value' => 'yes']) ?>Yes</td>
	</tr>
	<tr>
		<td colspan2 align="center"</td>
		<td><?= $form->input('submit',['name' => 'save','value' => 'Order']) ?></td>
	</tr>
	
 </table>
 </form>
	 
 