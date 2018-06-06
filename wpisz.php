<?php
include('header.emp.php');
?>

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" href="style.login.css" type="text/css" />

<style>
body{
  font-size: 20px;
}

.wynikii
{
  width: 400px;
  padding: 10px 30px 30px 30px;
  margin-left: auto;
  margin-right: auto;
background-color: #e0d1b3;
border: 5px solid #ffffff;
border-radius: 20px 20px 20px 20px;
-moz-border-radius: 20px 20px 20px 20px;
-webkit-border-radius: 20px 20px 20px 20px;
margin-bottom: 15px;
}

</style>
</head>
<body>
<div class="wynikii">
<h2> Potwierdź wpis na wydarzenie:</h2><h3>
  <?php
function zmiendzien($dzien_tyg)
{
  if($dzien_tyg=='Fri') $dzien_tyg='Piatek';
  if($dzien_tyg=='Sat') $dzien_tyg='Sobota';
  if($dzien_tyg=='Sun') $dzien_tyg='Niedziela';
  if($dzien_tyg=='Mon') $dzien_tyg='Poniedzialek';
  if($dzien_tyg=='Tue') $dzien_tyg='Wtorek';
  if($dzien_tyg=='Wed') $dzien_tyg='Sroda';
  if($dzien_tyg=='Thu') $dzien_tyg='Czwartek';
  return $dzien_tyg;

}

  require_once "dbconnect.php";

  @ $db = new mysqli($host, $user, $password, $database);


  if (mysqli_connect_errno())
  {
  	echo 'Połączenie z bazą nie powiodło się. Spóbuj ponownie';
  	exit;
  }
  $db->query('SET NAMES utf8');
  $db->query('SET CHARACTER_SET utf8_unicode_ci');
  if(isset($_GET['wyrazenie']))
    $_SESSION['wydarzenie']=$_GET['wyrazenie'];
    $id_wydarzenie=$_SESSION['wydarzenie'];
    $zapytanie = "select * from event where id=$id_wydarzenie";
    $wynik = $db->query($zapytanie);
    $ile_znaleziono = $wynik->num_rows;
    $row = $wynik->fetch_assoc();

  echo $row['Tytul'].'<br/>';
  $dzien_tyg = date("D",strtotime($row['Dzien']));
  $dzien=zmiendzien($dzien_tyg);
  echo $row['Dzien'].' ('.$dzien.')<br/>';
  echo 'Zbiorka: '.$row['Zbiorka'].'<br/><br/>';
  $informacja=1;
  echo '<button class="inputlogin">';
 echo '<a href = "wpiszedit.php?info='.$informacja.'">Potiwerdzam Udzial </a>';

 echo '</button ><br/><br/>';
  $informacja=0;
  echo '<button >';
 echo '<a href = "wpiszedit.php?info='.$informacja.'">Wypisz Mnie </a>';

 echo '</button class="inputsubmit">';
 echo '<br/><br/><button >';
 echo '<a style="text-decoration:none; color: blue;" href="ludzie.php"><b>Powrot</b></a>';
 echo '</button >'.'</td>';


  ?>
</h3>
</div>


</body>
</html>
