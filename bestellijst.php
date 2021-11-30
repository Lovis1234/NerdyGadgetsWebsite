<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

function getCountries($databaseConnection)
{
    $Query = "
                SELECT *
                FROM countries ";
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    $countries = mysqli_stmt_get_result($Statement);
    return $countries;
}
function getVerzend($databaseConnection)
{
    $Query = "
                SELECT *
                FROM deliverymethods ";
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    $countries = mysqli_stmt_get_result($Statement);
    return $countries;
}
function getBetaal($databaseConnection)
{
    $Query = "
                SELECT *
                FROM paymentmethods ";
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    $countries = mysqli_stmt_get_result($Statement);
    return $countries;
}

if(isset($_GET["bestel"])) {
    $email = $_GET['email'];
    $geslacht = $_GET['geslacht'];
    $vn = $_GET['vn'];
    $an = $_GET['an'];
    $beoordeling = $_GET['beoordeling'];
    $zip = $_GET['zip'];
    $hn = $_GET['huisnummer'];
    $toevoeging = $_GET['toevoeging'];
    $straat = $_GET['straat'];
    $plaats = $_GET['plaats'];
    $tel = $_GET['telnummer'];
    $vz = $_GET['vz'];
    $bm = $_GET['bm'];
    echo $email. "<br>". $geslacht. "<br>".$vn. "<br>".$an. "<br>".$beoordeling. "<br>".$zip. "<br>".$hn. "<br>".$toevoeging. "<br>".$straat. "<br>".$plaats. "<br>".$tel. "<br>".$vz. "<br>".$bm. "<br>";

    $Query = "INSERT INTO `customers` 
(`CustomerID`, `CustomerName`, `BillToCustomerID`, `CustomerCategoryID`, 
     `BuyingGroupID`, `PrimaryContactPersonID`, `AlternateContactPersonID`,
     `DeliveryMethodID`, `DeliveryCityID`, 
     `PostalCityID`, `CreditLimit`, `AccountOpenedDate`,
     `StandardDiscountPercentage`, `IsStatementSent`, `IsOnCreditHold`, `PaymentDays`,
     `PhoneNumber`, `FaxNumber`, `DeliveryRun`, `RunPosition`,
     `WebsiteURL`, `DeliveryAddressLine1`, `DeliveryAddressLine2`, `DeliveryPostalCode`, `DeliveryLocation`,
     `PostalAddressLine1`, `PostalAddressLine2`,
     `PostalPostalCode`, `LastEditedBy`, `ValidFrom`, `ValidTo`) 
 VALUES (NULL, '".$vn." ".$an."', '1', '1', NULL, '1', NULL, '".$vz."', '1', '1', NULL, '".date("Y-m-d")."', '0', '0', '0', '7',
  '".$tel."', '".$tel."', NULL, NULL, 'http://www.microsoft.com/', '".$straat."', NULL, '".$zip ."', NULL,
   '".$plaats."', NULL, '".$zip ."', '1', '".date("Y-m-d h:i:sa")."', '".date("Y-m-d h:i:sa")."')
                ";
    echo "<br>". $Query;
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);

    $Query = "INSERT INTO `orders` (`OrderID`, `CustomerID`, `SalespersonPersonID`, `PickedByPersonID`,
`ContactPersonID`, `BackorderOrderID`,
                      `OrderDate`, `ExpectedDeliveryDate`, `CustomerPurchaseOrderNumber`,
`IsUndersupplyBackordered`, `Comments`, `DeliveryInstructions`, `InternalComments`, `PickingCompletedWhen`, 
                      `LastEditedBy`, `LastEditedWhen`) 
VALUES (NULL, (SELECT max(CustomerID) FROM customers), '1', NULL, '1', NULL,
        '".date("Y-m-d")."', '".date("Y-m-d")."', NULL,
         '1', NULL, NULL, NULL, '".date("Y-m-d h:i:sa")."', (SELECT max(CustomerID) FROM customers), '".date("Y-m-d h:i:sa")."')";
    echo "<br><br>". $Query;
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
}


//    $query = "SELECT artikelnaam FROM producten
//                WHERE artikelnaam=:artikelnaam OR artikelomschrijving=:artikelomschrijving OR foto=:foto";
//    $stmt = $db->prepare($query);
//    $stmt->bindValue(':artikelnaam', $email);
//    $stmt->bindValue(':artikelomschrijving', $ao);
//    $stmt->bindValue(':foto', $ft);
//    $stmt->execute();

//    if ($stmt->rowCount() == 0) {
//        if(!$an || !$ao || !$pp || !$ft){
//            echo "De gegevens zijn niet volledig ingevuld!";
//        }
//        else{
//            $x = $v->execute(array($an, $ao,$ft));
//            echo '<div class="alert alert-success">Artikel is succesvol toegevoegd!</div><br>';
//        }
//    }
//    else{
//        echo '<div class="alert alert-danger">Je kan geen dubbele product toevoegen!</div><br>';
//    }

?>
<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>
<body>
<center><h1>Afronden bestelling</h1></center>
    <div class="row">
        <div class="col-75">
             <div class="container">
                <form action="bestellijst.php">
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
    Voornaam: <input type="text" id="email" name="vn" required>
                            Achternaam: <input type="text" id="email" name="an" required>
    <SELECT name="beoordeling" required>
        <option value="">Selecteer een land</option>
      <?php
      $countries = getCountries($databaseConnection);
      foreach ($countries as $aap) {
          echo '<option value="'.$aap["CountryID"].'">'.$aap["CountryName"].'</option>';
      }?>

       </SELECT> <br><br>
    Postcode: <input type="text" id="zip" name="zip" required><br>
    Huisnummer: <input type="text" id="huisnummer" name="huisnummer" required>
                            Toevoeging: <input type="text" id="toevoeging" name="toevoeging"><br>
    Straat: <input type="text" id="straat" name="straat" required><br>
    Plaats: <input type="text" id="plaats" name="plaats" required><br>
    Telefoonnummer: <input type="text" id="telnummer" name="telnummer" required><br>
                            Verzendmethode: <SELECT name="vz" required>
                                <option value="">Selecteer een verzendmethode</option>
                                <?php
                                $countries = getVerzend($databaseConnection);
                                foreach ($countries as $aap) {
                                    echo '<option value="'.$aap["DeliveryMethodID"].'">'.$aap["DeliveryMethodName"].'</option>';
                                }?>
                            </SELECT> <br><br>
                            Betaalmethode: <SELECT name="bm" required>
                                <option value="">Selecteer een betaalmethode</option>
                                <?php
                                $countries = getBetaal($databaseConnection);
                                foreach ($countries as $aap) {
                                    echo '<option value="'.$aap["PaymentMethodID"].'">'.$aap["PaymentMethodName"].'</option>';
                                }?>
                            </SELECT> <br><br>
    <input type="submit" name="bestel" value="Submit">
</form>


<?php
include __DIR__ . "/footer.php";

?>