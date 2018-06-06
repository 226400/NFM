<?php
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
$zapytanie = "select * from alert where id='$_GET[info]'";
  $wynik = $db->query($zapytanie);
  $edytuj = $db->query("UPDATE alert SET seen=1 WHERE id='$idik'");
  Header('Location: wpisany.php');

?>
