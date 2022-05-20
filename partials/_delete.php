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
} else {
    if ($_SESSION['reg_num'] == '132001') {
    } else {
        header("Location: /ECC/home.php");
        exit();
    }
}
?>

<?php include "_dbconnect.php"; ?>


<!-- Accept and Reject Logic -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $std_id = $_POST['std_id'];
    echo $std_id;
    $reject = isset($_POST['reject']);
    $accept = isset($_POST['accept']);
    if($reject){
        $sql = "DELETE FROM `temp_student_signup` WHERE `temp_student_signup`.`student_id` = '$std_id'";
        $result = mysqli_query($connection, $sql);
        if($result){
            echo "Deleted from temp student table";
        }
        else{
            echo "not Deleted from temp student table";
        }

    }
}
?>