<?php
include "Functies.php"; //pagina include
include __DIR__ . "/header.php";
$cart = getCart($databaseConnection); //Hiermee krijg je de huidige carsessie in de array
$id = $_GET['idprod']; //Pakt de id van het product die verwijderd word van de winkelwagen, dat doet die met een GET
$StockItem = getStockItem($id, $databaseConnection); //Met het id van hier boven pakken wij alle gegevens van het product met de standaard fucntie get stock item. (deze functie zat al ik nerdygadgets)
 ?>
<center>
<h1>Are you sure you want to remove <?php print $StockItem['StockItemName']; ?> from your cart?</h1>
<form>
    <input type="submit" name="annuleren" value="Cancel" class="button2" style="background-color: red">
    <input type="submit" name="doorgaan" value="Continue" class="button2">
    <input type="hidden" name="idprod" value="<?php print($id); ?>">
</form>
</center>
<?php
if(isset($_GET["doorgaan"])) {//Als je op de knop doorgaan klikt dan doet die deze if.
    unset($cart[$id]);                   //Met de functie unset verwijderen wij iets van een array. Wat wij hier verwijderen is de id van het product die wij willen verwijderen
    saveCart($cart,$databaseConnection);  //Hiermee slaan wij de verandering op.
    header("Location:Cart.php");  //Met de header kunnen wij weer terug gaan naar de winkelmand pagina.
}
if(isset($_GET["annuleren"])) { //Als je op de knop annuleren klikt dan voert die dit onder uit.
    header("Location:Cart.php"); //Met de header kunnen wij weer terug gaan naar de winkelmand pagina.
}
