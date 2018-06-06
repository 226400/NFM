<?php include('header.php');
if (isset($_POST['Tytul']))
{
  require_once "dbconnect.php";
  @ $db = new mysqli($host, $user, $password, $database);
  $db->query('SET NAMES utf8');
  $db->query('SET CHARACTER_SET utf8_unicode_ci');
$tresc = 'Dodano nowe wydarzenie "'.$_POST['Tytul'].'"';
 $zmiana=$db->query("INSERT INTO `event`(`id`, `Tytul`, `Dzien`, `Miejsce`, `Poczatek`, `Ludzie`,`Koordynator`, `Zapotrzebowanie`, `Zbiorka`, `Koniec`, `zapisy`)
 VALUES (NULL, '$_POST[Tytul]', '$_POST[Data]', '$_POST[Miejsce]', '$_POST[Poczatek]' ,0 , '$_POST[Koordynator]', '$_POST[Zapotrzebowanie]', '$_POST[Zbiorka]', 0, 1)");
 $zapytanie = "select id from pracownik";
 $wynik = $db->query($zapytanie);
 $ile_znaleziono = $wynik->num_rows;

 for ($i=0;$i<$ile_znaleziono;$i++)

 {
 	$row = $wynik->fetch_assoc();
  $zmiana1=$db->query("INSERT INTO `alert`(`id`, `id_pracownik`, `od_kogo`, `tresc`, `seen`)
  VALUES (NULL, '$row[id]', '$_SESSION[id]', '$tresc', 0)");

}
 if ($zmiana==1 && $zmiana1==1)
 echo '  Dodano wydarzenie oraz poinformowano wolontariuszy ';

}
?>

<link rel="stylesheet" href="style.login.css" type="text/css" />
<div id="container">

<form action="addevent.php"  method="post">
Dodawanie nowego wydarzenia: <br/>
  Tytuł <input  class="inputlogin"  type="text" name="Tytul" /><br/>
  Data <input  class="inputlogin"  type="date" name="Data" /><br/>
  Miejsce <input   class="inputlogin" type="text" name="Miejsce" /><br/>
  Początek <input   class="inputlogin" type="time" name="Poczatek" /><br/>
  Zbiórka <input   class="inputlogin" type="time" name="Zbiorka" /><br/>
  Koordynator <input  class="inputlogin"  type="text" name="Koordynator" /><br/>
  Zapotrzebowanie <input  class="inputlogin"  type="text" name="Zapotrzebowanie" /><br/>
  <input type="submit" class="inputsubmit" value="Dodaj Wydarzenie" name="dadaj "/>
</form>
</div>
