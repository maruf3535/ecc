<!-- INSERT INTO `news_feed_reply` (`reply_id`, `news_id`, `student_id`, `teacher_id`, `news_reply`, `time`) VALUES (NULL, '1', '1', '', 'Ami maruf ata hosse reply of news_id = 1', current_timestamp()) -->


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
    $news_id = $_GET['news_id'];
    $news_question = $_POST['news-question'];
    // Get the 'teacher id' or 'student id' from 'login.php'
    $is_teacher = $_SESSION['is_teacher'];
    $is_student = $_SESSION['is_student'];
    if ($is_student) {
        $std_id_main = $_SESSION['std_id'];
        $std_first_name = $_SESSION['std_first_name'];
        $sql = "INSERT INTO `news_feed_reply` (`news_id`, `student_id`, `news_reply`, `time`) VALUES ('$news_id', '$std_id_main', '$news_question', current_timestamp())";
    }
    if ($is_teacher) {
        $tec_id_main = $_SESSION['tec_id'];
        $tec_first_name = $_SESSION['tec_first_name'];
        $sql = "INSERT INTO `news_feed_reply` (`news_id`, `teacher_id`, `news_reply`, `time`) VALUES ('$news_id', '$tec_id_main', '$news_question', current_timestamp())";
    }

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

    <title>Newsfeed | ECC</title>
</head>

<body>

    <!-- Header Start-->
    <?php include "_navbar.php" ?>


    <div class="container my-3">
        <h2 class="text-center my-3"><u>Notice Board</u></h2>






        <!-- Show the notice -->
        <?php

        $is_student = $_SESSION['is_student'];
        $is_teacher = $_SESSION['is_teacher'];
        $reg_num = $_SESSION['reg_num'];
        $std_id_main = $_SESSION['std_id'];
        $tec_id_main = $_SESSION['tec_id'];
        // $full_name = $_SESSION['full_name'];

        $news_id = $_GET['news_id'];
        $sql = "SELECT * FROM `news_feed` WHERE `news_id` = '$news_id'";
        $result = mysqli_query($connection, $sql);
        $rows_num = mysqli_num_rows($result);
        $row_data = mysqli_fetch_assoc($result);
        $std_id = $row_data['student_id'];
        $tec_id = $row_data['teacher_id'];

        echo '<div class="alert" role="alert" style="border: 0.1px solid #9ca0a3;">
            <div class="row">
                <div class="col-lg-2 col-sm-12 text-center">'; ?>



        <!-- Show the profile picture Start -->

        <!-- For  Students -->
        <?php
        if ($std_id != '0') {
            $result2 = $connection->query("SELECT * FROM students WHERE `student_id` = '$std_id'");
        }
        ?>
        <?php if ($result2->num_rows > 0) {
        ?>
            <div class="gallery">
                <?php while ($row = $result2->fetch_assoc()) {
                    $full_name = $row['full_name'];
                ?>
                    <?php
                    // echo var_dump($row['photo']);
                    if ($row['photo'] == '') {
                        echo '<img src="/ECC/img/user.png" alt="" style="height: 60px; width:60px;">';
                    } else { ?>
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" style="height: 60px; width: 60px; border-radius: 50%;">

                    <?php } ?>

                <?php } ?>
            </div>
        <?php } else { ?>
            <img src="/ECC/img/user.png" alt="" style="height: 60px; width:auto;">
        <?php } ?>
        <!-- <img src="/ECC/img/user.png" class="img-fluid rounded-start" alt="..." width="40px"> -->

        <!-- Show the profile picture End -->


        <!-- For  Teachers -->
        <?php
        if ($tec_id != '0') {
            $result2 = $connection->query("SELECT * FROM teachers WHERE `teacher_id` = '$tec_id'");
        }
        ?>
        <?php if ($result2->num_rows > 0) {
        ?>
            <div class="gallery">
                <?php while ($row = $result2->fetch_assoc()) {
                    $full_name = $row['full_name'];
                ?>
                    <?php
                    // echo var_dump($row['photo']);
                    if ($row['photo'] == '') {
                        echo '<img src="/ECC/img/user.png" alt="" style="height: 60px; width:60px;">';
                    } else { ?>
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" style="height: 60px; width: 60px; border-radius: 50%;">

                    <?php } ?>

                <?php } ?>
            </div>
        <?php } else { ?>
            <img src="/ECC/img/user.png" alt="" style="height: 60px; width:auto;">
        <?php } ?>
        <!-- <img src="/ECC/img/user.png" class="img-fluid rounded-start" alt="..." width="40px"> -->

        <!-- Show the profile picture End -->



        <?php
        echo '<h5 class="m-0 text-center fs-6">' . $full_name . '</h5>
                    <p class="m-0" style="font-size: 14px;">' . date("F j, Y, g:i a", strtotime($row_data['time'])) . '</p>
                </div>
                <div class="col-lg-10 col-sm-12">
                    <h4 class="alert-heading ">' . $row_data['news_title'] . '</h4>
                    <p>' . $row_data['news_description'] . '</p>
                </div>
            </div>
        </div>';
        ?>




        <!--Confirmation Alert -->
        <?php
        if ($post_notice) {
            echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-6" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    Your question is asked successfully! Please wait teachers will reply your question.
                    <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>


        <!-- Repley the notice -->
        <div class="row mb-5">
            <div class="col-lg-6 col-md-4 col-sm-2 col-0"></div>
            <div class="col-lg-6 col-md-8 col-sm-10 col-12">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <em class="fs-5">Ask Your Question</em>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST">
                                    <div class="mb-3">
                                        <label for="news-question" class="form-label">Question *</label>
                                        <textarea class="form-control" id="news-question" name="news-question" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ask Question</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Show the Questions -->
        <div class="row">
            <div class="col-lg-6 col-md-4 col-2"></div>
            <div class="col-lg-6 col-md-8 col-10">
                <?php

                $sql = "SELECT * FROM `news_feed_reply` WHERE `news_id` = '$news_id'";
                $result = mysqli_query($connection, $sql);

                $rows_num = mysqli_num_rows($result);
                for ($i = 0; $i < $rows_num; $i++) {
                    $row_data = mysqli_fetch_assoc($result);
                    $std_id = $row_data['student_id'];
                    $tec_id = $row_data['teacher_id'];
                    echo '<div class="alert" role="alert" style="border: 0.1px solid #dbdddf; background-color: #dbdddf; border-radius: 50px 20px;">
                            <div class="row">
                                <div class="col-sm-12 text-center">'; ?>


                    <!-- Show the profile picture Start -->

                    <!-- For  Students -->
                    <?php
                    if ($std_id != '0') {
                        $result2 = $connection->query("SELECT * FROM students WHERE `student_id` = '$std_id'");
                    }
                    ?>
                    <?php if ($result2->num_rows > 0) {
                    ?>
                        <div class="gallery">
                            <?php while ($row = $result2->fetch_assoc()) {
                                $full_name = $row['full_name'];
                            ?>
                                <?php
                                // echo var_dump($row['photo']);
                                if ($row['photo'] == '') {
                                    echo '<img src="/ECC/img/user.png" alt="" style="height: 60px; width:60px;">';
                                } else { ?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" style="height: 60px; width: 60px; border-radius: 50%;">

                                <?php } ?>

                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <img src="/ECC/img/user.png" alt="" style="height: 60px; width:auto;">
                    <?php } ?>
                    <!-- <img src="/ECC/img/user.png" class="img-fluid rounded-start" alt="..." width="40px"> -->

                    <!-- Show the profile picture End -->



                    <!-- For  Teachers -->
                    <?php
                    if ($tec_id != '0') {
                        $result2 = $connection->query("SELECT * FROM teachers WHERE `teacher_id` = '$tec_id'");
                    }
                    ?>
                    <?php if ($result2->num_rows > 0) {
                    ?>
                        <div class="gallery">
                            <?php while ($row = $result2->fetch_assoc()) {
                                $full_name = $row['full_name'];
                            ?>
                                <?php
                                // echo var_dump($row['photo']);
                                if ($row['photo'] == '') {
                                    echo '<img src="/ECC/img/user.png" alt="" style="height: 60px; width:60px;">';
                                } else { ?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" style="height: 60px; width: 60px; border-radius: 50%;">

                                <?php } ?>

                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <img src="/ECC/img/user.png" alt="" style="height: 60px; width:auto;">
                    <?php } ?>
                    <!-- <img src="/ECC/img/user.png" class="img-fluid rounded-start" alt="..." width="40px"> -->

                    <!-- Show the profile picture End -->


                <?php
                    echo '<h6 class="m-0">' . $full_name . '</h6>
                                    <p class="m-0">' . date("g:i a", strtotime($row_data['time'])) . '</p>
                                </div>
                                <div class="col-sm-12">
                                    <p>' . $row_data['news_reply'] . '</p>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>


        </div>

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