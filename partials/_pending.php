<?php include "_dbconnect.php"; ?>

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
    if ($_SESSION['username'] == 'nasar22') {
    } else {
        header("Location: /ECC/home.php");
        exit();
    }
}
?>



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
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Manual CSS -->
    <link rel="stylesheet" href="/ECC/style/style.css">

    <title>Admin | ECC</title>
</head>

<body>

    <!-- Header Start-->
    <?php include "_navbar.php" ?>

    <p>This page show the pending list.</p>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- JQuery Plugin Data Table CSS -->
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        var temp = document.getElementById("std_id");
        console.log(tmep.value);
    </script>

</body>

</html>