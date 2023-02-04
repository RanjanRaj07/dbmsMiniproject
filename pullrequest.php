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
    <link rel="shortcut icon" href="img/logo.jpg">
    <link rel="stylesheet" href="css/poolstyle.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>joinpool</title>
    <style>
      .profile-img{
          display: flex;
          align-items: center;
          justify-content: center;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          border: 2px solid #6533e2;
      }
      .profile-img img{
          width: 30px;
          height: 30px;
          object-fit: cover;
          border-radius: 50%;
          object-position: center;
      }
    </style>
</head>
<body>
<div class="body">
    <?php include("header.php"); ?>
        <div class="alert alert-light" role="alert" data-aos="fade-in">
        choose your pool <i class="ri-map-pin-add-fill"></i> to join
    </div>
    <!-- showing current pool -->
    <div class="nps">
        <h3 data-aos="fade-left"><i>Currently available pools</i></h3>
        <table class="table"data-aos="fade-up">
        <thead class="table-dark">
          <tr>
            <th></th>
            <th>name</th>
            <th>contact no</th>
            <th>starttime</th>
            <th>startpoint</th>
            <th>destination</th>
            <th>vehical id</th>
            <th>vehical name</th>
            <th>no of seats</th>
            <th>choose</th>
          </tr>
        </thead>
         <tbody>
		 <?php
      $sql="SELECT p.*,u.*,v.v_noseats,v.v_name from `ranjan`.`pushrequest` p,`ranjan`.`users` u,
      `ranjan`.`vehical` v where p.u_id=u.u_id and v.v_id=p.v_id and p.duetime>CURRENT_TIMESTAMP
       GROUP by p.r_id ORDER by p.duetime;";
      $res = mysqli_query($con, $sql);
      $cnt = mysqli_num_rows($res);
       while ($cnt>0) {
        $row0 = mysqli_fetch_row($res);
        $rid = $row0[0];
        $query1 = "SELECT COUNT(r_id) from `ranjan`.`pullrequest` where r_id='$rid';";
        $res1 = mysqli_query($con, $query1);
        $row2 = mysqli_fetch_row($res1);
        $count = $row2[0];
        if($row0[1]!=$_SESSION['u_id']){?>
         <tr>
          <td><div class="profile-img"> <?php if($row0[10]=="male"){ ?>
                   <img src="img/avatar.jpg" alt="">
               <?php }
                else{?>
                    <img src="img/avatarf.jpg" alt="">
               <?php }
            ?></div></td>
          <td><?php echo $row0[7];?></td>
          <td><?php echo $row0[1];?></td>
          <td><?php echo $row0[2];?></td>
          <td><?php echo $row0[4];?></td>
          <td><?php echo $row0[3];?></td>
          <td><?php echo $row0[5];?></td>
          <td><?php echo $row0[12];?></td>
          <td><?php echo intval($row0[11])-intval($count);?></td>
          <td><a href="confirmrequest.php?id=<?php echo $row0[0];?>"><button class="btn btn-success btn-sm">join</button></a></td>
          </tr>
     <?php 
        }
      $cnt -= 1;
      }
		 ?>    
    </tbody>
    </table>
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
