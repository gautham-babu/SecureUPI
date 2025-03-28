<?php
session_start();
if (!isset($_SESSION['managerId'])) { header('location:login.php'); }
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
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(100px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            color: #007bff;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
    <script>
        (function () {
            emailjs.init("uHasjq7B0siEy0lAu"); // Replace with your Email.js public key
        })();
    </script>
</head>
<body style="background:#ffffff;background-size: 100%">
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" width="130" height="30" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="mindex.php">Customers</a></li>
                <li class="nav-item"><a class="nav-link active" href="maddnew.php">Add New Account</a></li>
                <li class="nav-item"><a class="nav-link" href="mfeedback.php">Feedback</a></li>
            </ul>
            <?php include 'msideButton.php'; ?>
        </div>
    </div>
</nav>
<br><br><br>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendOTP'])) {
    // Step 1: Generate OTP and store it in session
    $_SESSION['generatedOTP'] = rand(100000, 999999);
    $_SESSION['otpData'] = $_POST; // Save form data in session temporarily
    $recipientEmail = $_POST['email'];

    echo "
    <script>
        emailjs.send('service_lwe5j15', 'template_e6vorv7', {
            to_email: '$recipientEmail',
            otp: '{$_SESSION['generatedOTP']}'
        }).then(function(response) {
            alert('OTP sent successfully to $recipientEmail!');
        }, function(error) {
            alert('Failed to send OTP. Error: ' + JSON.stringify(error));
        });
    </script>
    ";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verifyOTP'])) {
    // Step 2: Verify OTP
    $enteredOTP = $_POST['otp'];
    if ($enteredOTP == $_SESSION['generatedOTP']) {
        // OTP verified, create the account
        $data = $_SESSION['otpData']; // Retrieve the saved form data
        if ($con->query("INSERT INTO useraccounts (name, aadhaar, accountNo, upi_pin, address, email, password, balance, number, branch, Previous_Fraudulent_Activity, Daily_Transaction_Count, Failed_Transaction_Count) VALUES 
            ('{$data['name']}', '{$data['aadhaar']}', '{$data['accountNo']}', '{$data['upi_pin']}', '{$data['address']}', '{$data['email']}', '{$data['password']}', '{$data['balance']}', '{$data['number']}', '{$data['branch']}', '0', '0', '0')")) {
            echo "<div class='alert alert-info text-center'>Account added Successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $con->error . "</div>";
        }
        unset($_SESSION['generatedOTP'], $_SESSION['otpData']); // Clear OTP session data
    } else {
        echo "<div class='alert alert-danger'>Invalid OTP. Please try again.</div>";
    }
}
?>

<div class="container">
    <div class="card w-100 text-center shadowBlue">
        <div class="card-header">New Account Form</div>
        <div class="card-body bg-white text-dark">
            <form method="POST">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <td><input type="text" name="name" class="form-control input-sm" required></td>
                        <th>Aadhaar</th>
                        <td><input type="number" name="aadhaar" class="form-control input-sm" required></td>
                    </tr>
                    <tr>
                        <th>UPI Id</th>
                        <td><input type="text" name="accountNo" readonly value="<?php echo time(); ?>" class="form-control input-sm" required></td>
                        <th>UPI Pin</th>
                        <td><input type="number" name="upi_pin" class="form-control input-sm" required></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><input type="text" name="address" class="form-control input-sm" required></td>
                        <th>Contact Number</th>
                        <td><input type="number" name="number" class="form-control input-sm" required></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="email" name="email" class="form-control input-sm" required></td>
                        <th>Password</th>
                        <td><input type="password" name="password" class="form-control input-sm" required></td>
                    </tr>
                    <tr>
                        <th>Deposit</th>
                        <td><input type="number" name="balance" min="500" class="form-control input-sm" required></td>
                        <th>Branch</th>
                        <td>
                            <select name="branch" required class="form-control input-sm">
                                <option selected value="">Choose Branch</option>
                                <?php
                                $arr = $con->query("SELECT * FROM branch");
                                if ($arr->num_rows > 0) {
                                    while ($row = $arr->fetch_assoc()) {
                                        echo "<option value='{$row['branchId']}'>{$row['branchName']}</option>";
                                    }
                                } else {
                                    echo "<option value='1'>Main Branch</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button type="submit" name="sendOTP" class="btn btn-primary btn-sm">Send OTP</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
            <?php if (isset($_SESSION['generatedOTP'])): ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="otp">Enter OTP</label>
                        <input type="number" name="otp" class="form-control input-sm" required>
                    </div>
                    <button type="submit" name="verifyOTP" class="btn btn-success btn-sm">Verify OTP</button>
                </form>
            <?php endif; ?>
        </div>
        <div class="card-footer text-muted">
            <p>Secure UPI</p>
        </div>
    </div>
</div>
</body>
</html>
