<?php
//session_start();
include("config.php");
       $main=new db();
       $user=$_SESSION['username'];
if(isset($_POST['follow'])){
	 
	    $value=$_POST['follow'];

	  
	    if ($main->exist($user,$value)){
	    $main->following($value,$user);}
	   
}

if(isset($_POST['block'])){
	 
	    $value=$_POST['block'];
	     
	    $main->block($value,$user);
}


if(isset($_POST['submitpost'])){
	 
	    $body=$_POST['post'];
	     if($body==""){
	     	header('location: home.php');
	     }
	     else{
	     	if($main->repeatedpost($user,$body)){$main->post($body,$user);}
	     	
}
	     }
	    

?>



<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">


	<script language="javascript" type="text/javascript" src="js/main.js">
		

	</script>











</head>

<body>
	
	


<div align="center">


<table  cellspacing="50" >
		<form method="post" onSubmit="return do_post();">
  <tr>
    <th class="tg-0pky">
		


    	 <div class="post">	
<br><input type="texti" placeholder='Post something' id="post" name="post" /><br><br>
			<button  class="button button-post" type="submit" id="submitpost" name="submitpost" value="post" >post</button>
			 
		

    	 </div><br><br>

    <div class="post">	

<?php
		
        
	    
	    $re = $main->showposts($user);
		  while ($r = mysqli_fetch_array($re,MYSQLI_BOTH)){
		
		//$id=$r['id'];
		?><br>


		
	<font size="3" color="#00a8e2"><?php
		print $r['username']; print $r['id']; ?></font><br><br>
		<textarea class="textarea bodypost" id="show" name="show"><?php print $r['body'];?></textarea><br><br>
		
		
		<?php

		


        $resss=$main->likecount($r['id']);
       


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
		if(isset($_POST['showhottest'])){ 
			 header('location: hotposts.php');
		}
		if(isset($_POST['profile'])){ 


			$profileId=$_POST['profile'];
			$res = $main->openprofile($profileId);
		}
		?>
		
        
</div>


    </th>
    <th class="tg-0lax" valign="top">
    	
	<font size="4" color="#00a8e2"><p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p></font><br>
		
		
		<button  class="button button-post" type="showhottest" id="submitpost" name="showhottest" value="showhotest" >Show hottest posts</button><br><br><br>

            <input type="textii" placeholder='Search for friends' id="term2" name="term2"/>
			
			<button type="text" class="button button-go" type="submit" id="search" name="search" value="search">Go</button>
			

<div align="left"> <br/> 
    	<?php
		
        if(isset($_POST['search'])){
	    $term2=$_POST['term2'];
	    $res = $main->search($user,$term2);
			
		  while ($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
		  	
	
	
	if ($main->exist($user,$row['username'])){ 
	
	?>
	<button type="submit" class="button button-user" id="profile" name="profile" value="<?php print $row['username'];?>" ><?php print $row['username'];?></button>

	
	<button type="submit" class="button button-go" id="follow" name="follow" value="<?php print $row['username'];?>" >follow</button> <button type="submit" class="button button-go" id="block" name="block" value="<?php print $row['username'];?>" >block</button>
	<br/><br/>
		<?php
	}
			  
			  else{ 
				  ?>
				  
				 <button type="submit" class="button button-user" id="profile" name="profile" value="<?php print $row['username'];?>" ><?php print $row['username'];?></button>
<button type="submit" class="button button-go" id="block" name="block" value="<?php print $row['username'];?>" >block</button>

				 <br/> <br/> 
				 
			  <?php
			  
			  }
		}
		}
		?>
		
		
		
		
		
		
		
		
		
		</div>
		
		<br><br>
		
		
		
<input type="textii" placeholder='Search for hashtag' id="term" name="term"/>
			
			<button type="text" class="button button-go" type="submit" id="hashtagsearch" name="hashtagsearch" value="hashtagsearch">Go</button>
	
	
	
	<?php
		
        if(isset($_POST['hashtagsearch'])){
	    $term=$_POST['term'];
	    $res = $main->hashtagsearch($term);
			
		  while ($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
	
	
	 
	
	?>
	
		<br><br><font size="2" color="#585858"><?php print $row['username'];?></font>
	<br><font size="1" color="#585858"><?php print $row['body'];?></font>
	<button class="button-like" type="submit" id="jQueryColorChange" name="like" value="<?php print $row['id'];?>" /><i class="fa fa-heart"></i><span>Like</span></button>
		<button class="button button-like" type="submit" id="comment" name="comment" value="<?php print $row['id'];?>" >comment</button><br/><br><hr>
	

				  
	
				 
			  <?php
			  
			  }
	}
	
		?>
		
		
		
		
		
		
		
		
		
		
		
		<br><br>
		
	
	
	
	
	
	
	</div>
    </th>
  </tr>
</form>
</table>

</div>








</body>
</html>