<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:login.php');
}

// Database connection
$con = new mysqli('localhost', 'root', '1997', 'mybank');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure UPI</title>
    <!-- Include Bootstrap 5 -->
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
    .hero-section {
        text-align: center;
        padding: 100px 100px;
        color: #333;
    }
    .hero-section h1 {
        font-size: 2.5rem;
        font-weight: bold;
    }
    .hero-section p {
        font-size: 1.2rem;
        margin-top: 10px;
    }
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background: #fff;
    }
    .card img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        height: 150px;
        object-fit: cover;
    }
    .btn {
        border-radius: 20px;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
    .stats-section {
        margin-top: 10px;
        text-align: center;
    }
    .stats-section .stat-card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .stats-section .stat-card h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }
    .stats-section .stat-card p {
        font-size: 1rem;
        color: #666;
    }

    /* Top-right image styling */
    .top-right-image {
        position: absolute;
        top: 100px; /* Adjust the distance from the top */
        right: 100px; /* Adjust the distance from the right */
        width: 550px; /* Adjust the size of the image */
        height: auto;
        z-index: 10; /* Ensure it stays above other elements */
    }
    </style>
</head>
<body>
    <!-- Top-right image -->
    <img src="images/image1.jpg" alt="Top Right Image" class="top-right-image">

    <!-- Navbar -->
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
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="accounts.php">View Profile</a>
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
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="container hero-section">
    <div class="row align-items-center">
        <div class="col-md-6 text-start"> <!-- Left-aligned content -->
            <h1>Safe transactions with Secure UPI</h1>
            <p>Uses Advanced Machine Learning Models to prevent fraud</p>
        </div>
        
    </div>
</div>

<!-- Stats Section -->
<div class="container stats-section mt-5">
    <div class="row">
        <div class="col-md-6"> <!-- Left-aligned Account Balance -->
            <div class="card border-0 shadow-sm text-start p-2">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Account Balance</h5>
                    <p class="card-text text-muted" style="font-size: 1.2rem;">Your current balance is ₹<?php echo isset($_SESSION['user']['balance']) ? $_SESSION['user']['balance'] : '0'; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cards Section -->
<div class="container mt-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Transfer Money</h5>
                    <p class="card-text text-muted">Send money securely to other accounts.</p>
                    <a href="transfer.php" class="btn btn-outline-primary rounded-pill px-4">Transfer Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Notices</h5>
                    <p class="card-text text-muted">Check the latest notices and updates.</p>
                    <a href="notice.php" class="btn btn-outline-warning rounded-pill px-4">View Notices</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Contact Us</h5>
                    <p class="card-text text-muted">Get in touch with our support team.</p>
                    <a href="feedback.php" class="btn btn-outline-primary rounded-pill px-4">Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <br><br><br><br>

    </div>

    <!-- Include Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>