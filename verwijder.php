<?php
include "Functies.php";
include __DIR__ . "/header.php";
//$cart = array(1 => 1);
$cart = getCart($databaseConnection);
$id = $_GET['idprod'];
$StockItem = getStockItem($id, $databaseConnection);
//print_r($cart); ?>
<center>
<h1>Are you sure you want to remove <?php print $StockItem['StockItemName']; ?> from your cart?</h1>
<form>
    <input type="submit" name="annuleren" value="Cancel" class="button2" style="background-color: red">
    <input type="submit" name="doorgaan" value="Continue" class="button2">
    <input type="hidden" name="idprod" value="<?php print($id); ?>">
</form>
</center>
<?php
if(isset($_GET["doorgaan"])) {//controleren of $stockItemID(=key!) al in array staat
    unset($cart[$id]);                   //zo ja:  aantal met 1 verhogen
    saveCart($cart,$databaseConnection);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
    print_r($cart);
    header("Location:Cart.php");
}
if(isset($_GET["annuleren"])) {//controleren of $stockItemID(=key!) al in array staat
    header("Location:Cart.php");
}
