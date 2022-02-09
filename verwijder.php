<?php
include "Functies.php"; //pagina include
include __DIR__ . "/header.php";
$cart = getCart($databaseConnection);
$id = $_GET['idprod'];
$StockItem = getStockItem($id, $databaseConnection);
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
if(isset($_GET["doorgaan"])) {
    unset($cart[$id]);
    saveCart($cart,$databaseConnection);
    header("Location:Cart.php");
}
if(isset($_GET["annuleren"])) {
    header("Location:Cart.php");
}
