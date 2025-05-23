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
<title>UPI</title>
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
<body>
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
                    <a class="nav-link" href="statements.php">Transaction History</a>
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
            Send Money
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="alert alert-success w-50 mx-auto">
                    <h5>New Transfer</h5>
                    <input type="text" name="otherNo" class="form-control" placeholder="Enter Receiver UPI Id" required>
                    <button type="submit" name="get" class="btn btn-primary btn-bloc btn-sm my-1">Get Account Info</button>
                </div>
            </form>
            <?php if (isset($_POST['get'])) {
                $array3 = $con->query("SELECT * FROM useraccounts WHERE accountNo = '$_POST[otherNo]'");
                if ($array3->num_rows > 0) {
                    $row2 = $array3->fetch_assoc();
                    echo "<div class='alert alert-success w-50 mx-auto'>
                          <form method='POST'>
                            UPI Id.
                            <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control' readonly required>
                            Account Holder Name.
                            <input type='text' class='form-control' value='$row2[name]' readonly required>
                           
                            Enter Amount for Transfer.
                            <input type='number' name='amount' class='form-control' min='1' max='$userData[balance]' required>
                            Enter UPI PIN.
                            <input type='password' name='upiPin' class='form-control' required>
                            <button type='submit' name='transferSelf' class='btn btn-primary btn-bloc btn-sm my-1'>Transfer</button>
                          </form>
                        </div>";
                } else {
                    echo "<div class='alert alert-danger w-50 mx-auto'>Account No. $_POST[otherNo] does not exist</div>";
                }
            } ?>
            <br>
            <h5 class="text-center">Transfer History</h5>
            <?php
if (isset($_POST['transferSelf'])) {
    $otherNo = $_POST['otherNo'];
    $upiPin = $_POST['upiPin']; // Get the entered UPI PIN

// Check if the sender's account number is the same as the receiver's account number
if ($userData['accountNo'] === $otherNo) {
    echo "<div class='alert alert-danger'>You cannot transfer money to your own account.</div>";
    return;
}

// Increment the Daily_Transaction_Count in the database
$updateDailyTransactionQuery = "UPDATE useraccounts SET Daily_Transaction_Count = Daily_Transaction_Count + 1 WHERE id = '$userId'";
$con->query($updateDailyTransactionQuery);



// Fetch the account creation date of the receiver
$query = "SELECT date FROM useraccounts WHERE accountNo = '$otherNo'";
$result = $con->query($query);

if ($result->num_rows > 0) {
    $receiverData = $result->fetch_assoc();
    $accountCreationDate = $receiverData['date']; // Timestamp from the database

    // Calculate the account age in days
    $currentDate = new DateTime(); // Current date
    $creationDate = new DateTime($accountCreationDate); // Account creation date
    $interval = $currentDate->diff($creationDate); // Difference between dates
    $accountAgeInDays = $interval->days; // Get the difference in days

    // Ensure the account age fits within VARCHAR(10)
    $accountAgeInDays = min($accountAgeInDays, 9999999999); // Truncate if it exceeds 10 characters

    // Update the Acc_Age column in the useraccounts table
    $updateAccAgeQuery = "UPDATE useraccounts SET Acc_Age = '$accountAgeInDays' WHERE accountNo = '$otherNo'";
    $con->query($updateAccAgeQuery);
}



// Calculate the average transaction amount
$avgQuery = "SELECT AVG(amount) AS avgAmount FROM (
    SELECT debit AS amount FROM transaction WHERE userId = '$userId' AND debit IS NOT NULL
    UNION ALL
    SELECT credit AS amount FROM transaction WHERE userId = '$userId' AND credit IS NOT NULL
) AS combined";
$avgResult = $con->query($avgQuery);

if ($avgResult->num_rows > 0) {
    $avgAmount = $avgResult->fetch_assoc()['avgAmount'];

    // Format the average amount to fit within VARCHAR(10)
    $avgAmount = number_format($avgAmount, 2); // Round to 2 decimal places

    // Ensure the formatted value does not exceed 10 characters
    if (strlen($avgAmount) > 10) {
        $avgAmount = substr($avgAmount, 0, 10); // Truncate to 10 characters
    }

    // Update Avg_Transaction_Amount in useraccounts table
    $updateAvgQuery = "UPDATE useraccounts SET Avg_Transaction_Amount = '$avgAmount' WHERE id = '$userId'";
    $con->query($updateAvgQuery);
}




    // Validate the UPI PIN
    $upiQuery = "SELECT upi_pin FROM useraccounts WHERE id = '$userId'";
    $upiResult = $con->query($upiQuery);
    if ($upiResult->num_rows > 0) {
        $storedUpiPin = $upiResult->fetch_assoc()['upi_pin'];

        if ($upiPin !== $storedUpiPin) {
            // Increment the Failed_Transaction_Count in the database
            $updateFailedTransactionQuery = "UPDATE useraccounts SET Failed_Transaction_Count = Failed_Transaction_Count + 1 WHERE id = '$userId'";
            $con->query($updateFailedTransactionQuery);
        
 // Insert a new row into the transaction table for "wrong pin"
 $amount = $_POST['amount'];
 $insertWrongPinTransactionQuery = "INSERT INTO transaction (userId, action, date, debit, credit, other) 
 VALUES ('$userId', 'wrong pin', NOW(), '$amount', NULL, '$otherNo')";
$con->query($insertWrongPinTransactionQuery);

 // Fetch the last 5 transactions with action as "wrong pin"
 $fetchWrongPinTransactionsQuery = "SELECT date FROM transaction WHERE userId = '$userId' AND action = 'wrong pin' ORDER BY date DESC LIMIT 5";
 $result = $con->query($fetchWrongPinTransactionsQuery);



 if ($result->num_rows >= 5) { // Ensure there are at least 5 transactions to calculate the time difference
     $dates = [];
     while ($row = $result->fetch_assoc()) {
         $dates[] = strtotime($row['date']); // Convert dates to timestamps
     }

     // Calculate the time difference between the earliest and the latest transactions
     $timeDifference = max($dates) - min($dates); // Difference in seconds

     if ($timeDifference < 3600) { // Check if the time difference is less than 1 hour (3600 seconds)
         // Update Previous_Fraudulent_Activity in the useraccounts table
         $updateFraudulentActivityQuery = "UPDATE useraccounts SET Previous_Fraudulent_Activity = '1' WHERE id = '$userId'";
         $con->query($updateFraudulentActivityQuery);
     }
 }



            // Show an alert and redirect back to the transfer page
            echo "<script>
                alert('Invalid UPI PIN. Please try again.');
                window.location.href = 'transfer.php';
            </script>";
            exit; // Stop further execution
        }
    } else {
        echo "<div class='alert alert-danger'>Unable to validate UPI PIN. Please try again later.</div>";
        return;
    }

    // Proceed with fraud detection and transfer
    $query = "SELECT * FROM useraccounts WHERE accountNo = '$otherNo'";
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        $OtherData = $result->fetch_assoc();
    } else {
        die("User data not found.");
    }

    // Fetch sender's aadhaar and number
    $amount = $_POST['amount'];
    $sender_balance = $OtherData['balance'];
    $sender_pfa = $OtherData['Previous_Fraudulent_Activity'];
    $sender_dtc = $OtherData['Daily_Transaction_Count'];
    $sender_ftc = $OtherData['Failed_Transaction_Count'];
    $sender_avg = $OtherData['Avg_Transaction_Amount'];
    $sender_acc_age = $OtherData['Acc_Age'];
    $sender_rs = $OtherData['Risk_Score'];
  

    // Call the Python script for fraud detection
   
$command = escapeshellcmd("python e:/XAMPP/htdocs/bank/assets/fraud_detection2.py $amount $sender_balance $sender_pfa $sender_dtc $sender_avg $sender_ftc $sender_acc_age $sender_rs");



    $output = shell_exec($command . " 2>&1"); // Capture both output and errors

    error_log("Command: $command");
    error_log("Output: $output");

    // Check if the transaction is fraudulent
    if ($output === null || trim($output) === '') {
        error_log("Fraud detection script failed. Command: $command, Output: $output");
        echo "<div class='alert alert-warning'>Unable to determine if the transaction is fraudulent. Please try again later.</div>";
    } else {
        $is_fraud = trim($output) == '1';

        if ($is_fraud) {
            $amount = $_POST['amount'];
            makeTransaction('fraud', $amount, $otherNo); // Only one transaction for fraud
            echo "<div class='alert alert-danger'>Transfer Failed: The Receiver account is flagged as fraudulent!</div>";
        } else {
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
                    $amount = $row['action'] == 'debit' || $row['action'] == 'withdraw' || $row['action'] == 'fraud' || $row['action'] == 'wrong pin' ? $row['debit'] : $row['credit'];
                    $amount = isset($amount) ? $amount : 'N/A';
                    $otherNo = isset($row['other']) ? $row['other'] : 'N/A';

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