<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-2" />
<link rel="stylesheet" href="css/bootstrap.min.css"  />
<link rel="stylesheet" href="css/bootstrap-theme.min.css"  />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script src="js/jquery-3.1.1.js"> </script>


</head>
<body style="background-image: url('pictures/tlo.jpg');">
<?php
session_start();
require_once "connection.php";
require_once "Variety.php";
if(!isset($_SESSION['picture']))
{
	header('Location:index.php');
	exit;
}

$_SESSION['category'] = "year_answ";
try
{
$connection = new mysqli($host, $db_user, $db_password, $db_name);
if($connection->connect_errno !=0)
{
	throw new Exception(mysqli_connect_error());
}
else
{
	$result = $connection->query("SELECT * FROM table_pictures WHERE ID=".$_SESSION['id']);
	if(!$result) throw new Exception($connection->error);
	$row = $result->fetch_assoc();
	$picture = '<img class="img-responsive" style="border: 6px solid brown;"src="pictures/'.$row['ID'].'.jpg"/>';
	$_SESSION['answ_true_from']= $row['year_from'];
	$_SESSION['answ_true_to']= $row['year_to'];
	//fetched good answer and id of a picture we need
	?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="glyphicon glyphicon-align-justify"></span>
      </button>
      <a class="navbar-brand" href="#">Zalogowany: <?php echo $_SESSION['user'] ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
  <li role="presentation" class="active"><a href="#">Gra</a></li>
  <li role="presentation"><a href="stats.php">Statystyki</a></li>
  <li role="presentation"><a href="logout.php">Wyloguj sie</a></li>
  </ul>
	    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container" style="background-image: url('pictures/drewno.jpg');">

  <div class="row">
<div class="col-xs-10 col-xs-push-1 col-sm-6 col-sm-push-3 col-lg-4 col-lg-push-4" style="margin-top: 40px; margin-bottom: 50px;">
<?php

echo $picture;
echo "<b>W którym roku namalowano obraz?(można pomylić się o 100 lat)</b>";
?>

</div>
</div>


	
<div>
	<form action="trueyear.php" method="post">
		<div class="form-group">
			<label for="check">Wpisz wartość</label>
			<input class="form-control" type="text" name="year" id="check"/>
		</div>
		<div class="form-group">
			<input type="submit" value="Sprawdź" class="btn btn-primary"/>
		</div>
	</form>
</div>

</body>
<script src="js/bootstrap.min.js "> </script>
&copy Marek Dzilne 2017
</html>


<?php
unset($_SESSION['picture']);
$connection->close();
}
}
	catch(Exception $e)
	{
		echo '<div class="error">Jakis blad serwera</div>';
			//echo "<br>"."dodatkowa informacja".$e;
	}
/* if(isset($_POST['year']))
header('Location:index.php'); */
