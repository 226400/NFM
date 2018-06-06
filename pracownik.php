<?php
session_start();
error_reporting(0);


$wszystko_ok=true;


// /check nick
$Imie=$POST['Imie'];
$Nazwisko=$POST['Nazwisko'];
$Email=$POST['Email'];
$Telefon=$POST['Telefon'];

$nick=$_POST['nick'];
//check LengthException
if((strlen($nick)<3) || (strlen($nick)>20))
{
	$wszystko_ok=false;;
$_SESSION['e_nick']="Your name is too short or too long at least 3 letters maximum 20 letters";
}

if(ctype_alnum($nick)==false)
{
	$wszystko_ok=false;
	$_SESSION['e_nick']='Your name cannot include any special letters or maths expression.';
}

$haslo1=$_POST['haslo1'];
$haslo2=$_POST['haslo2'];
if((strlen($haslo1)<5 || strlen($haslo1)>20))
{
	$wszystko_ok=false;
	$_SESSION['e_haslo']='Your password need to be at least 5 letters long.';

}

if($haslo1!=$haslo2)
{
	$wszystko_ok=false;
	$_SESSION['e_haslo']='These passwords are different.';

}

$haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);




if($wszystko_ok==true)
{
	//echo $_SESSION['id'];
	// /dziala
	require_once "dbconnect.php";
	@ $db = new mysqli($host, $user, $password, $database);


	// $zmiana=$db->query("UPDATE nfm SET login='$nick', password='$haslo_hash', Imie='$Imie', Nazwisko='$Nazwisko', Email='$Email', Telefon='$Telefon',  temporary_password='' WHERE id='$_SESSION[id]'");
	$zmiana=$db->query("INSERT INTO `pracownik`(`id`, `Imie`, `Nazwisko`, `Telefon`, `Email`, `login`, `password`)VALUES (NULL, '$_POST[Imie]', '$_POST[Nazwisko]', '$_POST[Telefon]', '$_POST[Email]', '$nick', '$haslo_hash' )");

if($zmiana==1) header("Location: login0.php");
 }

?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"pl-PL\">
<head>
	<link rel="stylesheet" href="style.login.css" type="text/css" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>StaffSystem</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
body
{
	font-size: 25px;
}
.error
{
	color: red;
	margin-top: 10px;
	margin-bottom: 10px;
}
.wynikii
{
  width: 300px;
  height: 200px;
	  float: left;
  padding: 10px 30px 0px 30px;
  margin-left: auto;
  margin-right: auto;
/* background-color: #e0d1b3; */
border: 5px solid #ffffff;
border-radius: 20px 20px 20px 20px;
-moz-border-radius: 20px 20px 20px 20px;
-webkit-border-radius: 20px 20px 20px 20px;
margin-bottom: 15px;
}

</style>
</head>

<body>
<div id="container">
	<div class="wynikii" style="font-size: 18px;">
Czesc! <br/>
Witaj w wersji testowej aplikacji do rejestracji wolontariuszy na wydarzenia w Narodowym Forum Muzyki<br/>
Poprosimy Cie teraz o wypelnienie formularza rejestracyjnego.<br/>
Dostep do Twoich danych beda mieli Koordynatorzy wydarzen. Haslo i login pozostana tajne.
</div>

<form method="post">
	<input class="inputlogin" name="nick" type="text" placeholder="login">
<?php
if (isset($_SESSION["e_nick"]))
{
	// echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
	unset($_SESSION['e_nick']);
}
?>
<input class="inputlogin" name="haslo1" type="password" placeholder="haslo">
<?php
if (isset($_SESSION["e_haslo"]))
{
	// echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
	unset($_SESSION['e_haslo']);
}
?>

<input class="inputlogin" name="haslo2" type="password" placeholder="haslo">
<input class="inputlogin" name="Imie" type="text" placeholder="Imie">
<input class="inputlogin" name="Nazwisko" type="text" placeholder="Nazwisko">
<input class="inputlogin" name="Email" type="text" placeholder="Email">
<input class="inputlogin" name="Telefon" type="text" placeholder="Telefon">
<input class="inputsubmit" type="submit"value="Zarejestruj" name="sub">

<!-- Imie:</br/>  <input name="Imie" type="text"/></br/> -->
<!-- Nazwisko:</br/>  <input name="Nazwisko" type="text"/></br/> -->
<!-- Email:</br/>  <input name="Email" type="text"/></br/> -->
<!-- Telefon:</br/>  <input name="Telefon" type="text"/></br/> -->
<!-- </br/> <input name="sub" type="submit"/></br/></br/> -->

</form>
</div>
	</body>
</html>
