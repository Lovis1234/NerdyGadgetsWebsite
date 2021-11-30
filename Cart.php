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
<h1>&nbsp &nbsp Winkelmand</h1>

<div class="Cart" id="ResultsArea">
<?php
$superaantal = 0; //Het totaal aantal producten
$totaalprijs = 0; //Het totaalbedrag
$cart = getCart(); //aanroepen cart array

//Aanpassen hoeveelheid van product
if(isset($_GET["button-minder"])) {
    if( $cart[$_GET["idprod"]] != 1){
        $cart[$_GET["idprod"]] -= 1;
        saveCart($cart);
        header("Location:Cart.php");
    }
    else
    {
        header('Location:verwijder.php?idprod='.$_GET["idprod"]);
    }
}
elseif (isset($_GET["button-meer"])){
    $cart[$_GET["idprod"]] += 1;
    saveCart($cart);
    header("Location:Cart.php");
}
//einde van aanpassen hoeveelheid product

$test = array(1,2,3,4,5);

foreach ($cart as $artikel => $aantal){
    $StockItem = getStockItem($artikel, $databaseConnection);
    $StockItemImage = getStockItemImage($artikel, $databaseConnection);
    $artikelprijstotaal = $StockItem['SellPrice']*$aantal;
    $totaalprijs = $totaalprijs+$artikelprijstotaal;
    $superaantal = $superaantal+$aantal;
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
                <input type="submit" name="button-minder" value="-" id="CartPlusMin">
                <input id="CartAantal" type="text" name="aantal" value="<?php print($aantal); ?>" disabled>
                <input type="submit" name="button-meer" value="+" id="CartPlusMin">
                <a id="CartBin" href='verwijder.php?idprod=<?php print($artikel); ?>'><i class="bi-trash-fill search"></i></a>
            </form>
        </div>
        <div class="CartPrijzen">
            <a id="CartTotPrijsStuk"></i><?php print sprintf("Totaal prijs: € %.2f", $artikelprijstotaal); ?></a>
            <a id="CartPrijsStuk"></i><?php print sprintf("Prijs per stuk: € %.2f", $StockItem['SellPrice']); ?></a>
        </div>
    </div>
    <div style="height: 200px"/>
<?php
    }
?>
</div>
<div class="CartAfronden">
    <a id="CartTotaalPrijs">Totaalprijs (inclusief btw): </i><?php print(sprintf("€%.2f", $totaalprijs));?></a>
    <a id="CartTotaalArtikelen">Aantal producten in winkelmand: </i><?php print($superaantal);?></a>

</div>
</body>
</html>