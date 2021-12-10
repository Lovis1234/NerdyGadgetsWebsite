
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
<center> <br><br><br><br><br><br><br><br>
<h1>Je staat op het punt om uit te loggen</h1>
<form action="logout.php">
    <input type="submit" name="annuleren" value="Annuleren" class="button2" style="background-color: red">
    <input type="submit" name="doorgaan" value="Doorgaan" class="button2">
</form>
    <center>
<?php
if(isset($_GET["doorgaan"])) {//controleren of $stockItemID(=key!) al in array staat
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location: index.php");
    exit;
}
if(isset($_GET["annuleren"])) {//controleren of $stockItemID(=key!) al in array staat
    header("Location:Index.php");
}


