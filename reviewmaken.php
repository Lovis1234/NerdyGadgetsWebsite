
<?php
include __DIR__ . "/header.php";
include "Functies.php";

if(isset($_GET["review"])) {
    $email = $_GET['email'];
//    $geslacht = $_GET['geslacht'];
//    $vn = $_GET['vn'];
//    $an = $_GET['an'];
//    $beoordeling = $_GET['beoordeling'];
//    $zip = $_GET['zip'];
//    $hn = $_GET['huisnummer'];
//    $toevoeging = $_GET['toevoeging'];
//    $straat = $_GET['straat'];
//    $plaats = $_GET['plaats'];
//    $tel = $_GET['telnummer'];
//    $vz = $_GET['vz'];
//    $bm = $_GET['bm'];
//    echo $email. "<br>". $geslacht. "<br>".$vn. "<br>".$an. "<br>".$beoordeling. "<br>".$zip. "<br>".$hn. "<br>".$toevoeging. "<br>".$straat. "<br>".$plaats. "<br>".$tel. "<br>".$vz. "<br>".$bm. "<br>";

//    $Query = "INSERT INTO `customers`
//(`CustomerID`, `CustomerName`, `BillToCustomerID`, `CustomerCategoryID`,
//     `BuyingGroupID`, `PrimaryContactPersonID`, `AlternateContactPersonID`,
//     `DeliveryMethodID`, `DeliveryCityID`,
//     `PostalCityID`, `CreditLimit`, `AccountOpenedDate`,
//     `StandardDiscountPercentage`, `IsStatementSent`, `IsOnCreditHold`, `PaymentDays`,
//     `PhoneNumber`, `FaxNumber`, `DeliveryRun`, `RunPosition`,
//     `WebsiteURL`, `DeliveryAddressLine1`, `DeliveryAddressLine2`, `DeliveryPostalCode`, `DeliveryLocation`,
//     `PostalAddressLine1`, `PostalAddressLine2`,
//     `PostalPostalCode`, `LastEditedBy`, `ValidFrom`, `ValidTo`)
// VALUES (NULL, '".$vn." ".$an."', '1', '1', NULL, '1', NULL, '".$vz."', '1', '1', NULL, '".date("Y-m-d")."', '0', '0', '0', '7',
//  '".$tel."', '".$tel."', NULL, NULL, 'http://www.microsoft.com/', '".$straat."', NULL, '".$zip ."', NULL,
//   '".$plaats."', NULL, '".$zip ."', '1', '".date("Y-m-d h:i:sa")."', '".date("Y-m-d h:i:sa")."')
//                ";
//
//    $Statement = mysqli_prepare($databaseConnection, $Query);
//    mysqli_stmt_execute($Statement);
?>
<form action="bestellijst.php">
                    <div class="row">
                        <div class="col-50">
                            <h3>Review achterlaten</h3>
    Onderwerp: <input type="text" id="onderwerp" name="onderwerp" required><br>
    Naam: <input type="text" id="naam" name="naam" required>
    Titel: <input type="text" id="titel" name="titel"><br>
    Opmerking: <input type="text" id="straat" name="straat" required><br>
                            <SELECT name="sterren" required>
                                <option value="">Selecteer een beoordeling</option>
                                <option value="1">1 ster</option>
                                <option value="2">2 ster</option>
                                <option value="3">3 ster</option>
                                <option value="4">4 ster</option>
                                <option value="5">5 ster</option>

                            </SELECT> <br><br>
    <input type="submit" name="review" value="Submit">
</form>

makeReview($databaseConnection, $productID,$onderwerp,$naam,$opmerking,$aantSterren);
