<html>
<head>
  <link rel="stylesheet" href="style.login.css" type="text/css" />

</head>
<body>


  <?php
  include('header.emp.php');
  error_reporting(0);
require_once "dbconnect.php";
@ $db = new mysqli($host, $user, $password, $database);

if (mysqli_connect_errno())
{
	echo 'Połączenie z bazą nie powiodło się. Spóbuj ponownie';
	exit;
}
$db->query('SET NAMES utf8');
$db->query('SET CHARACTER_SET utf8_unicode_ci');
$zapytanie = "select * from pracownik where id='$_SESSION[id]'";
$wynik = $db->query($zapytanie);
	$row = $wynik->fetch_assoc();
  if (isset($_POST['Imie']))
{  if ($row['Imie']!=$_POST['Imie'] || $row['Nazwisko']!=$_POST['Nazwisko'] || $row['Telefon']!=$_POST['Telefon'] || $row['Email']!=$_POST['Email'] )
  {$zmiana = $db->query("UPDATE pracownik SET Imie='$_POST[Imie]', Nazwisko = '$_POST[Nazwisko]', Email = '$_POST[Email]', Telefon = '$_POST[Telefon]' WHERE id='$_SESSION[id]'");
  if ($zmiana == 1) echo 'Dane zaktualizowano';
  }
}
$zapytanie = "select * from pracownik where id='$_SESSION[id]'";
$wynik = $db->query($zapytanie);
	$row = $wynik->fetch_assoc();

echo '  <div id="container" style="width: 300px;">

  <form action="dane.php"  method="post">
  Moje Dane: <br/>
     <input  class="inputlogin" value="'.$row['Imie'].'" type="text" name="Imie" placeholder="Imie" /><br/>
     <input  class="inputlogin"  value="'.$row['Nazwisko'].'" type="text" name="Nazwisko" placeholder="Nazwisko" /><br/>
     <input   class="inputlogin" value="'.$row['Email'].'" type="text" name="Email" placeholder="Email" /><br/>
     <input   class="inputlogin" value="'.$row['Telefon'].'" type="text" name="Telefon" placeholder="Telefon" /><br/>
    <input type="submit" class="inputsubmit" value="Aktualizuj Dane" name="dadaj "/>
  </form>
  </div>';

?>


</body>
</html>
