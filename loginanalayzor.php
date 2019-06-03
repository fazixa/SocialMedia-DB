<?php
if(isset($_POST['login'])){
	$username=$_POST['user'];
	$password=$_POST['pass'];
	$main->loginAnalayzer($username,$password);
}
?>




<div align="center">
		<b>login</b>
	</div></br></br></br>
	
	<form method="post" >
		
			<input class="inputn in" placeholder='Username' type="text" id="user" name="user"/><br><br>
			<input class="inputn in" placeholder='Passwornd' type="password" id="pass" name="pass"/> <br><br>
			<input class="button button-go" type="submit" id="login" name="login" value="Login" />
		
		
		
		</form>









