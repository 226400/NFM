<?php include('header.php'); ?>

<html>
</head>
<style>
.wynikii
{
  width: 550px;
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
.obecny{
  margin-left: 10px;
  margin-top: 8px;
  padding: 1px, 1px, 1px, 1px;
}
.nieobecny{
  margin-left: 10px;
  margin-top: 8px;
  padding: 1px, 1px, 1px, 1px;
}
.wypisz{
  margin-left: 10px;
  margin-top: 8px;
  padding: 1px, 1px, 1px, 1px;
}
</style>
</head>
<body>


<?php

require_once "dbconnect.php";
@ $db = new mysqli($host, $user, $password, $database);


if (mysqli_connect_errno())
{
	// echo 'Połączenie z bazą nie powiodło się. Spóbuj ponownie';
	exit;
}
$db->query('SET NAMES utf8');
$db->query('SET CHARACTER_SET utf8_unicode_ci');
if (isset($_GET['wyrazenie']))
  $_SESSION['wydarzenie']=$_GET['wyrazenie'];
$id_wydarzenie=$_SESSION['wydarzenie'];
  $zapytanie = "select * from event where id=$id_wydarzenie";
  $wynik = $db->query($zapytanie);
  $ile_znaleziono = $wynik->num_rows;
  $row = $wynik->fetch_assoc();



?>


<div class="wynikii">
<form action="eventedit.php"  method="post">
Tutaj mozesz edytowac dane wydarzenie<br/>
<br/>
  Tutul <input type="text" value="<?php echo $row['Tytul']; ?>"  name="tytul" /><br/>
  Data: <input type="text" value="<?php echo $row['Dzien']; ?>" name="data" /><br/>
  Miejsce: <input type="text" value="<?php echo $row['Miejsce']; ?>" name="miejsce" /><br/>
  Koordynator: <input type="text" value="<?php echo $row['Koordynator']; ?>" name="koordynator" /><br/>
  Start (koncert): <input type="text" value="<?php echo $row['Poczatek']; ?>" name="start" /><br/>
  Zapotrzebowanie <input type="text" value="<?php echo $row['Zapotrzebowanie']; ?>" name="zapotrzebowanie" /><br/>
  Zbiorka <input type="text " value="<?php echo $row['Zbiorka']; ?>" name="zabiorka" /><br/>
  Koniec <input type="text  " value="<?php echo $row['Koniec']; ?>" name="koniec" /><br/><br/>
  <input type="submit" class="inputsubmit" value="Edytuj" name="wyszukaj " onclick="dis1()" />
  <input name="wydarzenie" style="visibility:hidden;" value="<?php echo $row['id'];?>" ></input>
</form>
</div>


  <div class="wynikii" style="font-size: 15px;">
    <h3> Lista Obecnosci </h3>
  <?php
  // $zapytanie = "select * from `event_pracownik` JOIN `pracownik` ON `event_pracownik`.`event_id` = `pracownik.`id`";
  $zapytanie = "select event_pracownik.event_id, event_pracownik.id, event_pracownik.pracownik_id, event_pracownik.obecny, pracownik.Imie, pracownik.Nazwisko
  from event_pracownik, pracownik
  WHERE event_pracownik.event_id='$_SESSION[wydarzenie]' AND pracownik.id=event_pracownik.pracownik_id";
  $wynik = $db->query($zapytanie);
  $ile_znaleziono = $wynik->num_rows;
  for ($i=0;$i<$ile_znaleziono;$i++)

  {
  $row = $wynik->fetch_assoc();
  $praca=$row['pracownik_id'];
echo   '<a style="text-decoration:none; color:black;" href = "profil.php?wyrazenie='.$praca.'">';

  echo $row['Imie'].' ';
  echo $row['Nazwisko'];
  echo '</a>';
  $informacja=$row['id'];
  if($row['obecny']==1)
{
  $obecnosc=1;
  echo '<button style="background-color: #b8dc6f;" class="obecny"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Obecny </a></button>';
$obecnosc=0;
  echo '<button class="nieobecny"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Nieobecny</a></button>';
  $obecnosc=3;
  echo '<button class="wypisz"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Usprawiedliwiony</a></button>';

}

 else if ($row['obecny']==0)
{   $obecnosc=1;
   echo '<button class="obecny"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Obecny </a></button>';
   $obecnosc=0;
   echo '<button style="background-color: #F08080;" class="nieobecny"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Nieobecny</a></button>';
     $obecnosc=3;
     echo '<button class="wypisz"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Usprawiedliwiony</a></button>';
}


else if ($row['obecny']==3)
{
$obecnosc=1;
echo '<button  class="obecny"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Obecny </a></button>';
$obecnosc=0;
echo '<button class="nieobecny"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Nieobecny</a></button>';

$obecnosc=3;
  echo '<button class="wypisz" style ="background-color:	#00BFFF;"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Usprawiedliwiony</a></button>';
}
$obecnosc=2;
  echo '<button class="wypisz"><a style="text-decoration:none; color:black;" href = "obecnosc.php?info='.$informacja.'&obecnosc='.$obecnosc.'">Wypisz</a></button>';
  echo '<br/>';

}

?>
</div>
</body>
</html>
