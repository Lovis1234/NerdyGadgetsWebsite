
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
                            <h3>Write A Customer Review</h3>
    Subject: <input type="text" id="onderwerp" name="onderwerp" required><br>
    Name: <input type="text" id="naam" name="naam" required>
    Review: <input type="text" id="opmerking" name="opmerking" required><br>
                            <SELECT name="sterren" required>
                                <option value="">Select Your Rating</option>
                                <option value="1">1 star  - Very Unsatisfied</option>
                                <option value="2">2 stars - Unsatisfied</option>
                                <option value="3">3 stars - Neutral</option>
                                <option value="4">4 stars - Satisfied</option>
                                <option value="5">5 stars - Very Satisfied</option>

                            </SELECT> <br><br>
                            <input type="hidden" value="<?php print($_GET["id"]); ?>" name="id">
    <input type="submit" name="review" value="Submit">
</form>

<!--makeReview($databaseConnection, $productID,$onderwerp,$naam,$opmerking,$aantSterren);-->
