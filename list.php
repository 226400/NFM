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
<form action="list.php" method="post">

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
echo '<a style="  text-decoration: none; color:black;" href = "event.php?wyrazenie='.$id_wydarzenie.'">';

echo '<div class="wynikii">';
echo $row['Tytul'].'<br/>';
echo $row['Dzien'].'<br/>';
echo $row['Miejsce'].'<br/>';
echo $row['Koordynator'].'<br/>';
echo "Start: ".$row['Poczatek'].'<br/>';
echo "zapisanych: ".$row['Ludzie'].'<br/>';
echo "potrzebnych: ".$row['Zapotrzebowanie'].'<br/>';
echo "Zbiorka: ".$row['Zbiorka'].'<br/>';
echo "Koniec: ".$row['Koniec'].'<br/>';

echo '</div></a>';


}}


?>


</body>
</html>
