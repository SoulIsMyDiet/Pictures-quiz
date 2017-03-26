<?php
session_start();
if(isset($_POST['nick'])) 
{
	$allright= true; // flag change to false if something go wrong with validation
	
	$nick = $_POST['nick'];
	$_SESSION['nick'] = $nick;
	
	if((strlen($nick)<3) || (strlen($nick)>20))
	{
		$allright = false;
		$er_nick = "Nick musi posiadac od 3 do 20 znakow";
		//nick lenght validation
	}
	
	if(ctype_alnum($nick)==false)
	{
		$allright = false;
		$er_nick = "Nick musi składac sie tylko i wylacznie z liter oraz/lub cyfr";
		//nick letter/digits validation
	}
	$email = $_POST['email'];
	$emails = filter_var($email, FILTER_SANITIZE_EMAIL); // first step to validate e-mail adress
	
	if((filter_var($emails, FILTER_VALIDATE_EMAIL)==FALSE) || ($emails !=$email)) // second step to validate e-mail adress
	{
		
		$allright = false;
		$er_mail = "Mail nie poprawny";
		
	}

	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	If(strlen($password1)<8 || strlen($password2)>20)
	{
		$allright = false;
		$er_password1 = "haslo musi zawierac od 8 do 20 znakow";
		//password validation
		
	}	
	else
	{
		$password_hash = password_hash($password1, PASSWORD_DEFAULT); //hashing password
	}
	if($password1 != $password2)
	{
		$allright = false;
		$er_password2 = "hasla nie zgadzja sie ze soba";
		//password validation
	}
	if(!isset($_POST['regulation']))
	{
		$allright = false;
		$er_regulation = "Zaznacz regulamin";
		//regulation validation
	}
		$secret = "6LeOcw8UAAAAAOTcLu7jqJ4y941MkkGr4VrW3DS8";
		
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		
		$answer = json_decode($check);
		
		//3 lines above provides us to check if user is a bot
		
	if($answer->success==false)
	{
			$allright = false;
			$er_bot= "czyzbys byl botem?";
			//bot validation
	}
		
	require_once "connection.php";
	mysqli_report(MYSQLI_REPORT_STRICT);

	try
	{
			$connection = new mysqli($host, $db_user, $db_password , $db_name); // connecting with database
			if($connection->connect_errno !=0)
			{
				throw new Exception(mysqli_connect_error());
			}
			else
			{
				$result = $connection->query("SELECT id FROM users WHERE email='$email'");
				
					if(!$result) throw new Exception($connection->error);
					else
					{	
						$ile_maili = $result->num_rows;	
						
							if($ile_maili > 0)
							{
								$allright = false;
								$er_mail_again = "Istnieje juz konto takie jak to"; 
								//checking if there is already such an email adress
							}
					}
					
				$result = $connection->query("SELECT id FROM users WHERE user='$nick'");
				if(!$result) throw new Exception($connection->error);
				else
					{	
						$how_nicks = $result->num_rows;	//*how much nicks
						if($how_nicks > 0)
						{
							$allright = false;
							$er_nick = "Istnieje juz konto takie jak to"; 
							//checking if there is already such a nick in our base
						}
					}
				if($allright==true)
					{
						if($connection->query("INSERT INTO users VALUES(NULL, '$nick', '$password_hash', '$email')"))
						{
							$_SESSION['validation_acompl'] = true;
			
							header('Location:welcome.php');
							
							//if everything is ok we are heading further
						}
						else
						{
							throw new Exception($connection->error);
						}
					}
			}
			$connection->close();
	}
	catch(Exception $e)
	{
		echo '<div class="error">Jakis blad serwera</div>';
			//echo "<br>"."dodatkowa informacja ".$e;
	}
}
// 6LeOcw8UAAAAAOvOeBCA0s8TMdXUSnz6YNtOnmBI site key available
//6LeOcw8UAAAAAOTcLu7jqJ4y941MkkGr4VrW3DS8 secret key 

?>
<html>
<head>
<title>zaloz darmowe konto</title>
<script src='https://www.google.com/recaptcha/api.js'></script>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.min.css"  />
<link rel="stylesheet" href="css/bootstrap-theme.min.css"  />
<script src="js/jquery.min.js"> </script>
</head>
<body style="background-image: url('pictures/tlo.jpg');">
	<div class="container" style="background-image: url(pictures/drewno.jpg);">
		<div class="row">
			<div class="col-xs-8">

				<form method="post">
					<div class="form-group">
						<label for="nick">Nick</label>
						<input class="form-control" type="text" name="nick" id="nick"/>
					</div>
<?php
if(isset($er_nick))
{
	echo '<div class="error">'.$er_nick.'</div>';
	//info about bad nick
}
?>
					<div class="form-group">
						<label for="email">E-mail</label>
						<input class="form-control" type="email" name="email" id="email"/>
					</div>
<?php
if(isset($er_mail))
{
	echo '<div class="error">'.$er_mail.'</div>';
	//info about bad e-mail adress
}
if(isset($er_mail_again))
{
	echo '<div class="error">'.$er_mail_again.'</div>';
	//info about bad second e-mail adress (not in use right now)
}
?>

					<div class="form-group">
						<label for="password1">Hasło</label>
						<input class="form-control" type="password" name="password1" id="password1"/>
					</div>
<?php
if(isset($er_password1))
{
	echo '<div class="error">'.$er_password1.'</div>';
	//info about bad password
}
?>

					<div class="form-group">
						<label for="password2">Powtórz hasło</label>
						<input class="form-control" type="password" name="password2" id="password2"/>
					</div>
<?php
if(isset($er_password2))
{
	echo '<div class="error">'.$er_password2.'</div>';
	//info about bad second password
}
?>
					<label>
						<input type="checkbox" name="regulation">Akceptuje regulamin
					</label>
<?php
if(isset($er_regulation))
{
	echo '<div class="error">'.$er_regulation.'</div>';
	//info when not checked regulation box
}
?>
					<div class="g-recaptcha" data-sitekey="6LeOcw8UAAAAAOvOeBCA0s8TMdXUSnz6YNtOnmBI"></div><br/>
<?php
if(isset($er_bot))
{
	echo '<div class="error">'.$er_bot.'</div>';
	//info when not checked recaptcha box
}
?>

					<div class="form-group">
						<input type="submit" value="Zarejestruj się" class="btn btn-default"/>
					</div>


				</form>
			</div>
		</div>
	</div>
</body>
<script src="js/bootstrap.min.js "> </script>
&copy Marek Dzilne 2017
</html>
