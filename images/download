<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  
</head>
<body style="background:#ffffff;background-size: 100%">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #244f9e;">
 <a class="navbar-brand" href="#">
    <img src="images/federal.png" width="130" height="30" class="d-inline-block align-top" alt="">
   
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="accounts.php">View Profile</a></li>
      <li class="nav-item ">  <a class="nav-link" href="statements.php">Account Statement</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transfer</a></li>
    </ul>
    <?php include 'sideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<div class="row w-100" >
  <div class="col" style="padding: 22px;padding-top: 0">
    <div class="jumbotron shadowBlack" style="padding: 25px;min-height: 241px;max-height: 241px;background-color: white;">
  <h5 class="display-5">Welcome to Federal Bank</h5>
  <p  class="lead alert alert-warning"><b>Latest Notification:</b>

  <?php 
      $array = $con->query("select * from notice where userId = '$_SESSION[userId]' order by date desc");
      if ($array->num_rows > 0)
      {
        $row = $array->fetch_assoc();
        // {
          echo $row['notice'];
        // }
      }
      else
        echo "<div class='alert alert-info'>Notice box empty</div>";
     ?></p>
  
</div>
        <div id="carouselExampleIndicators" class="carousel slide my-2 rounded-1 shadowBlack" data-ride="carousel" >
          <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="images/f1.png" alt="First slide" style="max-height: 350px">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/f2.png" alt="Second slide" style="max-height: 350px">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/f3.png" alt="Third slide" style="max-height: 350px">
          </div>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
  </div>
<div class="col">
    <div class="row" style="padding: 22px;padding-top: 0">
      <div class="col">
        <div class="card shadowBlack ">
          <img class="card-img-top" src="images/acount.jpg" style="max-height: 160px;min-height: 155px" alt="Card image cap">
          <div class="card-body">
            <a href="accounts.php" class="btn btn-outline-success btn-block">Account Summary</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadowBlack ">
          <img class="card-img-top" src="images/transfermoney.jpg" alt="Card image cap" style="max-height: 175px;min-height: 155px">
        <div class="card-body">
          <a href="transfer.php" class="btn btn-outline-success btn-block">Transfer Money</a>
         </div>
        </div>
      </div>
    </div>
    <div class="row" style="padding: 22px">
      <div class="col">
        <div class="card shadowBlack ">
          <img class="card-img-top" src="images/notification.gif" style="max-height: 175px;min-height: 105px" alt="Card image cap">
          <div class="card-body">
            <a href="notice.php" class="btn btn-outline-primary btn-block">Check Notification</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadowBlack ">
          <img class="card-img-top" src="images/contact.png" alt="Card image cap" style="max-height: 175px;min-height: 155px">
        <div class="card-body">
          <a href="feedback.php" class="btn btn-outline-primary btn-block">Contact Us</a>
         </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>