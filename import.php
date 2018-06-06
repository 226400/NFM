<?php
 include('header.php');
require_once "dbconnect.php";
@ $connect = new mysqli($host, $user, $password, $database);
$connect->query('SET NAMES utf8');
$connect->query('SET CHARACTER_SET utf8_unicode_ci');

{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {mysql_query("SET NAMES latin1");
                $query = "INSERT into event(id, Dzien, Miejsce, Tytul, Poczatek, Zbiorka, Koordynator, Zapotrzebowanie, Ludzie, Koniec, zapisy) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]')";
              $updated=  mysqli_query($connect, $query);
   }
   fclose($handle);
   if($updated==1)
   echo "<script>alert('Wydarzenia wczytane do kalendarza!');</script>";
  }
 }
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Import</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 </head>
 <body>
   <h2> Jakie warunki trzeba spełnić, aby poprawnie importować wydarzenia do kalendarza z pliku excel?</h2>
   <h3>1. Skopiuj poniższy rząd i wklej go do pliku excel jako pierwszy wiersz, następnie upewnij się, że pozostałe kolumny pasują do nagłówków</h3>
   <table  cellpadding=\"5\" border=1 >
   <tr align="left", style="font-weight: bold; font-family:Arial; background: linear-gradient(white 20%, #B7B750);" >
<td style="width: 100px; height: 30px;">id</td>
<td style="width: 100px; height: 30px;">Data</td>
<td style="width: 100px; height: 30px;">Lokalizacja</td>
<td style="width: 100px; height: 30px;">Rodzaj</td>
<td style="width: 150px; height: 30px;">Rozp. koncertu</td>
<td style="width: 150px; height: 30px;">Rozp. pracy</td>
<td style="width: 100px; height: 30px;">Koordyntor</td>
<td style="width: 150px; height: 30px;">Zapotrzebowanie</td>
<td style="width: 100px; height: 30px;">Ludzie</td>
<td style="width: 100px; height: 30px;">koniec</td>
<td style="width: 100px; height: 30px;">zapisy</td>
</tr>
</table>
<h3>2. Upewnij się, że daty są w formacie rrrr-mm-dd</h3>
	<img src="img/excel.png" />
<h3>3. Zapisz plik w formacie CSV [CSV UTF-8 (Comma delimited)(*.csv)]</h3>
	<img src="img/excel1.png" />
<h3>4. Wybierz plik z swojej lokalnej maszyny i kliknij Import</h3>

  <h3 align="center">Importowanie wydarzeń z pliku Excel o rozszerzeniu .csv</h3><br />
  <form method="post" enctype="multipart/form-data">
   <div align="center">
    <label>Wybierz plik z wydarzeniami:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
  </form>
 </body>
</html>
