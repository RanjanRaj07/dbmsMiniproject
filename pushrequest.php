<?php
session_start();
if(!isset($_SESSION['u_name'])){
    header("location: index.php");
}
require("connection.php");
?>
<link rel="shortcut icon" href="img/logo.jpg">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="img/logo.jpg">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>StartDrive</title>
    <link rel="stylesheet" href="css/formstyles.css">
</head>
<body>

    <?php include("header.php"); ?>
    <div class="alert alert-primary" role="alert" data-aos="fade-in">
    enter the <i class="ri-steering-2-fill"></i> Drive details.....!make sure u enter your registered vehicle id
    </div>
    <!-- form container -->
    <div class="container" data-aos="zoom-in" >  
        <form action="pushrequest.php" method="POST">        
        <div class="mb-3">
            <label for="p_id" class="form-label">Drive Start Time</label>
            <input type="datetime-local" class="form-control" name="dueTime" placeholder="enter Drive start time">
        </div>
        <div class="mb-3">
            <label for="p_id" class="form-label">Drive Start Point</label>
            <input type="text" class="form-control" name="start" placeholder="enter Drive start point">
        </div>
        <div class="mb-3">
            <label for="p_id" class="form-label">Drive Destination</label>
            <input type="text" class="form-control" name="dest" placeholder="enter destination">
        </div>
        <div class="mb-3">
            <label for="p_id" class="form-label">Vehicle Number</label>
            <input type="text" class="form-control" name="v_id" placeholder="enter your vehicle number">
        </div>
        <div class="submit">
        <button type="text" class="btn btn-success" name="submit">confirm</button>
        </div>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                $query = "SELECT * FROM `ranjan`.`vehical` where u_id='$_SESSION[u_id]';";
                $res = mysqli_query($con, $query);
                $cnt = mysqli_num_rows($res);
                if(($cnt>=1)){
                    while($cnt>=1){
                        $row=mysqli_fetch_row($res);
                        if ($row[0] == $_POST['v_id'])
                            break;
                        $cnt -= 1;
                    }
                if ($cnt == 0) {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                        the vehicle is not regestered with you<a href=\"vehical.php\" class=\"alert-link\">vehical entry</a>click here to register new vehical
                    </div>";}
                
                } 
                if($cnt>0){
                $sql = "INSERT INTO `ranjan`.`pushrequest` (`u_id`, `duetime`, `destination`,`startpoint`,`v_id`) VALUES ( '$_SESSION[u_id]', '$_POST[dueTime]', '$_POST[dest]','$_POST[start]','$_POST[v_id]'); ";

                if (mysqli_query($con,$sql) == true) {
                    echo "<p>details entered succesfuly<a href=\"user.php\">back-to-user-page</a></p>";
                } else {
                    echo "error ".mysqli_error($con);
                }
                $con->close();
            }
            }
        ?>
    </div>  
    <?php include("footer.php");?>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration:2500
    });
  </script>
</body>
</html>
<!-- INSERT INTO `pushrequest` (`r_id`, `u_id`, `duetime`, `destination`) VALUES ('1', '9740200327', '18:44:51', 'ElectronicCIty'); -->
