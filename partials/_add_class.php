<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    $loggedin = true;
} else {
    $loggedin = false;
}
if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] != 'true')) {
    header("Location: /ECC/home.php");
    exit();
}
?>

<?php include "_dbconnect.php"; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$pass = $_SERVER['confirm-password'];
echo $pass;

}


if (isset($_GET['tec_id'])) {
    $tec_id = $_GET['tec_id'];
    $sql = "SELECT * FROM `teachers` WHERE `teacher_id` = '$tec_id'";
    $result = mysqli_query($connection, $sql);
    $row_data = mysqli_fetch_assoc($result);
    $total_class = $row_data['total_class'];
    $total_class = $total_class + 1;
    $sql_ins = "UPDATE `teachers` SET `total_class` = $total_class WHERE `teachers`.`teacher_id` = '$tec_id'";
    $result = mysqli_query($connection, $sql_ins);
    header("Location: /ECC/partials/_profile.php?total_class=" . $total_class . "&add=true");
}


?>
