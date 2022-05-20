<!-- INSERT INTO `notice` (`notice_id`, `teacher_id`, `notice_title`, `notice_description`, `notice_for`, `time`) VALUES (NULL, '26', 'Chemistry Class', 'abc', 'XI', current_timestamp()) -->

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


<!-- Post a notice -->
<?php
$post_notice = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the teacher id from 'login.php'
    $tec_id_main = $_SESSION['tec_id'];
    $tec_first_name = $_SESSION['tec_first_name'];
    $notice_title = $_POST['notice-title'];
    $notice_description = $_POST['notice-description'];
    $notice_for = $_POST['notice-for'];
    $sql = "INSERT INTO `noticelist` (`teacher_id`, `teacher_name`, `notice_title`, `notice_description`, `notice_for`, `time`) VALUES ('$tec_id_main', '$tec_first_name', '$notice_title', '$notice_description', '$notice_for', current_timestamp())";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $post_notice = true;
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

    <title>Notice | ECC</title>
</head>

<body>

    <!-- Header Start-->
    <?php include "_navbar.php" ?>


    <!--Confirmation Alert -->
    <?php
    if ($post_notice) {
        echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        Notice successfully updated!
        <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>


    <div class="container my-3">
        <h2 class="text-center my-3"><u>Notice Board</u></h2>

        <!-- Post a notice -->
        <?php
        $is_teacher = $_SESSION['is_teacher'];
        if ($is_teacher) {
            echo '<div class="row mb-5">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <em class="fs-5">Post a Notice.</em>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
                                        <div class="mb-2">
                                            <label for="notice-title" class="form-label">Title *</label>
                                            <input type="text" class="form-control" id="notice-title" name="notice-title" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="notice-description" class="form-label">Description *</label>
                                            <textarea class="form-control" id="notice-description" name="notice-description" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-2">
                                        <label for="notice-for" class="form-label">For </label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <select class="form-select" aria-label="Default select example" id="notice-for" name="notice-for" required>
                                                        <option value="XI">XI</option>
                                                        <option value="XII">XII</option>
                                                    </select>                                        
                                                </div>
                                                <div class="col-2 ">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="col-3"></div>
            </div>';
        }
        ?>


        <!-- Show the notices -->
        <?php

        $reg_num = $_SESSION['reg_num'];

        $sql = "SELECT * FROM `noticelist`";
        $result = mysqli_query($connection, $sql);
        $rows_num = mysqli_num_rows($result);
        for ($i = 0; $i < $rows_num; $i++) {
            for ($i = 0; $i < $rows_num; $i++) {
                $row_data = mysqli_fetch_assoc($result);
                $tec_id = $row_data['teacher_id'];
                $teacher_name = $row_data['teacher_name'];
                $title = $row_data['notice_title'];
                $description = $row_data['notice_description'];
                $notice_id = $row_data['notice_id'];
                $time = $row_data['time'];
                echo '<div class="alert" role="alert" style="border: 0.1px solid #9ca0a3;">
                <div class="row">
                    <div class="col-md-2 col-12 text-center">'; ?>


                <!-- Show the profile picture Start -->
                <?php
                $result1 = $connection->query("SELECT photo FROM teachers WHERE `teacher_id` = '$tec_id'");

                ?>
                <?php if ($result1->num_rows > 0) {
                ?>
                    <div class="gallery">
                        <?php while ($row = $result1->fetch_assoc()) { ?>
                            <?php
                            // echo var_dump($row['photo']);
                            if ($row['photo'] == '') {
                                echo '<img src="/ECC/img/user.png" alt="" style="height: 60px; width:60px;">';
                            } else { ?>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" style="height: 60px; width: 60px; border-radius: 50%;">

                            <?php } ?>
                            <!-- <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" style="height: 105px; width: 105px; border-radius: 50%;" /> -->

                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <img src="/ECC/img/user.png" alt="" style="height: 105px; width:auto;">
                <?php } ?>
                <!-- <img src="/ECC/img/user.png" class="img-fluid rounded-start" alt="..." width="40px"> -->

                <!-- Show the profile picture End -->



        <?php
                echo '<h5 class="m-0 text-center">' . $teacher_name . ' Sir</h5>
                        <p class="m-0" style="font-size: 14px;">' . date("F j, Y, g:i a", strtotime($time)) . '</p>
                    </div>
                    <div class="col-md-10 col-12">
                        <h4 class="alert-heading">' . $title . '</h4>
                        <p>' . substr($description, 0, 400) . '... <a href="/ECC/partials/_notice.php?notice_id=' . $notice_id . '">Full Notice</a></p>
                    </div>
                </div>
            </div>';
            }
        }
        ?>



    </div>


    <!-- Footer Start -->
    <div class="container-fluid p-0">
        <?php include "_footer.php" ?>
    </div>
    <!-- Footer End -->



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- JQuery Plugin Data Table CSS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#studentlist').DataTable();
        });
    </script>


    <!-- Maual JS -->
    <script src="/ECC/partials/script.js"></script>

</body>

</html>