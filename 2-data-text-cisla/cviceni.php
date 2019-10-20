<?php
//cvičení
print '<h3>Cvičení 2</h3>';
$hamburger = 4.95;
$koktejl = 1.95;
$kola = 0.85;

$dan_sazba = 7.5;
$spropitne_sazba = 16; //pred zdanenim

$cena = 2*$hamburger + $koktejl + $kola;
$spropitne = $spropitne_sazba/100*$cena;
$cena_s_dani = $cena*(1+$dan_sazba/100);
$cena_celkem = $cena_s_dani + $spropitne;

print "Celková cena je $$cena_celkem<br />";

print '<h3>Cvičení 3</h3>';
//využívám předchozí výpočty
print("<pre>");
printf("%d %-9s at \$%.2f each: \$%5.2f\n", 2, 'Hamburger', $hamburger, 2*$hamburger);
printf("%d %-9s at \$%.2f each: \$%5.2f\n", 1, 'Koktejl', $koktejl, $koktejl);
printf("%d %-9s at \$%.2f each: \$%5.2f\n", 1, 'Kola', $kola, 2*$kola);

printf("%25s: \$%5.2f\n", "Cena celkem",$cena+$spropitne);
printf("%25s: \$%5.2f\n","Cena a daň celkem", $cena_s_dani);
printf("%25s: \$%5.2f\n","Cena, daň, spropitné celkem", $cena_celkem);
print("</pre>");

print '<h3>Cvičení 4</h3>';
$first_name = 'Martin';
$second_name = 'Kosek';
$full_name = $first_name." ".$second_name;
print($full_name.'<br />');
print(strlen($full_name));

print '<h3>Cvičení 5</h3>';
$number = 1;
$mocnina = 2;
print("<pre>");
printf("%d %5d\n", $number, $mocnina);
printf("%d %5d\n", ++$number, $mocnina*=2);
printf("%d %5d\n", ++$number, $mocnina*=2);
printf("%d %5d\n", ++$number, $mocnina*=2);
printf("%d %5d\n", ++$number, $mocnina*=2);
print("</pre>");

?>