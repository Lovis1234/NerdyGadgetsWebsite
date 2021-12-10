<!-- dit is het bestand dat wordt geladen zodra je naar de website gaat -->
<?php
include __DIR__ . "/header.php";
include "CartFuncties.php";
$email = "Test@test.nl";
$mail = getMail($databaseConnection, $email);
foreach ($mail as $aap) {
     $winkemandarray = print_r(unserialize($aap["winkelmand"]));
    }


?>

<?php
include __DIR__ . "/footer.php";
?>

