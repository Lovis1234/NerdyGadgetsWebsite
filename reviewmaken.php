
<?php
include __DIR__ . "/header.php";
include "Functies.php";
$productID = $_GET["id"];
$StockItem = getStockItem($productID, $databaseConnection);
if(isset($_GET["review"])) {
    $onderwerp = $_GET['onderwerp'];
    $naam = $_GET['naam'];
    $opmerking = $_GET['opmerking'];
    $aantSterren = $_GET['sterren'];
    $productID = $_GET["id"];
    $StockItem = getStockItem($productID, $databaseConnection);

    $Query = "  INSERT INTO reviews(onderwerp, naam, opmerkingen, productID, aantSterren)
                VALUES ('$onderwerp','$naam', '$opmerking','$productID','$aantSterren')";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    header("Location:view.php?id=".$productID);
}
?>
<div class="container rounded bg-white mt-5 mb-5" style="color:black">
    <div class="row">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Write a customer review for <?php print $StockItem['StockItemName'] ?></h4>
                <form action="reviewmaken.php">
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Name:</label><input type="text" class="form-control" placeholder="Name" value="" id="naam" name="naam" required></div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Subject:</label><input type="text" class="form-control" placeholder="Subject" value="" id="onderwerp" name="onderwerp" required></div>
                <div class="col-md-12"><label class="labels">Remark:</label><input type="text" class="form-control" placeholder="Remark" value="" id="opmerking" name="opmerking" required></div>
                <SELECT class="col-md-12" name="sterren" required>
                    <option value="">Choose a star rating</option>
                    <option value="1">1 star</option>
                    <option value="2">2 star</option>
                    <option value="3">3 star</option>
                    <option value="4">4 star</option>
                    <option value="5">5 star</option>
                </SELECT>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Submit review</button></div>
                <input type="hidden" value="<?php print($productID); ?>" name="id" >
                </form
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php
include __DIR__ . "/footer.php";
