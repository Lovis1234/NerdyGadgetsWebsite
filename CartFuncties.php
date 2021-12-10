    <?php // altijd hiermee starten als je gebruik wilt maken van sessiegegevens
    function getVerzend($databaseConnection)
    {
        $Query = "
    SELECT max(OrderID)
    FROM orderlines ";
        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_execute($Statement);
        $orderid = mysqli_stmt_get_result($Statement);
        return $orderid;
    }
function getCart($databaseConnection){

//    $sql = "SELECT winkelmand FROM login";
//    $Statement = mysqli_prepare($databaseConnection, $sql);
//    mysqli_stmt_execute($Statement);
//    $cartserialized = mysqli_stmt_get_result($Statement);
//    $cart = unserialize($cartserialized);
//    return $cart;
    if(isset($_SESSION['cart'])){               //controleren of winkelmandje (=cart) al bestaat
        $cart = $_SESSION['cart'];                  //zo ja:  ophalen
    } else{
        $cart = array();                            //zo nee: dan een nieuwe (nog lege) array
    }                            // resulterend winkelmandje terug naar aanroeper functie
return $cart;
    }


function saveCart($cart,$databaseConnection){
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $email = $_SESSION["email"];
        $cartserialised = serialize($cart);
        $sql = "UPDATE users SET winkelmand='$cartserialised' WHERE email='$email'";
        $Statement = mysqli_prepare($databaseConnection, $sql);
        mysqli_stmt_execute($Statement);
        $_SESSION["cart"] = $cart;
        } else {
                $_SESSION["cart"] = $cart;                  // werk de "gedeelde" $_SESSION["cart"] bij met de meegestuurde gegevens
        }
                     // werk de "gedeelde" $_SESSION["cart"] bij met de meegestuurde gegevens
}

function addProductToCart($stockItemID,$databaseConnection){
    $cart = getCart($databaseConnection);                          // eerst de huidige cart ophalen

    if(array_key_exists($stockItemID, $cart)){  //controleren of $stockItemID(=key!) al in array staat
        $cart[$stockItemID] += 1;                   //zo ja:  aantal met 1 verhogen
    }else{
        $cart[$stockItemID] = 1;                    //zo nee: key toevoegen en aantal op 1 zetten.
    }

    saveCart($cart,$databaseConnection);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

    function getCountries($databaseConnection)
    {
        $Query = "
                SELECT *
                FROM countries ";
        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_execute($Statement);
        $countries = mysqli_stmt_get_result($Statement);
        return $countries;
    }
    function getBetaal($databaseConnection)
    {
        $Query = "
                SELECT *
                FROM paymentmethods ";
        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_execute($Statement);
        $countries = mysqli_stmt_get_result($Statement);
        return $countries;
    }
    function getMail($databaseConnection, $mail)
    {
        $Query = "
                SELECT *
                FROM users WHERE email = ?";

        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_bind_param($Statement, "s", $param_email);
        $param_email = $mail;
        mysqli_stmt_execute($Statement);
        $countries = mysqli_stmt_get_result($Statement);
        return $countries;
    }
//function removeProductFromCart($stockItemID){
//    $cart = getCart($databaseConnection);                          // eerst de huidige cart ophalen
//
//    if(array_key_exists($stockItemID, $cart)){  //controleren of $stockItemID(=key!) al in array staat
//        unset($cart[$stockItemID]);                   //zo ja:  aantal met 1 verhogen
//    }
//
//    saveCart($cart,$databaseConnection);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
//    print_r($cart);
//}
