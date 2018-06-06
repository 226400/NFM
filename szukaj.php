<?php include('header.php');?>
<style>
.wynikii
{
  text-align: center;
  font-size: 18px;
  width: 300px;
  height: 20px;
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


    <form action="szukaj.php" method="post">
      <h2>Search Staffs' Details:</h2>
      <select style="height: 35px; font-size:20px;" name="metoda">
       <option style="height: 30px;" value="Imie" />Imie
       <option value="Nazwisko" />Nazwisko
      </select>

      <input type="text" style="height: 35px; font-size:20px;" name="wyrazenie" />
		  <input type="submit" style="height: 35px; font-size: 20px;" value="Search" name="wyszukaj " onclick="dis1()" />
    </form>
<hr style="width:600px; float:left;"  /><br/><hr style="width:600px; float:left;" /><br/>
<?php
if(isset($_POST['wyrazenie']))
{

$metoda = $_POST['metoda'];
    $wyrazenie = $_POST['wyrazenie'];
    $wyrazenie = trim($wyrazenie);
    if (!get_magic_quotes_gpc())
    {
      $metoda = addslashes($metoda);
      $wyrazenie = addslashes($wyrazenie);
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
    $zapytanie = "select * from pracownik where ".$metoda. " like '%".$wyrazenie."%'";
    $wynik = $db->query($zapytanie);
    $ile_znaleziono = $wynik->num_rows;
    for ($i=0;$i<$ile_znaleziono;$i++)
    {

      $wiersz = $wynik->fetch_assoc();
//echo 'startdate(s): '.stripslashes($wiersz['postcode']).'<br />';

      $informacja=$wiersz['id'];
      echo '<div class="wynikii">';
      echo '<a class="wynikiii" href = "profil.php?wyrazenie='.$informacja.'">';
      echo '<div class="wynikii33">';

      echo '<b> '.stripslashes($wiersz['Imie']);
      echo ' '.stripslashes($wiersz['Nazwisko']).'<b>';
      echo '</div></a></div>';

    }
    $wynik->free();
    $db->close();}

?>

  </body>
</html>
