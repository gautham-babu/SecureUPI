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
        <a class="nav-link" href="mindex.php">Customers<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link active" href="maccounts.php">Staff</a></li>
      <li class="nav-item ">  <a class="nav-link" href="maddnew.php">Add New Account</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>

    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
  </div>
</nav><br><br><br>
<?php
if (isset($_POST['saveAccount']))
{
  if (!$con->query("insert into management (email,password,type) values ('$_POST[email]','$_POST[password]','cashier')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from management where id ='$_GET[del]'");
}
  $array = $con->query("select * from management where type='cashier'");
  
 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    All Staff Accounts <button class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Add New Account</button>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Email</th>
          <th>Password</th>
          <th>Account Type</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if ($array->num_rows > 0)
          {
            while ($row = $array->fetch_assoc())
            {
              echo "<tr>";
              echo "<td>".$row['email']."</td>";
              echo "<td>".$row['password']."</td>";
              echo "<td>".$row['type']."</td>";
              echo "<td><a href='maccounts.php?del=$row[id]' class='btn btn-danger btn-sm'>Delete</a></td>";
              echo "</tr>";
            }
          }
         ?>
      </tbody>
    </table>
  </div>
  <div class="card-footer text-muted">
    <p>Secure Upi</p>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Cashier Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST">
          Enter Details
         <input class="form-control w-75 mx-auto" type="email" name="email" required placeholder="Email">
         <input class="form-control w-75 mx-auto" type="password" name="password" required placeholder="Password">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveAccount" class="btn btn-primary">Save Account</button>
      </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>