<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-2" />
<link rel="stylesheet" href="css/bootstrap.min.css"  />
<link rel="stylesheet" href="css/bootstrap-theme.min.css"  />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script src="js/jquery.min.js"> </script>


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

$_SESSION['category'] = "museum_answ";

try
{
$pdo = new PDO('mysql:host=localhost;dbname=obrazy;charset=utf8', 'root', '');

//if($pdo->connect_errno !=0)
//{
	//echo "error{$connection->connect_errno}";
	
//}
//else

	$result = $pdo->query("SELECT museum FROM table_pictures WHERE ID=".$_SESSION['id']." union (SELECT DISTINCT museum FROM table_pictures WHERE ID != ".$_SESSION['id']." ORDER BY RAND() LIMIT 4)"); //yes 4 :P
	$row = $result->fetchAll();
	$result = null;
	//print_r($row);
	//fetching good answer and 3 random answers from base
	$result = $pdo->query("SELECT * FROM table_pictures WHERE ID=".$_SESSION['id']);
	$name = $result->fetch(PDO::FETCH_ASSOC);
	$picture = '<img class="img-responsive" style="border: 6px solid brown;"src="pictures/'.$name['ID'].'.jpg"/>';
	//3 lines above needed for viewing the correct picture
	$_SESSION['answ_true']= $row[0][0]; 
	$pdo = null;
	$result = null;
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
echo "<b>Do którego muzeum należy ten obraz?</b>";
?>
</div>
</div>
<?php
$rand = new variety();
 $tab = $rand->randomize1();
//check the class
?>
<div class="row">
	<div class="col-xs-push-1 col-xs-8 col-sm-push-2 col-sm-5 ">
		<div class="row">
			<label>
				<div class="signer">
					<form action="answa.php">
						<input style="display: none"  type="submit">
					</form>
			<?php 
				$_SESSION['answa']=$row[$tab[0]][0];
				echo $row[$tab[0]][0]; 
				//one of asnwers atributed to answer A. Similarly with the others below
			?>
				</div>
			</label>
		</div>
	</div>

	<div class="col-xs-push-1 col-xs-8 col-sm-push-2 col-sm-5 ">
		<div class="row">
			<label>
				<div class="signer">
					<form action="answb.php">
						<input style="display: none"  type="submit">
					</form>
			<?php
				$_SESSION['answb']=$row[$tab[1]][0];
				echo $row[$tab[1]][0]; 
			?>
				</div>
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-push-1 col-xs-8 col-sm-push-2 col-sm-5 ">
		<div class="row">
			<label>
				<div class="signer">
					<form action="answc.php">
						<input style="display: none"  type="submit">
					</form>
			<?php
				$_SESSION['answc']=$row[$tab[2]][0];
				echo $row[$tab[2]][0]; 
			?>
				</div>
			</label>
		</div>
	</div>

	<div class="col-xs-push-1 col-xs-8 col-sm-push-2 col-sm-5 ">
		<div class="row">
			<label>
				<div class="signer">
					<form action="answd.php">
						<input style="display: none"  type="submit">
					</form>
			<?php 
				$_SESSION['answd']=$row[$tab[3]][0];
				echo $row[$tab[3]][0];
			?>
				</div>
			</label>
		</div>
	</div>
</div>

</div>
<?php
unset($_SESSION['picture']);
}
catch(PDOException $e)
{
	 echo "Połączenie nie mogło zostać utworzone: " . $e->getMessage();
}

?>
<script>

	 $(".signer").mouseover(function(){
		 $(this).css({backgroundColor: 'yellow' , color: 'red' });
	 });
	  $(".signer").mouseleave(function(){
		 $(this).css({backgroundColor: 'white' , color: 'black' });
	 });

</script>

</body>
<script src="js/bootstrap.min.js "> </script>
&copy Marek Dzilne 2017
</html>
