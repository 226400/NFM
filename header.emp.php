<?php error_reporting(0);
session_start(); ?>
<?php
if(!isset($_SESSION['logged']))
{
	header('Location: login0.php');
	exit();
}

?>
<!DOCTYPE html PUBLIC /"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">



</script>
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"pl-PL\">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>StaffSystem</title>
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

				<a href="http://www.bradfordcounsellingservices.org.uk">	<img class="logo" src="img/logoNFM.jpg" /></a>

					<ol  class="list">
						<li class="list1"><a href="wpisany.php">Główna</a></li>
						<li class="list1"><a href="ludzie.php">Wydarzenia</a></li>
						<li class="list1"><a href="dane.php">Dane</a>
						<li class="list1"><a href="statystyki.php">Statystyki</a>
					</ol>
					<div style="font-size: 20px;" id="Session">Hi  <?php echo $_SESSION['login']; ?> !<br/>    <div id="czas"></div><button><a href="logout.php">Logout</a></button>
					<script type="text/javascript">counter(0,0,20,0);</script>
					 <br/></div>
						</div>

				</div>
				<div><br/></div>
