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

<!-- Profile Photo upload logic -->
<?php

// If file upload form is submitted 
$status = $statusMsg = '';
$reg_num = $_SESSION['reg_num'];
$is_student = $_SESSION['is_student'];
$is_teacher = $_SESSION['is_teacher'];
$is_nor_user = $_SESSION['is_nor_user'];
$std_id_main = $_SESSION['std_id'];
$tec_id_main = $_SESSION['tec_id'];
$nor_user_id_main = $_SESSION['nor_user_id'];
$first_name = $_SESSION['first_name'];
if (isset($_POST["submit"])) {
    $status = 'error';
    if (!empty($_FILES["image"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

            // Insert image content into database 
            // $insert = $connection->query("INSERT into students (photo) VALUES ('$imgContent') WHERE ");
            if ($is_student) {
                // $sql = "INSERT INTO `students` (`photo`) VALUES ('$imgContent') WHERE `students`.`student_id` = '$std_id_main'";
                $sql = "UPDATE `students` SET `photo` = '$imgContent' WHERE `students`.`student_id` = $std_id_main";
                $result = mysqli_query($connection, $sql);
            }
            if ($is_teacher) {
                // $sql = "INSERT INTO `teachers` (`photo`) VALUES ('$imgContent') WHERE `teachers`.`teacher_id` = '$tec_id_main'";
                $sql = "UPDATE `teachers` SET `photo` = '$imgContent' WHERE `teachers`.`teacher_id` = $tec_id_main";
                $result = mysqli_query($connection, $sql);
            }
            if ($is_nor_user) {
                // $sql = "INSERT INTO `teachers` (`photo`) VALUES ('$imgContent') WHERE `teachers`.`teacher_id` = '$tec_id_main'";
                $sql = "UPDATE `normal_user` SET `photo` = '$imgContent' WHERE `normal_user`.`user_id` = $nor_user_id_main";
                $result = mysqli_query($connection, $sql);
            }

            if ($result) {
                $status = 'success';
                $statusMsg = "File uploaded successfully.";
                header("Location: /ECC/partials/_profile.php");
            } else {
                $statusMsg = "File upload failed, please try again.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select an image file to upload.';
    }
}

// Display status message 
echo $statusMsg;
?>