<?php include('header.php'); ?>

<style>
.wynikii
{
  font-size: 18px;
  width: 300px;
  height: 200px;
  float: left;
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



<?php

$date = date('Y-m-d');
if (isset($_POST['now']))
$data = date('Y-m-d');
else if (isset($_POST['next']))
$data=date('Y-m-d', strtotime($date." 1 month"));
else if (isset($_POST['prev']))
$data=date('Y-m-d', strtotime($date." -1 month"));
else {
  $data=$date;
}
$miesiac=date("M",strtotime($data))
// echo date('Y-m-d', strtotime(date('Y-m')." -1 month"));

?>
<form action="tabela.php" method="post">

  <input class="inputsubmit" name ="next" type="submit"value="Nastepny">
  <input class="inputsubmit" name ="now" type="submit"value="Obecny">
  <input class="inputsubmit" name="prev" type="submit"value="Poprzedni">
  <!-- Hi! We can move back to an old server.<br/> -->
  <!-- https://staffsystem.000webhostapp.com -->
</form>

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
$zapytanie = "select * from event";
$wynik = $db->query($zapytanie);
$ile_znaleziono = $wynik->num_rows;

for ($i=0;$i<$ile_znaleziono;$i++)

{
	$row = $wynik->fetch_assoc();
$id_wydarzenie=$row['id'];
if($miesiac==date("M",strtotime($row['Dzien'])))
{
  echo "<table  cellpadding=\"5\" border=1 >";


  echo "<tr align=\"left\", bgcolor=\"#B7B7CB\", style=\"font-weight: bold; font-family:Arial; background: linear-gradient(white 20%, #B7B7CB);\" >";
  echo "<td style=\"width: 350px;\">".$row["Tytul"]."</td>";
  echo "<td style=\"width: 150px;\">".$row["Miejsce"]."</td>";
  echo "<td style=\"width: 150px;\">".$row["Dzien"]."</td>";
  echo "<td style=\"width: 100px;\">".$row["Poczatek"]."</td>";
  echo "<td style=\"width: 100px;\">".$row["Zbiorka"]."</td>";
  $zapytanies = "select pracownik_id from event_pracownik where event_id=$id_wydarzenie";
  $wyniks = $db->query($zapytanies);
  $ile_znalezionos = $wyniks->num_rows;
    echo "<td style=\"width: 200px;\">";
  for ($i=0;$i<$ile_znalezionos;$i++)

  {
  	$rows = $wyniks->fetch_assoc();
    $zapytaniess = "select Imie,Nazwisko from pracownik where id='$rows[pracownik_id]'";
    $wynikss = $db->query($zapytaniess);
      $rowss = $wynikss->fetch_assoc();
  echo  $rowss["Imie"].' '.$rowss['Nazwisko'].'<br/>';
}
echo "</td>";
}
  echo "</tr>";
  echo "</table>";


}


?>


</body>
</html>
