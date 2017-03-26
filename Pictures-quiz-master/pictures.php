<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" href="css/bootstrap.min.css"  />
<link rel="stylesheet" href="css/bootstrap-theme.min.css"  />
<script src="js/jquery.min.js"> </script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
 session_start();
?>

</head>
<body style="background-image: url('pictures/tlo.jpg');">
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

<?php
$_SESSION['picture'] = true;
$good = '<img class="lpicture" src="pictures/2z.jpg"/>'; //sign of good answer
$bad = '<img class="lpicture" src="pictures/1z.jpg"/>'; //sign of bad answer

 if(!isset($_SESSION['logged_in']))
{
	header('Location:index.php');
	exit();
} 

unset($_SESSION['error']);

require_once "connection.php";
try
{
$connection = new mysqli($host, $db_user, $db_password, $db_name);
if($connection->connect_errno !=0)
{
	echo "error{$connection->connect_errno}";
}
else
{
	
	$result = $connection->query("SELECT * FROM table_pictures ORDER BY RAND() LIMIT 1");
	if(!$result) throw new Exception($connection->error);
	$row = $result->fetch_assoc();
	//random one picture from base
	$picture = '<img class="img-responsive" style="border: 6px solid brown;"src="pictures/'.$row['ID'].'.jpg"/>';
	$_SESSION['id']=$row['ID'];
	if($result = $connection->query("SELECT * FROM ".$_SESSION['user']."_last_question WHERE picture_id=".$_SESSION['id']))
	{
		$numrows = $result->num_rows;
		if($numrows>0)
		{
			$answered = $result->fetch_assoc();
			$_SESSION['answer'] = $answered;
			//do if the user answered some questions about this picture before
		}
		else
		{
unset($_SESSION['answer']);		
		}
	}
}
?>
      
  
  
	<div class="row">
		<div class="col-xs-10 col-xs-push-1 col-sm-6 col-sm-push-3 col-lg-4 col-lg-push-4" style="margin-top: 40px; margin-bottom: 50px;">
<?php
	echo $picture;
	echo '<b style="text-align: center;">Wybierz kategorie!</b>';
?>
		</div>
	</div>

<div class="row">
		<div class="col-xs-push-1 col-xs-8 col-sm-push-2 col-sm-5 ">
			<div class="row">
				<label>
					<div class="signer">
						<form action="name.php">
							<input style="display: none"  type="submit">
						</form>
						<?php echo "Tytuł"; ?>
					</div>
				</label>
			</div>
		</div>
	<div class="col-xs-4 col-xs-pull-2 col-sm-1">
		<div class="signery">
		<?php
			if(isset($answered['name_answ']))
		{
			if($answered['name_answ']==1) echo $bad;
			if($answered['name_answ']>1) echo $good;
		}
			//view correct sign dependly on given answer(same with others below)
		?>
		</div>
	</div>





	
			<div class="col-xs-push-1 col-xs-8 col-sm-push-2 col-sm-5 ">
				<div class="row">
					<label>
						<div class="signer">
							<form action="author.php">
								<input style="display: none"  type="submit">
							</form>
							<?php echo "Autor"; ?>
						</div>
					</label>
				</div>
			</div>
		<div class="col-xs-pull-2 col-xs-4 col-sm-1">
			<div class="signery">
			<?php
				if(isset($answered['author_answ']))
			{
				if($answered['author_answ']==1) echo $bad;
				if($answered['author_answ']>1) echo $good;
			}
			?>
			</div>
		</div>
</div>

<!--<div class="row">
<div style="height: 10px;"></div>
</div>-->

<div class="row">
		<div class="col-xs-push-1 col-xs-8 col-sm-push-2 col-sm-5 ">
			<div class="row">
				<label>
					<div class="signer">
						<form action="museum.php">
							<input style="display: none"  type="submit">
						</form>
						<?php echo "Muzeum"; ?>
					</div>
				</label>
			</div>
		</div>
	<div class="col-xs-pull-2 col-xs-4 col-sm-1 ">
		<div class="signery">
		<?php
			if(isset($answered['museum_answ']))
		{
			if($answered['museum_answ']==1) echo $bad;
			if($answered['museum_answ']>1) echo $good;
		}
		?>
		</div>
	</div>
	<div class="col-xs-8 col-xs-push-1 col-sm-push-2 col-sm-5 ">
		<div class="row">
			<label>
				<div class="signer">
					<form  action="year.php">
						<input style="display: none" type="submit">
					</form>
					<?php echo "Rok"; ?>
				</div>
			</label>
		</div>
	</div>
	<div class="col-xs-4  col-xs-pull-2 col-sm-1 ">
		<div class="signery">
		<?php
			if(isset($answered['year_answ']))
		{
			if($answered['year_answ']==1) echo $bad;
			if($answered['year_answ']>1) echo $good;
		}
		?>
		</div>
	</div>
</div>

<?php
if(isset($_SESSION['answ1']))
{
	echo $_SESSION['answ1'];
}

$connection->close();
}
	catch(Exception $e)
	{
		echo '<div class="error">Jakis blad serwera</div>';
			//echo "<br>"."dodatkowa informacja ".$e;
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
