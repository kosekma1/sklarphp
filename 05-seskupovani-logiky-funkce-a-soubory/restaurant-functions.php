<?php

function restaurant_check3($meal, $tax, $tip): float{ //návratový typ float - desetinné číslo
	$tax_amount = $meal*($tax/100);
	$tip_amount = $meal*($tip/100);
	$total_amount = $meal + $tax_amount + $tip_amount;
	
	return $total_amount;
}

function payment_method1($cash_on_hand, $amount){
	if($amount > $cash_on_hand){
		return 'credit card';
	} else {
		return 'cash';
	}
}

?>