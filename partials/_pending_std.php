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
    $std_id = $_POST['std_id'];
    // Accept Logic
    $accept = isset($_POST['accept']);
    if ($accept) {
        $sql_exist = "SELECT student_id FROM `main_table` WHERE `student_id` = '$std_id';";
        $result_exist = mysqli_query($connection, $sql_exist);
        $rows_num_exist = mysqli_num_rows($result_exist);
        if ($rows_num_exist == 1) {
            $already_inserted = true;
        } else {
            $sql = "SELECT * FROM `temp_student_signup` WHERE `temp_student_id` = $std_id";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $row_data = mysqli_fetch_assoc($result);

                $first_name = $row_data['first_name'];
                $full_name = $row_data['full_name'];
                $email = $row_data['email'];
                $username = $row_data['username'];
                $father_name = $row_data['father_name'];
                $mother_name = $row_data['mother_name'];
                $father_mobile = $row_data['father_mobile'];
                $mother_mobile = $row_data['mother_mobile'];
                $personal_mobile = $row_data['personal_mobile'];
                $address = $row_data['present_address'];
                $class = $row_data['class'];
                $gender = $row_data['gender'];
                $ssc_school = $row_data['ssc_school'];
                $ssc_result = $row_data['ssc_result'];
                $group = $row_data['subject_group'];
                $subjects = $row_data['subjects'];
                $college = $row_data['college'];
                $exam_year = $row_data['exam_year'];
                $about = $row_data['about'];
                $password = $row_data['password'];
                $application_time = $row_data['time'];

                // Insert data into 'students table'.
                $sql_students = "INSERT INTO `students` (`first_name`, `full_name`, `email`, `username`, `father_name`, `mother_name`, `father_mobile`, `mother_mobile`, `personal_mobile`, `present_address`, `class`, `gender`, `ssc_school`, `ssc_result`, `subject_group`, `subjects`, `college`, `exam_year`, `about`, `password`, `application_time`, `admission_time`) VALUES ('$first_name', '$full_name', '$email', '$username', '$father_name', '$mother_name', '$father_mobile', '$mother_mobile', '$personal_mobile', '$address', '$class', '$gender', '$ssc_school', '$ssc_result', '$group', '$subjects', '$college', '$exam_year', '$about', '$password', '$application_time', current_timestamp())";

                $result_students = mysqli_query($connection, $sql_students);
                // echo var_dump($result_students);

                // Select the student id from 'students table' not 'temp_student_id'.
                $sql_std_id = "SELECT student_id FROM `students` ORDER BY student_id DESC LIMIT 1";
                $result_std_id = mysqli_query($connection, $sql_std_id);
                $row_std_id_data = mysqli_fetch_assoc($result_std_id);
                $main_std_id = $row_std_id_data['student_id'];

                // Insert data into 'main table'.
                
                $sql_main = "INSERT INTO `main_table` (`teacher_id`, `first_name`, `full_name`, `student_id`, `username`, `email`, `password`, `time`) VALUES ('0', '$first_name', '$full_name', '$main_std_id', '$username', '$email', '$password', current_timestamp())";
                
                $result_main = mysqli_query($connection, $sql_main);
                // echo var_dump($result_main);


                // Delete data from 'temporary table'.
                $sql_temp = "DELETE FROM `temp_student_signup` WHERE `temp_student_signup`.`temp_student_id` = '$std_id'";
                $result_temp = mysqli_query($connection, $sql_temp);

                // Confirmation Alert
                if ($result_students && $result_main && $result_temp) {
                    $accept = true;
                }
            }
        }
    }

    // Delete Logic
    $reject = isset($_POST['reject']);
    if ($reject) {
        $sql_del = "DELETE FROM `temp_student_signup` WHERE `temp_student_signup`.`temp_student_id` = '$std_id'";
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

    <!-- Confirmation box -->
    <div class="container py-2">
    <?php

    // Accept confirmation
    if ($accept) {
        echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <strong>Successfully </strong>added data into our studentlist.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }

    // Alreasy inseted
    if ($already_inserted) {
        echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <strong>Successfully </strong>added data into our studentlist.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }

    // Delete confirmation
    if ($delete) {
        echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                Successfully deleted the pending student\'s data.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>

    </div>


    <div class="container-fluid my-5">
        <table class="table table-success table-hover table-striped caption-top py-2" id="pending-std-signup">
            <h3>List of Pending Student's Admission</h3>
            <thead>
                <tr>
                    <th scope="col">Serial No.</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Father Name</th>
                    <th scope="col">Mother Name</th>
                    <th scope="col">Father Mobile</th>
                    <th scope="col">Mother Mobile</th>
                    <th scope="col">Personal Mobile</th>
                    <th scope="col">Present Address</th>
                    <th scope="col">Class</th>
                    <th scope="col">SSC School</th>
                    <th scope="col">SSC Result</th>
                    <th scope="col">Group</th>
                    <th scope="col">Subjects</th>
                    <th scope="col">College</th>
                    <th scope="col">Exam Year</th>
                    <th scope="col">About</th>
                    <th scope="col">Time</th>
                    <th scope="col">Decission</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `temp_student_signup`";
                $result = mysqli_query($connection, $sql);
                $rows_num = mysqli_num_rows($result);
                for ($i = 1; $i <= $rows_num; $i++) {
                    $row_data = mysqli_fetch_assoc($result);
                    echo '<tr>
                        <th scope="row">' . $i . '</th>
                        <td>' . $row_data['first_name'] . '</td>
                        <td>' . $row_data['full_name'] . '</td>
                        <td>' . $row_data['email'] . '</td>
                        <td>' . $row_data['father_name'] . '</td>
                        <td>' . $row_data['mother_name'] . '</td>
                        <td>' . $row_data['father_mobile'] . '</td>
                        <td>' . $row_data['mother_mobile'] . '</td>
                        <td>' . $row_data['personal_mobile'] . '</td>
                        <td>' . $row_data['present_address'] . '</td>
                        <td>' . $row_data['class'] . '</td>
                        <td>' . $row_data['ssc_school'] . '</td>
                        <td>' . $row_data['ssc_result'] . '</td>
                        <td>' . $row_data['subject_group'] . '</td>
                        <td>' . $row_data['subjects'] . '</td>
                        <td>' . $row_data['college'] . '</td>
                        <td>' . $row_data['exam_year'] . '</td>
                        <td>' . substr($row_data['about'], 0, 40) . '</td>
                        <td>' . $row_data['time'] . '</td>
                        <td>                    
                            <form class="decission" action="' . $_SERVER['REQUEST_URI'] . '">
                                <input type="text" class="form-control" name="std_id" value="' . $row_data['temp_student_id'] . '" hidden>
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
            $('#pending-std-signup').DataTable();
        });
    </script>


    <!-- Maual JS -->
    <script src="/ECC/partials/script.js"></script>

</body>

</html>