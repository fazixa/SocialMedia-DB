
<?php
//session_start();
include("config.php");
       $main=new db();
       $user=$_SESSION['username'];

       $profile=$_SESSION['profile'];

if(isset($_POST['follow'])){
	 
	    $value=$_POST['follow'];
	     
	    $main->following($value,$user);
}


?>

<font size="4" color="#00a8e2"><p> <strong><?php echo $_SESSION['profile']; ?> page</strong></p></font><br>

<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script language="javascript" type="text/javascript" src="js/main.js"></script>
</head>

<body>
	
	


<div align="center">

<table  cellspacing="50" >
		<form method="post" onSubmit="return do_post();">
  <tr>
    <th class="tg-0pky">
		


    	

    <div class="post">	

<?php
		
        
	    
	    $re = $main->showuserposts($profile);
		  while ($r = mysqli_fetch_array($re,MYSQLI_BOTH)){
		
		//$id=$r['id'];
		?><br>

<script type="text/javascript">$( "button-like#jQueryColorChange" ).click(function() {
  $(this).toggleClass( "selected" );
});
</script>
		
	<font size="3" color="#00a8e2"><?php
		print $r['username']; ?></font><br><br>
		<textarea class="textarea bodypost" id="show" name="show"><?php print $r['body'];?></textarea><br><br>
		
		
		
		 
		<?php

		echo $r['id']; echo $user;
		 if ($main->liked($user,$r['id'])){
	
	?>
		<button class="button-like" type="submit" id="jQueryColorChange" name="like"  value="<?php print $r['id'];?>" ><i class="fa fa-heart"></i><span>Like</span></button> <?php } else { ?> <div class="button-go" type="submit" id="jQueryColorChange" name="liked" value="liked" /><i class="fa fa-heart"></i><span>Liked</span></div>  <?php } ?>
		<button class="button button-like" type="submit" id="comment" name="comment" value="<?php print $r['id'];?>" >comment</button><br/><br><hr>
		<?php
		
		}
			
		if(isset($_POST['like'])){ 

			
			$postid_like=$_POST['like'];
			if ($main->liked($user,$postid_like))
			$res = $main->like($user,$postid_like);
		    else {
		    	?>



		    	<?php



		    }




		}		
		if(isset($_POST['comment'])){ 
			$postid_comm=$_POST['comment'];
			$res = $main->opencomments($postid_comm);
		}
	
		
		?>
		
        
</div>


    </th>

    <th>
    		<?php  $res = $main->getfollowerscount($profile); ?>	<button type="text" class="button button-go" type="submit" id="followers" name="followers" value="followers">followers</button>
			

<div align="left"> <br/> 
    	<?php
		
        if(isset($_POST['followers'])){
	    
	    $res = $main->getfollowers($profile);
			
		  while ($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
		  	
	
	
	if ($main->exist($user,$row['follower'])){ 
	
	?>
	<div class="button button-user" id="profile" name="profile" value="<?php print $row['follower'];?>" ><?php print $row['follower'];?></div>

	
	<button type="submit" class="button button-go" id="follow" name="follow" value="<?php print $row['follower'];?>" >follow</button> <button type="submit" class="button button-go" id="block" name="block" value="<?php print $row['follower'];?>" >block</button>
	<br/><br/>
		<?php
	}
			  
			  else{ 
				  ?>
				  
				 <div class="button button-user" id="profile" name="profile" value="<?php print $row['follower'];?>" ><?php print $row['follower'];?></div>
<button type="submit" class="button button-go" id="block" name="block" value="<?php print $row['follower'];?>" >block</button>

				 <br/> <br/> 
				 
			  <?php
			  
			  }
		}
		}
		?>
		
		
		
		
		
		
		
		
		
		</div>
		


    </th>



    <th>
    		<?php  $res = $main->getfollowingscount($profile); ?>	<button type="text" class="button button-go" type="submit" id="followers" name="followings" value="followings">followings</button>
			

<div align="left"> <br/> 
    	<?php
		
        if(isset($_POST['followings'])){
	    
	    $res = $main->getfollowings($profile);
			
		  while ($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
		  	
	
	
	if ($main->exist($user,$row['following'])){ 
	
	?>
	<div class="button button-user" id="profile" name="profile" value="<?php print $row['following'];?>" ><?php print $row['following'];?></div>

	
	<button type="submit" class="button button-go" id="follow" name="follow" value="<?php print $row['following'];?>" >follow</button> <button type="submit" class="button button-go" id="block" name="block" value="<?php print $row['following'];?>" >block</button>
	<br/><br/>
		<?php
	}
			  
			  else{ 
				  ?>
				  
				 <div class="button button-user" id="profile" name="profile" value="<?php print $row['following'];?>" ><?php print $row['following'];?></div>
<button type="submit" class="button button-go" id="block" name="block" value="<?php print $row['following'];?>" >block</button>

				 <br/> <br/> 
				 
			  <?php
			  
			  }
		}
		}
		?>
		
		
		
		
		
		
		
		
		
		</div>
		


    </th>
    </tr>
</form>
</table>

</div>








</body>
</html>