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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="shortcut icon" href="img/logo.jpg">
    <style>
      footer {
    text-align: left;
    background-color: whitesmoke;
    text-shadow: 2px;
    bottom: 0;
    width: 100%;
    height: 1.8rem;
    z-index: -2;
    }
    footer p{
      margin-left: 100px;

    }
    </style>
    <title>greenpool</title>
</head>
<body>
    <!--alert-->
    <div class="alert" >
      <div class="text">
      <img src="img/greencar1.png" alt="">
       <b><strong>Welcome</strong> to <i class="ri-leaf-fill"></i>greenpool</b></div>
    </div>
    <!--cuorsel-->
    <div class="main-post"data-aos="fade-up">
      <!-- box 1 -->
      <div class="post-box">
          <img src="img/pollution.jpg" alt="post">
          <div class="post-info">
                  <h5>More Vehicals More Pollution</h5>
          </div>
      </div>
      <!-- box 2 -->
      <div class="post-box">
          <img src="img/accident.jpg" alt="post">
          <div class="post-info">
                  <h5>More Vehicals More Accidents</h5>
          </div>
        </div>
      <!-- box 3 -->
      <div class="post-box">
          <img src="img/traffic.jpg" alt="post">
          <div class="post-info">
                  <h5>More Vehicals More Traffic</h5>
          </div>
      </div>
  </div>
    <!--form-->
    <div class="formblock"data-aos="fade-left"data-aos-once="true">
        <div class="data">
        <h4><b><u>Lets Go Together</u></b></h4>
        <ul>
          <li>avoid pollution❗❕</li>
          <li>avoid traffic❗❕</li>
          <li>reduce accidents❗❕</li>
          <li>hav a safe and fun ride❗❕</li>
        </ul>
      </div>
      <img src="img/greencar2.png" alt="">
    <form action="index.php" method="post">
        <div class="mb-3 mt-3">
          <label for="name" class="form-label">User name</label>
          <input type="text" class="form-control" name="name" placeholder="enter user name" name="name">
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Password</label>
          <input type="password" class="form-control" name="phno" placeholder="enter password" name="phone" min="0000000000" max="9999999999">
        </div>
        <div class="submit">
           <button type="submit" class="btn btn-primary" name="login">login</button>
              <div class="newuser">
                new user <button type="button" class="btn btn-warning"><a href="registration.php">register</a></button>
              </div>
          </div>
        </div>
    </form>  
    <?php
    if(isset($_POST['login'])){
      $sql = "SELECT * FROM `ranjan`.`users` WHERE `u_name`= '$_POST[name]' AND `u_id`= '$_POST[phno]';";
      $result = mysqli_query($con, $sql);
      if(mysqli_num_rows($result)==1){
        session_start();
        $_SESSION['u_name'] = $_POST['name'];
        $_SESSION['u_id'] = $_POST['phno'];
        header("location: user.php");
      }
      else{
        echo "<script>alert('incorrect password or user name')</script>";
      }
    }
    mysqli_close($con);
    ?>
  </div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration:2000
    });
  </script>
  <footer>
      <p>&copy; 2022 - <?php echo date ('Y');?> ~RanjanRaj</p>
</footer>
</body>
</html>