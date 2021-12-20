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
    print_r($cart);

    foreach ($cart as $tamim => $stan)
    {
        $Query = "INSERT INTO `orderlines` (`OrderLineID`, `OrderID`, `StockItemID`, `Description`, `PackageTypeID`, 
    `Quantity`, `UnitPrice`, `TaxRate`, `PickedQuantity`, `PickingCompletedWhen`, `LastEditedBy`, `LastEditedWhen`) 
    VALUES (NULL, (SELECT max(OrderID) FROM orders), '".$tamim."', (SELECT MarketingComments FROM stockitems WHERE StockItemID = '".$tamim."' ), (SELECT OuterPackageID FROM stockitems WHERE StockItemID = '".$tamim.")' ), '".$stan."',
     (SELECT UnitPrice FROM stockitems WHERE StockItemID = '".$tamim."' ), (SELECT TaxRate FROM stockitems WHERE StockItemID = '".$tamim."' ), '".$stan."', '".date("Y-m-d h:i:sa")."', '1', '".date("Y-m-d h:i:sa")."')";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    }

}




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
                                <?php
                                $resultaat = getVerzend($databaseConnection);
                                foreach ($resultaat as $resultaten) {
                                    echo '<option value="'.$resultaten["DeliveryMethodID"].'">'.$resultaten["DeliveryMethodName"].'</option>';
                                }?>
                            </SELECT> <br><br>
                            Payment: <SELECT name="bm" required>
                                <option value="">Select a payment method</option>
                                <?php
                                $resultaat = getBetaal($databaseConnection);
                                foreach ($resultaat as $resultaten) {
                                    echo '<option value="'.$resultaten["PaymentMethodID"].'">'.$resultaten["PaymentMethodName"].'</option>';
                                }?>
                            </SELECT> <br><br>
    <input type="submit" name="bestel" value="Submit">
</form>


<?php
include __DIR__ . "/footer.php";
?>