<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    $loggedin = true;
} else {
    $loggedin = false;
}
?>

<!-- INSERT INTO `contact_us` (`contact_id`, `user_id`, `teacher_id`, `student_id`, `contact_subject`, `contact_description`, `time`) VALUES (NULL, '1', '', '', 'Hello World', 'Hello World Hello World Hello World Hello World Hello World Hello World Hello World Hello World ', current_timestamp()) -->


<?php
include "partials/_dbconnect.php";

$submit = false;
$submit_fail = false;
$submit_loggedin = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if ($loggedin) {
        $submit_loggedin = true;

        $reg_num = $_SESSION['reg_num'];
        $std_id_main = $_SESSION['std_id'];
        $tec_id_main = $_SESSION['tec_id'];
        $nor_user_id_main = $_SESSION['nor_user_id'];

        $contact_subject = $_POST['subject'];
        $contact_description = $_POST['comment'];

        // Insert comment into database 'contact_us'
        $sql = "INSERT INTO `contact_us` (`reg_num`, `user_id`, `contact_subject`, `contact_description`, `time`) VALUES ('$reg_num', '$nor_user_id_main', '$contact_subject', '$contact_description', current_timestamp())";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            $submit = true;
        } else {
        }
    } else {
        $submit_loggedin = false;        
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

    <!-- Manual CSS -->
    <link rel="stylesheet" href="/ECC/style/style.css">

    <title>Contact Us | ECC</title>
</head>

<body>

    <!-- Header Start-->
    <?php include "partials/_navbar.php" ?>


    <?php
    if ($submit) {
        echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            আপনার মতামতের জন্য ধন্যবাদ।
            <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($submit_fail) {
        echo '<div class="alert alert-info alert-dismissible fade show mb-1" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
            <use xlink:href="#info-fill" />
        </svg>
        আপনার মতামতটি সাবমিট হয়নি। দয়া করে কিছুক্ষন পর আবার চেষ্টা করুন।
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        
    }
    if(!$submit_loggedin){
        echo '<div class="alert alert-info alert-dismissible fade show mb-1" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
            <use xlink:href="#info-fill" />
        </svg>
        দয়া করে লগইন করে মতামত করুন।
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

    <div class="container my-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="5" aria-describedby="comment"></textarea>
                        <em>
                            <div id="comment" class="form-text">Feel Free to Give Your Comment. We Will Try to Improve Ourselves.</div>
                        </em>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include "partials/_footer.php"; ?>
    <!-- Footer End -->



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Manual JS -->
    <script src="/ECC/js/script.js"></script>
</body>

</html>