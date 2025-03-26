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
        backdrop-filter: blur(5px); /* Light blur effect */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional shadow for better visibility */
    }
    .navbar-brand img {
        height: 40px;
    }
  
  
    </style>
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
        <a class="nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active ">  <a class="nav-link" href="accounts.php">View Profile</a></li>
      <li class="nav-item ">  <a class="nav-link" href="statements.php">Account Statement</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transfer</a></li>
    </ul>
    <?php include 'sideButton.php'; ?>
   
  </div>
</nav><br><br><br>
<div class="container">
  <div class="card  w-75 mx-auto">
  <div class="card-header text-center">
    Your Account Information
  </div>
  <div class="card-body">
    <table class="table table-striped table-dark w-75 mx-auto">
  <thead>
    <tr>
      <td scope="col">Account No.</td>
      <th scope="col"><?php echo $userData['accountNo']; ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Branch</th>
      <td><?php echo $userData['branchName']; ?></td>
    </tr>
    <tr>
      <th scope="row">Branch Code</th>
      <td><?php echo $userData['branchNo']; ?></td>
    </tr>
    <tr>
      <th scope="row">Account Type</th>
      <td><?php echo $userData['accountType']; ?></td>
    </tr>
    <tr>
      <th scope="row">Account Created</th>
      <td><?php echo $userData['date']; ?></td>
    </tr>
  </tbody>
</table>
      
  </div>
  <div class="card-footer text-muted">
   <?php echo bankName ?>
  </div>
</div>

</div>
</body>
</html>