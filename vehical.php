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
    <title>vehicaldetails</title>
    <link rel="stylesheet" href="css/formstyles.css">
    <style>
        .header2{
            background-color: rgb(4, 65, 122);
            text-align: center;
            margin: auto;
            width: 95%;
            border-radius: 10px;
            padding: 5px;
            box-shadow: 0 0 3px 3px;
        }
        .header2 h3{
            color: whitesmoke;
        }
        .box{
            margin: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit,289px);
            gap: 20px;
            z-index: -1;
        }
    </style>
</head>
<body>

    <?php include("header.php"); ?>
    <div class="alert alert-info" role="alert" data-aos="fade-in">
    enter your   <i class="ri-roadster-fill"></i> new vehical   details
    </div>
    <div class="container" data-aos="zoom-in">  
        <form action="vehical.php" method="POST">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Vehical_number</label>
            <input type="text" class="form-control" name="v_id" placeholder="enter vehical_id" >
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Vehical_name</label>
            <input type="text" class="form-control" name="v_name" placeholder="enter vehical_name">
        </div>
        <div class="mb-3">
            <label for="c_id" class="form-label">Number_of_Seats</label>
            <input type="text" class="form-control" name="v_seats" placeholder="enter number of seats">
        </div>
        <div class="submit">
        <button type="text" class="btn btn-primary" name="submit">submit</button>
        </div>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                $query1="SELECT * from `ranjan`.`vehical` where v_id='$_POST[v_id]';";
                $res = mysqli_query($con, $query1);
                if(mysqli_num_rows($res)==1){
                        echo "<script>alert('vehical already registered');</script>";
                }
                else{
                    $sql = " INSERT INTO `ranjan`.`vehical` (`v_id`, `v_name`, `v_noseats`, `u_id`) VALUES ('$_POST[v_id]','$_POST[v_name]',$_POST[v_seats], '$_SESSION[u_id]');";
                    if ($con->query($sql) == true) {
                        echo "<p>details entered succesfuly<a href=\"user.php\">back-to-user-page</a></p>";
                    } 
                    else {
                        echo "error : $con->error";
                    }
                }
            }
        ?>
    </div> 
    <?php
    $query = "SELECT * from `ranjan`.`vehical` where u_id='$_SESSION[u_id]'";
    $res = mysqli_query($con, $query);
    $cnt = mysqli_num_rows($res);
    if($cnt>0){?>
    </br>
        <div class="header2"data-aos="fade-up"data-aos-once="true">
            <h3><i>your currently registered vehicles</i></h3>
        </div>
        <?php?>
        <div class="box">
            <?php
            while($cnt>0){
                $row = mysqli_fetch_row($res);
                echo "<div class=\"card text-bg-dark mb-3\" style=\"max-width: 540px;\"data-aos=\"fade-up\"data-aos-once=\"true\">
                <div class=\"row g-0\">
                  <div class=\"col-md-4\">
                    <img src=\"img/cars/$row[2]0.png\" class=\"img-fluid rounded-start\" alt=\"...\">
                  </div>
                  <div class=\"col-md-8\">
                    <div class=\"card-body\">
                      <h5 class=\"card-title\">$row[0]</h5>
                      <p class=\"card-text\">name - $row[1]</br>seats - $row[2] </p>
                    </div>
                  </div>
                </div>
              </div>
              ";
                $cnt -= 1;
            }
            $con->close();
            ?>
        </div>
   <?php }
    ?>  
    <?php include("footer.php");?>
</body>
</html>
<!-- INSERT INTO `vehical` (`v_id`, `v_name`, `v_noseats`, `u_id`) VALUES ('KA105', 'benz', '5', '9740200327'); -->
