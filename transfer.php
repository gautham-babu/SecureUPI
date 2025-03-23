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
</head>
<body style="background:#ffffff;background-size: 100%">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #244f9e;">
    <a class="navbar-brand" href="#">
        <img src="images/federal.png" width="130" height="30" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item "> <a class="nav-link" href="accounts.php">View Profile</a></li>
            <li class="nav-item "> <a class="nav-link" href="statements.php">Account Statement</a></li>
            <li class="nav-item active"> <a class="nav-link" href="transfer.php">Transfer</a></li>
        </ul>
        <?php include 'sideButton.php'; ?>
    </div>
</nav><br><br><br>
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
                        echo "<div class='alert alert-danger'>Transfer Failed: The Receiver account is flagged as fraudulent!</div>";
                       
                      } else {
                        // If the transaction is not fraudulent, proceed with the transfer
                        echo "<div class='alert alert-success'>Transaction is not fraudulent. Proceeding with transfer...</div>";
                        $amount = $_POST['amount'];
                        setBalance($amount, 'debit', $userData['accountNo']);
                        setBalance($amount, 'credit', $otherNo);
                        makeTransaction('transfer', $amount, $otherNo);
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
                    $amount = $row['action'] == 'transfer' || $row['action'] == 'withdraw' ? $row['debit'] : $row['credit'];
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
            <?php echo bankName ?>
        </div>
    </div>
</div>
</body>
</html>