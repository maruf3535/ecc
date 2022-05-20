<?php
include "_dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM `main_table` WHERE `username` = '$username'";
    $result = mysqli_query($connection, $sql);
    $rows_num = mysqli_num_rows($result);
    if ($rows_num == 1) {
        $row_data = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row_data['password'])) {
            $first_name = $row_data['first_name'];
            $reg_num = $row_data['registration_number'];
            session_start();
            $_SESSION['is_student'] = false;
            $_SESSION['is_teacher'] = false;
            $_SESSION['is_nor_user'] = false;

            // Check login member is student or teacher or normal user.
            $std_id_main = $row_data['student_id'];
            $tec_id_main = $row_data['teacher_id'];
            $nor_user_id_main = $row_data['normal_user_id'];
            $full_name = $row_data['full_name'];
            $password = $row_data['password'];
            if ($std_id_main != 0) {
                // echo "I am a student";
                $_SESSION['is_student'] = true;
                $_SESSION['std_first_name'] = $row_data['first_name'];
            }
            if ($tec_id_main != 0) {
                // echo "I am a teacher";
                $_SESSION['is_teacher'] = true;
                $_SESSION['tec_first_name'] = $row_data['first_name'];
            }
            if ($nor_user_id_main != 0) {
                $_SESSION['is_nor_user'] = true;
                $_SESSION['nor_user_first_name'] = $row_data['first_name'];
            }

            $_SESSION['loggedin'] = true;
            $_SESSION['reg_num'] = $reg_num;
            $_SESSION['std_id'] = $std_id_main;
            $_SESSION['tec_id'] = $tec_id_main;
            $_SESSION['nor_user_id'] = $nor_user_id_main;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            header("location: /ECC/home.php");
        } else {
            header("Location: /ECC/home.php?loggedin=falsepass");
        }
    } else {
        header("Location: /ECC/home.php?loggedin=invalid");
    }
}
