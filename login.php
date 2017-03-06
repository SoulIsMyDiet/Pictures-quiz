<?php

session_start();
if((!isset($_POST['login'])) || (!isset($_POST['pass'])))
{
	header('Location:index.php');
	exit();
}

require_once "connection.php";
try
{
$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if($connection->connect_errno !=0)
{
	throw new Exception($connection->error);
}
else
{
	$login = $_POST['login'];
	$password = $_POST['pass'];
//login and password from index.php
	
	$login = htmlentities($login, ENT_NOQUOTES, "UTF-8");
	$password = htmlentities($password, ENT_NOQUOTES, "UTF-8");
//protection from sql injection

	if($result = @$connection->query(sprintf("SELECT * FROM users WHERE user='%s'", mysqli_real_escape_string($connection,$login)))) //protection from injection again and query searching for a player
	{
		$users = $result->num_rows;
		if($users>0)
		{
			$row = $result->fetch_assoc();
			if(password_verify($password,$row['pass'])) //function comapring password we gave with hashed password from base
			{
				$_SESSION['logged_in'] = true;
				$_SESSION['iduser'] = $row['id'];
				$_SESSION['user'] = $row['user'];
				$result->free_result();
				header('Location: pictures.php');
			}
			else
			{
				$_SESSION['error'] = '<span style="color:blue">nie ma takiego hasla lub loginu</span>';
				header('Location: index.php');
			}
		}
		else
		{
			$_SESSION['error'] = '<span style="color:blue">nie ma takiego hasla lub loginu</span>';
			header('Location: index.php');
		}
	}
	else
	{
		echo "cos nie tak";
	}
	}
}
	catch(Exception $e)
	{
		echo '<div class="error">Jakis blad serwera</div>';
			//echo "<br>"."dodatkowa informacja".$e;
	}

	$connection->close();