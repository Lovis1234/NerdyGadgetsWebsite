<?php
include __DIR__ . "/header.php";
include "CartFuncties.php";

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>
<body>
    <br><br><br>
<?php
    $orderID = getVerzend($databaseConnection);
foreach ($orderID as $aap) {
    ?><center>
    <h1> Bedankt voor uw bestelling!</h1>
    <h2> Ordernummer: #<?php print($aap["max(OrderID)"]); ?></h2>
    <br><br>
    <img src="Public/StockItemIMG/voltooid.gif" style="height: 30%; width: 30%">
<?php }