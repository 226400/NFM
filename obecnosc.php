<?php
session_start();

require_once "dbconnect.php";

@ $db = new mysqli($host, $user, $password, $database);


if (mysqli_connect_errno())
{
  echo 'Połączenie z bazą nie powiodło się. Spóbuj ponownie';
  exit;
}
$db->query('SET NAMES utf8');
$db->query('SET CHARACTER_SET utf8_unicode_ci');
$idik = $_GET['info'];
$obecnosc = $_GET['obecnosc'];
$zapytanie = "select * from event_pracownik where id='$_GET[info]'";
  $wynik = $db->query($zapytanie);
  $ile_znaleziono = $wynik->num_rows;
  $row = $wynik->fetch_assoc();
  $pracownik=$row['pracownik_id'];
  $evencik=$row['event_id'];
  if ($obecnosc==0)
{  $edytuj = $db->query("UPDATE event_pracownik SET obecny=0 WHERE id='$idik'");
  $zapytanie = "select Tytul from event where id='$evencik'";
  $wynik = $db->query($zapytanie);
  $row = $wynik->fetch_assoc();
  $tresc = 'Odnotowaliśmy Twoją nieobecność na wydarzeniu: "'.$row['Tytul'].'"<br/> Prosimy j usprawiedliwić';
  $edytuj = $db->query("INSERT INTO `alert`(`id`, `id_pracownik`, `od_kogo`, `tresc`, `seen`) VALUES (NULL, '$pracownik', '$_SESSION[id]', '$tresc', 0 )");
  Header('Location: event.php?info='.$_SESSION['wydarzenie']);
}

  if ($obecnosc==1)
{  $edytuj = $db->query("UPDATE event_pracownik SET obecny=1 WHERE id='$idik'");
  Header('Location: event.php?info='.$_SESSION['wydarzenie']);
}

  if ($obecnosc==2)
  {
  $zapytanie = $db->query("DELETE FROM event_pracownik WHERE id='$idik'");
  $db->query('SET NAMES utf8');
  $db->query('SET CHARACTER_SET utf8_unicode_ci');
  $zapytanie = "select Ludzie from event";
  $wynik = $db->query($zapytanie);
  $row = $wynik->fetch_assoc();
  $do_wpisu=$row['Ludzie'];
  // echo $row['Ludzie'];
  $do_wpisu=$do_wpisu-1;
  // echo $do_wpisu;
  $edytuj = $db->query("UPDATE event SET Ludzie=$do_wpisu WHERE id='$_SESSION[wydarzenie]'");
  $zapytanie = "select Tytul from event where id='$evencik'";
  $wynik = $db->query($zapytanie);
  $row = $wynik->fetch_assoc();
  $tresc = 'Przykro nam, wypisano Cie administracyjnie z wydarzenia "'.$row['Tytul'].'"<br/>Zapraszamy do zapisu na inne wydarzenia';
  $edytuj = $db->query("INSERT INTO `alert`(`id`, `id_pracownik`, `od_kogo`, `tresc`, `seen`) VALUES (NULL, '$pracownik', '$_SESSION[id]', '$tresc', 0 )");
if($edytuj==1)
  Header('Location: event.php?info='.$_SESSION['wydarzenie']);
}


  if ($obecnosc==3)
  {
  $zapytanie = $db->query("UPDATE event_pracownik SET `obecny`=3 WHERE id='$idik'");
  $zapytanie = "select Tytul from event where id='$evencik'";
  $wynik = $db->query($zapytanie);
  $row = $wynik->fetch_assoc();
  $tresc = 'Usprawiedliwiono Twoją nieobecność na wydarzeniu:  "'.$row['Tytul'];
  $edytuj = $db->query("INSERT INTO `alert`(`id`, `id_pracownik`, `od_kogo`, `tresc`, `seen`) VALUES (NULL, '$pracownik', '$_SESSION[id]', '$tresc', 0 )");
if($edytuj==1)
  Header('Location: event.php?info='.$_SESSION['wydarzenie']);
}

  ?>
