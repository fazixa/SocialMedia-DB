<?php
//session_start();
include("config.php");
       $main=new db();
       $user=$_SESSION['username'];?>


<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script language="javascript" type="text/javascript" src="js/main.js"></script>
</head>

<body>
	
	


<div align="center">


	<table  cellspacing="50" >
		<form method="post" onSubmit="return do_post();">
	<button type="text" class="button button-go" type="submit" id="shome" name="home" value="home">home</button><br><br>

	  	<?php
		


if(isset($_POST['home'])){
	   


		  	header('location: home.php');


}

 	?>




			<button type="text" class="button button-go" type="submit" id="search" name="search" value="search">followback</button>
			

<div align="left"> <br/> 
    	<?php
		


if(isset($_POST['search'])){
	   


		  $t=$main->followback();


}

 	?>



	<button type="text" class="button button-go" type="submit" id="query2" name="query2" value="query2">activeusers</button>
			

<div align="left"> <br/> 
    	<?php
		


if(isset($_POST['query2'])){
	   


		  $t=$main->activeusers();


 
}


?>







		 



	</form>
</table>

</div>








</body>
</html>