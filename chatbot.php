<?php
include __DIR__ . "/header.php";
include "Functies.php";
$chat=array();

$chat = $_SESSION['chat'];

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

    $chat[] = "/help";
    $chat[] = "/test";
    if(isset($_POST["submit"])) {
        $chat[] = $_POST["chatbericht"];
        $_SESSION['chat'] = $chat;
    }
    ?>
    <div class="chatbot">
        <div id="chatbox">
            <?php
                foreach ($chat as $vraagnummer => $vraag) {
            ?>
            <div class="botbericht">
                <h4 id="botnaam">Gebruiker</h4>
                <div style="word-wrap: break-word; margin-right: 20px">
                    <p id="botopmerking"> <?php print($vraag); ?></p>
                </div>
            </div>
            <?php
                    if ($vraag == "/help" || $vraag == "/test") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">Je Moeder</p>
                            </div>
                        </div>
            <?php
                    }
            }
            ?>
        </div>
    <form method="post">
        <input type="text" id="chatbericht" name="chatbericht" required>
        <input type="submit" id="chatsubmit" name="submit" value="" required>
    </form>
    <form method="get">
        <input type="submit" id="chatclear" name="submit" value="">
    </form>
    </div>

    </body>
    </html>
