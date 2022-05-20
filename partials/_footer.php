<?php
if (isset($_SESSION['loggedin'])) {
    $loggedin = true;
} else {
    $loggedin = false;
}
?>

<div class="container-fluid" style="background-color: #c3ceda;">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4 col-12">
                <h4 class="text-md-start text-center"><u>EASY COACHING CENTER</u></h4>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rerum modi voluptate dolore suscipit temporibus. Eligendi inventore minus nisi a porro, expedita officia impedit quidem commodi dicta deleniti excepturi illum adipisci vitae optio sed quisquam qui repudiandae dolorem iusto veritatis? Aliquid ratione atque dolor, similique veritatis repellat saepe, repudiandae aspernatur temporibus quam nemo ducimus assumenda placeat eos natus! Ratione, quod natus?</p>
            </div>
            <!-- <hr> -->
            <div class="col-md-4 col-12 mb-4">
                <div class="list-group">
                    <a href="/ECC/home.php" class="list-group-item list-group-item-action" aria-current="true">
                        Home
                    </a>
                    <a href="/ECC/about.php" class="list-group-item list-group-item-action">About Us</a>
                    <a href="/ECC/services.php" class="list-group-item list-group-item-action">Services</a>
                    <a href="/ECC/contact.php" class="list-group-item list-group-item-action">Contact Us</a>
                    <?php
                    include "_dbconnect.php";

                    if ($loggedin) {
                        $reg_num = $_SESSION['reg_num'];
                        $is_student = $_SESSION['is_student'];
                        $is_teacher = $_SESSION['is_teacher'];
                        $is_nor_user = $_SESSION['is_nor_user'];
                        $std_id_main = $_SESSION['std_id'];
                        $tec_id_main = $_SESSION['tec_id'];
                        $nor_user_id_main = $_SESSION['nor_user_id'];
                        $first_name = $_SESSION['first_name'];
                        echo '<a href="/ECC/partials/_signup_std.php" class="list-group-item list-group-item-action">Take Admission</a>';

                        // echo '<a href="https://www.facebook.com/easycoachingcentre" class="list-group-item list-group-item-action">Post</a>';
                        if ($is_student || $is_teacher) {
                            echo '<a href="/ECC/partials/_noticelist.php" class="list-group-item list-group-item-action">Notice</a>
                            <a href="/ECC/partials/_newsfeedlist.php" class="list-group-item list-group-item-action">News Feed</a>';
                        }
                    }

                    ?>

                </div>
            </div>
            <!-- <hr> -->
            <div class="col-md-4 col-12">
                <p>9/1-A Allama Iqbal Road,College Road, Chasara,Narayangonj, Narayanganj, Dhaka Division, Bangladesh</p>
                <div class="mapouter">
                    <div class="gmap_canvas"><iframe width="300" height="200" id="gmap_canvas" src="https://maps.google.com/maps?q=chasara,%20narayanganj,%20bangladesh&t=&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://2piratebay.org"></a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark text-light">
    <div class="container text-center py-1">Copyright&amp2022 <a href="https://www.facebook.com/easycoachingcentre">EASY COACHING CENTER</a></div>
</div>