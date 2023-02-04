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
    <style>
        .container {
        background-color: whitesmoke;
        margin: auto;
        width: 50%;
        padding: 20px;
        border-radius: 20px;
        }
    </style>
    <title>confirmjoin</title>
</head>
<body>
<?php include("header.php"); ?>
<div class="alert alert-warning" role="alert">
 Confirm joining pool <a href="user.php" class="alert-link">back-to-userpage</a> or click here to exit.
</div>
<?php
$id = $_GET['id'];
$sql1="SELECT p.*,u.*,v.v_noseats,v.v_name from `ranjan`.`pushrequest` p,`ranjan`.`users` u,`ranjan`.`vehical` v where p.u_id=u.u_id and v.v_id=p.v_id and p.r_id=$id and p.duetime>CURRENT_TIMESTAMP GROUP by v.v_id ORDER by p.duetime;";
$res = mysqli_query($con, $sql1);
$row = mysqli_fetch_row($res);
?>
<div class="container">
    <form action="confirmrequest.php?id=<?php echo $id ?>" method="POST">
        <div class="mb-3 mt-3">
            <label for="c_id" class="form-label">Owner name</label>
            <input type="text" class="form-control" readonly value="<?php echo "$row[7]"; ?>" >
        </div>
        <div class="mb-3">
            <label for="c_name" class="form-label">Owner contact_no</label>
            <input type="text" class="form-control" readonly value="<?php echo "$row[1]"; ?>">
        </div>
        <div class="mb-3">
            <label for="p_id" class="form-label">Drive Starting time</label>
            <input type="text" class="form-control" readonly value="<?php echo "$row[2]"; ?>">
        </div>
        <div class="mb-3">
            <label for="p_id" class="form-label">destination</label>
            <input type="text" class="form-control" readonly value="<?php echo "$row[3]"; ?>">
        </div>
        <div class="mb-3">
            <label for="p_id" class="form-label">Drive starting point</label>
            <input type="text" class="form-control" readonly value="<?php echo "$row[4]"; ?>">
        </div>
        <div class="mb-3">
            <label for="p_id" class="form-label">Vehical id</label>
            <input type="text" class="form-control" readonly value="<?php echo "$row[5]"; ?>">
        </div>
        <div class="mb-3">
            <label for="p_id" class="form-label">Vehical name</label>
            <input type="text" class="form-control" readonly value="<?php echo "$row[12]"; ?>">
        </div>
        <div class="mb-3">
            <label for="p_id" class="form-label">number of seats</label>
            <input type="text" class="form-control" readonly value="<?php echo "$row[11]"; ?>">
        </div>
        <div class="submit">
        <button type="text" class="btn btn-dark" name="submit">confirm</button>
        </div>
    </form>
<?php
if(isset($_POST['submit'])){
$query1="SELECT * from `ranjan`.`pullrequest` where u_id='$_SESSION[u_id]' and r_id='$row[0]';";
$res = mysqli_query($con, $query1);
if(mysqli_num_rows($res)==1){
        echo "<script>alert('your already present in the pool');</script>";
}
else{
$sql = "INSERT INTO `ranjan`.`pullrequest` (`r_id`, `u_id`) VALUES ('$row[0]', '$_SESSION[u_id]'); ";
if ($con->query($sql) == true) {
    echo "<p>details entered succesfuly<a href=\"user.php\">back-to-user-page</a></p>";
            $con->close();
} 
else {
    echo "error : $con->error";
}
}
}
?>
</div>
<!-- <?php include("footer.php");?> -->
</body>
</html>
