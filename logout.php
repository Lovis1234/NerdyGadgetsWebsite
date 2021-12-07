
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NerdyGadgets</title>

    <!-- Javascript -->
    <script src="Public/JS/fontawesome.js"></script>
    <script src="Public/JS/jquery.min.js"></script>
    <script src="Public/JS/bootstrap.min.js"></script>
    <script src="Public/JS/popper.min.js"></script>
    <script src="Public/JS/resizer.js"></script>

    <!-- Style sheets-->
    <link rel="stylesheet" href="Public/CSS/style.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/typekit.css">
</head>
<body>
<?php
//include __DIR__ . "/header.php";
//include "CartFuncties.php";
//$cart = getCart($databaseConnection);
//print_r($cart);
//$email = $_SESSION["email"];
//$sql = "SELECT winkelmand FROM login WHERE email='$email'";
//$Statement = mysqli_prepare($databaseConnection, $sql);
//mysqli_stmt_execute($Statement);
//$cartserialized = mysqli_stmt_get_result($Statement);
////print($cartserialized);
//$cart = unserialize($cartserialized);
//unse
//print_r($cart);

//$array = serialize(array());
//print($array);
//$cartserialised = serialize($cart);
//$sql = "UPDATE login SET winkelmand='$cartserialised' WHERE email='$email'";
//$sql2 = "SELECT winkelmand FROM login";
//print($_SESSION["email"]);
//$result = $databaseConnection->query($sql);
//
//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//        print_r(unserialize($row["winkelmand"])). "<br>";
//    }
//} else {
//    echo "0 results";
//}
//
//$Statement = mysqli_prepare($databaseConnection, $sql);
//mysqli_stmt_execute($Statement);


// Destroy the session.
//session_destroy("loggedin");

// Redirect to login page
//header("location: inlog.php");
//exit;

// Initialize the session
// Unset all of the session variables

// Destroy the session. ?>
<center> <br><br><br><br><br><br><br><br>
<h1>Je staat op het punt om uit te loggen</h1>
<form action="logout.php">
    <input type="submit" name="annuleren" value="Annuleren" class="button2" style="background-color: red">
    <input type="submit" name="doorgaan" value="Doorgaan" class="button2">
</form>
    <center>
<?php
if(isset($_GET["doorgaan"])) {//controleren of $stockItemID(=key!) al in array staat
    unset($_SESSION["loggedin"]);
    unset($_SESSION["loggedin"]);
    unset($_SESSION["id"]);
    unset($_SESSION["email"]);
    header("Location:Index.php");
}
if(isset($_GET["annuleren"])) {//controleren of $stockItemID(=key!) al in array staat
    header("Location:Index.php");
}
?>