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


// if (isset($_GET['reset'])) {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['confirm-password'];
    $temp = password_verify($password, $_SESSION['password']);
    if (password_verify($password, $_SESSION['password'])) {
        $sql = "SELECT `total_class` FROM `teachers`";
        $result = mysqli_query($connection, $sql);
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $sql_reset = "UPDATE `teachers` SET `total_class` = '0'";
            $result_reset = mysqli_query($connection, $sql_reset);
        }
        header("Location: /ECC/partials/_teacherlist.php?reset=true");
    }
    else{
        header("Location: /ECC/partials/_teacherlist.php?reset=false");
    }
}


?>
