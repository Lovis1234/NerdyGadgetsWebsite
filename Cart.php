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
<h1>Inhoud Winkelwagen</h1>

<?php
$superaantal = 0;
$totaalprijs = 0;
$cart = getCart();
if(isset($_GET["button-minder"])) {
    if( $cart[$_GET["idprod"]] != 0){
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
} //
$cart = getCart();
print("<table><tr></tr>");
foreach ($cart as $artikel => $aantal){
$StockItem = getStockItem($artikel, $databaseConnection);
$StockItemImage = getStockItemImage($artikel, $databaseConnection);
$artikelprijstotaal = $StockItem['SellPrice']*$aantal;
$totaalprijs = $totaalprijs+$artikelprijstotaal;
$superaantal = $superaantal+$aantal;
?>

<div id="ArticleHeader">
            <a id="class-naamartikel" href='view.php?id=<?php print($artikel); ?>'></i> <?php print $StockItem['StockItemName']; ?></a>
            <a id="class-prijsartikellos"></i><?php print sprintf("Prijs per stuk: € %.2f", $StockItem['SellPrice']); ?></a>
            <a id="class-prijsartikel"></i><?php print sprintf("Totaal prijs: € %.2f", $artikelprijstotaal); ?></a>
            <a id="class-artikelnummer">Artikelnummer: <?php print($artikel);?></a>
   <a id="class-verwijderartikel" href='verwijder.php?idprod=<?php print($artikel); ?>'><i class="bi-trash-fill"></i></a>
    <form method="get" action="Cart.php" id="class-aantalartikel">
        <input type="hidden" name="idprod" value="<?php print($artikel); ?>">
        <input type="submit" name="button-minder" value="-">
        <fieldset disabled="disabled">
            <input type="text" name="aantal" value="<?php print($aantal); ?>">
        </fieldset>
        <input type="submit" name="button-meer" value="+">
    </form>
    <?php
    if (isset($StockItemImage)) {
    // één plaatje laten zien
    if (count($StockItemImage) == 1) {
        ?>
        <div id="ImageFrame2"
             style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-size: 200px; background-repeat: no-repeat; background-position: center;"></div>
        <?php
    } else if (count($StockItemImage) >= 2) { ?>
    <!-- meerdere plaatjes laten zien -->
    <div id="ImageFrame">
        <div id="ImageCarousel" class="carousel slide" data-interval="false">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <?php for ($i = 0; $i < count($StockItemImage); $i++) {
                    ?>
                    <li data-target="#ImageCarousel"
                        data-slide-to="<?php print $i ?>" <?php print (($i == 0) ? 'class="active"' : ''); ?>></li>
                    <?php
                } ?>
            </ul>
            <?php
            }}
    print("<tr><td>"."</td><td>"."</td><td>"."</td></tr>");
}
print("</table>");
print("Aantal producten in winkelmand = ".$superaantal);
print(sprintf("<br>Totaal prijs: € %.2f", $totaalprijs));
?>


</body>
</html>