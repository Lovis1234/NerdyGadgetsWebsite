<?php
include __DIR__ . "/header.php";
include 'Functies.php';
$email = $_SESSION["email"];
$voornaam = getProfiel($databaseConnection, $email, "voornaam");
$achternaam = getProfiel($databaseConnection, $email,"achternaam");
$bestelnaam = getProfiel($databaseConnection, $email, "bestelnaam");
$bestelstraat = getProfiel($databaseConnection, $email,"bestelstraat");
$bestelhuisnummer = getProfiel($databaseConnection, $email, "bestelhuisnummer");
$bestelpostcode = getProfiel($databaseConnection, $email,"bestelpostcode");
$bestelplaats = getProfiel($databaseConnection, $email,"bestelplaats");
$factuurnaam = getProfiel($databaseConnection, $email, "factuurnaam");
$factuurstraat = getProfiel($databaseConnection, $email,"factuurstraat");
$factuurhuisnummer = getProfiel($databaseConnection, $email, "factuurhuisnummer");
$factuurpostcode = getProfiel($databaseConnection, $email,"factuurpostcode");
$factuurplaats = getProfiel($databaseConnection, $email,"factuurplaats");
if(isset($_GET["Save"])) {//save profile gegevens
    updateProfile($databaseConnection, $_GET["Voornaam"],$_GET["Achternaam"],$_GET["Factuurnaam"],$_GET["Factuurstraat"],$_GET["Factuurhuisnummer"],$_GET["Factuurpostcode"],$_GET["Factuurplaats"],$_GET["Bestelnaam"],$_GET["Bestelstraat"],$_GET["Bestelhuisnummer"],$_GET["Bestelpostcode"],$_GET["Bestelplaats"], $email);
}
if(isset($_GET["Save2"])) {//save profile gegevens
    updateProfile($databaseConnection, $_GET["Voornaam"],$_GET["Achternaam"],$_GET["Bestelnaam"],$_GET["Bestelstraat"],$_GET["Bestelhuisnummer"],$_GET["Bestelpostcode"],$_GET["Bestelplaats"],$_GET["Bestelnaam"],$_GET["Bestelstraat"],$_GET["Bestelhuisnummer"],$_GET["Bestelpostcode"],$_GET["Bestelplaats"], $email);
}
?>
<form method="get" action="profile.php">
<div class="container rounded bg-white mt-5 mb-5" style="color: black">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php print($email); ?></span><span class="text-black-50"><?php print($email); ?></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                    <form method="get">
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Firstname</label><input name="Voornaam" type="text" class="form-control" placeholder="<?php if (!empty($voornaam)) {print($voornaam);} else {echo"Voornaam";} ?>" value="<?php if ($voornaam !== NULL) {print($voornaam);} ?>"></div>
                    <div class="col-md-6"><label class="labels">Surname</label><input name="Achternaam" type="text" class="form-control" value="<?php if ($achternaam !== NULL) {print($achternaam);} ?>" placeholder="<?php if (!empty($achternaam)) {print($achternaam);}else {echo"Achternaam";} ?>"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">This information is used to send your package.</label></div>
                    <div class="col-md-6"><label class="labels">Ordername</label><input name="Bestelnaam" type="text" class="form-control" placeholder="<?php if (!empty($bestelnaam)) {print($bestelnaam);}else {echo"Bestelnaam";} ?>" value="<?php if ($bestelnaam !== NULL) {print($bestelnaam);} ?>"></div>
                    <div class="col-md-6"><label class="labels">Ordercity</label><input name="Bestelplaats" type="text" class="form-control" value="<?php if ($bestelplaats !== NULL) {print($bestelplaats);}else {} ?>" placeholder="<?php if (!empty($bestelplaats)) {print($bestelplaats);}else {echo"Bestelplaats";} ?>"></div>
                    <div class="col-md-6"><label class="labels">Orderzipcode</label><input name="Bestelpostcode" type="text" class="form-control" placeholder="<?php if (!empty($bestelpostcode))  {print($bestelpostcode);}else {echo"Bestelpostcode";} ?>" value="<?php if ($bestelpostcode !== NULL) {print($bestelpostcode);}else {} ?>"></div>
                    <div class="col-md-6"><label class="labels">Orderstreet</label><input name="Bestelstraat" type="text" class="form-control" value="<?php if ($bestelstraat !== NULL) {print($bestelstraat);}else {} ?>" placeholder="<?php if (!empty($bestelstraat)) {print($bestelstraat);}else {echo"Bestelstraat";} ?>"></div>
                    <div class="col-md-6"><label class="labels">Orderhousenumber</label><input name="Bestelhuisnummer" type="text" class="form-control" value="<?php if ($bestelhuisnummer !== NULL) {print($bestelhuisnummer);}else {} ?>" placeholder="<?php if (!empty($factuurhuisnummer)) {print($bestelhuisnummer);}else {echo"Bestelhuisnummer";} ?>"></div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="Save2">Transfer to Invoice</button></div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">This information will be shown on your invoice.</label></div>
                    <div class="col-md-6"><label class="labels">Invoicename</label><input name="Factuurnaam" type="text" class="form-control" placeholder="<?php if (!empty($factuurnaam)) {print($factuurnaam);}else {echo"Factuurnaam";} ?>" value="<?php if ($factuurnaam !== NULL) {print($factuurnaam);}else {} ?>"></div>
                    <div class="col-md-6"><label class="labels">Invoicecity</label><input name="Factuurplaats" type="text" class="form-control" value="<?php if ($factuurplaats !== NULL) {print($factuurplaats);}else {} ?>" placeholder="<?php if (!empty($factuurplaats)) {print($factuurplaats);}else {echo"Factuurplaats";} ?>"></div>
                    <div class="col-md-6"><label class="labels">Invoicezipcode</label><input name="Factuurpostcode" type="text" class="form-control" placeholder="<?php if (!empty($factuurpostcode)) {print($factuurpostcode);}else {echo"Factuurpostcode";} ?>" value="<?php if ($factuurpostcode !== NULL) {print($factuurpostcode);}else {} ?>"></div>
                    <div class="col-md-6"><label class="labels">Invoicestreet</label><input name="Factuurstraat" type="text" class="form-control" value="<?php if ($factuurstraat !== NULL) {print($factuurstraat);}else {} ?>" placeholder="<?php if (!empty($factuurstraat)) {print($factuurstraat);}else {echo"Factuurstraat";} ?>"></div>
                    <div class="col-md-6"><label class="labels">Invoicehousenumber</label><input name="Factuurhuisnummer" type="text" class="form-control" value="<?php if ($factuurhuisnummer !== NULL) {print($factuurhuisnummer);}else {} ?>" placeholder="<?php if (!empty($factuurhuisnummer)) {print($factuurhuisnummer);}else {echo"Factuurhuisnummer";} ?>"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="Save">Save Profile</button></div>
            </form
            </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Orders</span></div><br>
               <?php $ordersdat = getOrders($databaseConnection,$email);
               foreach ($ordersdat as $order)
               {
                   echo'
                        <div class="col-md-12"><label class="labels">'.$order['OrderID'].'</label></div> <br>';
               }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</form>