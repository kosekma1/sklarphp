<form method="POST" action="<?= $form->encode($_SERVER['PHP_SELF']) ?>">
<table>
 <?php if($errors) { ?>
   <tr>
     <td>You need to correct the following errors:</td>
	 <td>
	   <ul>
		   <?php foreach($errors as $error) { ?>
		   <li><?= $form->encode($error) ?></li>
		   <?php } ?>
	   </ul>
	</td>
 <?php } ?>
    <tr>				
		<tr>
		  <td>Důvod zřízení účtu:</td>
		  <td><?= $form->input('checkbox',['name' => 'reason[]', 'value' => 'PAYMENTS']) ?>Soukromé platby</td>
		  <td><?= $form->input('checkbox',['name' => 'reason[]', 'value' => 'SAVINGS']) ?>Úspory</td>
		  <td><?= $form->input('checkbox',['name' => 'reason[]', 'value' => 'INVESTMENTS']) ?>Investice</td>
		  <td><?= $form->input('checkbox',['name' => 'reason[]', 'value' => 'OTHER']) ?>Jiné
		      <?= $form->input('text',['name' => 'other-text', 'value' => 'Prosím upřesněte']) ?>
		  </td>
		</tr>
		
		<tr>
		  <td>Původ peněz:</td>		  
		  <td>Tímto potvrzuji, že původ mých finančních prostředků je legální a zdroj jejich nabytí je: <?= $form->select($GLOBALS['money_origin'],['name' => 'money_origin']) ?></td></td>		  
		</tr>
		<tr>
		  <td>Zaměstnání</td>		  
		  <td><?= $form->select($GLOBALS['employment'],['name' => 'employment']) ?></td></td>		  
		</tr>
		<tr>
		  <td>Předpokládaný objem transakcí (měsíční součet plateb vyjádřený jako korunový ekvivalent v EUR)</td>		  
		  <td><?= $form->select($GLOBALS['aml_volume'],['name' => 'aml_volume']) ?></td></td>		  
		</tr>
		
		<tr>
		  <td>Skutečný vlastník finančních prostředků na účtu</td>
		  <td><?= $form->input('checkbox',['name' => 'aml_owner', 'value' => 'real_owner']) ?>Jsem skutečný vlastník finančních prostředků na účtu</td>
		  <td><?= $form->input('checkbox',['name' => 'politicaly_exposed', 'value' => 'politicaly_exposed']) ?>Jsem politicky exponovaná osoba (<a href="https://www.expobank.cz/politicky-exponovana-osoba?_ga=2.141974706.1810085846.1573154382-159641321.1572629207" target="_blank">PEP</p></td>		  		  
		</tr>
		
		<tr>
		  <td>Prohlášení o daňové rezidenci</td>		  
		  <td><?= $form->select($GLOBALS['countries'],['name' => 'country']) ?></td></td>		  
		  <td>DIČ</td>		  
		  <td><?= $form->input('text', ['name' => 'dic']) ?></td></td>		  
		</tr>
						
	<tr>
		<td colspan2 align="center"</td>
		<td><?= $form->input('submit',['name' => 'save','value' => 'Uložit']) ?></td>
	</tr>
	
 </table>
 </form>
	 
 