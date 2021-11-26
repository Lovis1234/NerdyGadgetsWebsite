<?php
include "cartfuncties.php";
include __DIR__ . "/header.php";
//$cart = array(1 => 1);
$cart = getCart();
$id = $_GET['idprod'];
//print_r($cart); ?>
<center>
<h1>Je staat op het punt om een product uit de winkelwagen te verwijderen.</h1>
<form action="Cart.php">
        <input type="submit" name="annuleren" value="Annuleren">
</form>
<form>
        <input type="submit" name="doorgaan" value="Doorgaan">
    <input type="hidden" name="idprod" value="<?php print($id); ?>">
    </form>
</center>
<?php
if(isset($_GET["doorgaan"])) {//controleren of $stockItemID(=key!) al in array staat
    unset($cart[$id]);                   //zo ja:  aantal met 1 verhogen
    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
    print_r($cart);
    header("Location:Cart.php");
}
if(isset($_GET["annuleren"])) {//controleren of $stockItemID(=key!) al in array staat
    header("Location:Cart.php");
}