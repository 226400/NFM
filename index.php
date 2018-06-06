<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"pl-PL\">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>StaffSystem</title>

<style>
body
{
  background-color: #E9E9E2;
	background-image: url("img/sala.jpg")
}

#window
{
  margin-right: auto;
  margin-left: auto;
  margin-top: 5%;
  margin-bottom: 5%;
  width: 70%;
  height: 50%;


  /* background-color: #F2F2FA; */
}


#logo
{
max-width: 50%;
max-height: 50%;
margin-left: 20%;
margin-top: 14%;
/* float: left; */
}
#buttons
{
/* clear:both; */
}


a:link
	{

		color: green;
		text-decoration: none;
	}
a:visited
	{

		color: #424547;
		text-decoration: none;
	}
a:hover
	{

		color: 66CC66;
		text-decoration: none;
	}


.admin
{
  font-size: 60px;
font-family:"Berlin Sans FB";
  color:424547;
  margin-left: 15%;
  margin-top: 20%;
  cursor: pointer;
  border: solid grey 2px;
  letter-spacing: 2px;
  background-color: #BCC0C2;
  text-decoration: none;
}
</style>


</head>
<body>


<div id="window">
<!-- <img id="logo" src="img/logoNFM.jpg"/> -->
<br/>
<div id="buttons" style="clear:both">
<br/><button class="admin" >
  <a  class="butt" href="login.php" onclick="return costam(this.href)">Koordynator</a>

</button>
<button class="admin"><a  class="butt" href="login0.php" onclick="return costam(this.href)">Wolontariusz</a></button>
</div>
</div>

<br/>
</body>
</html>
