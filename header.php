<!-- de inhoud van dit bestand wordt bovenaan elke pagina geplaatst -->
<?php
session_start();
include "database.php";
$databaseConnection = connectToDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NerdyGadgets</title>

    <!-- Javascript -->
    <script src="Public/JS/fontawesome.js"></script>
    <script src="Public/JS/jquery.min.js"></script>
    <script src="Public/JS/bootstrap.min.js"></script>
    <script src="Public/JS/popper.min.js"></script>
    <script src="Public/JS/resizer.js"></script>

    <!-- Style sheets-->
    <link rel="stylesheet" href="Public/CSS/style.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/typekit.css">
</head>
<body>
<div class="Background">
    <div class="row" id="Header">
        <div class="col-2"><a id="LogoA" href="index.php" >
                <img style="padding: 50px;"src="Public/Img/NerdyGadgets_Logo.png">
            </a></div>
        <div class="col-8" id="CategoriesBar">
            <ul id="ul-class">
                <?php
                $HeaderStockGroups = getHeaderStockGroups($databaseConnection);

                foreach ($HeaderStockGroups as $HeaderStockGroup) {
                    ?>
                    <li>
                        <a href="browse.php?category_id=<?php print $HeaderStockGroup['StockGroupID']; ?>"
                           class="HrefDecoration"><?php print $HeaderStockGroup['StockGroupName']; ?></a>
                    </li>
                    <?php
                }
                ?>

                <li>
                    <a href="categories.php" class="HrefDecoration">Categories</a>
                </li>
            </ul>

        </div>


<!-- code voor US3: zoeken -->

<form>

</form>
        <ul id="class-navigation">
            <li>
                <a href="browse.php" class="HrefDecoration"><i class="fas fa-search search"></i> Search</a>
                <a href="cart.php" class="HrefDecoration"><i class="fas fa-shopping-cart search"></i> Cart</a>
                <?php if(isset($_SESSION["loggedin"]) !== true){ print('<a href="inlog.php" class="HrefDecoration"><i class="fas fa-user-circle search"></i> Login</a>');}?>
                <?php if(isset($_SESSION["loggedin"]) == true){ print('<a href="logout.php" class="HrefDecoration" ><i class="fas fa-user-circle search"></i></i> Log Out</a>');}?>
                <?php if(isset($_SESSION["loggedin"]) == true){ print('<a href="profile.php" class="HrefDecoration" ><i class="fas fa-user-circle search"></i></i> Account</a>');}?>
            </li>
        </ul>

<!--        <ul id="ul-class-winkelwagen">-->
<!--            <li>-->
<!--                <a href="cart.php" class="HrefDecoration"><i class="fas fa-shopping-cart search"></i> Winkelwagen</a>-->
<!--            </li>-->
<!--        </ul>-->

<!-- einde code voor US3 zoeken -->
    </div>
    <div class="row" id="Content">
        <div class="col-12">
            <div id="SubContent">
                <br>
                <?php
                if (date("h") > 0 AND date("h") < 2   ){
                    print "<center>Je happyhour kortingscode: 'happyhour' (20%)</center>";
                    $sql_coupon = "SELECT couponcode FROM coupons WHERE couponcode = 'happyhour'";
                    $declaratie = mysqli_query($databaseConnection, $sql_coupon);
                    $rij = mysqli_num_rows($declaratie);

                    if ($rij == 0){
                        $Query = "  INSERT INTO `coupons` (`couponcode`, `couponpercentage`, `beschrijving`) VALUES ('happyhour', '20', NULL);";
                        $Statement = mysqli_prepare($databaseConnection, $Query);
                        mysqli_stmt_execute($Statement);
                    }

                } else {
                    $sql_coupon = "SELECT couponcode FROM coupons WHERE couponcode = 'happyhour'";
                    $declaratie = mysqli_query($databaseConnection, $sql_coupon);
                    $rij = mysqli_num_rows($declaratie);

                    if ($rij > 0){
                        $Query = "DELETE FROM `coupons` WHERE `coupons`.`couponcode` = 'happyhour'";
                        $Statement = mysqli_prepare($databaseConnection, $Query);
                        mysqli_stmt_execute($Statement);
                    }

                }
                ?>
