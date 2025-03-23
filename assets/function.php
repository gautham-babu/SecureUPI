<?php 
function setBalance($amount,$process,$accountNo)
{
	$con = new mysqli('localhost','root','1997','mybank');
	$array = $con->query("select * from userAccounts where accountNo='$accountNo'");
	$row = $array->fetch_assoc();
	if ($process == 'credit') 
	{
		$balance = $row['balance'] + $amount;
		return $con->query("update userAccounts set balance = '$balance' where accountNo = '$accountNo'");
	}else
	{
		$balance = $row['balance'] - $amount;
		return $con->query("update userAccounts set balance = '$balance' where accountNo = '$accountNo'");
	}
}

function makeTransaction($action,$amount,$other)
{
	$con = new mysqli('localhost','root','1997','mybank');


	$current = $_SESSION['userId'];
    $query = "SELECT * FROM useraccounts WHERE id = '$current'";
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        $currentData = $result->fetch_assoc();
    } else {
        die("User data not found.");
    }


	$otherNo = $other;
    $query = "SELECT * FROM useraccounts WHERE accountNo = '$otherNo'";
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        $OtherData = $result->fetch_assoc();
    } else {
        die("User data not found.");
    }


	if ($action == 'transfer')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('debit','$amount','$other','$_SESSION[userId]')");
	}
	if ($action == 'receive')
	{
		return $con->query("insert into transaction (action,credit,other,userId) values ('credit','$amount','$currentData[accountNo]','$OtherData[id]')");
	}
	if ($action == 'fraud')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('fraud','$amount','$other','$_SESSION[userId]')");
	}
	
	if ($action == 'withdraw')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('withdraw','$amount','$other','$_SESSION[userId]')");
		
	}
	if ($action == 'deposit')
	{
		return $con->query("insert into transaction (action,credit,other,userId) values ('deposit','$amount','$other','$_SESSION[userId]')");
		
	}
}
function makeTransactionCashier($action,$amount,$other,$userId)
{
	$con = new mysqli('localhost','root','1997','mybank');
	if ($action == 'transfer')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('transfer','$amount','$other','$userId')");
	}
	if ($action == 'withdraw')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('withdraw','$amount','$other','$userId')");
		
	}
	if ($action == 'deposit')
	{
		return $con->query("insert into transaction (action,credit,other,userId) values ('deposit','$amount','$other','$userId')");
		
	}
}
 ?>