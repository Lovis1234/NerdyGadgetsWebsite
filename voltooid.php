<?php
include __DIR__ . "/header.php";
include "Functies.php";

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
foreach ($orderID as $resultaten) {
    ?><center>
    <h1> Thank you for shopping with us!</h1>
    <h2> Ordernumber: #<?php print($resultaten["max(OrderID)"]); ?></h2>
    <h2>The products you bought:</h2>
    <br><br>
    <div class="Cart" id="ResultsArea">
        <?php }
        $superaantal = 0; //Het totaal aantal producten
        $totaalprijs = 0; //Het totaalbedrag
        $cart = getCart($databaseConnection); //aanroepen cart array
        foreach ($cart as $artikel => $aantal){
            $StockItem = getStockItem($artikel, $databaseConnection);
            $StockItemImage = getStockItemImage($artikel, $databaseConnection);

            ?>
            <hr style="border: 1px solid white">

            <div class="CartProductFrame">
                <?php
                if (isset($StockItemImage)) {
                    if (count($StockItemImage) == 0) {
                        ?>
                        <div id="CartImageFrame"
                             style="background-image: url('Public/StockItemIMG/GeenAfbeelding.jpg'); background-size: 200px; background-repeat: no-repeat; background-position: center;"></div>
                        <?php
                    }
                    // één plaatje laten zien
                    if (count($StockItemImage) >= 1) {
                        ?>
                        <div id="CartImageFrame"
                             style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-size: 200px; background-repeat: no-repeat; background-position: center;"></div>
                        <?php
                    }
                }
                ?>
                <div class="CartNaamArtikel">
                    <a id="NaamArtikel" href='view.php?id=<?php print($artikel); ?>'></i> <?php print $StockItem['StockItemName']; ?></a>
                </div>
                <div class="CartArtikelNr">
                    <a id="Artikelnummer">Artikelnummer: <?php print($artikel);?></a>
                </div>
                <div class="CartHoeveelheid">
                    <form method="get" action="Cart.php" id="CartHoeveelheidArtikel">
                        <input type="hidden" name="idprod" value="<?php print($artikel); ?>">

                       Total: <?php print($aantal); ?>
                    </form>
                </div>

            </div>
            <div style="height: 160px"/>
<?php
}
include __DIR__ . "/footer.php";