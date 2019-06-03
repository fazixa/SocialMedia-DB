<?php
include("config.php");
       $main=new db();


 $username=$_SESSION['username'];
 $id=$_SESSION['comment_id'];
 $resualt = $main->showreply($id);
if(isset($_POST['submitreply'])){
	 
	    $body=$_POST['reply'];

	     if($body==""){
	     	 header('location: reply.php');
	     }
	     else{
	    if($main->repeatedreply($username,$body))

	    	$main->insertreply($body,$username,$id);}
}
	     
	if(isset($_POST['like'])){ 

			
			$commentId=$_POST['like'];
			print $commentId;
			if ($main->likedreply($username,$commentId)){

				print "true";
			$res = $main->likereply($username,$commentId);}
		   



		}	   

?>
<html>
<head>
	<title>comment</title>
 <link rel="stylesheet" type="text/css" href="style.css"></head>



 <body>
<form method="post"  >


	<div align="center">
	<table>
	<tr><td>reply:</td><td><input type="text" id="reply" name="reply"/></td><td><input type="submit" id="submitreply" name="submitreply" value="reply" /></td></tr>
	
			
		</table>
	
	</div>

	
 <?php
  while ($row = mysqli_fetch_array($resualt,MYSQLI_BOTH)){
		
		?>
		<font size="3" color="#00a8e2"><?php
		print $row['username'];  ?></font><br><br>
	   
		<input type="text" id="show" name="show" value="<?php print $row['reply_body'];?>" />



		<?php

		


        $resss=$main->likereplycount($row['id']);
       


		 if ($main->likedreply($username,$row['id'])){
	
	?>
		<button class="button-like" type="submit" id="jQueryColorChange" name="like"  value="<?php print $row['id'];?>" ><i class="fa fa-heart"></i><span>Like</span></button> <?php } 



		else { ?>


		 <div class="button-go" type="submit" id="jQueryColorChange" name="liked" value="liked" /><i class="fa fa-heart"></i><span>Liked</span></div>

		   <?php }
		

		}
	 
?>
</form>

</body>

</html>

