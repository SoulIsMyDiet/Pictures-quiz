<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" href="css/bootstrap.min.css"  />
<link rel="stylesheet" href="css/bootstrap-theme.min.css"  />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script src="js/jquery-3.1.1.js"> </script>
</head>
<body style="background-image: url('pictures/tlo.jpg');">
<?php
/* where '.$_SESSION['user'].'_last_question.update>="'.$date['update'].'" */  //little tint for author if he wanna change to limit
/* $result = $connection->query( 'SELECT " "_last_question.update FROM `" "_last_question` ORDER BY " "_last_question.update DESC limit 1 OFFSET 4');
	$date = $result->fetch_assoc(); */ //little tint for author if he wanna change to limit
	
session_start();
require_once "connection.php";
mysqli_report(MYSQLI_REPORT_STRICT);
	try
	{
		$connection = new mysqli($host, $db_user, $db_password , $db_name);
	
		if($connection->connect_errno !=0)
		{
			throw new Exception(mysqli_connect_error());
		}
		else
		{
	
			$result = $connection->query('SELECT name_answ, author_answ, museum_answ, year_answ, picture_id FROM `'.$_SESSION['user'].'_last_question` ORDER BY '.$_SESSION['user'].'_last_question.update DESC limit 5');
			if(!$result) throw new Exception($connection->error);
			$table = $result->fetch_all();
			//fetching last 5 picture we gave answers on them
			$result = $connection->query( 'SELECT COUNT(name_answ), name_answ FROM `'.$_SESSION['user'].'_last_question` GROUP BY name_answ');
			if(!$result) throw new Exception($connection->error);
			$title = $result->fetch_all();
			//needed for getting info about how many good answer we gave about name of the picture
			
				$title_answ = 0;
				$title_bad = 0;
					if(isset($title[0][1])){
					if($title[0][1] == 2)$title_answ = $title[0][0]; //according to the query name_answ ="2" and it means that we answered corectly
					if($title[0][1] == 1)$title_bad = $title[0][0]; //according to the query name_nasw = "1" and it means that we answered uncorectly
													}
					if(isset($title[1][1])){
					
					if($title[1][1] == 2)$title_answ = $title[1][0];
					if($title[1][1] == 1)$title_bad = $title[1][0];
													}
					if(isset($title[2][1]))$title_answ = $title[2][0]; //if there is 3rd row it means it have to be "2" what means " correct answer"
				//similarly with the others below
	
			$result = $connection->query( 'SELECT COUNT(author_answ), author_answ FROM `'.$_SESSION['user'].'_last_question` GROUP BY author_answ');
			if(!$result) throw new Exception($connection->error);
			$author = $result->fetch_all();
//needed for getting info about how many good answer we gave about author of the picture
				$author_answ = 0;
				$author_bad = 0;
					if(isset($author[0][1])){
					if($author[0][1] == 2)$author_answ = $author[0][0];
					if($author[0][1] == 1)$author_bad = $author[0][0];
													}
					if(isset($author[1][1])){
					
					if($author[1][1] == 2)$author_answ = $author[1][0];
					if($author[1][1] == 1)$author_bad = $author[1][0];
													}
					if(isset($author[2][1]))$author_answ = $author[2][0];
	
			$result = $connection->query( 'SELECT COUNT(museum_answ), museum_answ FROM `'.$_SESSION['user'].'_last_question` GROUP BY museum_answ');
			if(!$result) throw new Exception($connection->error);
			$museum = $result->fetch_all();
	//needed for getting info about how many good answer we gave about museum of the picture
				$museum_answ = 0;
				$museum_bad = 0;
					if(isset($museum[0][1])){
					if($museum[0][1] == 2)$museum_answ = $museum[0][0];
					if($museum[0][1] == 1)$museum_bad = $museum[0][0];
														}
					if(isset($museum[1][1])){
					
					if($museum[1][1] == 2)$museum_answ = $museum[1][0];
					if($museum[1][1] == 1)$museum_bad = $museum[1][0];
													}
					if(isset($museum[2][1]))$museum_answ = $museum[2][0];
	
			$result = $connection->query( 'SELECT COUNT(year_answ), year_answ FROM `'.$_SESSION['user'].'_last_question`  GROUP BY year_answ');
			if(!$result) throw new Exception($connection->error);
			$year = $result->fetch_all();
	//needed for getting info about how many good answer we gave about year-making of the picture
				$year_answ = 0;
				$year_bad = 0;
					if(isset($author[0][1])){
					if($year[0][1] == 2)$year_answ = $year[0][0];
					if($year[0][1] == 1)$year_bad = $year[0][0];
														}
					if(isset($year[1][1])){
					
					if($year[1][1] == 2)$year_answ = $year[1][0];
					if($year[1][1] == 1)$year_bad = $year[1][0];
													}
					if(isset($year[2][1]))$year_answ = $year[2][0];
	
			$answ = $title_answ + $author_answ +$museum_answ + $year_answ; // sum of good answers
			$bad = $title_bad + $author_bad +$museum_bad + $year_bad; // sum of bad answers
			if($answ !=0 || $bad !=0)
			$perc = $answ * 100/ ($answ + $bad); //perc value of good answers
	
	
		}
	$connection->close();
	}
	catch(Exception $e)
	{
		echo '<div class="error">Jakis blad serwera</div>';
		//echo "<br>"."dodatkowa informacja".$e;
	}
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
  <li role="presentation" ><a href="pictures.php">Gra</a></li>
  <li role="presentation" class="active"><a href="#">Statystyki</a></li>
  <li role="presentation"><a href="logout.php">Wyloguj sie</a></li>
  </ul>
	    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container" style="background-image: url('pictures/drewno.jpg');">

  <div class="row">

	<table class="table table-condensed">
		<thead>
		<tr>
			<td>
			obraz
			</td>
			<td>
			tytul
			</td>
			<td>
			autor
			</td>
			<td>
			muzeum
			</td>
			<td>
			rok
			</td>
			</tr>
		</thead>
		<tbody>
		<tr>
			<td>
			<?php
			if(isset($table[0][4]))
			echo '<img class="lpicture" src="pictures/'.$table[0][4].'.jpg"/>';
			?>
			</td>
			<td>
			<?php
			if(isset($table[0][4]))
			echo '<img class="lpicture" src="pictures/'.$table[0][0].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[0][4]))
			echo '<img class="lpicture" src="pictures/'.$table[0][1].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[0][4]))
			echo '<img class="lpicture" src="pictures/'.$table[0][2].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[0][4]))
			echo '<img class="lpicture" src="pictures/'.$table[0][3].'z.jpg"/>'
			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php
			if(isset($table[1][4]))
			echo '<img class="lpicture" src="pictures/'.$table[1][4].'.jpg"/>';
			?>
			</td>
			<td>
			<?php
			if(isset($table[1][4]))
			echo '<img class="lpicture" src="pictures/'.$table[1][0].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[1][4]))
			echo '<img class="lpicture" src="pictures/'.$table[1][1].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[1][4]))
			echo '<img class="lpicture" src="pictures/'.$table[1][2].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[1][4]))
			echo '<img class="lpicture" src="pictures/'.$table[1][3].'z.jpg"/>'
			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php
			if(isset($table[2][4]))
			echo '<img class="lpicture" src="pictures/'.$table[2][4].'.jpg"/>';
			?>
			</td>
			<td>
			<?php
			if(isset($table[2][4]))
			echo '<img class="lpicture" src="pictures/'.$table[2][0].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[2][4]))
			echo '<img class="lpicture" src="pictures/'.$table[2][1].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[2][4]))
			echo '<img class="lpicture" src="pictures/'.$table[2][2].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[2][4]))
			echo '<img class="lpicture" src="pictures/'.$table[2][3].'z.jpg"/>'
			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php
			if(isset($table[3][4]))
			echo '<img class="lpicture" src="pictures/'.$table[3][4].'.jpg"/>';
			?>
			</td>
			<td>
			<?php
			if(isset($table[3][4]))
			echo '<img class="lpicture" src="pictures/'.$table[3][0].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[3][4]))
			echo '<img class="lpicture" src="pictures/'.$table[3][1].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[3][4]))
			echo '<img class="lpicture" src="pictures/'.$table[3][2].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[3][4]))
			echo '<img class="lpicture" src="pictures/'.$table[3][3].'z.jpg"/>'
			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php
			if(isset($table[4][4]))
			echo '<img class="lpicture" src="pictures/'.$table[4][4].'.jpg"/>';
			?>
			</td>
			<td>
			<?php
			if(isset($table[4][4]))
			echo '<img class="lpicture" src="pictures/'.$table[4][0].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[4][4]))
			echo '<img class="lpicture" src="pictures/'.$table[4][1].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[4][4]))
			echo '<img class="lpicture" src="pictures/'.$table[4][2].'z.jpg"/>'
			?>
			</td>
			<td>
			<?php
			if(isset($table[4][4]))
			echo '<img class="lpicture" src="pictures/'.$table[4][3].'z.jpg"/>'
			?>
			</td>
			</tbody>
		</tr>
	</table>
	</div>
<?php
	echo "Łącznie udzielono ".$answ." poprawnych odpowiedzi<br/>";
	echo "Łącznie udzielono ".$bad." błędnych odpowiedzi<br/>";
	if(isset($perc))
	echo "Procentowo dobrych odpowiedzi: ".$perc."%";
?>

</div>
</body>
<script src="js/bootstrap.min.js"> </script>
&copy Marek Dzilne 2017
</html>