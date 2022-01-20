<!-- dit bestand bevat alle code voor de pagina die één product laat zien -->
<?php

include __DIR__ . "/header.php";
include 'Functies.php';
$StockItem = getStockItem($_GET['id'], $databaseConnection);
$StockItemImage = getStockItemImage($_GET['id'], $databaseConnection);
$ChocTemp = getChocTemp($databaseConnection);
$button="";
if(isset($_SESSION["email"]))
{
    $idmail = $_SESSION["email"];
    getWelkom($databaseConnection, $idmail, $_GET['id']);
}
?>
<div id="CenteredContent">
    <?php
    if ($StockItem != null) {
        ?>
        <?php
        if (isset($StockItem['Video'])) {
            ?>
            <div id="VideoFrame">
                <?php print $StockItem['Video']; ?>
            </div>
        <?php }
        ?>


        <div id="ArticleHeader">
            <?php
            if (isset($StockItemImage)) {
                if (count($StockItemImage) == 0) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/GeenAfbeelding.jpg'); background-size: 250px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php
                }
                // één plaatje laten zien
                elseif (count($StockItemImage) == 1) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php
                } elseif (count($StockItemImage) >= 2) { ?>
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

                            <!-- slideshow -->
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($StockItemImage); $i++) {
                                    ?>
                                    <div class="carousel-item <?php print ($i == 0) ? 'active' : ''; ?>">
                                        <img src="Public/StockItemIMG/<?php print $StockItemImage[$i]['ImagePath'] ?>">
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- knoppen 'vorige' en 'volgende' -->
                            <a class="carousel-control-prev" href="#ImageCarousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#ImageCarousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div id="ImageFrame"
                     style="background-image: url('Public/StockGroupIMG/<?php print $StockItem['BackupImagePath']; ?>'); background-size: cover;"></div>
                <?php
            }
            ?>


            <h1 class="StockItemID">Product id: <?php print $StockItem["StockItemID"]; ?></h1>
            <h2 class="StockItemNameViewSize StockItemName">
                <?php print $StockItem['StockItemName']; ?>
            </h2>
            <div class="ChocTemp"><?php
                if ($StockItem['IsChillerStock'] == 1) {
                    print "Chocolate temperature: " . $ChocTemp . " °C";
                }
                ?></div>
            <div class="QuantityText"><?php print $StockItem['QuantityOnHand']; ?></div>
            <div id="StockItemHeaderLeft">
                <div class="CenterPriceLeft">
                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText"><b><?php print sprintf("€ %.2f", $StockItem['SellPrice']); ?></b></p>
                        <h6> Price Including <?php $StockItem['SellPrice']/100*$StockItem['TaxRate'] ?> VAT </h6>
                        <form method="post">
                            <input type="submit" name="button" value="&nbsp &nbsp Add to cart &nbsp &nbsp" class="button" id="button">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </ul>
        <div id="StockItemDescription">
            <h3>Product Description</h3>
            <p><?php print $StockItem['SearchDetails']; ?></p>
        </div>
        <div id="StockItemSpecifications">
            <h3>Product Details</h3>
            <?php
            $CustomFields = json_decode($StockItem['CustomFields'], true);
            if (is_array($CustomFields)) { ?>
                <table>
                <thead>
                <th>Name</th>
                <th>Data</th>
                </thead>
                <?php
                foreach ($CustomFields as $SpecName => $SpecText) { ?>
                    <tr>
                        <td>
                            <?php print $SpecName; ?>
                        </td>
                        <td>
                            <?php
                            if (is_array($SpecText)) {
                                foreach ($SpecText as $SubText) {
                                    print $SubText . " ";
                                }
                            } else {
                                print $SpecText;
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </table><?php
            } else { ?>

                <p><?php print $StockItem['CustomFields']; ?>.</p>
                <?php
            }
            ?>
        </div>
            <?php
            $idarray = getReviewIDUit($databaseConnection,$_GET['id']); // Alle reviewID's ophalen bij het gegeven product
            if (getReviewCount($databaseConnection,$_GET['id']) == 0) { // Wanneer er geen reviews zijn
                ?>
                    <div id="StockItemReview">
                    <h3 class='Review'>Reviews:</h3>
                <form method="post" action="reviewmaken.php?id=<?php print($_GET["id"]); ?>">
                    <input type="submit" name="button2" value="Be the first to write a customer review!" class="button" style="margin-top: 20px; margin-bottom: 20px">
                </form>

                    <?php }
            if (getReviewCount($databaseConnection,$_GET['id']) >= 1) { // Wanneer er reviews zijn
                ?><div id="StockItemReview"><?php

                print("<h3 class='Review'>Reviews:</h3>");
                ?><div style="margin: 30px"><?php
                foreach ($idarray as $id) { // Om voor elk review alle gegevens op te halen
                    $sterren = getReviewDetails($databaseConnection,$_GET['id'],$id,"aantSterren");
                    $naam = getReviewDetails($databaseConnection,$_GET['id'],$id,"naam");
                    $datum = getReviewDetails($databaseConnection,$_GET['id'],$id,"datum");
                    $omschrijving = getReviewDetails($databaseConnection,$_GET['id'],$id,"opmerkingen");
                    $titel = getReviewDetails($databaseConnection,$_GET['id'],$id,"onderwerp");
                    print("<a style='font-size: 20px'> $titel </a><br>");

                    for ($i = 0; $i < $sterren; $i++) {
                        print('<img src="Public/Img/starvol.png" style="height: 10%; width: 10%">'); // Aantal gegeven sterren
                    }
                    for ($i = 0; $i < 5-$sterren; $i++) {
                        print('<img src="Public/Img/star.png" style="height: 10%; width: 10%">'); // Opvul lege sterren
                    }
                    ?>

                    <br>
                    <h3>(<?php print($titel); ?>)</h3>
                    <h4><?php print("$naam");?> | <?php print("$datum");?> </h4>
                    <h3>(<?php print($omschrijving); ?>)</h3>
                <?php print("<hr style='border: 1px solid white'");
                } ?>
                <?php } ?>
        </div>
            <?php // Button review maken als er reviews zijn
                if (getReviewCount($databaseConnection,$_GET['id']) >= 1) { ?>
                    <form method="post" action="reviewmaken.php?id=<?php print($_GET["id"]); ?>">
                        <input type="submit" name="button2" value="Write a customer review" class="button" style="margin-top: 20px; margin-bottom: 20px">
                    </form>
            <?php } ?>
        </div>
        <?php
    } else {
        ?><h2 id="ProductNotFound">Het opgevraagde product is niet gevonden.</h2><?php
    } ?>
</div>
<?php
if(isset($_POST["button"])) {
    $id=$_GET["id"];
    getCart($databaseConnection);
    addProductToCart("$id",$databaseConnection);
}

?>
</div>
<?php
include __DIR__ . "/footer.php";
