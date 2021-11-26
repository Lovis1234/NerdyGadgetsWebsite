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
<h1>Gegevens Factuuradres/Afleveradres</h1>
<center>
<form>
    Email: <input type="text" id="email" name="email"><br>
    Geslacht:
      <input type="radio" id="html" name="fav_language" value="HTML">
      <label for="html">Man</label>
      <input type="radio" id="css" name="fav_language" value="CSS">
      <label for="css">Vrouw</label>
      <input type="radio" id="javascript" name="fav_language" value="JavaScript">
      <label for="javascript">Ik weet het niet</label><br>
    Voornaam: <input type="text" id="email" name="email"> Achternaam: <input type="text" id="email" name="email">
    <SELECT name="beoordeling" required>
        <option value="">Selecteer een land</option>
        <option value="1">Nederland</option>
        <option value="2">Vaticaanstad</option>
       </SELECT> <br><br>
    Postcode: <input type="text" id="email" name="email"><br>
    Huisnummer: <input type="text" id="email" name="email"> Toevoeging: <input type="text" id="email" name="email"><br>
    Straat: <input type="text" id="email" name="email"><br>
    Plaats: <input type="text" id="email" name="email"><br>
    Telefoonnummer: <input type="text" id="email" name="email"><br>
    <input type="submit" value="Submit">
</form>
</center>

<?php
include __DIR__ . "/footer.php";