<?php


if(isset($_POST['submit'])){
	$user=$_POST['username'];
	$pass=$_POST['password'];
	$email=$_POST['email'];
	$sele=$_POST['selection'];
	$answ=$_POST['answer'];
	$main->register($user,$pass,$email,$sele,$answ);

}



?>

<div align="center">
		<b>Register</b>
	</div></br></br></br>
	
	<form method="post" onSubmit="return do_register(); ">
		
		<input  class="inputn in" placeholder='Username' type="text" id="username" name="username"/><br><br>
			<input class="inputn in" placeholder='password' type="password" id="password" name="password"/> <br><br>
		<input class="inputn in" placeholder='email' type="email" id="email" name="email"/> <br><br>
			<select class="select in" id="selection" name="selection"><br><br>
				<option value="0">select one of these question and answer it</option>
				<option value="1">What is your favorite song</option>
				<option value="2">What is your favorite movie</option>
				<option value="3">What is your favorite sport</option>
				<option value="4">What is your favorite book</option>
				</select><br><br>
			<input class="inputn in" type="text" id="answer" name="answer"/><br><br>
			<input class="button button-go" type="submit" id="submit" name="submit" value="Register" />

		
		
		</form>