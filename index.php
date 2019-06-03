<?php
//session_start();
include_once("config.php");
$main=new db();
?>



<!doctype html>
<html>
<head>

<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<title>SocailNetwork.ir</title>
<script language="javascript" type="text/javascript" src="js/main.js">
	</script>
</head>

<body>


	<table cellspacing="50" class="tg">
  <tr>
    <th class="tg-0pky"><div align="center">
		<br><br><br><br><br><br>
	 <a class="button" href="index.php?men=1" title="login">login</a><br/><br/>
	<a class="button button-post" href="index.php?men=2" title="login">register</a><br/><br/>
	 <a class="button button-post" href="index.php?men=3" title="login">forgot password</a><br/><br/>
		 <a class="button" href="index.php?men=4" title="login">Admin</a><br/><br/>
		 <a class="button" href="index.php?men=5" title="login">Analayzor</a><br/><br/>
	</div>
	</th>
    <th class="tg-0lax"><?php
	
	if (isset($_GET['men'])) 
{ 
$men= $_GET['men'];

   
	if($men==1){
		include("login.php");
	}elseif($men==2){
		include("register.php");
	}elseif
		($men==3){
		include("forgotpass.php");
	}elseif
		($men==4){
		include("loginmanager.php");
	}elseif
		($men==5){
		include("loginanalayzor.php");
	}
	}
//include_once("register.php");
	//include_once("login.php");
	    //echo $_SESSION['success'];
	    //unset($_SESSION['success']);
?>
</th>
  </tr>
</table>

	
	

	

</body>
</html>