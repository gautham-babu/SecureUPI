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
  $array = $con->query("select * from useraccounts,branch where useraccounts.id = '$_GET[id]' AND useraccounts.branch = branch.branchId");
  $row = $array->fetch_assoc();
 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    Account profile for <?php echo $row['name'];?>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td>Name</td>
          <th><?php echo $row['name'] ?></th>
          <td>UPI Id</td>
          <th><?php echo $row['accountNo'] ?></th>
        </tr><tr>
          <td>Branch Name</td>
          <th><?php echo $row['branchName'] ?></th>
          <td>Email</td>
          <th><?php echo $row['email'] ?></th>
        </tr><tr>
          <td>Current Balance</td>
          <th>₹<?php echo $row['balance'] ?></th>
          <td>Address</td>
          <th><?php echo $row['address'] ?></th>
        </tr><tr>
          <td>Aadhaar</td>
          <th><?php echo $row['aadhaar'] ?></th>
          <td>Contact Number</td>
          <th><?php echo $row['number'] ?></th>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="card-footer text-muted">
   <p>Secure UPI</p>
  </div>
</div>

</body>
</html>