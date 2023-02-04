<?php     
$server = "localhost";
$username = "root";
$pwd = "";
// $db = "ranjan";
$con = mysqli_connect($server, $username, $pwd);

if (!$con) {
        die("connection to this database failed due to" .
            mysqli_connect_error());
}
// else{
//     echo "connected";
// }