<?php include "_dbconnect.php"; ?>

<!doctype html>
<html lang="en">

<head>
    <!--  meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Manual CSS -->
    <link rel="stylesheet" href="/ECC/style/style.css">
    <link rel="stylesheet" href="/ECC/partials/style.css">

    <title>Teacher Signup Form | ECC</title>
</head>

<body>


    <?php include "_navbar.php"; ?>

    <!-- Insert data into 'temp-techer-table' -->
    <?php
    $user_exist = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first-name'];
        $full_name = $_POST['full-name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $father_name = $_POST['father-name'];
        $mother_name = $_POST['mother-name'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $ssc_school = $_POST['ssc_school'];
        $ssc_result = $_POST['ssc_result'];
        $hsc_college = $_POST['hsc_college'];
        $hsc_result = $_POST['hsc_result'];
        $university = $_POST['university'];
        $group = $_POST['group'];
        $subjects = $_POST['subjects'];
        $about = $_POST['about'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];

        if ($pass == $cpass) {
            $sql = "SELECT * FROM `main_table` WHERE `username` = '$username'";
            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) == 1) {
                $user_exist = true;
            } else {
                $pass = password_hash($pass, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `temp_teacher_signup` (`first_name`, `full_name`, `email`, `username`, `father_name`, `mother_name`, `mobile`, `permanent_address`, `gender`, `ssc_school`, `ssc_result`, `hsc_college`, `hsc_result`, `university`, `subject_group`, `subjects`, `about`, `password`, `time`) VALUES ('$first_name', '$full_name', '$email', '$username', '$father_name', '$mother_name', '$mobile', '$address', '$gender', '$ssc_school', '$ssc_result', '$hsc_college', '$hsc_result', '$university', '$group', '$subjects', '$about', '$pass', current_timestamp())";

                $result = mysqli_query($connection, $sql);


                // Confirmation Alert
                if ($result) {
                    echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    আপনার আবেদনটি সাবমিট হয়েছে, দয়া করে আমাদের অফিসে এসে যোগাযোগ করুন।
                    <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                } else {
                    echo '<div class="alert alert-info alert-dismissible fade show mb-1" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                        <use xlink:href="#info-fill" />
                    </svg>
                    আপনার আবেদনটি সাবমিট হয়নি। দয়া করে কিছুক্ষন পর আবার চেষ্টা করুন।
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
            }
        } else {
            echo '<div class="alert alert-success alert-dismissible fade show mb-1" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    দয়া করে একই পাসওয়ার্ড দুইবার দিয়ে পুনরায় চেষ্টা করুন।
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }

    if ($user_exist) {
        echo '<div class="alert alert-success alert-dismissible fade show mb-1" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                এই নামের ইউজার ইতোমধ্যে রয়েছে। দয়া করে নতুন কোনো ইউজার নেম দিয়ে পুনরায় চেষ্টা করুন।
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }

    ?>

    <h2 class="text-center mt-4" id="signup-heading">শিক্ষকের আবেদন ফরম</h2>
    <p class="text-center"><b>সঠিক তথ্য দিয়ে আবেদন ফরমটি পূরণ করুন, অন্যথায় আপনার আবেদন ফরমটি বাতিল হয়ে যাবে।</b></p>
    <div class="container my-3">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="full-name" class="form-label">Nickname *</label>
                        <input type="text" class="form-control" id="first-name" name="first-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="full-name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="full-name" name="full-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username *</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" required>
                        <div id="usernameHelp" class="form-text">Give some numbers(1, 2, 3...) with your username to make unique.</div>
                    </div>
                    <div class="mb-3">
                        <label for="father-name" class="form-label">Father's Name *</label>
                        <input type="text" class="form-control" id="father-name" name="father-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="mother-name" class="form-label">Mother's Name *</label>
                        <input type="text" class="form-control" id="mother-name" name="mother-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile *</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Present Address *</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender *</label>
                        <select class="form-select" aria-label="Default select example" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ssc_school" class="form-label">SSC School *</label>
                        <input type="text" class="form-control" id="ssc_school" name="ssc_school" required>
                    </div>
                    <div class="mb-3">
                        <label for="ssc_result" class="form-label">SSC Result *</label>
                        <input type="number" class="form-control" id="ssc_result" name="ssc_result" placeholder="5.00" required>
                    </div>
                    <div class="mb-3">
                        <label for="hsc_college" class="form-label">HSC College *</label>
                        <input type="text" class="form-control" id="hsc_college" name="hsc_college" required>
                    </div>
                    <div class="mb-3">
                        <label for="hsc_result" class="form-label">HSC Result *</label>
                        <input type="number" class="form-control" id="hsc_result" name="hsc_result" placeholder="5.00" required>
                    </div>
                    <div class="mb-3">
                        <label for="university" class="form-label">University *</label>
                        <input type="text" class="form-control" id="university" name="university" required>
                    </div>
                    <div class="mb-3">
                        <label for="study_subject" class="form-label">Study Subject * <span style="font-size: 12px;">(Your running studying subject.)</span></label>
                        <input type="text" class="form-control" id="study_subject" name="study_subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="group" class="form-label">Subject Group *<span style="font-size: 12px;"> (Which subject group do you want to teach in ECC?)</span></label>
                        <select class="form-select" aria-label="Default select example" id="group" name="group" required>
                            <option value="Science">Science</option>
                            <option value="Commerce">Commerce</option>
                            <option value="Arts">Arts</option>
                            <option value="Arts">General</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="subjects" id="subjects-container" hidden>
                        <label for="subjects" class="form-label">Subjects *<span style="font-size: 12px;"> (Which subject/subjects do you want to teach in ECC?)</span></label>
                        <select class="form-select" id="subjects" aria-label="Default select example" onclick="subSelect()" multiple required>
                            <optgroup label="Science">
                                <option value="physics">Physics</option>
                                <option value="chemistry">Chemistry</option>
                                <option value="math">Higher Math</option>
                                <option value="biology">Biology</option>
                            </optgroup>
                            <optgroup label="Commerce">
                                <option value="finance">Finance</option>
                                <option value="accounting">Accounting</option>
                                <option value="management">Management</option>
                                <option value="marketing">Marketing</option>
                            </optgroup>
                            <optgroup label="Arts">
                                <option value="logic">Logic</option>
                                <option value="civics">Civics</option>
                                <option value="social">Social Work</option>
                                <option value="islamic">Islamic History</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="about" class="form-label">About Your Teaching Experience *</label>
                        <textarea class="form-control" placeholder="Say something about your teaching experience..." id="about" name="about" style="height: 100px" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password *</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Maual JS -->
    <script src="/ECC/partials/script.js"></script>

</body>

</html>