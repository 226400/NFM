<?php
session_start();
require_once "dbconnect.php";
@ $db = new mysqli($host, $user, $password, $database);


if (mysqli_connect_errno())
{
	// echo 'Połączenie z bazą nie powiodło się. Spóbuj ponownie';
	exit;
}
$db->query('SET NAMES utf8');
$db->query('SET CHARACTER_SET utf8_unicode_ci');

if (isset($_POST['wydarzenie']))
{
$edytuj = $db->query("UPDATE event SET Tytul='$_POST[tytul]', Dzien='$_POST[data]', Miejsce='$_POST[miejsce]', Koordynator='$_POST[koordynator]', Poczatek='$_POST[start]', Zapotrzebowanie='$_POST[zapotrzebowanie]',
   Zbiorka='$_POST[zabiorka]', Koniec='$_POST[koniec]'
    WHERE id='$_SESSION[wydarzenie]'");
    if ($edytuj==1)
    header('Location: list.php');

  }

  ?>
