<?php
include __DIR__ . "/header.php";
include "Functies.php";
$chat=array();
if(isset($_SESSION['chat'])){               //controleren of winkelmandje (=cart) al bestaat
    $chat = $_SESSION['chat'];                  //zo ja:  ophalen
} else{
    $cart = array();                            //zo nee: dan een nieuwe (nog lege) array
}

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
    if(isset($_POST["chatsubmit"])) {
        $chat[] = $_POST["chatbericht"];
        $_SESSION['chat'] = $chat;
    }
    if(isset($_POST["chatclear"])) {
        unset($chat);
        $chat= array();
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
                $begroetingen = array('Hey', 'Hello', 'hey', 'hello', 'Goodday', 'goodday', "Good day", "good day");
                foreach ($begroetingen as $begroeting){
                    if (strpos($vraag, $begroeting) !== false) {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">Hey there, to help you get started type '/help'</p>
                            </div>
                        </div>
                        <?php
                    }
                }
                    if ($vraag == "/help") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">A list of commands will popup below to help you get further.</p>
                            </div>
                        </div>

            <?php
                    }
                    if ($vraag == "/shipping") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    For information about: <br>

                                    &nbsp &nbsp - Packet service (type '/ps')<br>
                                    &nbsp &nbsp - Shipping time (type '/st')<br>
                                    &nbsp &nbsp - Track & trace (type '/tnt')<br>
                                    &nbsp &nbsp - Billing and order address (type '/baoa')<br>
                                    &nbsp &nbsp - Date of delivery (type '/dod')
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/ps") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">Depending on the ordered items, your order will either be processed by PostNL or DHL.</p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/st") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">If the order has been placed before 16:00 and is a letter package it will be delivered the next day.<br>
                                    If it’s a parcel it can take up to 2 workdays.<br>
                                    If you would like to track your package, see our information about track & trace.</p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/tnt") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">Both DHL and PostNL provide track and trace codes.<br>
                                    To follow your order, please copy the track and trace code, sent to you by email, and paste it in the following page:<br>
                                    PostNL:<br>
                                    &nbsp &nbsp - <a href="url">https://www.postnl.nl/ontvangen/post-ontvangen/track-en-trace/</a><br>
                                    DHL:<br>
                                    &nbsp &nbsp - <a href="url">https://www.dhlparcel.nl/nl/consument/track-en-trace</a>
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/baoa") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">In our webshop, it’s possible to set a seperate billing and orderdering address.<br>
                                    It’s possible to save these addresses if you’ve got an account on our site.<br>
                                    The next time you place an order while logged in, you will automatically proceed to check-out without having to fill in your personal data again.</p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/dod") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">If, for any reason, you are not able to be at home on the date of delivery, it’s possible to pick another date.<br>
                                    Please follow the steps as shown on these sites:<br>
                                    PostNL:<br>
                                    &nbsp &nbsp - <a href="url">https://www.postnl.nl/klantenservice/niet-thuis-bij-bezorging/ander-moment-of-locatie/</a><br>
                                    DHL: <br>
                                    &nbsp &nbsp - <a href="url">https://play.google.com/store/apps/details?id=com.dhlparcel.nl</a><br>
                                    &nbsp &nbsp - <a href="url">https://apps.apple.com/nl/app/mijn-dhl/id1530944632</a>
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/returnpolicy") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                        Is the delivered product different from your order, broken, or not up to your standards? <br>
                                        Please contact us by sending an email to sexynerd@hotmail.nl containing the reason for returning the product, your client number and order number. <br>
                                        We will contact you as soon as possible. <br>
                                        - If your request for return has been accepted and the package has been sent back, you will get a confirmation. <br>
                                        - It can take up to two workdays for the money to be transferred back to your account.<br>
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/choctemp") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    The temperature of our warehouse is being monitored by a Raspberry Pi via a SenseHat.<br>
                                    Every few seconds the Pi updates the temperature. <br>
                                    This temperature can be found on every product page that includes chocolate products.
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/warranty") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    Our USB Novelties contain a 2 week warranty starting from the day of delivery. <br>
                                    During this period, if your product shows any signs of malfunctions, we will provide you with a new product. <br>
                                    To get your new product please send a mail to sexynerd@hotmail.nl containing:<br>
                                    &nbsp - A photo <br>
                                    &nbsp - A short explanation of the malfunctioning <br>
                                    &nbsp - Your client and order number. <br>
                                    We will contact you and start the replacing process as soon as possible .
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/contact") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    Email: sexynerd@hotmail.nl<br>
                                    Telephone: 06-21676241<br>
                                    Address: Campus 2, 8017 CA Zwolle, gebouw T
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/payment") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    Unfortunately, it’s only possible to pay using iDEAL up until this day.<br>
                                    More payment options will be added in the future. <br>
                                    For now, all transactions using our webshop are 100% safe. <br>
                                    Other than information needed for the transaction, we will not share any personal information or other data with iDEAL.
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/privacy") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    Your privacy is very important to us. <br>
                                    We guarantee that your data will not be shared with third parties. <br>
                                    Your data is stored very safely as we have taken measurements to prevent hacking. <br>
                                    We are always looking for solutions to improve the safety of our webshop.
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/account") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    For information about: <br>

                                    &nbsp &nbsp - Registration (type '/registration')<br>
                                    &nbsp &nbsp - Billing and order address (type '/baoa')<br>
                                    &nbsp &nbsp - Password forgotten (type '/pf')
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/registration") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    Would you like to get an account on our webshop? <br>
                                    Press the button ‘Log in’. <br>
                                    Next, press the button ‘Sign up now’. <br>
                                    Here you can register yourself using an email address and set up a password. <br>
                                    Please use a safe password to prevent other people from trying to hack your account.

                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/pf") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    Have you forgotten your password? <br>
                                    Send an email to sexynerd@hotmail.nl and we will send you an email with your password.
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                    if ($vraag == "/discount") {
                        ?>
                        <div class="botbericht">
                            <h4 id="botnaam">Nerd</h4>
                            <div style="word-wrap: break-word; margin-right: 20px">
                                <p id="botopmerking">
                                    You can add "coupon20" as discount code <3
                                </p>
                            </div>
                        </div>

                        <?php
                    }

            }
            if(isset($_POST["chatsubmit"])) {
                if (strpos($_POST["chatbericht"], "/help") !== false) {
                    ?>
                    <div style="height: 100px"></div>
                    <?php
                }
            }
            ?>
        </div>
        <?php // /help commandos
        if(isset($_POST["chatsubmit"])) {
            if ($_POST["chatbericht"] == "/help") {
                ?>

                <div id="chatmenu">
                    <table style="width: 100%; text-align: center">
                        <tr>
                            <td><h3 id="chatmenusub">/shipping</h3></td>
                            <td><h3 id="chatmenusub">/choctemp</h3></td>
                            <td><h3 id="chatmenusub">/payment</h3></td>
                            <td><h3 id="chatmenusub">/warranty</h3></td>
                            <td><h3 id="chatmenusub">/discount</h3></td>
                        </tr>
                        <tr style="">
                            <td><h3 id="chatmenusub">/returnpolicy</h3></td>
                            <td><h3 id="chatmenusub">/account</h3></td>
                            <td><h3 id="chatmenusub">/privacy</h3></td>
                            <td><h3 id="chatmenusub">/contact</h3></td>
                        </tr>
                    </table>
                </div>
                <?php
            }
        }
        ?>

    <form method="post">
        <input type="text" id="chatbericht" name="chatbericht" placeholder="Type /help" required>
        <input type="submit" id="chatsubmit" name="chatsubmit" value="Klik" required>
    </form>
    <form method="post">
        <input type="submit" id="chatclear" name="chatclear" value="Reset">
    </form>
    </div>

    </body>
    </html>
