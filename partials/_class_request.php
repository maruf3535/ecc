<!-- INSERT INTO `temp_class_request` (`techer_id`, `class_request`, `time`) VALUES ('1', '1', current_timestamp()) -->

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
    // Accept Logic
    $accept = isset($_POST['accept']);
    if ($accept) {
        $sql = "SELECT * FROM `temp_class_request` WHERE `teacher_id` = '$tec_id'";
        $result = mysqli_query($connection, $sql);
        $row_data = mysqli_fetch_assoc($result);
        $class_request = $row_data['class_request'];

        $sql2 = "SELECT * FROM `teachers` WHERE `teacher_id` = '$tec_id'";
        $result2 = mysqli_query($connection, $sql2);
        $row_data = mysqli_fetch_assoc($result2);
        $total_class = $row_data['total_class'];
        $total_class = $total_class + $class_request;
        $sql_ins = "UPDATE `teachers` SET `total_class` = $total_class WHERE `teachers`.`teacher_id` = '$tec_id'";
        $result_ins = mysqli_query($connection, $sql_ins);
        $sql_rem = "UPDATE `temp_class_request` SET `class_request` = '0' WHERE `temp_class_request`.`teacher_id` = '$tec_id'";
        $result_rem = mysqli_query($connection, $sql_rem);
        if ($result_ins && $result_rem) {
            $accept = true;
        }
    }

    // Delete Logic
    $delete = isset($_POST['reject']);
    if ($delete) {
        $sql_teachers = "UPDATE `temp_class_request` SET `class_request` = '0' WHERE `temp_class_request`.`teacher_id` = '$tec_id'";
        $result_teachers = mysqli_query($connection, $sql_teachers);

        if ($result_teachers) {
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
            <strong>Successfully </strong>classes are added into teacher\'s account.
            <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }

        // Delete confirmation
        if ($delete) {
            echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                Successfully deleted the teacher\'s class request.
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
                    <th scope="col">Class Request</th>
                    <th scope="col">Time</th>
                    <th scope="col">Decission</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `temp_class_request`";
                $result = mysqli_query($connection, $sql);
                $rows_num = mysqli_num_rows($result);
                for ($i = 1; $i <= $rows_num; $i++) {
                    $row_data = mysqli_fetch_assoc($result);
                    echo '<tr>
                        <th scope="row">' . $i . '</th>
                        <td>' . $row_data['teacher_id'] . '</td>
                        <td>' . $row_data['class_request'] . '</td>
                        <td>' . $row_data['time'] . '</td>
                        <td>                    
                            <form class="decission" action="' . $_SERVER['REQUEST_URI'] . '">
                                <input type="text" class="form-control" name="tec_id" value="' . $row_data['teacher_id'] . '" hidden>
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
            $('#teacherlist').DataTable();
        });
    </script>


    <!-- Maual JS -->
    <script src="/ECC/partials/script.js"></script>

</body>

</html>