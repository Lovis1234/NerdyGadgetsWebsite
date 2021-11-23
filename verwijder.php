<?php
include "CartFuncties.php";
$cart = getCart();                          // eerst de huidige cart ophalen

if(array_key_exists(1, $cart)){  //controleren of $stockItemID(=key!) al in array staat
    unset($cart[$stockItemID]);                   //zo ja:  aantal met 1 verhogen
}

saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
print_r($cart);