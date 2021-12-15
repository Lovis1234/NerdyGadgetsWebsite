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
?>
<div class="container rounded bg-white mt-5 mb-5">
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
                    <div class="col-md-6"><label class="labels">Voornaam</label><input type="text" class="form-control" placeholder="<?php if ($voornaam !== NULL) {print($voornaam);} else {echo"Voornaam";} ?>" value="<?php if ($voornaam !== NULL) {print($voornaam);} ?>"></div>
                    <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="<?php if ($achternaam !== NULL) {print($achternaam);}   ?>" placeholder="<?php if ($achternaam !== NULL) {print($achternaam);}else {echo"Achternaam";} ?>"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
                    <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" placeholder="enter address line 1" value=""></div>
                    <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">State</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>
                    <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value=""></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
            </form
            </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>