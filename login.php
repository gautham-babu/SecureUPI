<!DOCTYPE html>
<html>
<head>
<title>UPI</title>
	<?php require 'assets/autoloader.php'; ?>
	<?php require 'assets/function.php'; ?>
	<?php
    $con = new mysqli('localhost','root','1997','mybank');
    define('bankName', 'Secure UPI');
	
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
		      $error = "<div style='height: 40px;'></div><div class='alert alert-warning text-center rounded-0'>Incorrect Username or Password, try again!</div>";
		    }
		}
		if (isset($_POST['cashierLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from management where email='$user' AND password='$pass'");
		    if($result->num_rows>0)
		    { 
		      session_start();
		      $data = $result->fetch_assoc();
		      $_SESSION['cashId']=$data['id'];
		      header('location:cindex.php');
		     }
		    else
		    {
				$error = "<div style='height: 40px;'></div><div class='alert alert-warning text-center rounded-0'>Incorrect Username or Password, try again!</div>";
		    }
		}
		if (isset($_POST['managerLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from management where email='$user' AND password='$pass' AND type='manager'");
		    if($result->num_rows>0)
			{ 
		      session_start();
		      $data = $result->fetch_assoc();
		      $_SESSION['managerId']=$data['id'];
		      header('location:mindex.php');
		    }
		    else
		    {
				$error = "<div style='height: 40px;'></div><div class='alert alert-warning text-center rounded-0'>Incorrect Username or Password, try again!</div>";
		    }
		}
	?>
</head>
<body style="background: url(images/image2.jpg);background-size: 100%">
	
<h6 <small class="float-right text-muted" style="font-size: 14pt;"><kbd>Presented by:Emmanuel,Fidha,Liya,Gautham</kbd></small></h6>
<br>
<?php echo $error ?>
<br><br><br>

<div id="accordion" role="tablist" class="w-25 float-right shadowBlack" style="margin: 180px 565px">
	<br><h4 class="text-center text-black">Select Your Session</h4>
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a style="text-decoration: none;" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <button class="btn btn-outline-success btn-block">User Login</button>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       <form method="POST">
       	<input type="email" value="liya@gmail.com" name="email" class="form-control" required placeholder="Enter Email">
       	<input type="password" name="password" value="liya123" class="form-control" required placeholder="Enter Password">
       	<button type="submit" class="btn btn-primary btn-block btn-sm my-1" name="userLogin">Enter </button>
       </form>
      </div>
    </div>
  </div>
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed btn btn-outline-success btn-block" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Admin Login
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
         <form method="POST">
       	<input type="email" value="admin@gmail.com" name="email" class="form-control" required placeholder="Enter Email">
       	<input type="password" name="password" value="admin" class="form-control" required placeholder="Enter Password">
       	<button type="submit" class="btn btn-primary btn-block btn-sm my-1" name="managerLogin">Enter </button>
       </form>
      </div>
    </div>
  </div>
  
 </div> 
</body>
</html>