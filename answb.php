<?php
session_start();
if(!isset($_SESSION['answ_true']))
header('Location:index.php');

	$_SESSION['answa'] = $_SESSION['answb'];
	
header('Location:answa.php');

