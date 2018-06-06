<?php include('header.php'); ?>
<style>
.wynikii
{
  font-size: 18px;
  width: 250px;
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
margin-left: 20px;
text-align: center;
}
</style>
<?php
function zmienmies($miesiac)
{
  if($miesiac=='Jan') $miesiac='Styczeń';
  if($miesiac=='Feb') $miesiac='Luty';
  if($miesiac=='Mar') $miesiac='Marzec';
  if($miesiac=='Apr') $miesiac='Kwiecień';
  if($miesiac=='May') $miesiac='Maj';
  if($miesiac=='Jun') $miesiac='Czerwiec';
  if($miesiac=='Jul') $miesiac='Lipiec';
  if($miesiac=='Aug') $miesiac='Sierpien';
  if($miesiac=='Sep') $miesiac='Wrzesień';
  if($miesiac=='Oct') $miesiac='Paźdźiernik';
  if($miesiac=='Nov') $miesiac='Listopad';
  if($miesiac=='Dec') $miesiac='Grudzień';
  return $miesiac;

}



require_once "dbconnect.php";
@ $db = new mysqli($host, $user, $password, $database);


if (mysqli_connect_errno())
{
	echo 'Połączenie z bazą nie powiodło się. Spóbuj ponownie';
	exit;
}
	$db->query('SET NAMES utf8');
	$db->query('SET CHARACTER_SET utf8_unicode_ci');
	$zapytanie = "select id,Dzien,zapisy from event order by Dzien DESC	limit 100";
	$wynik = $db->query($zapytanie);
	$ile_znaleziono = $wynik->num_rows;

	$data=date('Y-m-d', strtotime($date." -1 month"));
	$miesiac=date('M',strtotime($data));
	for ($i=0;$i<$ile_znaleziono;$i++)
	{
		$row = $wynik->fetch_assoc();
		if($miesiac==date("M",strtotime($row['Dzien'])))
{
	if($row['zapisy']==0)
	echo '<div class="wynikii" style="background-color: #98FB98;">';
	else 	if($row['zapisy']==1)
	echo '<div class="wynikii" style="background-color: #FA8072;">';
	echo '<h2>Zapisy:</h2>';
	$dzien=zmienmies($miesiac);
  echo '<h3>'.$dzien.'</h3>';
	if($row['zapisy']==0)
	{
echo 'AKTYWNE';
$informacja = 0;
echo '<br/><br/><button><a style="text-decoration:none; color:black;" href = "zapiski.php?$miesiace='.$miesiac.'&informacja='.$informacja.'">Zamknij</a></button>';
}
else if ($row['zapisy']==1)
{
	echo 'ZAMKNIĘTĘ';
	$informacja = 1;
	echo '<br/><br/><button><a style="text-decoration:none; color:black;" href = "zapiski.php?$miesiace='.$miesiac.'&informacja='.$informacja.'">Otwórz</a></button>';
}
	$miesiac=1;
	echo '</div>';
}

}

$zapytanie = "select id,Dzien,zapisy from event order by Dzien DESC	limit 60";
$wynik = $db->query($zapytanie);
$ile_znaleziono = $wynik->num_rows;

$data=date('Y-m-d');
$miesiac=date('M',strtotime($data));
for ($i=0;$i<$ile_znaleziono;$i++)
{
	$row = $wynik->fetch_assoc();
	if($miesiac==date("M",strtotime($row['Dzien'])))
{
	if($row['zapisy']==0)
	echo '<div class="wynikii" style="background-color: #98FB98;">';
	else 	if($row['zapisy']==1)
	echo '<div class="wynikii" style="background-color: #FA8072;">';
	echo '<h2>Zapisy:</h2>';

	$dzien=zmienmies($miesiac);

  echo '<h3>'.$dzien.'</h3>';
	if($row['zapisy']==0)
	{
echo 'AKTYWNE';
$informacja = 0;
echo '<br/><br/><button><a style="text-decoration:none; color:black;" href = "zapiski.php?$miesiace='.$miesiac.'&informacja='.$informacja.'">Zamknij</a></button>';
}
else if ($row['zapisy']==1)
{
	echo 'ZAMKNIĘTĘ';
	$informacja = 1;
	echo '<br/><br/><button><a style="text-decoration:none; color:black;" href = "zapiski.php?$miesiace='.$miesiac.'&informacja='.$informacja.'">Otwórz</a></button>';
}
	$miesiac=1;
	echo '</div>';
}

}


$zapytanie = "select id,Dzien,zapisy from event order by Dzien DESC	limit 10";
$wynik = $db->query($zapytanie);
$ile_znaleziono = $wynik->num_rows;

$data=date('Y-m-d', strtotime($date." 1 month"));
$miesiac=date('M',strtotime($data));
for ($i=0;$i<$ile_znaleziono;$i++)
{
	$row = $wynik->fetch_assoc();
	if($miesiac==date("M",strtotime($row['Dzien'])))
{
	if($row['zapisy']==0)
	echo '<div class="wynikii" style="background-color: #98FB98;">';
	else 	if($row['zapisy']==1)
	echo '<div class="wynikii" style="background-color: #FA8072;">';
	echo '<h2>Zapisy:</h2>';

	$dzien=zmienmies($miesiac);
  echo '<h3>'.$dzien.'</h3>';
	if($row['zapisy']==0)
	{
echo 'AKTYWNE';
$informacja = 0;
echo '<br/><br/><button><a style="text-decoration:none; color:black;" href = "zapiski.php?$miesiace='.$miesiac.'&informacja='.$informacja.'">Zamknij</a></button>';
}
else if ($row['zapisy']==1)
{
	echo 'ZAMKNIĘTĘ';
	$informacja = 1;
	echo '<br/><br/><button><a style="text-decoration:none; color:black;" href = "zapiski.php?$miesiace='.$miesiac.'&informacja='.$informacja.'">Otwórz</a></button>';
}
	$miesiac=1;
	echo '</div>';
}

}




?>
