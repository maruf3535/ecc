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





<!-- Delete Logic -->
<?php
$delete = false;
if (isset(($_POST['std_id'])) && $_SERVER['REQUEST_METHOD'] == 'POST') {
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



// Add class confiramtion logic
$add_class_request = false;
$false_pass = false;
if (isset(($_POST['confirm-password'])) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass = $_POST['confirm-password'];

    if (password_verify($pass, $_SESSION['password'])) {
        $tec_id = $_SESSION['tec_id'];
        $sql = "SELECT * FROM `temp_class_request` WHERE `teacher_id` = '$tec_id'";
        $result = mysqli_query($connection, $sql);
        $row_data = mysqli_fetch_assoc($result);
        $class_request = $row_data['class_request'];
        $class_request = $class_request + 1;
        $sql_ins = "UPDATE `temp_class_request` SET `class_request` = $class_request WHERE `temp_class_request`.`teacher_id` = '$tec_id'";
        $result_ins = mysqli_query($connection, $sql_ins);
        $sql_ins_time = "UPDATE `temp_class_request` SET `time` = current_timestamp() WHERE `temp_class_request`.`teacher_id` = '$tec_id'";
        $result_ins = mysqli_query($connection, $sql_ins);
        if ($result_ins) {
            $add_class_request = true;
        }
    } else {
        $false_pass = true;
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

    <title>Profile | ECC</title>
</head>

<body>

    <!-- Header Start-->
    <?php include "_navbar.php" ?>

    <?php
    $reg_num = $_SESSION['reg_num'];
    $is_student = $_SESSION['is_student'];
    $is_teacher = $_SESSION['is_teacher'];
    $is_nor_user = $_SESSION['is_nor_user'];
    $std_id_main = $_SESSION['std_id'];
    $tec_id_main = $_SESSION['tec_id'];
    $nor_user_id_main = $_SESSION['nor_user_id'];
    $first_name = $_SESSION['first_name'];
    ?>


    <?php
    if ($add_class_request) {
        echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <strong>' . $first_name . '</strong> Your Class Request Added Successfully.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    if ($false_pass) {
        echo '<div class="alert alert-warning alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <strong>' . $first_name . '</strong> Please Give Correct Password!
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>


    <!-- Profile -->
    <?php

    // Get data from 'students table'.
    $sql_students = "SELECT * FROM `students` WHERE `student_id` = '$std_id_main'";
    $result_students = mysqli_query($connection, $sql_students);
    $row_data_students = mysqli_fetch_assoc($result_students);

    // Get data from 'teachers table'.
    $sql_teachers = "SELECT * FROM `teachers` WHERE `teacher_id` = '$tec_id_main'";
    $result_teachers = mysqli_query($connection, $sql_teachers);
    $row_data_teachers = mysqli_fetch_assoc($result_teachers);


    // Get data from 'normal_user table'.
    $sql_nor_user = "SELECT * FROM `normal_user` WHERE `user_id` = '$nor_user_id_main'";
    $result_nor_user = mysqli_query($connection, $sql_nor_user);
    $row_data_nor_user = mysqli_fetch_assoc($result_nor_user);
    echo '<div class="container my-3">
                <h2 class="text-center mb-3"><u>Profile</u></h2>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                        <div class="col-4">
                    ';
    ?>

    <?php
    if ($is_student) {
        $result = $connection->query("SELECT photo FROM students WHERE `student_id` = '$std_id_main'");
    }
    if ($is_teacher) {
        $result = $connection->query("SELECT photo FROM teachers WHERE `teacher_id` = '$tec_id_main'");
    }
    if ($is_nor_user) {
        $result = $connection->query("SELECT photo FROM normal_user WHERE `user_id` = '$nor_user_id_main'");
    }
    ?>
    <?php if ($result->num_rows > 0) {
    ?>
        <div class="gallery">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <?php
                // echo var_dump($row['photo']);
                if ($row['photo'] == '') {
                    echo '<img src="/ECC/img/user.png" alt="" style="height: 105px; width:auto;">';
                } else { ?>
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" style="height: 105px; width: 105px; border-radius: 50%;">

                <?php } ?>
            <?php } ?>
        </div>
    <?php } else { ?>
        <img src="/ECC/img/user.png" alt="" style="height: 105px; width:auto;">
    <?php } ?>

    </div>

    <?php
    if ($is_teacher) {
        $sql = "SELECT * FROM `teachers` WHERE `teacher_id` = '$tec_id_main'";
        $result = mysqli_query($connection, $sql);
        $row_data = mysqli_fetch_assoc($result);
        $total_class = $row_data['total_class'];
        $password = $row_data['password'];
        echo '<div class="col-8">
                <p class="my-2">Total Class of This Month: ' . $total_class . '</p>
                <div class="row">
                    <div class="col-8">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Add Class
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
                        <div class="mb-3">
                          <label for="confirm-password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="confirm-password" name="confirm-password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                        </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
                

            </div>';
    }
    ?>
    </div>

    <!-- <a id="add-class-btn" href="" class="btn btn-primary py-1 px-1 my-2">Add Class</a><br> -->


    </div>

    <div class="col-md-6 col-sm-12 my-2">
        <form action="/ECC/partials/_profile_pic_upload.php" method="post" enctype="multipart/form-data">
            <label>Upload Photo:</label>
            <input type="file" name="image"><br>
            <input type="submit" class="btn btn-primary py-1 my-1" name="submit" value="Upload">
        </form>
    </div>
    </div>



    <?php
    echo '<div class="row">
            <div class="col-md-4 mb-3">
                <label for="reg-num" class="form-label"><b>Registration Number</b></label>
                <input type="number" class="form-control " id="reg-num" value="' . $reg_num . '" readonly>
            </div>';

    // For students
    if ($is_student) {
        echo '<div class="col-md-6 mb-3">
                <label for="id-number" class="form-label"><b>ID Number</b></label>
                <input type="number" class="form-control " id="id-number" value="' . $row_data_students['student_id'] . '" readonly>
            </div>
            <div class="col-md-2 mb-3">
                <label for="full-name" class="form-label"><b>Gender</b></label>
                <input type="text" class="form-control " id="full-name" value="' . $row_data_students['gender'] . '"  readonly>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first-name" class="form-label"><b>Nickname</b></label>
                    <input type="text" class="form-control " id="first-name" value="' . $row_data_students['first_name'] . '"  readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="full-name" class="form-label"><b>Full Name</b></label>
                    <input type="text" class="form-control " id="full-name" value="' . $row_data_students['full_name'] . '"  readonly>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="email" class="form-label"><b>Email</b></label>
                    <input type="text" class="form-control " id="email"value="' . $row_data_students['email'] . '"  readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="username" class="form-label"><b>Username</b></label>
                    <input type="text" class="form-control " id="username" value="' . $row_data_students['username'] . '"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="father-name" class="form-label"><b>Father\'s Name</b></label>
                    <input type="text" class="form-control " id="father-name" value="' . $row_data_students['father_name'] . '"  readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mother-name" class="form-label"><b>Mother Name</b></label>
                    <input type="text" class="form-control " id="mother-name" value="' . $row_data_students['mother_name'] . '"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="personal-mobile" class="form-label"><b>Personal Mobile</b></label>
                    <input type="text" class="form-control " id="personal-mobile" value="' . $row_data_students['personal_mobile'] . '"  readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="father-mobile" class="form-label"><b>Father Mobile</b></label>
                    <input type="text" class="form-control " id="father-mobile"value="' . $row_data_students['father_mobile'] . '"  readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="mother-mobile" class="form-label"><b>Mother Mobile</b></label>
                    <input type="text" class="form-control " id="mother-mobile" value="' . $row_data_students['mother_mobile'] . '"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="address" class="form-label"><b>Address</b></label>
                    <textarea type="text" class="form-control " id="address" readonly>' . $row_data_students['present_address'] . '</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-12 mb-3">
                    <label for="class" class="form-label"><b>Class</b></label>
                    <input type="text" class="form-control " id="class" value="' . $row_data_students['class'] . '"  readonly>
                </div>
                <div class="col-md-2 col-sm-12 mb-3">
                    <label for="ssc-result" class="form-label"><b>SSC Result</b></label>
                    <input type="text" class="form-control " id="ssc-result" value="' . $row_data_students['ssc_result'] . '"  readonly>
                </div>
                <div class="col-md-2 cols-sm-12 mb-3">
                    <label for="group" class="form-label"><b>Group</b></label>
                    <input type="text" class="form-control " id="group" value="' . $row_data_students['subject_group'] . '"  readonly>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="subjects" class="form-label"><b>Subjects</b></label>
                    <input type="text" class="form-control " id="subjects" value="' . $row_data_students['subjects'] . '"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-12 mb-3">
                    <label for="college" class="form-label"><b>College</b></label>
                    <input type="text" class="form-control " id="college" value="' . $row_data_students['college'] . '"  readonly>
                </div>
                <div class="col-md-2 col-sm-12 mb-3">
                    <label for="exam-year" class="form-label"><b>Exam Year</b></label>
                    <input type="text" class="form-control " id="exam-year" value="' . $row_data_students['exam_year'] . '"  readonly>
                </div>
            </div>

            <div class="row">
                <div class="mb-3">
                    <label for="about" class="form-label"><b>About</b></label>
                    <textarea type="text" class="form-control " id="about" rows="5" readonly>' . $row_data_students['about'] . '</textarea>
                </div>
            </div>
            ';
    }

    // For teachers
    if ($is_teacher) {
        echo '<div class="col-md-4 mb-3">
                    <label for="id-number" class="form-label"><b>ID Number</b></label>
                    <input type="number" class="form-control " id="id-number" value="' . $row_data_teachers['teacher_id'] . '" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="first-name" class="form-label"><b>Nickname</b></label>
                    <input type="text" class="form-control " id="first-name" value="' . $row_data_teachers['first_name'] . '"  readonly>
                </div>
            </div>
            <div class="row">                
                <div class="col-md-6 mb-3">
                    <label for="full-name" class="form-label"><b>Full Name</b></label>
                    <input type="text" class="form-control " id="full-name" value="' . $row_data_teachers['full_name'] . '"  readonly>
                </div>       
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label"><b>Email</b></label>
                    <input type="text" class="form-control " id="email"value="' . $row_data_teachers['email'] . '"  readonly>
                </div>         
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="full-name" class="form-label"><b>Gender</b></label>
                    <input type="text" class="form-control " id="full-name" value="' . $row_data_teachers['gender'] . '"  readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="username" class="form-label"><b>Username</b></label>
                    <input type="text" class="form-control " id="username" value="' . $row_data_teachers['username'] . '"  readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="mobile" class="form-label"><b>Mobile</b></label>
                    <input type="text" class="form-control " id="mobile" value="' . $row_data_teachers['mobile'] . '"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="father-name" class="form-label"><b>Father\'s Name</b></label>
                    <input type="text" class="form-control " id="father-name" value="' . $row_data_teachers['father_name'] . '"  readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mother-name" class="form-label"><b>Mother Name</b></label>
                    <input type="text" class="form-control " id="mother-name" value="' . $row_data_teachers['mother_name'] . '"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="address" class="form-label"><b>Address</b></label>
                    <textarea type="text" class="form-control " id="address" readonly>' . $row_data_teachers['permanent_address'] . '</textarea>
                </div>
            </div>            
            <div class="row">                
                <div class="col-md-4 mb-3">
                    <label for="class" class="form-label"><b>University</b></label>
                    <input type="text" class="form-control " id="class" value="' . $row_data_teachers['university'] . '"  readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="group" class="form-label"><b>Group</b></label>
                    <input type="text" class="form-control " id="group" value="' . $row_data_teachers['subject_group'] . '"  readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="subjects" class="form-label"><b>Subjects</b></label>
                    <input type="text" class="form-control " id="subjects" value="' . $row_data_teachers['subjects'] . '"  readonly>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="ssc_school" class="form-label"><b>SSC School</b></label>
                    <input type="text" class="form-control " id="ssc_school" value="' . $row_data_teachers['ssc_school'] . '"  readonly>
                </div>
                <div class="col-md-6">
                    <label for="ssc_result" class="form-label"><b>SSC Result</b></label>
                    <input type="text" class="form-control " id="ssc_result" value="' . $row_data_teachers['ssc_result'] . '"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="hsc_college" class="form-label"><b>HSC College</b></label>
                    <input type="text" class="form-control " id="hsc_college" value="' . $row_data_teachers['hsc_college'] . '"  readonly>
                </div>
                <div class="col-md-6">
                    <label for="hsc_result" class="form-label"><b>HSC Result</b></label>
                    <input type="text" class="form-control " id="hsc_result" value="' . $row_data_teachers['hsc_result'] . '"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="about" class="form-label"><b>About</b></label>
                    <textarea type="text" class="form-control " id="about" rows="5" readonly>' . $row_data_teachers['about'] . '</textarea>
                </div>
            </div>
            ';
    }


    // For normal user
    if ($is_nor_user) {
        echo '<div class="col-md-4 mb-3">
                <label for="id-number" class="form-label"><b>ID Number</b></label>
                <input type="number" class="form-control " id="id-number" value="' . $row_data_nor_user['user_id'] . '" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label for="first-name" class="form-label"><b>Nickname</b></label>
                <input type="text" class="form-control " id="first-name" value="' . $row_data_nor_user['first_name'] . '"  readonly>
            </div>
            </div>
            <div class="row">                
                <div class="col-md-6 mb-3">
                    <label for="full-name" class="form-label"><b>Full Name</b></label>
                    <input type="text" class="form-control " id="full-name" value="' . $row_data_nor_user['full_name'] . '"  readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="full-name" class="form-label"><b>Gender</b></label>
                    <input type="text" class="form-control " id="full-name" value="' . $row_data_nor_user['gender'] . '"  readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="username" class="form-label"><b>Username</b></label>
                    <input type="text" class="form-control " id="username" value="' . $row_data_nor_user['username'] . '"  readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="email" class="form-label"><b>Email</b></label>
                    <input type="text" class="form-control " id="email"value="' . $row_data_nor_user['email'] . '"  readonly>
                </div>       
                <div class="col-md-4 mb-3">
                    <label for="mobile" class="form-label"><b>Mobile</b></label>
                    <input type="text" class="form-control " id="mobile" value="' . $row_data_nor_user['mobile'] . '"  readonly>
                </div>         
            </div>';
    }

    echo '</div>';

    ?>

    <!-- Footer Start -->
    <div style="height: 300px;">

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

    <!-- Maual JS -->
    <script>

    </script>


</body>

</html>