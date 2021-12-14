<!-- dit is het bestand dat wordt geladen zodra je naar de website gaat -->
<?php
include __DIR__ . "/header.php";
include "Functies.php";
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $id = $_SESSION["email"];
    $email = getMail($databaseConnection, $id);
    foreach ($email as $remails){
        echo" <center><h1>Welkom terug " .$remails['voornaam']. " ".$remails['achternaam']."</h1><br><br><br>
        <h2>Laast bekeken producten:</h2><br>
        
        
         
        
    
    
";
        $lbprod = $remails['bekekenprod'];
    }
    $lbprod = unserialize($lbprod);
    foreach ($lbprod as $product)
    {
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
         }
        echo $StockItem['StockItemName'];
 }
    echo "</center></center><div class='form-group'>
            <input href='categories.php' type='submit' class='btn btn-primary' value='Verder winkelen'>
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

