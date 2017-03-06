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
<?php
session_start();
if(!isset($_SESSION['validation_acompl']))
{
	
	header('Location:index.php');
	exit();
}
else
{
	unset($_SESSION['validation_acompl']);

	require_once "connection.php";
	$connection = new mysqli($host, $db_user, $db_password, $db_name); // connecting with database
	if($connection->connect_errno !=0)
	{
		echo "error{$connection->connect_errno}";
	}
	else
	{
	
	$sql = 'CREATE TABLE `'.$_SESSION['nick'].'_last_question` (
  `ID_answ` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `name_answ` int(11) NOT NULL,
  `author_answ` int(11) NOT NULL,
  `museum_answ` int(11) NOT NULL,
  `year_answ` int(11) NOT NULL,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;';

//query that make individual table for each player. Table will have info about answers we give

	$result = $connection->query($sql);
	
	$connection->close();
	}
}
 ?>
	<div class="jumbotron" style="margin-top:100px;">
		<div style="text-align: center;">
		<?php
			echo "Witaj i dziekujemy za rejestracje<br/>";
			echo '<p><a href="index.php" style="text-decoration: none;">Zaloguj </a> się na swoim nowym koncie</p>';
			//info about completing the registration
		?>
		</div>
	</div>
</body>
<script src="js/bootstrap.min.js "> </script>
&copy Marek Dzilne 2017
</html>