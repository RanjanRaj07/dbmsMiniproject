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
    <link rel="shortcut icon" href="img/logo.jpg">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>company-entry</title>
    <link rel="stylesheet" href="css/formstyles.css">
</head>
<body>

    <?php include("header.php"); ?>
    <div class="alert alert-warning" role="alert" data-aos="fade-in">
    enter the new <i class="ri-map-pin-fill"></i> Location details.
    </div>
    <!-- form container -->
    <div class="container" data-aos="zoom-in">  
        <form action="location-entry.php" method="POST">
        <div class="mb-3">
            <label for="c_name" class="form-label">Location_name</label>
            <input type="text" class="form-control" name="p_name" placeholder="enter Location_name">
        </div>
        <div class="mb-3 mt-3">
            <label for="c_id" class="form-label">Location_id</label>
            <input type="text" class="form-control" name="p_id" placeholder="enter Location-pin-code" >
        </div>
        <div class="submit">
        <button type="text" class="btn btn-warning" name="submit">submit</button>
        </div>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                $sql = "INSERT INTO `ranjan`.`places` (`p_name`, `p_id`) VALUES ('$_POST[p_name]', '$_POST[p_id]'); ";

                if ($con->query($sql) == true) {
                    echo "<p>details entered succesfuly<a href=\"user.php\">back-to-user-page</a></p>";
                } 
                else {
                    echo "error : $con->error";
                }
            $con->close();
            }
        ?>
    </div>   
    <?php include("footer.php");?>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration:2000
    });
  </script>
</body>
</html>