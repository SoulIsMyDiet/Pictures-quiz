<?php
session_start();
if(!isset($_SESSION['answ_true_from']))
header('Location:index.php');
$_SESSION['answ_true'] = 2;
if($_POST['year'] < $_SESSION['answ_true_from'])
{
	$difference = $_SESSION['answ_true_from'] - $_POST['year'];
}
elseif($_POST['year'] > $_SESSION['answ_true_to'])
{
	$difference =$_POST['year']  - $_SESSION['answ_true_to'];
}
else
	$difference = 0;
//getting an "absolote" value of how close we were
if($difference == 0)
{
	$_SESSION['value'] = '<div id="true"  >idealnie</div>';
	$_SESSION['answa'] = 2; // reminder:$_SESSION['answ_true'] = 2;
}
elseif ($difference <= 100)
{
	$_SESSION['value'] = '<div id="true" >brawo</div>';
	$_SESSION['answa'] = 2; //2nd reminder: $_SESSION['answ_true'] = 2;
	
}
elseif($difference > 100)
{
	$_SESSION['value'] = '<div id="not_true"  >pomyliles</div>';
	$_SESSION['answa'] = 1; //3rd reminder: $_SESSION['answ_true'] = 2;
}
else
	{
	$_SESSION['value'] = '<div id="not_true"  >idealnie</div>';
}

unset($_SESSION['answ_true_from']);
unset($_SESSION['answ_true_to']);
header('Location:answa.php');