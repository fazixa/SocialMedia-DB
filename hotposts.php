<?php
//session_start();
include("config.php");
       $main=new db();
 
?>
<!doctype html>


<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
	
		<form method="post" >
	   <div class="post">	

<?php
		
        
	    
	    $re =  $main-> showhottest();
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
		
		
		
		 
		<button class="button-like" type="submit" id="jQueryColorChange" name="like" value="<?php print $r['id'];?>" /><i class="fa fa-heart"></i><span>Like</span></button>
		<button class="button button-like" type="submit" id="comment" name="comment" value="<?php print $r['id'];?>" >comment</button><br/><br><hr>
		<?php
		 //print $user;
	  //  print $id;
		}
			
		if(isset($_POST['like'])){ 
			$postid_like=$_POST['like'];
			
			$res = $main->like($user,$postid_like);
		}	
		if(isset($_POST['comment'])){ 
			$postid_comm=$_POST['comment'];
			$res = $main->opencomments($postid_comm);
		}
		if(isset($_POST['showhottest'])){ 
			 header('location: hotposts.php');
		}
		?>
		
        
</div>
	
	
	
	</form>
	
	
</body>
</html>