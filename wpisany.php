
<style>
.obecny{
  margin-left: 10px;
  margin-top: 8px;
  padding: 0px, 1px, 1px, 1px;
  background-color: #7f7ff0;
}
.wpi  {
  margin-left: 15%;
  margin-right: 15%;
  margin-top: 15%;
  font-weight: 700;
  background-image: url(img/doodles.png);
}

</style>
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

include('header.emp.php');

require_once "dbconnect.php";
@ $db = new mysqli($host, $user, $password, $database);


if (mysqli_connect_errno())
{
  echo 'Połączenie z bazą nie powiodło się. Spóbuj ponownie';
  exit;
}
$db->query('SET NAMES utf8');
$db->query('SET CHARACTER_SET utf8_unicode_ci');
$zapytanie = "select * from alert where id_pracownik='$_SESSION[id]'";
$wynik = $db->query($zapytanie);
$ile_znaleziono = $wynik->num_rows;

for ($i=0;$i<$ile_znaleziono;$i++)

{  $row = $wynik->fetch_assoc();

  if($row['seen']==0)
  {
  echo '<div class="alerty">';
  echo $row['tresc'];
  $informacja=$row['id'];
  echo '<button class="obecny"><a style="text-decoration:none; color:black; " href = "odczytano.php?info='.$informacja.'">Ukryj Powiadomienie </a></button>';

  echo '</div><br/>';
}
}

echo '<div class="wpi">';
echo '<h2> Nadchodzące wydarzenia:</h2>';
$zapytanie = "select pracownik_id, event_id from event_pracownik where pracownik_id='$_SESSION[id]'";
$wynik = $db->query($zapytanie);
$ile_znaleziono = $wynik->num_rows;
$date = date('Y-m-d');

for ($i=0;$i<$ile_znaleziono;$i++)
{  $row = $wynik->fetch_assoc();
$tytulik=$row['event_id'];

  $zapytanies = "select Tytul, Dzien, Poczatek, Zbiorka from event where id='$tytulik' order by DZIEN ASC";
  $wyniks = $db->query($zapytanies);
  $rows = $wyniks->fetch_assoc();
  $dzien=date("M", strtotime($rows['Dzien']));
$miesiac=date("M",strtotime($date));
  $data=date('Y-m-d', strtotime($date." 1 month"));
  $miesiac1=date("M",strtotime($data));

if ($dzien==$miesiac || $dzien==$miesiac1)
{  echo $rows['Tytul'].' - ';  $dzien_tyg = date("D",strtotime($rows['Dzien']));


    $dzien=zmiendzien($dzien_tyg);

    echo $rows['Dzien'].' ('.$dzien.')'
.' <br/> '.$rows['Zbiorka'].' </br> '.$rows['Poczatek'].'<br/><br/>';
}}
echo '</div>';



//
//
//
// $date = date('Y-m-d');
// if (isset($_POST['now']))
// $data = date('Y-m-d');
// else if (isset($_POST['next']))
// $data=date('Y-m-d', strtotime($date." 1 month"));
// else if (isset($_POST['prev']))
// $data=date('Y-m-d', strtotime($date." -1 month"));
// else {
//   $data=$date;
// }
// $miesiac=date("M",strtotime($data))
//
// if($miesiac==date("M",date('Y-m-d')))

 ?>
