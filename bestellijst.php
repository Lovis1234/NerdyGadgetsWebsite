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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>
<body>
<center>
<h1>Afronden bestelling</h1>
    <div class="row">
        <div class="col-75">
             <div class="container">
                <form action="/action_page.php">
                    <div class="row">
                        <div class="col-50">
                            <h3>Contactgegevens</h3>
    Email: <input type="text" id="email" name="email" required><br>
    Geslacht:
      <input type="radio" id="man" name="geslacht" value="man">
      <label for="man">Man</label>
      <input type="radio" id="vrouw" name="geslacht" value="vrouw">
      <label for="css">Vrouw</label>
      <input type="radio" id="anders" name="geslacht" value="anders">
      <label for="anders">Anders</label><br>
    Voornaam: <input type="text" id="email" name="email" required> Achternaam: <input type="text" id="email" name="email" required>
    <SELECT name="beoordeling" required>
        <option value="">Selecteer een land</option>
        <option value="NL">Nederland</option>
        <option value="VA">Belgie</option>
       </SELECT> <br><br>
    Postcode: <input type="text" id="zip" name="zip" required><br>
    Huisnummer: <input type="text" id="huisnummer" name="huisnummer" required> Toevoeging: <input type="text" id="toevoeging" name="toevoeging"><br>
    Straat: <input type="text" id="straat" name="straat" required><br>
    Plaats: <input type="text" id="plaats" name="plaats" required><br>
    Telefoonnummer: <input type="text" id="telnummer" name="telnummer" required><br>
    <input type="submit" value="Submit">
</form>
</center>

<?php
include __DIR__ . "/footer.php";