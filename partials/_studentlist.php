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


<!-- Delete Logic -->
<?php
$delete = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $std_id = $_POST['std_id'];

    // Delete Logic
    $delete = isset($_POST['delete']);
    if ($delete) {
        $sql_students = "DELETE FROM `students` WHERE `students`.`student_id` = '$std_id'";
        $result_students = mysqli_query($connection, $sql_students);

        $sql_main = "DELETE FROM `main_table` WHERE `main_table`.`student_id` = '$std_id'";
        $result_main = mysqli_query($connection, $sql_main);
        if ($result_students && $result_main) {
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
    <?php
    // Delete confirmation
    if ($delete) {
        echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                Successfully deleted the student\'s data.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>


    <div class="container-fluid my-5">
        <table class="table table-success table-hover table-striped caption-top py-2" id="studentlist">
            <h3>List of Our ECC Students</h3>
            <thead>
                <tr>
                    <th scope="col">Serial No.</th>
                    <th scope="col">Student ID.</th>
                    <th scope="col">Nickname</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Father Name</th>
                    <th scope="col">Mother Name</th>
                    <th scope="col">Father Mobile</th>
                    <th scope="col">Mother Mobile</th>
                    <th scope="col">Personal Mobile</th>
                    <th scope="col">Present Address</th>
                    <th scope="col">Class</th>
                    <th scope="col">Gender</th>
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
                $sql = "SELECT * FROM `students`";
                $result = mysqli_query($connection, $sql);
                $rows_num = mysqli_num_rows($result);
                for ($i = 1; $i <= $rows_num; $i++) {
                    $row_data = mysqli_fetch_assoc($result);
                    echo '<tr>
                        <th scope="row">' . $i . '</th>
                        <td>' . $row_data['student_id'] . '</td>
                        <td>' . $row_data['first_name'] . '</td>
                        <td>' . $row_data['full_name'] . '</td>
                        <td>' . $row_data['email'] . '</td>
                        <td>' . $row_data['username'] . '</td>
                        <td>' . $row_data['father_name'] . '</td>
                        <td>' . $row_data['mother_name'] . '</td>
                        <td>' . $row_data['father_mobile'] . '</td>
                        <td>' . $row_data['mother_mobile'] . '</td>
                        <td>' . $row_data['personal_mobile'] . '</td>
                        <td>' . $row_data['present_address'] . '</td>
                        <td>' . $row_data['class'] . '</td>
                        <td>' . $row_data['gender'] . '</td>
                        <td>' . $row_data['ssc_result'] . '</td>
                        <td>' . $row_data['subject_group'] . '</td>
                        <td>' . $row_data['subjects'] . '</td>
                        <td>' . $row_data['college'] . '</td>
                        <td>' . $row_data['exam_year'] . '</td>
                        <td>' . substr($row_data['about'], 0, 40) . '</td>
                        <td>' . $row_data['admission_time'] . '</td>
                        <td>                    
                            <form class="decission" action="' . $_SERVER['REQUEST_URI'] . '">
                                <input type="text" class="form-control" name="std_id" value="' . $row_data['student_id'] . '" hidden>
                                    <button type="submit" class="btn btn-danger my-1 mx-1 reject" name="delete" value="reject">Delete</button>
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
            $('#studentlist').DataTable();
        });
    </script>


    <!-- Maual JS -->
    <script src="/ECC/partials/script.js"></script>

</body>

</html>