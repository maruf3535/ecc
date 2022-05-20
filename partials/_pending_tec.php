<!-- INSERT INTO `teachers` (`teacher_id`, `first_name`, `full_name`, `email`, `username`, `father_name`, `mother_name`, `mobile`, `permanent_address`, `university`, `subject`, `password`, `application_time`, `join_time`) VALUES (NULL, 'dsf', 'sdf', 'dsaf', 'dsa', 'd', 'sad', 'sdaf', 'dsfa', 'adf', 'sad', 'das', '', current_timestamp()) -->

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
$accept = false;
$already_inserted = false;
$delete = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $temp_tec_id = $_POST['tec_id'];
    $username = $_POST['username'];
    // Accept Logic
    $accept = isset($_POST['accept']);
    if ($accept) {
        $sql_exist = "SELECT * FROM `main_table` WHERE `username` = '$username';";
        $result_exist = mysqli_query($connection, $sql_exist);
        $rows_num_exist = mysqli_num_rows($result_exist);
        if ($rows_num_exist == 1) {
            $already_inserted = true;
        } else {
            $sql = "SELECT * FROM `temp_teacher_signup` WHERE `temp_teacher_id` = $temp_tec_id";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $row_data = mysqli_fetch_assoc($result);

                $first_name = $row_data['first_name'];
                $full_name = $row_data['full_name'];
                $email = $row_data['email'];
                $username = $row_data['username'];
                $father_name = $row_data['father_name'];
                $mother_name = $row_data['mother_name'];
                $mobile = $row_data['mobile'];
                $address = $row_data['permanent_address'];
                $gender = $row_data['gender'];
                $ssc_school = $_POST['ssc-school'];
                $ssc_result = $_POST['ssc-result'];
                $hsc_college = $_POST['hsc-college'];
                $hsc_result = $_POST['hsc-result'];
                $university = $row_data['university'];
                $group = $row_data['subject_group'];
                $subjects = $row_data['subjects'];
                $about = $row_data['about'];
                $password = $row_data['password'];
                $application_time = $row_data['time'];

                // Insert data into 'teachers table'.
                $sql_teachers = "INSERT INTO `teachers` (`first_name`, `full_name`, `email`, `username`, `father_name`, `mother_name`, `mobile`, `permanent_address`, `gender`, `ssc_school`, `ssc_result`, `hsc_college`, `hsc_result`, `university`, `subject_group`, `subjects`, `about`, `password`, `application_time`, `join_time`) VALUES ('$first_name', '$full_name', '$email', '$username', '$father_name', '$mother_name', '$mobile', '$address', '$gender', '$ssc_school', '$ssc_result', '$hsc_college', '$hsc_result', '$university', '$group', '$subjects', '$about', '$password', '$application_time', current_timestamp())";

                $result_teachers = mysqli_query($connection, $sql_teachers);


                // Select the teacher id from 'teachers table' not 'temp_teacher_id'.
                $sql_tec_id = "SELECT teacher_id FROM `teachers` ORDER BY teacher_id DESC LIMIT 1";
                $result_tec_id = mysqli_query($connection, $sql_tec_id);
                $row_tec_id_data = mysqli_fetch_assoc($result_tec_id);
                $main_tec_id = $row_tec_id_data['teacher_id'];

                // Insert data into 'main table'.
                $sql_main = "INSERT INTO `main_table` (`teacher_id`, `first_name`, `full_name`, `student_id`, `username`, `email`, `password`, `time`) VALUES ('$main_tec_id', '$first_name', '$full_name', '0', '$username', '$email', '$password', current_timestamp());";
                $result_main = mysqli_query($connection, $sql_main);

                // Insert 'teacher_id' into 'temp_class_request' table.
                $sql_temp_class_req = "INSERT INTO `temp_class_request` (`teacher_id`) VALUES ('$main_tec_id')";
                $result_temp_class_req = mysqli_query($connection, $sql_temp_class_req);

                // Delete data from 'temporary table'.
                $sql_temp = "DELETE FROM `temp_teacher_signup` WHERE `temp_teacher_signup`.`temp_teacher_id` = '$temp_tec_id'";
                $result_temp = mysqli_query($connection, $sql_temp);

                // Confirmation Alert
                if ($result_teachers && $result_main && $result_temp) {
                    $accept = true;
                }
            }
        }
    }

    // Delete Logic
    $reject = isset($_POST['reject']);
    if ($reject) {
        $sql_del = "DELETE FROM `temp_teacher_signup` WHERE `temp_teacher_signup`.`temp_teacher_id` = '$tec_id'";
        $result_del = mysqli_query($connection, $sql_del);
        if ($result_del) {
            $delete = true;
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- JQuery Plugin Data Table CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">


    <!-- Manual CSS -->
    <link rel="stylesheet" href="/ECC/style/style.css">
    <link rel="stylesheet" href="/ECC/partials/style.css">

    <title>Admin | ECC</title>
</head>

<body>

    <!-- Header Start-->
    <?php include "_navbar.php" ?>
    <?php include "_admin_nav.php" ?>

    <div class="container">
        <!-- Confirmation box -->
        <?php

        // Accept confirmation
        if ($accept) {
            echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <strong>Successfully </strong>added data into our teacherlist.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        // Alreasy inseted
        if ($already_inserted) {
            echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <strong>Successfully </strong>added data into our teacherlist. alrady
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        // Delete confirmation
        if ($delete) {
            echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                Successfully deleted the pending teachers\'s data.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
    </div>



    <div class="container-fluid my-5">
        <table class="table table-success table-hover table-striped caption-top py-2" id="pending-tec-signup">
            <h3>List of Pending Teacher's Joining Request</h3>
            <thead>
                <tr>
                    <th scope="col">Serial No.</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Father Name</th>
                    <th scope="col">Mother Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Permanent Address</th>
                    <th scope="col">Gender</th>
                    <th scope="col">SSC School</th>
                    <th scope="col">SSC Result</th>
                    <th scope="col">HSC College</th>
                    <th scope="col">HSC College</th>
                    <th scope="col">University</th>
                    <th scope="col">Study Subject</th>
                    <th scope="col">Group</th>
                    <th scope="col">Subjects</th>
                    <th scope="col">About</th>
                    <th scope="col">Time</th>
                    <th scope="col">Decission</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `temp_teacher_signup`";
                $result = mysqli_query($connection, $sql);
                $rows_num = mysqli_num_rows($result);
                for ($i = 1; $i <= $rows_num; $i++) {
                    $row_data = mysqli_fetch_assoc($result);
                    echo '<tr>
                        <th scope="row">' . $i . '</th>
                        <td>' . $row_data['first_name'] . '</td>
                        <td>' . $row_data['full_name'] . '</td>
                        <td>' . $row_data['email'] . '</td>
                        <td>' . $row_data['username'] . '</td>
                        <td>' . $row_data['father_name'] . '</td>
                        <td>' . $row_data['mother_name'] . '</td>
                        <td>' . $row_data['mobile'] . '</td>
                        <td>' . $row_data['permanent_address'] . '</td>
                        <td>' . $row_data['gender'] . '</td>
                        <td>' . $row_data['ssc_school'] . '</td>
                        <td>' . $row_data['ssc_result'] . '</td>
                        <td>' . $row_data['hsc_college'] . '</td>
                        <td>' . $row_data['hsc_result'] . '</td>
                        <td>' . $row_data['university'] . '</td>
                        <td>' . $row_data['study_subject'] . '</td>
                        <td>' . $row_data['subject_group'] . '</td>
                        <td>' . $row_data['subjects'] . '</td>
                        <td>' . substr($row_data['about'], 0, 40) . '</td>
                        <td>' . $row_data['time'] . '</td>
                        <td>                    
                            <form class="decission" action="' . $_SERVER['REQUEST_URI'] . '">
                                <input type="text" class="form-control" name="tec_id" value="' . $row_data['temp_teacher_id'] . '" hidden>
                                <input type="text" class="form-control" name="username" value="' . $row_data['username'] . '" hidden>
                                    <button type="submit" class="btn btn-success my-1 mx-1 accept" name="accept" value="accept">Accept</button>
                                    <button type="submit" class="btn btn-danger my-1 mx-1 reject" name="reject" value="reject">Reject</button>
                            </form>
                        </td>
                    </tr>';
                }

                ?>

            </tbody>
        </table>
    </div>




    <!-- Footer Start -->
    <div class="container-fluid p-0">
        <?php include "_footer.php" ?>
    </div>
    <!-- Footer End -->



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- JQuery Plugin Data Table CSS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#pending-tec-signup').DataTable();
        });
    </script>


    <!-- Maual JS -->
    <script src="/ECC/partials/script.js"></script>

</body>

</html>