<?php
include __DIR__ . "/header.php";
include "Functies.php";
$chat=array();

$_SESSION['chat'] = $chat;

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
    <?php
    if(isset($_POST["submit"]))
    ?>
    <div class="chatbot">
        <div id="chatbox">
            <div class="botbericht">
                <h4 id="botnaam">Naam</h4>
                <p id="botopmerking">hsjjajdajd</p>
            </div>
            <div class="botbericht">
                <h4 id="botnaam">Naam</h4>
                <p id="botopmerking">hsjjajdajd</p>
            </div>            <div class="botbericht">
                <h4 id="botnaam">Naam</h4>
                <p id="botopmerking">hsjjajdajd</p>
            </div>            <div class="botbericht">
                <h4 id="botnaam">Naam</h4>
                <p id="botopmerking">hsjjajdajd</p>
            </div>            <div class="botbericht">
                <h4 id="botnaam">Naam</h4>
                <p id="botopmerking">hsjjajdajd</p>
            </div>
            <div class="botbericht">
                <h4 id="botnaam">Naam</h4>
                <p id="botopmerking">hsjjajdajd</p>
            </div>
        </div>
    <form method="get">
        <input type="text" id="chatbericht" name="chatbericht" required>
        <input type="submit" id="chatsubmit" name="submit" required>
    </form>
    </div>

    </body>
    </html>
