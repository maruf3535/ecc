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


<!-- Delete Logic -->
<?php
$accept = false;
$already_inserted = false;
$delete = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tec_id = $_POST['tec_id'];

    // Delete Logic
    $delete = isset($_POST['delete']);
    if ($delete) {
        $sql_teachers = "DELETE FROM `teachers` WHERE `teachers`.`teacher_id` = '$tec_id'";
        $result_teachers = mysqli_query($connection, $sql_teachers);

        $sql_main = "DELETE FROM `main_table` WHERE `main_table`.`teacher_id` = '$tec_id'";
        $result_main = mysqli_query($connection, $sql_main);
        if ($result_teachers && $result_main) {
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

        // Delete confirmation
        if ($delete) {
            echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                Successfully deleted the teacher\'s data.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }


        // Reset Confirmation
        if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
            echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                Successfully reset!
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        // Password don't match alert
        if (isset($_GET['reset']) && $_GET['reset'] == 'false') {
            echo '<div class="alert alert-warning alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                Please Type Correct Password!
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
    </div>



    <div class="container-fluid my-5">
        <table class="table table-success table-hover table-striped caption-top py-2" id="teacherlist">
            <h3>List of Our ECC Teachers</h3>
            <thead>
                <tr>
                    <th scope="col">Serial No.</th>
                    <th scope="col">Teachers ID.</th>
                    <th scope="col">Nickname</th>
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
                    <th scope="col">HSC Result</th>
                    <th scope="col">University</th>
                    <th scope="col">Group</th>
                    <th scope="col">Subjects</th>
                    <th scope="col">Total Class</th>
                    <th scope="col">About</th>
                    <th scope="col">Time</th>
                    <th scope="col">Decission</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `teachers`";
                $result = mysqli_query($connection, $sql);
                $rows_num = mysqli_num_rows($result);
                for ($i = 1; $i <= $rows_num; $i++) {
                    $row_data = mysqli_fetch_assoc($result);
                    echo '<tr>
                        <th scope="row">' . $i . '</th>
                        <td>' . $row_data['teacher_id'] . '</td>
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
                        <td>' . $row_data['subject_group'] . '</td>
                        <td>' . $row_data['subjects'] . '</td>
                        <td>' . $row_data['total_class'] . '</td>
                        <td>' . substr($row_data['about'], 0, 40) . '</td>
                        <td>' . $row_data['join_time'] . '</td>
                        <td>                    
                            <form class="decission" action="' . $_SERVER['REQUEST_URI'] . '">
                                <input type="text" class="form-control" name="tec_id" value="' . $row_data['teacher_id'] . '" hidden>
                                    <button type="submit" class="btn btn-danger my-1 mx-1 reject" name="delete" value="reject">Delete</button>
                            </form>
                        </td>
                    </tr>';
                }

                ?>

            </tbody>
        </table>

    </div>
    <div class="container-fluid mb-2">
        <div class="row">
            <div class="col-3">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Reset All
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <!-- <a href="/ECC/partials/_reset_all_classes.php?reset=all" class="btn btn-success">Reset All Classes</a> -->
                            <form action="/ECC/partials/_reset_all_classes.php" method="POST">
                                <div class="mb-3">
                                    <label for="confirm-password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password">
                                </div>
                                <button type="submit" class="btn btn-success">Reset All Classes</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            $('#teacherlist').DataTable();
        });
    </script>


    <!-- Maual JS -->
    <script src="/ECC/partials/script.js"></script>

</body>

</html>