<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Document</title>
    <style>
        .header{
            width: 100%;
            font-family: poppins;
            display: flex;
            box-shadow: 0 0 10px 0 rgba(55, 53, 108, 0.621);
            justify-content: space-between;
            padding: 6px;
            background-color: rgb(0, 42, 66);
        }
        .header h3{
            color: #fff;
        }
        .img img{
            position:absolute;
            height: 40px;
            width: 60px;
            animation-name: exitcar;
            animation-duration: 6.5s;
            animation-iteration-count: 1;
            animation-delay: 0s;
            animation-fill-mode: forwards; 
            animation-timing-function: ease-in-out;
        }
        @keyframes exitcar {
        0%{
            left: 100%;
            opacity: 100%;
        }
        100%{
            left: 0px;
            opacity: 0%;
        }
        }
        .closeing{
            position: absolute;
            top: 50px;
            height: 300px;
            width: 300px;
            margin: auto;
            text-align: center;
            text-shadow: 15px;
        }
        .closeing img{
            z-index: -1;
            height: 500px;
            width: 500px;
            position: absolute;
            left: 100%;
        }
        .closting h3{
            position: absolute;
            top: 200px;
            left: 100%;
            color: black;
            z-index: 2;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="headblock" data-aos="fade-left">
        <h3> <a class="navbar-brand" href="user.php"><i class="ri-leaf-fill"></i></a>
        <?php 
             //setting the timezone
             $tz = 'Asia/Kolkata';   
             date_default_timezone_set($tz);
             $timeZone = date_default_timezone_get();
            $wel_str="Hello"; 
            $numeric_date=date("G");
            if($numeric_date>=0&&$numeric_date<=11) 
            $wel_str .= " Good Morning!"; 
            else if($numeric_date>=12&&$numeric_date<=17) 
            $wel_str=$wel_str." Good Afternoon!";  
            else if($numeric_date>=18&&$numeric_date<=23) 
            $wel_str=$wel_str." Good Evening!"; 
            echo "$wel_str";
            echo "  ";
            echo $_SESSION['u_name'];?></h3>
      </div> 
      <div class="img">
      <img src="img/greencar2.png" alt=""></div>
        <form action="user.php"method="post">
         <button name="logout"class="btn btn-light">LogOut</button>
        </form>
        <?php
        if(isset($_POST['logout'])){
        session_destroy();
        header("location: index.php");
        }
    ?>
 </div>   
 <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration:2000
    });
  </script>
</body>
</html>

