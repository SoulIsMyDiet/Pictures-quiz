<?php
session_start();
if(!isset($_SESSION['answ_true'])) header('Location:index.php');

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
			if ($_SESSION['answa'] == $_SESSION['answ_true'])
			{
				if(isset($_SESSION['answer'])) $result = $connection->query("UPDATE ".$_SESSION['user']."_last_question SET ".$_SESSION['category']." = 2 WHERE picture_id=".$_SESSION['id']); 
				//happens if answer is true and it was not a new picture to answer
				else
				{
					$result = $connection->query("INSERT INTO `".$_SESSION['user']."_last_question` (`picture_id`, `name_answ`, `author_answ`, `museum_answ`, `year_answ`, `update`) VALUES ('".$_SESSION['id']."', '', '', '', '', CURRENT_TIMESTAMP)");
					$result = $connection->query("UPDATE ".$_SESSION['user']."_last_question SET ".$_SESSION['category']." = 2 WHERE picture_id=".$_SESSION['id']);
					//happens if answer is true and it was a new picture to answer
				}
			
				$_SESSION['value'] = '<div id="true" >brawo</div>';
			}
			else
			{
				if(isset($_SESSION['answer'])) $result = $connection->query("UPDATE ".$_SESSION['user']."_last_question SET ".$_SESSION['category']." = 1 WHERE picture_id=".$_SESSION['id']);
				//happens if answer is false and it was not a new picture to answer
				else
				{
					$result = $connection->query("INSERT INTO `".$_SESSION['user']."_last_question` (`picture_id`, `name_answ`, `author_answ`, `museum_answ`, `year_answ`, `update`) VALUES ('".$_SESSION['id']."', '', '', '', '', CURRENT_TIMESTAMP)");
					$result = $connection->query("UPDATE ".$_SESSION['user']."_last_question SET ".$_SESSION['category']." = 1 WHERE picture_id=".$_SESSION['id']);
					//happens if answer is false and it was a new picture to answer
				}
				$_SESSION['value'] = '<div id="not_true"  >zle</div>'.$_SESSION['answa'].' '.$_SESSION['answ_true'];
			}


		}
		
		$connection->close();
	}
	catch(Exception $e)
	{
		echo '<div class="error">Jakis blad serwera</div>';
		//echo "<br>"."dodatkowa informacja".$e;
	}
	
	unset($_SESSION['category']);
	unset($_SESSION['answer']);
	//unset($_SESSION['answ_true']);
header('Location:pictures.php');