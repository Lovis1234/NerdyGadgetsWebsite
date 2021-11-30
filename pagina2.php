<?php
include __DIR__ . "/header.php";
include "database.php";
$sql = "select * from purchaseorderlines";
$result = mysqli_query($databaseConnection, $sql);
$i          = 0;
$count = 0;
$total_rows = $result->num_rows;
$halfsize = $total_rows / 2;
$FirstArray = array();
$SecondArray = array();


while ($row = mysqli_fetch_assoc($result)){
    while ($count <= $halfsize){
        $FirstArray[] = $row['DisplayName'];
        //echo "$FirstArray[$count]";
        $count++;
    }
    $SecondArray[] = $row['DisplayName'];
    //echo "$SecondArray[$count]";

}



echo "<table>";
for($j=0; $j<count($FirstArray); $j++){
    echo "<tr><td>". $FirstArray[$j] . "</td><td>" . $SecondArray[$j] . "</td>    </tr>";
}
echo "</table>";
?>