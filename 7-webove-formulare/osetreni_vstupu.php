<?php

//7-21 - odstranění HTML značek z řetězce
// odstraní HTML z komentářů
$_POST['comments'] = 'I <b>love</b> sweet<div class="fancy"> rice & tea.';
$comments = strip_tags($_POST['comments']);
// teď už můžete $comments v klidku vytisknout
print $comments."<br>";

//7-22 - Zakódování HTML entit v řetězci - znaky, které mají v HTML speciální význam (<, >, & a ") byly změněny na jejich ekvivalentní entity
$_POST['comments'] = 'I <b>love</b> sweet<div class="fancy"> rice & tea.';
$comments = htmlentities($_POST['comments']);
// teď už můžete $comments v klidku vytisknout
print $comments."<br>";

?>