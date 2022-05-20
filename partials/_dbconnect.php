<?php

$server_name = "localhost";
$username = "root";
$password = "";
$database = "ecc";

// Create Connection with Database
$connection = mysqli_connect($server_name, $username, $password, $database);
if(!$connection){
    echo "Connection is not successful.";
}
// else{
//     echo "Connection is successful.";
// }

?>
