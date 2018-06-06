<?php

	session_start();

	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: login0.php');
		exit();
	}

	require_once "dbconnect.php";
	@ $polaczenie = new mysqli($host, $user, $password, $database);

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
		sprintf("SELECT * FROM pracownik WHERE login='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();

				if (password_verify($haslo, $wiersz['password']) )
				{
					$_SESSION['logged'] = true;
					$_SESSION['login'] = $wiersz['login'];
					$_SESSION['id']=$wiersz['id'];

					unset($_SESSION['blad']);
					$rezultat->free_result();
					if($wiersz['first']==0)
				{
					$polaczenie->query("UPDATE `pracownik` SET `last_log` = now(),`first` = '1' WHERE `pracownik`.`id` = '$_SESSION[id]'");
					header('Location: wpisany.php');
				}else
				header('Location: wpisany.php');
				$polaczenie->query("UPDATE `pracownik` SET `last_log` = now(), `first` = '1'  WHERE `pracownik`.`id` = '$_SESSION[id]'");

				}








				else if (password_verify($haslo, $wiersz['temporary_password']) )
				{
					$_SESSION['logged'] = true;
					$_SESSION['login'] = $wiersz['login'];
					$_SESSION['id']=$wiersz['id'];

					unset($_SESSION['blad']);
					$rezultat->free_result();
					$polaczenie->query("UPDATE `pracownik` SET `temporary_password` = '' WHERE `pracownik`.`id` = '$_SESSION[id]'");

					header('Location: wpisany.php');

				}







				else
				{
					$_SESSION['blad'] = '<span style="color:red">Invalid login or password!</span>';
					header('Location: login0.php');
				}

			} else {

				$_SESSION['blad'] = '<span style="color:red">Invalid login or password!</span>';
				header('Location: login0.php');

			}

		}
		// echo $wiersz['password'];

		$polaczenie->close();
	}
