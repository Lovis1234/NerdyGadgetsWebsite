<?php
include __DIR__ . "/header.php";
include "Functies.php";

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
<h1>&nbsp &nbsp Winkelmand</h1>


<div class="Cart" id="ResultsArea">
<?php
$superaantal = 0; //Het totaal aantal producten
$totaalprijs = 0; //Het totaalbedrag
$cart = getCart($databaseConnection); //aanroepen cart array

//Aanpassen hoeveelheid van product
if ($cart == array()) {
    print("<h2> Uw winkelmand is leeg <br>");
    print('<img src="Public/StockItemIMG/jemoeder.gif" style="height: 25%; width: 25%" >');
}

if(isset($_GET["doorgaan"])) {//controleren of $stockItemID(=key!) al in array staat
    print("Het product is verwijdert!");
}
if(isset($_GET["button-minder"])) {
    if( $cart[$_GET["idprod"]] != 1){
        $cart[$_GET["idprod"]] -= 1;
        saveCart($cart,$databaseConnection);
        header("Location:Cart.php");
    }
    else
    {
        header('Location:verwijder.php?idprod='.$_GET["idprod"]);
    }
}
elseif (isset($_GET["button-meer"])){
    $cart[$_GET["idprod"]] += 1;
    saveCart($cart,$databaseConnection);
    header("Location:Cart.php");
}
//einde van aanpassen hoeveelheid product

foreach ($cart as $artikel => $aantal){
    $StockItem = getStockItem($artikel, $databaseConnection);
    $StockItemImage = getStockItemImage($artikel, $databaseConnection);
    $artikelprijstotaal = $StockItem['SellPrice']*$aantal;
    $totaalprijs = $totaalprijs+$artikelprijstotaal;
    $superaantal = $superaantal+$aantal;
    ?>
    <hr style="border: 1px solid white">

    <div class="CartProductFrame">
        <?php
        if (isset($StockItemImage)) {
            if (count($StockItemImage) == 0) {
                ?>
                <div id="CartImageFrame"
                     style="background-image: url('Public/StockItemIMG/GeenAfbeelding.jpg'); background-size: 200px; background-repeat: no-repeat; background-position: center;"></div>
                <?php
            }
        // één plaatje laten zien
        if (count($StockItemImage) >= 1) {
            ?>
            <div id="CartImageFrame"
                 style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-size: 200px; background-repeat: no-repeat; background-position: center;"></div>
            <?php
        }
        }
    ?>
        <div class="CartNaamArtikel">
            <a id="NaamArtikel" href='view.php?id=<?php print($artikel); ?>'></i> <?php print $StockItem['StockItemName']; ?></a>
        </div>
        <div class="CartArtikelNr">
            <a id="Artikelnummer">Artikelnummer: <?php print($artikel);?></a>
        </div>
        <div class="CartHoeveelheid">
            <form method="get" action="Cart.php" id="CartHoeveelheidArtikel">
                <input type="hidden" name="idprod" value="<?php print($artikel); ?>">
                <input type="submit" name="button-minder" value="-" id="CartPlusMin">
                <input id="CartAantal" type="text" name="aantal" value="<?php print($aantal); ?>" disabled>
                <input type="submit" name="button-meer" value="+" id="CartPlusMin">
                <a id="CartBin" href='verwijder.php?idprod=<?php print($artikel); ?>'><i class="bi-trash-fill search"></i></a>
            </form>
        </div>
        <div class="CartPrijzen">
            <a id="CartTotPrijsStuk"></i><?php print sprintf("Totaal prijs: € %.2f", $artikelprijstotaal); ?></a>
            <a id="CartTotBTWStuk"></i><?php print sprintf("Waarvan BTW: € %.2f", ($artikelprijstotaal/100*$StockItem['TaxRate'])); ?></a>

            <a id="CartPrijsStuk"></i><?php print sprintf("Prijs per stuk: € %.2f", $StockItem['SellPrice']); ?></a>
            <a id="CartBTWStuk"></i><?php print sprintf("Waarvan BTW: € %.2f", ($StockItem['SellPrice']/100*$StockItem['TaxRate'])); ?></a>
<!--            <script>-->
<!--                $("#apply").click(function(){-->
<!--                    if($('#promo_code').val()!=''){-->
<!--                        $.ajax({-->
<!--                            type: "POST",-->
<!--                            url: "process.php",-->
<!--                            data:{-->
<!--                                coupon_code: $('#coupon_code').val()-->
<!--                            },-->
<!--                            success: function(dataResult){-->
<!--                                var dataResult = JSON.parse(dataResult);-->
<!--                                if(dataResult.statusCode==200){-->
<!--                                    var after_apply=$('#total_price').val()-dataResult.value;-->
<!--                                    $('#total_price').val(after_apply);-->
<!--                                    $('#apply').hide();-->
<!--                                    $('#edit').show();-->
<!--                                    $('#message').html("Promocode applied successfully !");-->
<!---->
<!--                                }-->
<!--                                else if(dataResult.statusCode==201){-->
<!--                                    $('#message').html("Invalid promocode !");-->
<!--                                }-->
<!--                            }-->
<!--                        });-->
<!--                    }-->
<!--                    else{-->
<!--                        $('#message').html("Promocode can not be blank .Enter a Valid Promocode !");-->
<!--                    }-->
<!--                });-->
<!--                $("#edit").click(function(){-->
<!--                    $('#coupon_code').val("");-->
<!--                    $('#apply').show();-->
<!--                    $('#edit').hide();-->
<!--                    location.reload();-->
<!--                });-->
<!--            </script>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div style="height: 160px"/>-->
<?php
    }
?>

</div>
<a id="CartTotaalArtikelen">Aantal producten in winkelmand: </i><?php print($superaantal);?></a>

<div class="CartAfronden">
    <a id="CartTotaalPrijs">Totaalprijs: </i><?php print(sprintf("€%.2f", $totaalprijs));?></a>
    <?php
    if($totaalprijs == 0) {
        ?><a id="CartTotaalBTWPrijs"></i>Waarvan BTW: €0</a><?php
    } else {
        ?> <a id="CartTotaalBTWPrijs"></i><?php print sprintf("Waarvan BTW: € %.2f", ($totaalprijs/100*$StockItem['TaxRate'])); ?></a><?php
    }
    ?>

    <form action="browse.php" method="get">
        <input type="submit" name="button" value="Verder winkelen" class="button2" style="float: left;">
    </form>
    <form action="bestellijst.php" method="get">
    <?php if ($cart !== array()) {
        print('<input type="submit" name="button" value="Bestelling afronden" class="button2" style="float: right;">');
     } ?>
    </form>
    <div class="container">
        <h2></h2>

        <div class="form-group">
            <label for="email">Total Price:</label>
            <input type="text" class="form-control" id="total_price" name="total_price" value="1000.00">
        </div>
        <div class="form-group">
            <label for="promo_code">Apply Promocode:</label>
            <input type="text" class="form-control" id="coupon_code" placeholder="Apply Promocode" name="coupon_code">
            <b><span id="message" style="color:green;"></span></b>
        </div>

        <button id="apply" class="btn btn-default">Apply</button>
        <button id="edit" class="btn btn-default" style="display:none;">Edit</button>

    </div>

</div>
</body>
</html>
<?php
