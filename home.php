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

    <title>Home | ECC</title>

    <style>
        #carouselExampleIndicators {
            height: 390px;
        }

        #sliderContainer{
            height: 390px;
        }

        @media (max-width: 400px) {
            #carouselExampleIndicators {
                height: 275px;
            }
        }
    </style>
</head>

<body>

    <!-- Header Start-->
    <?php include "partials/_navbar.php" ?>

    <?php
    ?>

    <!-- Image Slider Start-->
    <!-- Welcome Heading -->
    <div class="alert alert-success mb-0 py-1" role="alert">
        <h2 id="welcome-heading" class="text-center">
            <p style="display: inline;"></p>
            <u></u>
        </h2>
    </div>

    <?php
    if (isset($_GET['loggedin']) && ($_GET['loggedin'] == 'falsepass')) {
        echo '<div class="alert alert-warning alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                Please enter correct password.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    } elseif (isset($_GET['loggedin']) && ($_GET['loggedin'] == 'invalid')) {
        echo '<div class="alert alert-danger alert-dismissible fade show py-2 fs-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                Please give correct username and password to login.
                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>


    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide my-md-4 mt-2" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div id="sliderContainer" class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slider-1.jpg" class="d-block w-100 slider-img" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider-1.jpg" class="d-block w-100 slider-img" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider-1.jpg" class="d-block w-100 slider-img" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Image Slider End-->
    <!-- Header End-->


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
            <div class="col-12 text-end">
                <a href="about.php" class="btn btn-success">See More About Us</a>
            </div>
        </div>


        <!-- Our Teacher's Section End-->
        <hr>


        <!-- Our Services Section Start -->
        <div class="container my-md-5 my-3">
            <h2 id="services-heading" class="text-center my-md-5 my-3"><u>Our Services</u></h2>
            <!-- <div class="d-flex justify-content-between"> -->
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="card text-white bg-success mb-3 p-2" style="max-width: 100%;">
                        <h3 class="card-header text-center text-light"><b>Science</b></h3>
                        <div class="card-body px-2">
                            <h5 class="card-title">Higher Math, Physics, Chemistry</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde rem sed
                                ipsum earum ipsa excepturi! Possimus excepturi illo laudantium assumenda dolorem cumque
                                dignissimos.</p>
                        </div>
                        <div class="text-start">
                            <button type="button" class="btn btn-outline-light">Read Details</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card text-white bg-secondary mb-3 p-2" style="max-width: 100%;">
                        <h3 class="card-header text-center text-light"><b>Commerce</b></h3>
                        <div class="card-body px-2">
                            <h5 class="card-title">Finance, Accounting</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde rem sed
                                ipsum earum ipsa excepturi! Possimus excepturi illo laudantium assumenda dolorem cumque
                                dignissimos.</p>
                        </div>
                        <div class="text-start">
                            <button type="button" class="btn btn-outline-light">Read Details</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card text-white bg-primary mb-3 p-2" style="max-width: 100%;">
                        <h3 class="card-header text-center text-light"><b>Arts</b></h3>
                        <div class="card-body px-2">
                            <h5 class="card-title">Amr jana nai</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde rem sed
                                ipsum earum ipsa excepturi! Possimus excepturi illo laudantium assumenda dolorem cumque
                                dignissimos.</p>
                        </div>
                        <div class="text-start">
                            <button type="button" class="btn btn-outline-light">Read Details</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <a href="about.php" class="btn btn-success">More Services</a>
                </div>
            </div>


        </div>
    </div>
    <!-- Our Services Section End-->



    <!-- Footer Start -->
    <?php include "partials/_footer.php"; ?>
    <!-- Footer End -->



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Manual JS -->
    <script src="/ECC/js/script.js"></script>
</body>

</html>