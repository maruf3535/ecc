<?php
if (isset($_SESSION['loggedin'])) {
    $loggedin = true;
} else {
    $loggedin = false;
}
?>

<!-- Topbar Start -->
<div class="container-fluid bg-light py-2">
    <div class="row text-dark">
        <div id="top-contact" class="col-6 fs-5"><b><u>Contact:</u> +8801934672982</b></div>
        <div class="col-6 text-end">
            <!-- <i class="fa-brands fa-facebook"></i> -->
            <!-- <i class="fa-brands fa-instagram-square"></i> -->
            <a href="https://www.facebook.com/easycoachingcentre"><img class="social-icon mx-1" src="/ECC/img/fb.png" alt=""></a>
            <!-- <a href="https://www.instagram.com/marufrafsan35/"><img class="social-icon mx-1" src="/ECC/img/ins.png" alt=""></a> -->
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start-->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark py-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php"><img id="ecc-logo" src="/ECC/img/mainlogo.jpg" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse fs-5" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-1 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" href="/ECC/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/ECC/about.php">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/ECC/services.php">SCIENCE</a></li>
                        <li><a class="dropdown-item" href="/ECC/services.php">COMMERCE</a></li>
                        <li><a class="dropdown-item" href="/ECC/services.php">ARTS</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/ECC/services.php">General Subjects</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-light" href="/ECC/contact.php">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto my-1 mb-lg-0">
                <?php
                if ($loggedin) {
                    $reg_num = $_SESSION['reg_num'];
                    $is_student = $_SESSION['is_student'];
                    $is_teacher = $_SESSION['is_teacher'];
                    $is_nor_user = $_SESSION['is_nor_user'];
                    $std_id_main = $_SESSION['std_id'];
                    $tec_id_main = $_SESSION['tec_id'];
                    $nor_user_id_main = $_SESSION['nor_user_id'];
                    $first_name = $_SESSION['first_name'];
                    if ($_SESSION['reg_num'] == '132001') {
                        echo '<li class="nav-item">
                                <a class="nav-link text-light" href="/ECC/partials/_pending_std.php">Admin</a>
                            </li>';
                    }

                    // Get the today's notices
                    include "_dbconnect.php";
                    $today_data = date("Y-m-d");
                    $sql_noticelist = "SELECT * FROM `noticelist` WHERE `data` = '$today_data'";
                    $result_noticelist = mysqli_query($connection, $sql_noticelist);
                    $notice_count = mysqli_num_rows($result_noticelist);
                    echo '<li class="nav-item dropdown">
                            <a class="nav-link text-light dropdown-toggle" href="#" id="signupDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Options
                            </a>
                            <ul class="dropdown-menu p-2" aria-labelledby="signupDropdown">
                                <li class="mb-1">
                                    <a class="nav-link text-dark p-0 fs-5" href="/ECC/partials/_profile.php">My Profile</a>
                                </li>';
                    echo '<hr>';
                    if ($is_student || $is_teacher) {
                        echo '<li class="mb-1 fs-5">
                                <a class="nav-link text-dark p-0" href="/ECC/partials/_noticelist.php">
                                    Notice <span class="badge bg-primary">' . $notice_count . '</span>
                                </button>                                    
                                </a>
                            </li>
                            <hr>
                            <li class="mb-1 fs-5">
                                <a class="nav-link text-dark p-0" href="/ECC/partials/_newsfeedlist.php">
                                    News Feed
                                </button>                                    
                                </a>
                            </li>';
                        echo '<hr>';
                    }
                    if ($is_nor_user) {
                        echo '<li class="mb-1 fs-6">
                                    <a class="nav-link text-dark p-0" href="/ECC/partials/_signup_std.php">
                                        Take Addmission
                                    </button>                                    
                                    </a>
                                </li>';
                        echo '<hr>';
                    }
                    // echo '<li class="mb-1 fs-5">
                    //         <a class="nav-link text-dark p-0" href="https://www.facebook.com/easycoachingcentre">
                    //             Post
                    //         </button>                                    
                    //         </a>
                    //     </li>
                    //     <hr>';
                    echo '<li>
                                    <a href="/ECC/partials/_logout.php"><button type="button" class="btn btn-outline-success">Logout</button></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/ECC/partials/_profile.php">Welcome ' . $_SESSION['first_name'] . '</a>
                        </li>';
                } else {
                    echo '<li class="nav-item dropdown me-2">
                            <a class="nav-link text-light dropdown-toggle" href="#" id="signupDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Signup
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="signupDropdown">
                                <li><a class="dropdown-item" href="/ECC/partials/_signup_normal_user.php">Normal User</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/ECC/partials/_signup_std.php">Student</a></li>
                                <li><a class="dropdown-item" href="/ECC/partials/_signup_tec.php">Teacher</a></li>
                            </ul>
                        </li>   
                        <li class="nav-item my-1">
                            <button type="button" class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
                        </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Confirmation Alert Icon from Bootstrap-->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
</svg>
<!-- Navbar End-->


<!-- Login modal -->
<div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Login Form -->
                <!-- <form> -->
                <form action="/ECC/partials/_login.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Welcome ' . $_SESSION['first_name'] . ' -->