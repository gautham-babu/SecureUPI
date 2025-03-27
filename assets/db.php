<?php 
    $con = new mysqli('localhost','root','1997','mybank');
    define('bankName', 'Secure UPI');
    $ar = $con->query("select * from useraccounts,branch where id = '$_SESSION[userId]' AND userAccounts.branch = branch.branchId");
    $userData = $ar->fetch_assoc();
?>
<script type="text/javascript">
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>