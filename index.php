<!-- dit is het bestand dat wordt geladen zodra je naar de website gaat -->
<?php
include __DIR__ . "/header.php";
include "Functies.php";
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $id = $_SESSION["email"];
    $email = getMail($databaseConnection, $id);
    foreach ($email as $remails){
        echo" <center><h1>Welcome back " .$remails['voornaam']. " ".$remails['achternaam']."</h1><br><br><br>
        <h2>Last seen products:</h2><br>
        
        
         
        
    
    <table><tr>
";
        $titels = array();
        $lbprod = $remails['bekekenprod'];
    }
    $lbprod = unserialize($lbprod);
    foreach ($lbprod as $product)
    {
        echo"<td>";
        $StockItem = getStockItem($product, $databaseConnection);
        $StockItemImage = getStockItemImage($product, $databaseConnection);
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
                }
                elseif (count($StockItemImage) >= 2) { ?>
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
         }
        array_push($titels,$StockItem['StockItemName']);
        echo "</td>";
        // $StockItem['StockItemName']
 }
    echo "</tr><tr>";
    foreach ($titels as $productnaam)
        {
            echo "<td>".$productnaam."</td>";
        }
    echo"</tr>


</table></center>
    
<div class='form-group'>
            <a href='categories.php'> <input  type='submit' class='btn btn-primary' value='Continue shopping'></a>
        </div>";
}
else
{
?>
<div class="IndexStyle">
    <div class="col-11">
        <div class="TextPrice">
            <a href="view.php?id=93">
                <div class="TextMain">
                    "The Gu" red shirt XML tag t-shirt (Black) M
                </div>
                <ul id="ul-class-price">
                    <li class="HomePagePrice">€30.95</li>
                </ul>
        </div>
        </a>
        <div class="HomePageStockItemPicture"></div>
    </div>
</div>
<?php
include __DIR__ . "/footer.php";
}
?>

