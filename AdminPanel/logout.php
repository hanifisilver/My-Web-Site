<?php

session_start();

if(isset($_SESSION['AdminID']))
{
	unset($_SESSION['AdminID']);

}
session_destroy();
header("Location: login.php");
die;
?>