    <?php // altijd hiermee starten als je gebruik wilt maken van sessiegegevens
    function getWelkom($databaseConnection, $mail, $idpro)
    {
        $datauser = getMail($databaseConnection, $mail);
        foreach ($datauser as $info)
        {
            $arrayprod = unserialize($info['bekekenprod']);
            $arrayprod[2] = $arrayprod[1];
            $arrayprod[1] = $arrayprod[0];
            $arrayprod[0] = $idpro;

            $datprod = serialize($arrayprod);
            updateWelkom($databaseConnection,$idpro,$datprod,$info['email']);
        }
    }
    function updateProfile($databaseConnection, $vn,$an,$fn,$fs,$fh,$fp,$fpl,$bn,$bs,$bh,$bp,$bpl, $mail)
    {
        $Query = "
     UPDATE users SET voornaam=?, achternaam=?, 
    factuurnaam=?, factuurstraat=?, factuurhuisnummer=?, factuurpostcode=?, factuurplaats=?,
     bestelnaam=?, bestelstraat=?, bestelhuisnummer=?, bestelpostcode=?, bestelplaats=?
     WHERE email=?";
        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_bind_param($Statement, "sssssssssssss", $vn,$an,$fn,$fs,$fh,$fp,$fpl,$bn,$bs,$bh,$bp,$bpl,$mail);
        mysqli_stmt_execute($Statement);
        header("Location:profile.php");
    }
    function updateWelkom($databaseConnection, $productID,$uAR,$mail)
    {
        $Query = "
                UPDATE users SET bekekenprod = '".$uAR."' WHERE email = '".$mail."';";
        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_execute($Statement);
    }
    function getMail($databaseConnection, $mail)
    {
        $Query = "
                SELECT *
                FROM users WHERE email = ?"; // Het sql klaar zetten om het te gebruiken

        $Statement = mysqli_prepare($databaseConnection, $Query); // Je koppelt hier de sql aan de database zodat hij ook weet waar uit te voeren
        mysqli_stmt_bind_param($Statement, "s", $param_email); // Veiligheid, hiermee voorkom je dat mensen shit invoeren die je niet wilt
        $param_email = $mail; // Hier zet je wat er kwa input moet komen
        mysqli_stmt_execute($Statement); // Hier voor je pas echt de code uit "executing"
        $resultaat = mysqli_stmt_get_result($Statement); //Hier haal je het resultaat op , alleen nodig bij SELECT statements omdat je ook echt iets terug wilt krijgen
        return $resultaat; // Return het resultaat om te gebruiken in de code
    }
    function getProfiel($databaseConnection, $email, $rij)
    {
        $results = getMail($databaseConnection, $email);
        foreach ($results as $result) {
            $naam = $result["$rij"];

        }
        return $naam;
    }
    function getReview($databaseConnection, $productID,$id)
    {

        $Query = "
                SELECT id, aantSterren, onderwerp, naam, datum, opmerkingen
                FROM reviews WHERE productID = ? AND id=".$id;

        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_bind_param($Statement, "s", $param_id);
        $param_id = $productID;
        mysqli_stmt_execute($Statement);
        $resultaat = mysqli_stmt_get_result($Statement);
        return $resultaat;
    }
    function getCount($databaseConnection, $productID)
    {
        $Query = "
                SELECT count(*) count
                FROM reviews WHERE productID = ?";

        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_bind_param($Statement, "s", $param_email);
        $param_email = $productID;
        mysqli_stmt_execute($Statement);
        $count = mysqli_stmt_get_result($Statement);
        return $count;
    }
    function getReviewCount($databaseConnection, $productID)
    {
        $results = getCount($databaseConnection, $productID);
        foreach ($results as $result) {
            $naam = $result["count"];

        }
        return $naam;
    }
    function getReviewNaam($databaseConnection, $productID, $id)
    {
        $results = getReview($databaseConnection, $productID, $id);
        foreach ($results as $result) {
            $naam = $result["naam"];

        }
        return $naam;
    }
    function getReviewOmschrijving($databaseConnection, $productID, $id)
    {
        $results = getReview($databaseConnection, $productID, $id);
        foreach ($results as $result) {
            $naam = $result["opmerkingen"];

        }
        return $naam;
    }
    function getReviewOnderwerp($databaseConnection, $productID, $id)
    {
        $results = getReview($databaseConnection, $productID, $id);
        foreach ($results as $result) {
            $naam = $result["onderwerp"];

        }
        return $naam;
    }
    function getReviewAantSterren($databaseConnection, $productID, $id)
    {
        $results = getReview($databaseConnection, $productID, $id);
        foreach ($results as $result) {
            $aantSterren = $result["aantSterren"];

        }
        return $aantSterren;
    }
    function getReviewDatum($databaseConnection, $productID, $id)
    {
        $results = getReview($databaseConnection, $productID, $id);
        foreach ($results as $result) {
            $datum = $result["datum"];

        }
        return $datum;
    }
    function getReviewID($databaseConnection, $productID)
    {
        {
            $Query = "
                SELECT id
                FROM reviews WHERE productID = ?";

            $Statement = mysqli_prepare($databaseConnection, $Query);
            mysqli_stmt_bind_param($Statement, "s", $param_email);
            $param_email = $productID;
            mysqli_stmt_execute($Statement);
            $resultaat = mysqli_stmt_get_result($Statement);
            return $resultaat;
        }
    }
    function getReviewIDUit($databaseConnection, $productID)
    {
        $idarray = array();
        $results = getReviewID($databaseConnection, $productID);
        foreach ($results as $result) {
            $idarray[] = $result["id"];

        }
        return $idarray;
    }
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
    function getCart3($databaseConnection)
    {
        $email = $_SESSION["email"];
        $mail = getMail($databaseConnection, $email);
        foreach ($mail as $resultaten) {
            $winkemandarray = unserialize($resultaten["winkelmand"]);

        }
        saveCart($winkemandarray,$databaseConnection);
    }


function getCart($databaseConnection){
    if(isset($_SESSION['cart'])){               //controleren of winkelmandje (=cart) al bestaat
        $cart = $_SESSION['cart'];                  //zo ja:  ophalen
    } else{
        $cart = array();                            //zo nee: dan een nieuwe (nog lege) array
    }                            // resulterend winkelmandje terug naar aanroeper functie
return $cart;
    }
//    }


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
        $resultaat = mysqli_stmt_get_result($Statement);
        return $resultaat;
    }
    function getVmet($databaseConnection)
    {
        $Query = "
                SELECT *
                FROM deliverymethods ";
        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_execute($Statement);
        $resultaat = mysqli_stmt_get_result($Statement);
        return $resultaat;
    }
    function getOrders($databaseConnection,$mail)
    {
        $Query = "
                SELECT *
                FROM orders, users WHERE orders.UserID = users.ID AND users.email ='".$mail."'";
        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_execute($Statement);
        $resultaat = mysqli_stmt_get_result($Statement);
        return $resultaat;
    }
    function getBetaal($databaseConnection)
    {
        $Query = "
                SELECT *
                FROM paymentmethods ";
        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_execute($Statement);
        $resultaat = mysqli_stmt_get_result($Statement);
        return $resultaat;
    }
