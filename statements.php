
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
  <?php
    $error = "";
    if (isset($_POST['userLogin']))
    {
      $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];
       
        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        if($result->num_rows>0)
        { 
          session_start();
          $data = $result->fetch_assoc();
          $_SESSION['userId']=$data['id'];
          $_SESSION['user'] = $data;
          header('location:index.php');
         }
        else
        {
          $error = "<div class='alert alert-warning text-center rounded-0'>Incorrect Username or Password, try again!</div>";
        }
    }

   ?>
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
      <li class="nav-item ">  <a class="nav-link" href="accounts.php">View Profile</a></li>
      <li class="nav-item active">  <a class="nav-link" href="statements.php">Account Statement</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transfer</a></li>
    </ul>
    <?php include 'sideButton.php'; ?>
   
  </div>
</nav><br><br><br>
<div class="container">
  <div class="card  w-75 mx-auto">
  <div class="card-header text-center">
    Transactions made with your account
  </div>
  <div class="card-body">
    <?php 
      $array = $con->query("select * from transaction where userId = '$userData[id]' order by date desc");
      if ($array ->num_rows > 0) 
      {
         while ($row = $array->fetch_assoc()) 
         {
            if ($row['action'] == 'withdraw') 
            {
              echo "<div class='alert alert-secondary'>You withdraw ₹$row[debit] from your account at $row[date]</div>";
            }
            if ($row['action'] == 'deposit') 
            {
              echo "<div class='alert alert-success'>You deposited ₹$row[credit] in your account at $row[date]</div>";
            }
            if ($row['action'] == 'credit') 
            {
              echo "<div class='alert alert-success'>Credited  ₹$row[credit] in your account at $row[date] from $row[other]</div>";
            }
            if ($row['action'] == 'debit') 
            {
              echo "<div class='alert alert-warning'>Debitted  ₹$row[debit] from your account at $row[date] to  account no.$row[other]</div>";
            }
            if ($row['action'] == 'fraud') 
            {
              echo "<div class='alert alert-danger'>Failed to sent ₹$row[debit] from your account at $row[date] to suspected Fraud account no.$row[other]</div>";
            }

         }
      } 
    ?>  
  </div>
  <div class="card-footer text-muted">
   <?php echo bankName ?>
  </div>
</div>

</div>
</body>
</html>