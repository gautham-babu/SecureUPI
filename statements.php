
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
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="Federal Bank">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="accounts.php">View Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="statements.php">Account Statement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transfer.php">Transfer</a>
                </li>
            </ul>
            <!-- Account Balance -->
            <span class="navbar-text ms-3">
                Account Balance: ₹<?php echo isset($_SESSION['user']['balance']) ? $_SESSION['user']['balance'] : '0'; ?>
            </span>
            <!-- Logout Button -->
            <a href="logout.php" class="btn btn-outline-danger ms-3">Logout</a>
        </div>
    </div>
</nav>
<br>
<div class="container mt-5">
    <div class="card w-75 mx-auto border-0 shadow-lg rounded-4"> <!-- Subtle shadow and smooth rounded corners -->
        <div class="card-header text-center fw-bold bg-secondary  bg-gradient text-white rounded-top">
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
   <p>Secure UPI</p>
  </div>
</div>

</div>
</body>
</html>