<?php
session_start();
$_SESSION['naam'] = "Alex";
//$leeftijd = 42;
//$cart = array();            // tijdelijke variabele op de huidige pagina
//$cart[$stockItemID] = 1;
//$cart[105932] = 7;	     // puur als voorbeeld: 2e artikel in de lijst
//$_SESSION['cart'] = $cart;  // sessievariabele neemt de huidige cart op
$naam = $_SESSION['naam'];
print("<p>Hallo " . $naam . "</p>");
?>
<a href="pagina2.php">Ga naar pagina 2</a>