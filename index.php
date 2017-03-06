<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.min.css"  />
<link rel="stylesheet" href="css/bootstrap-theme.min.css"  />
<script src="js/jquery-3.1.1.js"> </script>
</head>

<body style="background-image: url('pictures/tlo.jpg');">
	<div class="container" style="background-image: url(pictures/drewno.jpg);">
		<div class="row">
			<div class="col-xs-8">
			
				<h3 >Witam we wspaniałym quizie o obrazach<br/>Zaloguj się by zagrać!</h3><br/><br/>

				<form action="login.php" method="post">
					<div class="form-group">
						<label for="login">Login</label>
						<input class="form-control" type="text" name="login" id="login"/>
					</div>
					<div class="form-group">
						<label for="password">Hasło</label>	
						<input class="form-control" type="password" name = "pass" id="password"/>
					</div>
					<div class="form-group">
						<input type="submit" value="Zaloguj się" class="btn btn-primary"/>
					</div>
				</form>
				<div class="row" style="margin-top: 50px;">
					<div class="col-xs-8">
						<form action="registration.php" method="post">
							<div class="form-group">
								<input type="submit" value="Zarejestruj się" class="btn btn-default"/>
							</form>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</body>

<?php
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
{
	
	header('Location:pictures.php');
	exit();
}
if(isset($_SESSION['error'])) echo $_SESSION['error'];
?>

<script src="js/bootstrap.min "> </script>
&copy Marek Dzilne 2017
</html>