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
    <title>Federal Bank</title>
    <!-- Include Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0c3fc, #8ec5fc); /* Gradient background */
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .navbar {
            background-color: transparent;
            box-shadow: none;
        }
        .navbar-brand img {
            height: 40px;
        }
        .hero-section {
            text-align: center;
            padding: 100px 20px;
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
            margin-top: 50px;
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
    </style>
</head>
<body>
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
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Grow your savings with Federal Bank</h1>
        <p>Manage your finances with ease and security. Explore our services today.</p>
    </div>

    <!-- Stats Section -->
    <div class="container stats-section">
        <div class="row">
            <div class="col-md-6">
                <div class="stat-card">
                    <h3>Account Balance</h3>
                    <p>Your current balance is ₹<?php echo isset($_SESSION['user']['balance']) ? $_SESSION['user']['balance'] : '0'; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card">
                    <h3>Recent Transactions</h3>
                    <p>View your latest transactions in the account statement section.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Section -->
    <div class="container mt-5">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card">
                    <img src="images/acount.jpg" class="card-img-top" alt="Account Summary">
                    <div class="card-body">
                        <a href="accounts.php" class="btn btn-outline-success w-100">Account Summary</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="images/transfermoney.jpg" class="card-img-top" alt="Transfer Money">
                    <div class="card-body">
                        <a href="transfer.php" class="btn btn-outline-success w-100">Transfer Money</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="images/contact.png" class="card-img-top" alt="Contact Us">
                    <div class="card-body">
                        <a href="feedback.php" class="btn btn-outline-primary w-100">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>