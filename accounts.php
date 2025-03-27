<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>UPI</title>
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

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="Secure UPI">
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
                    <a class="nav-link active" href="accounts.php">View Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statements.php">Account Statement</a>
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
        <div class="card-header text-center fw-bold bg-success bg-gradient text-white rounded-top"> <!-- Light green header -->
            Your Account Information
        </div>
        <div class="card-body p-4"> <!-- Added padding for better spacing -->
            <table class="table table-hover table-striped table-bordered text-center align-middle rounded-3 overflow-hidden"> <!-- Added rounded corners and overflow-hidden -->
                <thead class="bg-light text-success"> <!-- Light background with green text -->
                    <tr>
                        <th scope="col" class="fw-bold text-center">Field</th> <!-- Center-aligned header -->
                        <th scope="col" class="fw-bold text-center">Details</th> <!-- Center-aligned header -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="text-center text-muted">Name</th>
                        <td class="text-center"><?php echo $userData['name']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center text-muted">UPI Id</th> <!-- Center-aligned field names -->
                        <td class="text-center"><?php echo $userData['accountNo']; ?></td> <!-- Center-aligned details -->
                    </tr>
                    
                    <tr>
                        <th scope="row" class="text-center text-muted">Email</th>
                        <td class="text-center"><?php echo $userData['email']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center text-muted">Ph No</th>
                        <td class="text-center"><?php echo $userData['number']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center text-muted">Account Created</th>
                        <td class="text-center"><?php echo $userData['date']; ?></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center text-muted bg-light rounded-bottom"> <!-- Light footer background with rounded bottom -->
        <p>Secure UPI</p>
      </div>
    </div>
</div>
</body>
</html>