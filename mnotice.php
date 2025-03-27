<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
<title>UPI</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
    {
      header("location:mindex.php");
    }
  } ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
body {
    background: url('images/background.jpg') no-repeat center center fixed; /* Replace with your image path */
    background-size: cover; /* Ensures the image covers the entire background */
    font-family: 'Arial', sans-serif;
    color: #333;
}

.navbar {
    background-color: rgba(255, 255, 255, 0.4); /* Increased transparency */
    backdrop-filter: blur(100px); /* Light blur effect */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional shadow for better visibility */
}

.navbar-brand img {
    height: 40px;
}

.navbar-nav .nav-link {
    color: #333;
    font-weight: bold;
    transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #007bff; /* Change to your desired hover color */
}

.navbar-text {
    font-weight: bold;
    color: #333;
}
</style>
</head>
<body style="background:#ffffff;background-size: 100%">
<nav class="navbar navbar-expand-lg navbar-light fixed-top" >
<div class="container">
 <a class="navbar-brand" href="#">
 <img src="images/logo.png" width="130" height="30" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link active" href="mindex.php">Customers<span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item ">  <a class="nav-link" href="maddnew.php">Add New Account</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>

    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
  </div>
</nav><br><br><br>
<?php 
  $array = $con->query("select * from useraccounts where id = '$_GET[id]'");
  $row = $array->fetch_assoc();


 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    Send Notice to <?php echo $row['name'] ?>
  </div>
  <div class="card-body">
    <form method="POST">
          <div class="alert alert-success w-50 mx-auto">
            <h5>Write notice for <?php echo $row['name'] ?></h5>
            <input type="hidden" name="userId" value="<?php echo $row['id'] ?>">
            <textarea class="form-control" name="notice" required placeholder="Write your message"></textarea>
            <button type="submit" name="send" class="btn btn-primary btn-block btn-sm my-1">Send</button>
          </div>
      </form><?php
    if (isset($_POST['send']))
    {
      if ($con->query("insert into notice (notice,userId) values ('$_POST[notice]','$_POST[userId]')")) {
        echo "<div class='alert alert-success'>Successfully send</div>";
      }else
      echo "<div class='alert alert-danger'>Not sent Error is:".$con->error."</div>";
    }
    
    ?>  
  </div>
  <div class="card-footer text-muted">
    <?php echo bankName; ?>
  </div>
</div>

</body>
</html>