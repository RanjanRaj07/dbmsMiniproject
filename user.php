<?php
session_start();
if(!isset($_SESSION['u_name'])){
    header("location: index.php");
}
require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stylesuser.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="shortcut icon" href="img/logo.jpg">
    <title>UserPage</title>
</head>
<body>
    <!--header-->
    <?php include("header.php");?>
    <!--navigation-->
    <nav class="navbar" style="background-color: #e3f2fd;" data-aos="fade-in">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="ri-leaf-fill"></i>greenpool</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="company-entry.php">CompanyEntry</a>
                <a class="nav-link" href="location-entry.php">LocationEntry</a>
                
            </div>
            </div>
            </div>
        </nav>
        <div class="date">                
        <?php
            //setting the timezone
            $tz = 'Asia/Kolkata';   
            date_default_timezone_set($tz);
            $timeZone = date_default_timezone_get();
            echo date("d-m-Y"); echo "  ";echo date("l"); echo "<br>";
            echo date("h:i:sa");
        ?>
        </div>
    </nav>
    <!--sidebar-->
    <div class="sidebar" data-aos="fade-right">
        <!----profile image---->
        <div class="profile">
            <div class="profile-img">
            <?php
                $sql = "SELECT `gender` FROM `ranjan`.`users` where `u_id`=$_SESSION[u_id];";
                $res = mysqli_query($con, $sql);
            
                mysqli_data_seek($res,14);
                // Fetch row
                $row = mysqli_fetch_row($res);
                if($row[0]=="male"){ ?>
                   <img src="img/avatar.jpg" alt="">
               <?php }
                else{?>
                    <img src="img/avatarf.jpg" alt="">
               <?php }
            ?>
            
            </div>
            <div class="name">
            <h1> <?php  echo $_SESSION['u_name']; ?> </h1>
            </div>
        </div>
        <div class="menu">
        <a href="vehical.php" >
            <span class="icon">
            <i class="ri-roadster-fill"></i>
            </span>
            your_vehical_details
        </a>
        <a href="pushrequest.php">
            <span class="icon">
                <i class="ri-steering-2-fill"></i>
            </span>
           start a drive
        </a>
        <a href="pullrequest.php">
            <span class="icon">
                <i class="ri-map-pin-add-fill"></i>
            </span>
            join a pool
        </a>
        <!-- <a href="riderates.php">
            <span class="icon">
                <i class="ri-star-fill"></i>
            </span>
             your ride ratings
        </a> -->
        </div>
    </div>
    <!--mainbox-->
    <div class="mainbox">
        <?php
            //pushed requests
            $query="SELECT r_id FROM `ranjan`.`pushrequest` where u_id='$_SESSION[u_id]' and duetime>CURRENT_TIMESTAMP;";
            $res = mysqli_query($con,$query);
            $cnt = mysqli_num_rows($res);
            // query for pulled requests
            $quer = "SELECT r_id FROM `ranjan`.`pullrequest` where u_id='$_SESSION[u_id]';";
            $resu = mysqli_query($con,$quer);
            $cntu = mysqli_num_rows($resu);
            if($cnt || $cntu){
            echo "<div class=\"box\">";
            while($cnt>0){
                $row = mysqli_fetch_row($res);
                $rid = $row[0];
                // query to find number of seats filled in pushed request
                $query1 = "SELECT COUNT(r_id) from `ranjan`.`pullrequest` where r_id='$rid';";
                $res1 = mysqli_query($con, $query1);
                $row1 = mysqli_fetch_row($res1);
                $seats = $row1[0];
                //fetching pushed request data
                $query2 = "SELECT * FROM `ranjan`.`pushrequest` where r_id='$rid' and duetime>CURRENT_TIMESTAMP;";
                $res2 = mysqli_query($con, $query2);
                $row2 = mysqli_fetch_row($res2);
                //finding actual number of seats of vehicle
                $query3 = "SELECT v_noseats,v_name from `ranjan`.`vehical` where v_id='$row2[5]';";
                $res3 = mysqli_query($con,$query3);
                $row3 = mysqli_fetch_row($res3);
                $count = $row3[0];
                echo "<div class=\"card text-bg-secondary mb-6\" style=\"width: 16rem;\" data-aos=\"zoom-in\">
                <div class=\"card-text\"><p>your drive starts @ $row2[2]</p>
                    </div>
                <img src=\"img/cars/$count$seats.png\" class=\"card-img-bottom\" >
                <div class=\"card-body\">
                    <div class=\"card-text\"><p>start point - $row2[4]
                    </br>destination - $row2[3] </br>vehical name - $row3[1]</br><i><b>have a safe drive</b></i></p>
                    </div>
                </div>
                </div>";   
                $cnt -= 1;
            }
            if ($cntu){
                while($cntu>0){
                    $row5 = mysqli_fetch_row($resu);
                    $rid = $row5[0];
                     //query for no of seats in pullled request
                    $query1 = "SELECT COUNT(r_id) from `ranjan`.`pullrequest` where r_id='$rid';";
                    $res1 = mysqli_query($con, $query1);
                    $row2 = mysqli_fetch_row($res1);
                    $seats = $row2[0];
                    //query for info of the pulled request
                    $query2 = "SELECT * FROM `ranjan`.`pushrequest` where r_id='$rid' and duetime>CURRENT_TIMESTAMP;";
                    $res2 = mysqli_query($con, $query2);
                    if(mysqli_num_rows($res2)){
                    $row3 = mysqli_fetch_row($res2);
                    //finding actual number of seats of vehicle
                    $query3 = "SELECT v_noseats from `ranjan`.`vehical` where v_id='$row3[5]';";
                    $res = mysqli_query($con,$query3);
                    $row = mysqli_fetch_row($res);
                    $count = $row[0];
                    // query for user name
                    $quer1 = "SELECT u_name FROM `ranjan`.`users` where u_id=$row3[1]";
                    $rw = mysqli_fetch_row(mysqli_query($con, $quer1));
                    $rate = '0';
                    echo "<div class=\"card text-bg-warning mb-6\" style=\"width: 16rem;\" data-aos=\"zoom-in\">
                        <div class=\"card-text\"><p>your pool starts @ $row3[2] &#160;	&#160; $row3[4]</p></div>
                        <img src=\"img/cars/$count$seats.png\" class=\"card-img-bottom\" alt=\"$count$seats.png\">
                        <div class=\"card-body\">
                            <div class=\"card-text\"><p>Owner name - $rw[0] </br>
                            phno - $row3[1]</br>
                            vehical no - $row3[5]</br>
                            destiation - $row3[3]</br>
                            <i><b>happy journy</b></i></br>
                        </div>
                    </div>
                    </div>";
                    }
                    $cntu -= 1;
                }
            }
            // closing box
            echo '</div>';
            $con->close();
            }
            else{
        ?>
        <div class="box">
            <div class="card" style="width: 18rem;">
                <img src="img/companyppl.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-text"><p>Let us Bring the Company Community together to contribute to reducing the vehicals on road
                        <br />register your company! in <u>CompanyEntry</u></p>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/place.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-text"><p>Know people in your community who are intrested in contributing to reducing the vehicals on road
                        <br />register your Location! in <u>LocationEntry</u></p>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/start.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-text"><p>Starting your Drive! </br> let people know by 
                    adding it in <u>start a drive</u> </p>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/joinpool.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-text"><p>Look for a pool to join! </br>choose it in <u>join a pool</u> </p>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/vehical.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-text"><p>Share your vehical details for better information! </br>add it in <u>your_vehical_details</u> </p>
                        </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/saving.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-text"><p>share your drive and drive expences save it!</p>
                    </div>
                </div>
            </div>
        </div> <?php } ?>
    </div>
    <?php include("footer.php");?>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration:2300
    });
  </script>
</body>
</html>
<!-- $sql = "SELECT COUNT(r_id) from pullrequest where r_id=\'12\';"; -->
<!-- $sql = "SELECT r_id FROM pushrequest where u_id=\"9740200327\";"; -->