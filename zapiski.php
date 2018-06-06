<?php
session_start();
require_once "dbconnect.php";
@ $db = new mysqli($host, $user, $password, $database);


if (mysqli_connect_errno())
{
	// echo 'Połączenie z bazą nie powiodło się. Spóbuj ponownie';
	exit;
}
$miesiac=$_GET['$miesiace'];
$db->query('SET NAMES utf8');
$db->query('SET CHARACTER_SET utf8_unicode_ci');
$zapytanie = "select id,Dzien,zapisy from event order by Dzien DESC	limit 100";
$wynik = $db->query($zapytanie);
$ile_znaleziono = $wynik->num_rows;
for ($i=0;$i<$ile_znaleziono;$i++)
{
	$row = $wynik->fetch_assoc();
  $id=$row['id'];
	if($miesiac==date("M",strtotime($row['Dzien'])))
{
if ($_GET['informacja']==1)
{
$edytuj = $db->query("UPDATE event SET zapisy=0 WHERE id='$id'");
    if ($edytuj==1)
    header('Location: zamknijzapisy.php');

  }
if ($_GET['informacja']==0)
{
$edytuj = $db->query("UPDATE event SET zapisy=1 WHERE id='$id'");
    if ($edytuj==1)
    header('Location: zamknijzapisy.php');

  }}}

  ?>
