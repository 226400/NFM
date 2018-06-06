<?php session_start();
require_once "dbconnect.php";

@ $db = new mysqli($host, $user, $password, $database);


if (mysqli_connect_errno())
{
  echo 'Połączenie z bazą nie powiodło się. Spóbuj ponownie';
  exit;
}
$db->query('SET NAMES utf8');
$db->query('SET CHARACTER_SET utf8_unicode_ci');
$zapytanie = "select * from event_pracownik where event_id='$_SESSION[wydarzenie]' AND pracownik_id='$_SESSION[id]'";
$wynik = $db->query($zapytanie);
$row = $wynik->fetch_assoc();
$ile_znaleziono = $wynik->num_rows;
if($ile_znaleziono!=0 && $_GET['info']==1) echo 'JUZ WPISALES SIE NA TO WYDARZENIE';
else {

if(isset($_GET['info']))
{
  if($_GET['info']==1){
    $zapytanies = "select * from event where id='$_SESSION[wydarzenie]'";
    $wyniks = $db->query($zapytanies);
    $rows = $wyniks->fetch_assoc();
if($rows['zapisy']==1)
echo 'Przykro nam, zapisy są już zamkniętę';
// echo 'Przykro nam zapisy są już zamkniętę';
else if ($rows['zapisy']==0)
{  $zmiana=$db->query("INSERT INTO `event_pracownik`(`id`, `event_id`, `pracownik_id`, `obecny`) VALUES (NULL, '$_SESSION[wydarzenie]', '$_SESSION[id]', 1 )");
  $db->query('SET NAMES utf8');
  $db->query('SET CHARACTER_SET utf8_unicode_ci');
  $zapytanie = "select Ludzie from event where id='$_SESSION[wydarzenie]'";
  $wynik = $db->query($zapytanie);
  $row = $wynik->fetch_assoc();
  $do_wpisu=$row['Ludzie'];
  $do_wpisu=$do_wpisu+1;
   // echo $do_wpisu;
  $edytuj = $db->query("UPDATE event SET Ludzie=$do_wpisu WHERE id='$_SESSION[wydarzenie]'");
if($edytuj==1)
header('Location: ludzie.php');
}
}
if($_GET['info']==0){
  $zapytanies = "select *  from event where id='$_SESSION[wydarzenie]'";
  $wyniks = $db->query($zapytanies);
  $ile_znaleziono = $wyniks->num_rows;
  $rows = $wyniks->fetch_assoc();

  if($rows['zapisy']==1)
  echo 'Przykro nam zapisy są już zamkniętę';
  if ($rows['zapisy']==0)
{
  $zapytanie = $db->query("DELETE FROM event_pracownik WHERE pracownik_id='$_SESSION[id]' && event_id='$_SESSION[wydarzenie]'");

// $zmiana=$db->query("INSERT INTO `event_pracownik`(`id`, `event_id`, `pracownik_id`, `obecny`) VALUES (NULL, '$_SESSION[wydarzenie]', '$_SESSION[id]', 1 )");
$db->query('SET NAMES utf8');
$db->query('SET CHARACTER_SET utf8_unicode_ci');
$zapytanies = "select Ludzie from event where id='$_SESSION[wydarzenie]'";
$wyniks = $db->query($zapytanies);
$rows = $wyniks->fetch_assoc();
$do_wpisu=$rows['Ludzie'];
$do_wpisu=$do_wpisu-1;
$edytuj = $db->query("UPDATE event SET Ludzie=$do_wpisu WHERE id='$_SESSION[wydarzenie]'");
if($edytuj==1)
header('Location: ludzie.php');
}
}}}
?>
