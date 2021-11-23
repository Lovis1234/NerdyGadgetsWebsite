<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>
<h1>Inhoud Winkelwagen</h1>

<?php
$cart = getCart();
print("<table><tr></tr>");
foreach ($cart as $artikel => $aantal){
$StockItem = getStockItem($artikel, $databaseConnection);
$StockItemImage = getStockItemImage($artikel, $databaseConnection);
$artikelprijstotaal = $StockItem['SellPrice']*$aantal;
?>
<div id="ArticleHeader">
            <a id="class-naamartikel" href='view.php?id=<?php print($artikel); ?>'></i> <?php print $StockItem['StockItemName']; ?></a>
            <a id="class-prijsartikellos"></i><?php print sprintf("Prijs per stuk: € %.2f", $StockItem['SellPrice']); ?></a>
            <a id="class-prijsartikel"></i><?php print sprintf("Totaal prijs: € %.2f", $artikelprijstotaal); ?></a>
            <action="verwijder.php"><a id="class-verwijderartikel"><i class="fas fa-trash-alt search"></i></a>
            <a id="class-artikelnummer">Artikelnummer: <?php print($artikel);?></a>
<!--    <form>-->
<!--        <button id="button-minder" type="button" value="<" name="-" ></button>-->
<!--        <button id="button-meer" type="button" value=">" name="+"></button>-->
<!--    </form>-->
    <fieldset disabled="disabled">
        <input type="text" id="class-aantalartikel" name="aantal" value="<?php print($aantal); ?>">
    </fieldset>
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
print_r($cart);
print("</table>");
?>

<!--//gegevens per artikelen in $cart (naam, prijs, etc.) uit database halen-->
<!--//totaal prijs berekenen-->
<!--//mooi weergeven in html-->
<!--//etc.-->
            <?php
            if(isset($_GET["Thuis"])) {
                if(isset($_GET["verhoogthuis"])) {
                    $thuisscore=$_GET["Thuis"]+1;
                    $uitscore=$_GET["Uit"];
                }
                elseif (isset($_GET["Uit"])){
                    $thuisscore=$_GET["Thuis"];
                    $uitscore=$_GET["Uit"]+1;
                }
            }
            else {
                $thuisscore=0;
                $uitscore=0;
            }

            ?>
</body>
</html>