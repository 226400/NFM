<?php include('header.emp.php'); ?>

<style>
.wynikii
{
 font-size: 18px;
  width: 300px;
  height: 300px;
  /* float: left; */
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
.tabela
{
  margin-left: auto;
  margin-right: auto;
}
</style>



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
$zapytanie = "select event_id,obecny from event_pracownik where pracownik_id='$_SESSION[id]'";
$wynik = $db->query($zapytanie);
$ile_znaleziono = $wynik->num_rows;
$godziny=0;
$wydarzen=0;
$nieobecny=0;
$uspr=0;
$obecny=0;
for ($i=0;$i<$ile_znaleziono;$i++)

{
  $wydarzen++;

	$row = $wynik->fetch_assoc();
if($row['obecny']==1 )
{
  $obecny++;
$id_wydarzenie=$row['event_id'];
  $zapytanies = "select id,Koniec,Zbiorka,Tytul from event where id='$id_wydarzenie'";
  $wyniks = $db->query($zapytanies);

  	$rows = $wyniks->fetch_assoc();
    if(((strtotime($rows['Koniec'])-strtotime($rows['Zbiorka']))/3600)>0)
{

  $godziny=$godziny+((strtotime($rows['Koniec'])-strtotime($rows['Zbiorka']))/3600);
}}
else if($row['obecny']==0 )
$nieobecny++;
else if($row['obecny']==3)
$uspr++;

}
echo '<div class="wynikii">';
echo '<h3>Godziny spędzone przy pomocy w wydarzeniach:</h3>';
echo $godziny;
echo '<h3>Liczba wydarzeń:</h3>';
echo $wydarzen;
echo '<h3>Frekwencja:</h3>';
echo 'Obecności: '.$obecny.'<br/>Nieobecności:  '.$nieobecny.'<br/>Usprawiedliwione: '.$uspr;

echo '</div>';




$zapytanie = "select event_id,obecny from event_pracownik where pracownik_id='$_SESSION[id]'";
$wynik = $db->query($zapytanie);
$ile_znaleziono = $wynik->num_rows;
for ($i=0;$i<$ile_znaleziono;$i++)

{
  $wydarzen++;

	$row = $wynik->fetch_assoc();
if($row['obecny']==1 )
{
$id_wydarzenie=$row['event_id'];
  $zapytanies = "select id,Koniec,Zbiorka,Tytul from event where id='$id_wydarzenie'";
  $wyniks = $db->query($zapytanies);

  	$rows = $wyniks->fetch_assoc();
    echo "<table class='tabela' cellpadding=\"5\" border=1 >";


    echo "<tr align=\"left\", bgcolor=\"#B7B7CB\", style=\"font-weight: bold; font-family:Arial; background: linear-gradient(white 20%, #B7B7CB);\" >";
    echo "<td style=\"width: 350px;\">".$rows["Tytul"]."</td>"."<td style=\"width: 100px;\">";
   if(((strtotime($rows['Koniec'])-strtotime($rows['Zbiorka']))/3600)<0)
   echo ' Brak danych</td>';
   else echo ((strtotime($rows['Koniec'])-strtotime($rows['Zbiorka']))/3600).'</td>';
}if($row['obecny']==0 )
{
$id_wydarzenie=$row['event_id'];
  $zapytanies = "select id,Koniec,Zbiorka,Tytul from event where id='$id_wydarzenie'";
  $wyniks = $db->query($zapytanies);

  	$rows = $wyniks->fetch_assoc();
    echo "<table class='tabela' cellpadding=\"5\" border=1 >";


    echo "<tr align=\"left\", bgcolor=\"#B7B7CB\", style=\"font-weight: bold; font-family:Arial; background: linear-gradient(white 20%, red);\" >";
    echo "<td style=\"width: 350px;\">".$rows["Tytul"]."</td>"."<td style=\"width: 100px;\">";
   if(((strtotime($rows['Koniec'])-strtotime($rows['Zbiorka']))/3600)<0)
   echo ' Brak danych</td>';
   else echo ((strtotime($rows['Koniec'])-strtotime($rows['Zbiorka']))/3600).'</td>';
}
if($row['obecny']==3 )
{
$id_wydarzenie=$row['event_id'];
  $zapytanies = "select id,Koniec,Zbiorka,Tytul from event where id='$id_wydarzenie'";
  $wyniks = $db->query($zapytanies);

  	$rows = $wyniks->fetch_assoc();
    echo "<table class='tabela' cellpadding=\"5\" border=1 >";


    echo "<tr align=\"left\", bgcolor=\"#B7B7CB\", style=\"font-weight: bold; font-family:Arial; background: linear-gradient(white 20%, blue);\" >";
    echo "<td style=\"width: 350px;\">".$rows["Tytul"]."</td>"."<td style=\"width: 100px;\">";
   if(((strtotime($rows['Koniec'])-strtotime($rows['Zbiorka']))/3600)<0)
   echo ' Brak danych</td>';
   else echo ((strtotime($rows['Koniec'])-strtotime($rows['Zbiorka']))/3600).'</td>';
}

echo "</tr>";
echo "</table>";
}
?>

<h3>Uwaga:<br/>Brak danych - nie wpisano godziny zakończenia koncertu</h3>
</body>
</html>
