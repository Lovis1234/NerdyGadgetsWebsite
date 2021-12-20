<?php
include __DIR__ . "/header.php";
include "Functies.php";

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
//    echo $email. "<br>". $geslacht. "<br>".$vn. "<br>".$an. "<br>".$beoordeling. "<br>".$zip. "<br>".$hn. "<br>".$toevoeging. "<br>".$straat. "<br>".$plaats. "<br>".$tel. "<br>".$vz. "<br>".$bm. "<br>";

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

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);

    $cart = getCart($databaseConnection);

    foreach ($cart as $tamim => $stan)
    {
        $Query = "INSERT INTO `orderlines` (`OrderLineID`, `OrderID`, `StockItemID`, `Description`, `PackageTypeID`, 
    `Quantity`, `UnitPrice`, `TaxRate`, `PickedQuantity`, `PickingCompletedWhen`, `LastEditedBy`, `LastEditedWhen`) 
    VALUES (NULL, (SELECT max(OrderID) FROM orders), '".$tamim."', (SELECT MarketingComments FROM stockitems WHERE StockItemID = '".$tamim."' ), (SELECT OuterPackageID FROM stockitems WHERE StockItemID = '".$tamim.")' ), '".$stan."',
     (SELECT UnitPrice FROM stockitems WHERE StockItemID = '".$tamim."' ), (SELECT TaxRate FROM stockitems WHERE StockItemID = '".$tamim."' ), '".$stan."', '".date("Y-m-d h:i:sa")."', '1', '".date("Y-m-d h:i:sa")."')";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    }
    header("Location:voltooid.php");
}
if(isset($_GET["bestel2"])) {
    $tel = $_GET['geslacht'];
    $vz = $_GET['vz'];
    $bm = $_GET['bm'];
    $email = $_SESSION["email"];
    $idu = getProfiel($databaseConnection, $email, "id");
    $Query = "INSERT INTO `orders` (`OrderID`, `CustomerID`, `SalespersonPersonID`, `PickedByPersonID`,
`ContactPersonID`, `BackorderOrderID`,
                      `OrderDate`, `ExpectedDeliveryDate`, `CustomerPurchaseOrderNumber`,
`IsUndersupplyBackordered`, `Comments`, `DeliveryInstructions`, `InternalComments`, `PickingCompletedWhen`,
                      `LastEditedBy`, `LastEditedWhen`, `UserID`)
VALUES (NULL, (SELECT max(CustomerID) FROM customers), '1', NULL, '1', NULL,
        '".date("Y-m-d")."', '".date("Y-m-d")."', NULL,
         '1', NULL, NULL, '".$tel."', '".date("Y-m-d h:i:sa")."', (SELECT max(CustomerID) FROM customers), '".date("Y-m-d h:i:sa")."', '".$idu."')";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);

    $cart = getCart($databaseConnection);

    foreach ($cart as $tamim => $stan)
    {
        $Query = "INSERT INTO `orderlines` (`OrderLineID`, `OrderID`, `StockItemID`, `Description`, `PackageTypeID`, 
    `Quantity`, `UnitPrice`, `TaxRate`, `PickedQuantity`, `PickingCompletedWhen`, `LastEditedBy`, `LastEditedWhen`) 
    VALUES (NULL, (SELECT max(OrderID) FROM orders), '".$tamim."', (SELECT MarketingComments FROM stockitems WHERE StockItemID = '".$tamim."' ), (SELECT OuterPackageID FROM stockitems WHERE StockItemID = '".$tamim.")' ), '".$stan."',
     (SELECT UnitPrice FROM stockitems WHERE StockItemID = '".$tamim."' ), (SELECT TaxRate FROM stockitems WHERE StockItemID = '".$tamim."' ), '".$stan."', '".date("Y-m-d h:i:sa")."', '1', '".date("Y-m-d h:i:sa")."')";

        $Statement = mysqli_prepare($databaseConnection, $Query);
        mysqli_stmt_execute($Statement);
    }
    header("Location:voltooid.php");
}
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
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
    if(empty($voornaam) OR empty($achternaam) OR empty($factuurnaam) OR empty($factuurhuisnummer) OR empty($factuurstraat) OR empty($factuurpostcode) OR empty($factuurplaats) OR empty($bestelnaam) OR empty($bestelhuisnummer) OR empty($bestelstraat) OR empty($bestelpostcode) OR empty($bestelplaats)  ){
        echo '<div style="text-align: center;"><h1>Finish order</h1></div>
<div class="bestellijst">
    <table style="border= 1px solid red">
    <tr>
        <table style="text-align: center; width: 100%">
            <tr>
                <td colspan="1">
                    Before u can go further fill in, all your info in profile!
                </td>
            </tr>
            <tr>
                <td>
                    <a href="profile.php"><input type="submit" name="profile" value="Go now!"></a>
                </td>
            </tr>
        </table>
    </div>';
    }
    else{
    ?>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <body>
        <div style="text-align: center;"><h1>Finish order</h1></div>
        <div class="bestellijst">
        <h3>Contact information</h3>
        <form action="bestellijst.php">
        <table style="border= 1px solid red">
            <tr>
                <table style="text-align: center; width: 100%">
                    <tr>
                        <td>
                            <SELECT name="geslacht" required>
                                <option value="">Select your adress</option>
                                <option value="Order">Orderadress</option>
                                <option value="Invoice">Invoiceadress</option>
                            </SELECT>
                        </td>
                    </tr>
                    <tr>
                        <table style="text-align: left; width: 100%">
                            <tr>
                                <td>
                                    Shipping method: <SELECT name="vz" required>
                                        <option value="">Select shipping method</option>
                                        <?php
                                        $resultaat = getVmet($databaseConnection);
                                        foreach ($resultaat as $resultaten) {
                                            echo '<option value="'.$resultaten["DeliveryMethodID"].'">'.$resultaten["DeliveryMethodName"].'</option>';
                                        }?>
                                    </SELECT>
                                </td>
                                <td>
                                    Paying method: <SELECT name="bm" required>
                                        <option value="">Select paying method</option>
                                        <?php
                                        $resultaat = getBetaal($databaseConnection);
                                        foreach ($resultaat as $resultaten) {
                                            echo '<option value="'.$resultaten["PaymentMethodID"].'">'.$resultaten["PaymentMethodName"].'</option>';
                                        }?>
                                    </SELECT>
                                </td>
                            </tr>
                        </table>
                    </tr>
                </table>
            </tr>
        </table>
        <br>
        <input type="submit" name="bestel2" value="Submit" style="width: 100%">
        </form>
    <?php

}}
else{
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
<<<<<<< HEAD
<<<<<<< HEAD
<center><h1>Checkout</h1></center>
    <div class="row">
        <div class="col-75">
             <div class="container">
                <form action="bestellijst.php">
                    <div class="row">
                        <div class="col-50">
                            <h3>Contact information</h3>
    Email: <input type="text" id="email" name="email" required><br>
    Gender:
      <input type="radio" id="man" name="geslacht" value="man">
      <label for="man">Male</label>
      <input type="radio" id="vrouw" name="geslacht" value="vrouw">
      <label for="css">Female</label>
      <input type="radio" id="anders" name="geslacht" value="anders">
      <label for="anders">Other</label><br>
    First name: <input type="text" id="email" name="vn" required>
                            Surname: <input type="text" id="email" name="an" required>
    <SELECT name="beoordeling" required>
        <option value="">Select a country</option>
      <?php
      $resultaat = getCountries($databaseConnection);
      foreach ($resultaat as $resultaten) {
          echo '<option value="'.$resultaten["CountryID"].'">'.$resultaten["CountryName"].'</option>';
      }?>

       </SELECT> <br><br>
    Zip/Postal code: <input type="text" id="zip" name="zip" required><br>
    House number: <input type="text" id="huisnummer" name="huisnummer" required>
                            Toevoeging: <input type="text" id="toevoeging" name="toevoeging"><br>
    Street: <input type="text" id="straat" name="straat" required><br>
    City: <input type="text" id="plaats" name="plaats" required><br>
    Phone: <input type="text" id="telnummer" name="telnummer" required><br>
                            Shipping method: <SELECT name="vz" required>
                                <option value="">Select a shipping method</option>
=======
<div style="text-align: center;"><h1>Afronden bestelling</h1></div>
=======
    <div style="text-align: center;"><h1>Finish order</h1></div>
>>>>>>> Stan
<div class="bestellijst">
    <h3>Contact information</h3>

    <table style="border= 1px solid red">
<<<<<<< HEAD
    <tr>
        <table style="text-align: center; width: 100%">
            <tr>
                <td colspan="1">
                    First name: <input type="text" id="email" name="vn" placeholder="First name" required>
                </td>
                <td>
                    Last name: <input type="text" id="email" name="an" placeholder="Last name" required>
                </td>
                <td style="width: 14%">
                    <SELECT name="geslacht" required>
                        <option value="">Select your gender</option>
                        <option value="man">Man</option>
                        <option value="vrouw">Woman</option>
                        <option value="anders">Different</option>
                    </SELECT>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <SELECT name="beoordeling" required>
                        <option value="">Select your country</option>
                        <?php
                        $countries = getCountries($databaseConnection);
                        foreach ($countries as $aap) {
                            echo '<option value="'.$aap["CountryID"].'">'.$aap["CountryName"].'</option>';
                        }?>
                    </SELECT>
                </td>
            </tr>
            <tr>
                <td>
                    Street: <input type="text" id="straat" name="straat" placeholder="Street" required>
                </td>
                <td>
                    House number: <input type="text" id="huisnummer" name="huisnummer" placeholder="House number" required>
                </td>
                <td style="width: 14%">
                    Addition: <input type="text" id="toevoeging" name="toevoeging" placeholder="Addition">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width: 30%">
                    Zipcode: <input type="text" id="zip" name="zip" placeholder="Zipcode" required>
                </td>
                <td>
                    City: <input type="text" id="plaats" name="plaats" placeholder="City" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Email: <input type="text" id="email" name="email" placeholder="Email" required>
                </td>
                <td>
                    Telephone number: <input type="text" id="telnummer" name="telnummer" placeholder="Telephone number" required>
                </td>
            </tr>
            <tr>
                <table style="text-align: left; width: 100%">
                    <tr>
                        <td>
                            Shipping method: <SELECT name="vz" required>
                                <option value="">Select shipping method</option>
>>>>>>> Jonathan
                                <?php
                                $resultaat = getVmet($databaseConnection);
                                foreach ($resultaat as $resultaten) {
                                    echo '<option value="'.$resultaten["DeliveryMethodID"].'">'.$resultaten["DeliveryMethodName"].'</option>';
                                }?>
<<<<<<< HEAD
                            </SELECT> <br><br>
                            Payment: <SELECT name="bm" required>
                                <option value="">Select a payment method</option>
=======
                            </SELECT>
                        </td>
                        <td>
                            Paying method: <SELECT name="bm" required>
                                <option value="">Select paying method</option>
>>>>>>> Jonathan
                                <?php
                                $resultaat = getBetaal($databaseConnection);
                                foreach ($resultaat as $resultaten) {
                                    echo '<option value="'.$resultaten["PaymentMethodID"].'">'.$resultaten["PaymentMethodName"].'</option>';
                                }?>
                            </SELECT>
                        </td>
                    </tr>
                </table>
            </tr>
        </table>
    </tr>
</table>
=======
        <tr>
            <table style="text-align: center; width: 100%">
                <tr>
                    <td colspan="1">
                        First name: <input type="text" id="email" name="vn" placeholder="First name" required>
                    </td>
                    <td>
                        Last name: <input type="text" id="email" name="an" placeholder="Last name" required>
                    </td>
                    <td style="width: 14%">
                        <SELECT name="geslacht" required>
                            <option value="">Select your gender</option>
                            <option value="man">Man</option>
                            <option value="vrouw">Woman</option>
                            <option value="anders">Different</option>
                        </SELECT>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <SELECT name="beoordeling" required>
                            <option value="">Select your country</option>
                            <?php
                            $countries = getCountries($databaseConnection);
                            foreach ($countries as $aap) {
                                echo '<option value="'.$aap["CountryID"].'">'.$aap["CountryName"].'</option>';
                            }?>
                        </SELECT>
                    </td>
                </tr>
                <tr>
                    <td>
                        Street: <input type="text" id="straat" name="straat" placeholder="Street" required>
                    </td>
                    <td>
                        House number: <input type="text" id="huisnummer" name="huisnummer" placeholder="House number" required>
                    </td>
                    <td style="width: 14%">
                        Addition: <input type="text" id="toevoeging" name="toevoeging" placeholder="Addition">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 30%">
                        Zipcode: <input type="text" id="zip" name="zip" placeholder="Zipcode" required>
                    </td>
                    <td>
                        City: <input type="text" id="plaats" name="plaats" placeholder="City" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Email: <input type="text" id="email" name="email" placeholder="Email" required>
                    </td>
                    <td>
                        Telephone number: <input type="text" id="telnummer" name="telnummer" placeholder="Telephone number" required>
                    </td>
                </tr>
                <tr>
                    <table style="text-align: left; width: 100%">
                        <tr>
                            <td>
                                Shipping method: <SELECT name="vz" required>
                                    <option value="">Select shipping method</option>
                                    <?php
                                    $countries = getVerzend($databaseConnection);
                                    foreach ($countries as $aap) {
                                        echo '<option value="'.$aap["DeliveryMethodID"].'">'.$aap["DeliveryMethodName"].'</option>';
                                    }?>
                                </SELECT>
                            </td>
                            <td>
                                Paying method: <SELECT name="bm" required>
                                    <option value="">Select paying method</option>
                                    <?php
                                    $countries = getBetaal($databaseConnection);
                                    foreach ($countries as $aap) {
                                        echo '<option value="'.$aap["PaymentMethodID"].'">'.$aap["PaymentMethodName"].'</option>';
                                    }?>
                                </SELECT>
                            </td>
                        </tr>
                    </table>
                </tr>
            </table>
        </tr>
    </table>
    <br>
>>>>>>> Stan
    <input type="submit" name="bestel" value="Submit" style="width: 100%">
<?php
}
include __DIR__ . "/footer.php";
?>