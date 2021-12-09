
<?php
include __DIR__ . "/header.php";
?>
<form action="bestellijst.php">
                    <div class="row">
                        <div class="col-50">
                            <h3>Review achterlaten</h3>
    Onderwerp: <input type="text" id="zip" name="zip" required><br>
    Naam: <input type="text" id="huisnummer" name="huisnummer" required>
                            Toevoeging: <input type="text" id="toevoeging" name="toevoeging"><br>
    Opmerking: <input type="text" id="straat" name="straat" required><br>
                            <SELECT name="beoordeling" required>
                                <option value="">Selecteer een beoordeling</option>
                                <option value="1">1 ster</option>
                                <option value="2">2 ster</option>
                                <option value="3">3 ster</option>
                                <option value="4">4 ster</option>
                                <option value="5">5 ster</option>

                            </SELECT> <br><br>
    <input type="submit" name="bestel" value="Submit">
</form>

makeReview($databaseConnection, $productID,$onderwerp,$naam,$opmerking,$aantSterren);
