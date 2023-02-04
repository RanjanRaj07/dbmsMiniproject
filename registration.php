<?php
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
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <style>
      header {
    background-color: #f5ba13;
    margin: auto -16px;
    padding: 16px 32px;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.3);
  }
  header h3 {
    color: #fff;
    font-family: "McLaren", cursive;
    font-weight: 200;
  }

  .container {
    background-color: rgb(224, 222, 222);
    margin: auto;
    width: 50%;
    padding: 20px;
    border-radius: 20px;
  }
  footer {
        text-align: center;
        text-shadow: 2px;
        width: 100%;
        height: 1.8rem;
        background-color: whitesmoke;
        z-index: 2;
        }
    </style>
    <link rel="shortcut icon" href="img/logo.jpg">
    <title>registration</title>
</head>
<body>
    <header><h3 data-aos="fade-up">registeration page</h3></header>
    <div class="container" data-aos="zoom-in">
        <h4>Enter your details to join the greenpool</h4>
        <p>your user name and phone number will be login credentials!
      </br>only rigester company and registered location people can rigsiter</p>
        <form action="registration.php" method="POST">
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">User name</label>
              <input type="text" class="form-control" name="name" placeholder="enter user name" name="name">
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">phone no</label>
              <input type="text" class="form-control" name="u_id" placeholder="enter phone no">
            </div>
            <div class="mb-3">
                <label for="c_id" class="form-label">company_id</label>
                <input type="text" class="form-control" name="c_id" placeholder="enter company_id">
            </div>
            <div class="mb-3">
                <label for="p_id" class="form-label">Location pin-code</label>
                <input type="text" class="form-control" name="p_id" placeholder="enter pincode" >
              </div>
            <div class="mb-3">
              <label for="p_id" class="form-label">gender</label>
              <input type="text" class="form-control"  placeholder="enter gender" name="gender" >
            </div>
            <div class="submit">
            <button type="text" class="btn btn-primary" name="submit">submit</button>
            </div>
            <?php
            try{
              if(isset($_POST['submit']))
              {
                $name = $_POST['name'];
                $u_id = $_POST['u_id'];
                $c_id = $_POST['c_id'];
                $p_id = $_POST['p_id'];
                $gender = $_POST['gender'];
                $sql3 = "SELECT * FROM `ranjan`.`users` WHERE `u_id`=\"$u_id\" and u_name=\"$name\";";
                $res3 = mysqli_query($con, $sql3);
                if(mysqli_num_rows($res3)==1){
                  echo "<div class=\"alert alert-warning\" role=\"alert\">User already Regisered</div>";
                  echo "<p>registration successful click here to login<a href=\"index.php\">login-page</a></p>";
                } else {
                  $sql = "INSERT INTO `ranjan`.`users` (`u_id`, `u_name`, `c_id`, `p_id`,`gender`) VALUES ('$u_id', '$name', '$c_id', '$p_id','$gender');";
                  if ($con->query($sql) == true) {
                    echo "<p>registration successful click here to login<a href=\"index.php\">login-page</a></p>";
                  } else {
                    echo "error : $con->error";
                  }
                }
                $con->close();
              }
            }
            catch(Exception $e){
              $sql1 = "SELECT * FROM `ranjan`.`company` WHERE `c_id`=\"$c_id\";";
                $res = mysqli_query($con, $sql1);
                if(mysqli_num_rows($res)!=1){
                    echo "<div class=\"alert alert-danger\" role=\"alert\">Company not registered</div>";
                }
              $sql2 = "SELECT * FROM `ranjan`.`places` WHERE `p_id`=\"$p_id\";";
                $res2 = mysqli_query($con, $sql2);
                if(mysqli_num_rows($res2)!=1){
                  echo "<div class=\"alert alert-danger\" role=\"alert\">Location not registered</div>";
                }
            }
            ?>
        </div>
        </form>
    </div>
    <footer><p>&copy; 2022 - <?php echo date ('Y');?> ~RanjanRaj</p></footer>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration:2000
    });
  </script>
</body>
</html>
