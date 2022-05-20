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



    <div class="container-fluid my-5">
        <table class="table table-success table-hover table-striped caption-top py-2" id="studentlist">
            <h3>List of Our ECC Students</h3>
            <thead>
                <tr>
                    <th scope="col">Serial No.</th>
                    <th scope="col">User ID.</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `contact_us`";
                $result = mysqli_query($connection, $sql);
                $rows_num = mysqli_num_rows($result);
                for ($i = 1; $i <= $rows_num; $i++) {
                    $row_data = mysqli_fetch_assoc($result);
                    echo '<tr>
                        <th scope="row">' . $i . '</th>
                        <td>' . $row_data['user_id'] . '</td>
                        <td>' . $row_data['contact_subject'] . '</td>
                        <td>' . $row_data['contact_description'] . '</td>
                        <td>' . $row_data['time'] . '</td>
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