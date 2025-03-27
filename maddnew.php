<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
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
      
      <li class="nav-item ">  <a class="nav-link active" href="maddnew.php">Add New Account</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>

    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
  </div>
</nav><br><br><br>
<?php
if (isset($_POST['saveAccount']))
{
  if (!$con->query("insert into useraccounts (name,aadhaar,accountNo,upi_pin,address,email,password,balance,number,branch,Previous_Fraudulent_Activity,Daily_Transaction_Count,Failed_Transaction_Count) values ('$_POST[name]','$_POST[aadhaar]','$_POST[accountNo]','$_POST[upi_pin]','$_POST[address]','$_POST[email]','$_POST[password]','$_POST[balance]','$_POST[number]','$_POST[branch]','0','0','0')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>Account added Successfully</div>";

}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from login where id ='$_GET[del]'");
}
  
  
 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
   New Account Form
  </div>
  <div class="card-body bg-white text-dark">
    <table class="table">
      <tbody>
        <tr>
          <form method="POST">
          <th>Name</th>
          <td><input type="text" name="name" class="form-control input-sm" required></td>
          <th>Aadhaar</th>
          <td><input type="number" name="aadhaar" class="form-control input-sm" required></td>
        </tr>
        <tr>
          <th>UPI Id</th>
          <td><input type="" name="accountNo" readonly value="<?php echo time() ?>" class="form-control input-sm" required></td>
          <th>UPI Pin</th>
          <td><input type="number" name="upi_pin" class="form-control input-sm" required></td>
        </tr>
        <tr>
          
          <th>Address</th>
          <td><input type="text" name="address" class="form-control input-sm" required></td>
          <th>Contact Number</th>
          <td><input type="number" name="number"  class="form-control input-sm" required></td>
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
                $arr = $con->query("select * from branch");
                if ($arr->num_rows > 0)
                {
                  while ($row = $arr->fetch_assoc())
                  {
                    echo "<option value='$row[branchId]'>$row[branchName]</option>";
                  }
                }
                else
                  echo "<option value='1'>Main Branch</option>";
               ?>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Save Account</button>
            <button type="Reset" class="btn btn-secondary btn-sm">Reset</button></form>
          </td>
        </tr>
      </tbody>
    </table>
    

  </div>
  <div class="card-footer text-muted">
   <p>Secure UPI</p>
  </div>
</div>
</body>
</html>