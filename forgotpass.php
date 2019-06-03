<?php

if(isset($_POST['forgotpassword'])){
	$username=$_POST['user'];
	
	$re=$main->forgotpass($username);
	$row = mysqli_fetch_array($re,MYSQLI_BOTH);
	echo $row['question'];
	$answ=$row['answer'];
	$pass=$row['password'];

	}


if(isset($_POST['answer'])){
	$answer=$_POST['answertext']; echo $row['password'];
	if ($answer==$row['answer']){echo $row['password'];}
	else echo "no";
	
	



	






}





?>




<div align="center">
		<b>login</b>
	</div></br></br></br>
	
	<form method="post" >
		<table align="center">
			<tr><td>UserName:</td><td><input type="text" id="user" name="user"/></td></tr>
			<tr><td></td><td><input type="submit" id="forgotpassword" name="forgotpassword" value="forgotpassword" /></td></tr>
			<form method="post" >
	        <tr><td>answer:</td><td><input type="text" id="answertext" name="answertext"/></td></tr>
			<tr><td></td><td><input type="submit" id="answer" name="answer" value="answer" /></td></tr>
		</table>
		
		
		</form>








