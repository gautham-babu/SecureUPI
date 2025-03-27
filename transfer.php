<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}

// Include the database connection
require 'assets/db.php'; // Ensure this file initializes the $con variable

// Fetch user data
$userId = $_SESSION['userId'];
$query = "SELECT * FROM useraccounts WHERE id = '$userId'";
$result = $con->query($query);
if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    die("User data not found.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Banking</title>
    <?php require 'assets/autoloader.php'; ?>
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
                    <a class="nav-link" href="statements.php">Account Statement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="transfer.php">Transfer</a>
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

<br><br><br>
<div class="container">
    <div class="card w-75 mx-auto">
        <div class="card-header text-center">
            Funds Transfer
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="alert alert-success w-50 mx-auto">
                    <h5>New Transfer</h5>
                    <input type="text" name="otherNo" class="form-control" placeholder="Enter Receiver Account number"
                           required>
                    <button type="submit" name="get" class="btn btn-primary btn-bloc btn-sm my-1">Get Account Info
                    </button>
                </div>
            </form>
            <?php if (isset($_POST['get'])) {
                $array3 = $con->query("select * from userAccounts where accountNo = '$_POST[otherNo]'");
                if ($array3->num_rows > 0) {
                    $row2 = $array3->fetch_assoc();
                    echo "<div class='alert alert-success w-50 mx-auto'>
                          <form method='POST'>
                            Account No.
                            <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                            Account Holder Name.
                            <input type='text' class='form-control' value='$row2[name]' readonly required>
                            Account Holder Bank Name.
                            <input type='text' class='form-control' value='" . bankName . "' readonly required>
                            Enter Amount for transfer.
                            <input type='number' name='amount' class='form-control' min='1' max='$userData[balance]' required>
                            <button type='submit' name='transferSelf' class='btn btn-primary btn-bloc btn-sm my-1'>Transfer</button>
                          </form>
                        </div>";
                } else {
                    echo "<div class='alert alert-danger w-50 mx-auto'>Account No. $_POST[otherNo] Does not exist</div>";
                }
            } ?>
            <br>
            <h5>Transfer History</h5>
            <?php
if (isset($_POST['transferSelf'])) {
    $otherNo = $_POST['otherNo'];
    
    $query = "SELECT * FROM useraccounts WHERE accountNo = '$otherNo'";
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        $OtherData = $result->fetch_assoc();
    } else {
        die("User data not found.");
    }

    // Fetch sender's aadhaar and number
    $sender_aadhaar = $OtherData['aadhaar'];
    $sender_number = $OtherData['number'];

    // Call the Python script for fraud detection
    $command = escapeshellcmd("python assets/fraud_detection.py $sender_number $sender_aadhaar");
    $output = shell_exec($command);

    // Debugging: Log the command and output
    error_log("Command executed: $command");
    error_log("Output from Python script: $output");

    // Check if the transaction is fraudulent
    if ($output === null || trim($output) === '') {
        echo "<div class='alert alert-warning'>Unable to determine if the transaction is fraudulent. Please try again later.</div>";
    } else {
        $is_fraud = trim($output) == '1';

        // Debugging: Log the fraud detection result
        error_log("Fraud detection result: $is_fraud");

        if ($is_fraud) {
            // If the transaction is fraudulent, display a warning and do not proceed
            $amount = $_POST['amount'];
            makeTransaction('fraud', $amount, $otherNo);
            echo "<div class='alert alert-danger'>Transfer Failed: The Receiver account is flagged as fraudulent!</div>";
        } else {
            // If the transaction is not fraudulent, proceed with the transfer
            echo "<div class='alert alert-success'>Transaction is not fraudulent. Proceeding with transfer...</div>";
            $amount = $_POST['amount'];
            setBalance($amount, 'debit', $userData['accountNo']);
            setBalance($amount, 'credit', $otherNo);
            makeTransaction('transfer', $amount, $otherNo);
            makeTransaction('receive', $amount, $otherNo);

            // Update the session balance
            $updatedBalanceQuery = "SELECT balance FROM useraccounts WHERE id = '$userId'";
            $updatedBalanceResult = $con->query($updatedBalanceQuery);
            if ($updatedBalanceResult->num_rows > 0) {
                $updatedBalance = $updatedBalanceResult->fetch_assoc()['balance'];
                $_SESSION['user']['balance'] = $updatedBalance; // Update session balance
            }

            echo "<script>alert('Transfer Successful');window.location.href='transfer.php'</script>";
        }
    }
}

            // Fetch and display transaction history
            $query = "SELECT * FROM transaction WHERE userId = '$userId' ORDER BY date DESC";
            $result = $con->query($query);

            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered w-75 mx-auto'>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Action</th>
                                <th>Amount</th>
                                <th>Other Account</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch_assoc()) {
                    // Determine the amount based on the action (credit or debit)
                    $amount = $row['action'] == 'debit' || $row['action'] == 'withdraw' || $row['action'] == 'fraud' ? $row['debit'] : $row['credit'];
                    $amount = isset($amount) ? $amount : 'N/A'; // Handle NULL values
                    $otherNo = isset($row['other']) ? $row['other'] : 'N/A'; // Handle NULL values

                    echo "<tr>
                            <td>{$row['date']}</td>
                            <td>{$row['action']}</td>
                            <td>{$amount}</td>
                            <td>{$otherNo}</td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-info w-75 mx-auto'>No transaction history available.</div>";
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