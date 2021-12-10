
<?php
include __DIR__ . "/header.php";
include "Functies.php";
if(isset($_GET["review"])) {
    $onderwerp = $_GET['onderwerp'];
    $naam = $_GET['naam'];
    $opmerking = $_GET['opmerking'];
    $aantSterren = $_GET['sterren'];
    $productID = $_GET["id"];

    $Query = "  INSERT INTO reviews(onderwerp, naam, opmerkingen, productID, aantSterren)
                VALUES ('$onderwerp','$naam', '$opmerking','$productID','$aantSterren')";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
}
?>
<form action="reviewmaken.php">
                    <div class="row">
                        <div class="col-50">
                            <h3>Review achterlaten</h3>
    Onderwerp: <input type="text" id="onderwerp" name="onderwerp" required><br>
    Naam: <input type="text" id="naam" name="naam" required>
    Opmerking: <input type="text" id="opmerking" name="opmerking" required><br>
                            <SELECT name="sterren" required>
                                <option value="">Selecteer een beoordeling</option>
                                <option value="1">1 ster</option>
                                <option value="2">2 ster</option>
                                <option value="3">3 ster</option>
                                <option value="4">4 ster</option>
                                <option value="5">5 ster</option>

                            </SELECT> <br><br>
                            <input type="hidden" value="<?php print($_GET["id"]);?>" name="id">
    <input type="submit" name="review" value="Submit">
</form>

makeReview($databaseConnection, $productID,$onderwerp,$naam,$opmerking,$aantSterren);
