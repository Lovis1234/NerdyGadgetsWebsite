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
                    <a href="categories.php" class="HrefDecoration">Alle categorieën</a>
                </li>
            </ul>

        </div>


<!-- code voor US3: zoeken -->

<form>

</form>
        <ul id="class-navigation">
            <li>
                <a href="browse.php" class="HrefDecoration"><i class="fas fa-search search"></i> Zoeken</a>
                <a href="cart.php" class="HrefDecoration"><i class="fas fa-shopping-cart search"></i> Winkelmand</a>
                <?php if(isset($_SESSION["loggedin"]) !== true){ print('<a href="inlog.php" class="HrefDecoration"><i class="fas fa-user-circle search"></i> Log in</a>');}?>
                <?php if(isset($_SESSION["loggedin"]) == true){ print('<a href="logout.php" class="HrefDecoration" ><i class="fas fa-user-circle search"></i></i> Log uit</a>');}?>
                <?php if(isset($_SESSION["loggedin"]) == true){ print('<a href="profile.php" class="HrefDecoration" ><i class="fas fa-user-circle search"></i></i> Mijn profiel</a>');}?>
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