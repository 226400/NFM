<?php

	session_start();

	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: login.php');
		exit();
	}

	require_once "dbconnect.php";
	@ $polaczenie = new mysqli($host, $user, $password, $database);

	//$polaczenie = @new mysqli('localhost','id2325974_bcs','kalina11','id2325974_bcs');
	// @ $db = new mysqli('localhost','id2325974_bcs','kalina11','id2325974_bcs');


	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['password'];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");

		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM admin WHERE login='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();

				if (password_verify($haslo, $wiersz['password']))
				{
					$_SESSION['logged'] = true;
					$_SESSION['login'] = $wiersz['login'];
					$_SESSION['id']=$wiersz['id'];

					unset($_SESSION['blad']);
					$rezultat->free_result();
					if($wiersz['first']==0)
				{

					$polaczenie->query("UPDATE `admin` SET `last_log` = now(), `first` = '1'  WHERE `admin`.`id` = '$_SESSION[id]'");


					header('Location: list.php');
				}else
{
$polaczenie->query("UPDATE `admin` SET `last_log` = now(), `first` = '1'  WHERE `admin`.`id` = '$_SESSION[id]'");

 header('Location: list.php');
}				}
else if (password_verify($haslo, $wiersz['temporary_password']))
{
	$_SESSION['logged'] = true;
	$_SESSION['login'] = $wiersz['login'];
	$_SESSION['id']=$wiersz['id'];

	unset($_SESSION['blad']);
	$rezultat->free_result();

	header('Location: list.php');
		}
				else
				{
					$_SESSION['blad'] = '<span style="color:red">Invalid login or password!</span>';
					header('Location: login.php');
				}

			} else {

				$_SESSION['blad'] = '<span style="color:red">Invalid login or password!</span>';
				header('Location: login.php');

			}

		}
		// echo $wiersz['password'];

		$polaczenie->close();
	}
