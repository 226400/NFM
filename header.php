<?php
error_reporting(0);

session_start();

if(!isset($_SESSION['logged']))
{
	header('Location: login.php');
	exit();
}

?>
<!DOCTYPE html PUBLIC /"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">



</script>
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"pl-PL\">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>NFM admin</title>
<link rel="stylesheet" type="text/css" href="style.header.css">
<style>
body
{
	font-size: 25px;
}
</style>
	<script style="float: right" type="text/javascript" src="cos.js"></script>

</head>

<body onload=" odliczanie(); left();" >
		<!-- <link href="style.navi.css" rel="stylesheet" type="text/css" /> -->


				<div class="nav">

				<a href="http://www.nfm.wroclaw.pl	">	<img class="logo" src="img/logoNFM.jpg" /></a>

					<ol  class="list">
						<li class="list1">Wydarzenia</a>
							<ul class="list2">
								<li class="list3"><a href="list.php">Pokaż</a></li>
								<li class="list3"><a href="addevent.php">Dodaj</a></li>
								<li class="list3"><a href="tabela.php">Tabela</a></li>
							</ul>						</li>
						<li class="list1"><a href="szukaj.php">Pracownik</a></li>
						<li class="list1"><a href="zamknijzapisy.php">Zapisy</a></li>
						<li class="list1"><a href="import.php">Import</a></li>

					</ol>
					<div style="font-size: 20px;" id="Session">Hi  <?php echo $_SESSION['login']; ?> !<br/>    <div id="czas"></div><button><a href="logout.php">Logout</a></button>
					<script type="text/javascript">counter(0,0,35,0);</script>
					 <br/></div>
						</div>

				</div>
				<div><br/></div>
