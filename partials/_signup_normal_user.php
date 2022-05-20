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

    <title>User Signup Form | ECC</title>
</head>

<body>


    <?php include "_navbar.php"; ?>


    <!-- Confirmation Alert -->
    <?php
    $user_exist = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first-name'];
        $full_name = $_POST['full-name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $mobile = $_POST['mobile'];
        $gender = $_POST['gender'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];

        if ($pass == $cpass) {
            $sql = "SELECT * FROM `main_table` WHERE `username` = '$username'";
            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) == 1) {
                $user_exist = true;
            } else {
                $pass = password_hash($pass, PASSWORD_DEFAULT);

                // Insert into 'normal_user' table.
                $sql = "INSERT INTO `normal_user` (`first_name`, `full_name`, `email`, `username`, `mobile`, `gender`, `password`, `time`) VALUES ('$first_name', '$full_name', '$email', '$username', '$mobile', '$gender', '$pass', current_timestamp());";
                $result = mysqli_query($connection, $sql);

                // Select the user_id from 'normal_user table'.
                $sql_user_id = "SELECT `user_id` FROM `normal_user` ORDER BY `user_id` DESC LIMIT 1";
                $result_user_id = mysqli_query($connection, $sql_user_id);
                $row_user_id_data = mysqli_fetch_assoc($result_user_id);
                $main_user_id = $row_user_id_data['user_id'];

                // Insert data into 'main table'.
                $sql_main = "INSERT INTO `main_table` (`first_name`, `full_name`, `normal_user_id`, `username`, `email`, `password`, `time`) VALUES ('$first_name', '$full_name', '$main_user_id', '$username', '$email', '$pass', current_timestamp());";
                $result_main = mysqli_query($connection, $sql_main);

                // Confirmation Alert
                if ($result) {
                    echo '<div class="alert alert-success alert-dismissible fade show py-2 fs-5" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        আপনার ফরমটি সাবমিট হয়েছে। এখর আপনি লগইন করতে পারেন।
                        <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                } else {
                    echo '<div class="alert alert-info alert-dismissible fade show mb-1" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                            <use xlink:href="#info-fill" />
                        </svg>
                        আপনার ফরমটি সাবমিট হয়নি। দয়া করে কিছুক্ষন পর আবার চেষ্টা করুন।
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

    if($user_exist){
        echo '<div class="alert alert-success alert-dismissible fade show mb-1" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                এই নামের ইউজার ইতোমধ্যে রয়েছে। দয়া করে নতুন কোনো ইউজার নেম দিয়ে পুনরায় চেষ্টা করুন।
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }

    ?>
    <h2 class="text-center mt-4" id="signup-heading">রেজিস্ট্রেশন ফরম</h2>
    <p class="text-center"><b>সঠিক তথ্য দিয়ে ফরমটি পূরণ করুন, অন্যথায় আপনার ভর্তি ফরমটি বাতিল হয়ে যাবে।</b></p>
    <div class="container my-3">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="first-name" class="form-label">Nickname *</label>
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
                        <label for="mobile" class="form-label">Mobile *</label>
                        <input type="number" class="form-control" id="personal-mobile" name="mobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender *</label>
                        <select class="form-select" aria-label="Default select example" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
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