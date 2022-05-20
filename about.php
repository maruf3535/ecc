<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    $loggedin = true;
} else {
    $loggedin = false;
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

    <title>About | ECC</title>
</head>

<body>

    <!-- Header Start-->
    <?php include "partials/_navbar.php" ?>


    <!-- Our Teacher's Section Start -->
    <div class="container my-md-5 my-1">
        <h2 id="our-teacher-heading" class="text-center my-md-5 mb-2"><u>Our Teachers</u></h2>
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-start justify-content-center mt-1">
                            <img src="img/teachers/nazmul.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-md-16 p-2">
                                <h5 class="card-title text-md-start text-center m-0">Head of ECC</h5>
                                <p>Name: Fahim Islam<br>
                                    University: Jagannath University<br>
                                    Subject: Accounting & Information Systems<br>
                                    Batch: University Batch -14<br>
                                    Session: 2018-19<br>
                                    Teacher Of Accounting & Finance</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-start">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-start justify-content-center mt-1">
                            <img src="img/teachers/payel-sir.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-md-16 p-2">
                                <h5 class="card-title text-md-start text-center m-0">Manager of ECC</h5>
                                <p>Name: Payal Bhowmick <br>
                                    University: Jagannath University<br>
                                    Subject: Mathematics<br>
                                    Batch: University Batch -14<br>
                                    Session: 2018-19<br>
                                    Teacher Of Physics & Chemistry</p>
                            </div>
                        </div>

                    </div>
                    <div class="text-start">
                    </div>
                </div>
            </div>

        </div>

        <div class="row my-3">
            <div class="col-md-4 col-12 my-2">
                <div class="card mx-auto" style="width: 80%;">
                    <img src="img/teachers/payel-sir.jpg" class="card-img-top" alt="..." height="220px">
                    <div class="card-body">
                        <p>Name: Fahim Islam<br>
                            University: Jagannath University<br>
                            Subject: Mathematics<br>
                            Batch: University Batch -14<br>
                            Session: 2018-19<br>
                            Teacher Of Physics & Chemistry</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 my-2">
                <div class="card mx-auto" style="width: 80%;">
                    <img src="img/teachers/payel-sir.jpg" class="card-img-top" alt="..." height="220px">
                    <div class="card-body">
                        <p>Name: Fahim Islam<br>
                            University: Jagannath University<br>
                            Subject: Mathematics<br>
                            Batch: University Batch -14<br>
                            Session: 2018-19<br>
                            Teacher Of Physics & Chemistry</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 my-2">
                <div class="card mx-auto" style="width: 80%;">
                    <img src="img/teachers/payel-sir.jpg" class="card-img-top" alt="..." height="220px">
                    <div class="card-body">
                        <p>Name: Fahim Islam<br>
                            University: Jagannath University<br>
                            Subject: Mathematics<br>
                            Batch: University Batch -14<br>
                            Session: 2018-19<br>
                            Teacher Of Physics & Chemistry</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-4 col-12 my-2">
                <div class="card mx-auto" style="width: 80%;">
                    <img src="img/teachers/payel-sir.jpg" class="card-img-top" alt="..." height="220px">
                    <div class="card-body">
                        <p>Name: Fahim Islam<br>
                            University: Jagannath University<br>
                            Subject: Mathematics<br>
                            Batch: University Batch -14<br>
                            Session: 2018-19<br>
                            Teacher Of Physics & Chemistry</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 my-2">
                <div class="card mx-auto" style="width: 80%;">
                    <img src="img/teachers/payel-sir.jpg" class="card-img-top" alt="..." height="220px">
                    <div class="card-body">
                        <p>Name: Fahim Islam<br>
                            University: Jagannath University<br>
                            Subject: Mathematics<br>
                            Batch: University Batch -14<br>
                            Session: 2018-19<br>
                            Teacher Of Physics & Chemistry</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 my-2">
                <div class="card mx-auto" style="width: 80%;">
                    <img src="img/teachers/payel-sir.jpg" class="card-img-top" alt="..." height="220px">
                    <div class="card-body">
                        <p>Name: Fahim Islam<br>
                            University: Jagannath University<br>
                            Subject: Mathematics<br>
                            Batch: University Batch -14<br>
                            Session: 2018-19<br>
                            Teacher Of Physics & Chemistry</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-4 col-12 my-2">
                <div class="card mx-auto" style="width: 80%;">
                    <img src="img/teachers/payel-sir.jpg" class="card-img-top" alt="..." height="220px">
                    <div class="card-body">
                        <p>Name: Fahim Islam<br>
                            University: Jagannath University<br>
                            Subject: Mathematics<br>
                            Batch: University Batch -14<br>
                            Session: 2018-19<br>
                            Teacher Of Physics & Chemistry</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 my-2">
                <div class="card mx-auto" style="width: 80%;">
                    <img src="img/teachers/payel-sir.jpg" class="card-img-top" alt="..." height="220px">
                    <div class="card-body">
                        <p>Name: Fahim Islam<br>
                            University: Jagannath University<br>
                            Subject: Mathematics<br>
                            Batch: University Batch -14<br>
                            Session: 2018-19<br>
                            Teacher Of Physics & Chemistry</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 my-2">
                <div class="card mx-auto" style="width: 80%;">
                    <img src="img/teachers/payel-sir.jpg" class="card-img-top" alt="..." height="220px">
                    <div class="card-body">
                        <p>Name: Fahim Islam<br>
                            University: Jagannath University<br>
                            Subject: Mathematics<br>
                            Batch: University Batch -14<br>
                            Session: 2018-19<br>
                            Teacher Of Physics & Chemistry</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
        



        <!-- Our Teacher's Section End-->
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