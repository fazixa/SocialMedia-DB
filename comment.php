<?php
include("config.php");
       $main=new db();


 $username=$_SESSION['username'];
 $id=$_SESSION['post_id'];
 $resualt = $main->showcomments($id);
if(isset($_POST['submitcomment'])){
	 
	    $body=$_POST['comment'];
	    if($body==""){
	     	header('location: comment.php');
	     }
	     else{
	     	 if($main->repeatedcomment($username,$body)) $main->insertcomment($body,$username,$id);
}
	     
	   
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
	<tr><td>comment:</td><td><input type="text" id="comment" name="comment"/></td><td><input type="submit" id="submitcomment" name="submitcomment" value="comment" /></td></tr>
	
			
		</table>
	
	</div>

	
 <?php
  while ($row = mysqli_fetch_array($resualt,MYSQLI_BOTH)){
		
		?>
	   		
	<font size="3" color="#00a8e2"><?php
		print $row['username'];  ?></font><br><br>
		<input type="text" id="show" name="show" value="<?php print $row['comment_body'];?>" />



		<?php

		


        $resss=$main->likecommentcount($row['id']);
       


		 if ($main->likedcomment($username,$row['id'])){
	
	?>
		<button class="button-like" type="submit" id="jQueryColorChange" name="like"  value="<?php print $row['id'];?>" ><i class="fa fa-heart"></i><span>Like</span></button> <?php } else { ?> <div class="button-go" type="submit" id="jQueryColorChange" name="liked" value="liked" /><i class="fa fa-heart"></i><span>Liked</span></div>  <?php } ?>
		<button class="button button-like" type="submit" id="reply" name="reply" value="<?php print $row['id'];?>" >reply</button><br/><br><hr>






     
	    
		<?php

		}
        	if(isset($_POST['like'])){ 

			
			$postid_like=$_POST['like'];
			if ($main->likedcomment($username,$postid_like))
			$res = $main->likecomment($username,$postid_like);
		    else {
		    	?>



		    	<?php



		    }




		}
	
		if(isset($_POST['reply'])){ 
			$commId=$_POST['reply'];
			$res = $main->openreply($commId);
		}
		 
?>
</form>

</body>

</html>

