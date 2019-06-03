<?php 

session_start();
$_SESSION['success'] = "";
//$_SESSION['username'] = "";
class db{
	public $db;
	function __construct(){
		//mysqli_connect()
    $this->db=mysqli_connect("127.0.0.1","root","");
		//$mysqli = new mysqli("localhost", "root", "", "socialnetwork");
       mysqli_query($this->db,"SET NAMES 'utf8'");
	   mysqli_select_db($this->db,"socialnetwork");



	}
	
	function register($user,$pass,$email,$sele,$answ){
	$q="INSERT INTO `users`  (`username`, `password`, `email`, `question`, `answer`) VALUES ('$user', '$pass', '$email', '$sele', '$answ')";
	 mysqli_query($this->db,$q);
	}
	
	
	function login($user,$pass){
	$q="SELECT * FROM `users` WHERE username='$user' AND password='$pass'";
	$results= mysqli_query($this->db,$q);
		
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $user;
				$_SESSION['success'] = "You are now logged in";
				header('location: home.php');
			
				
				
				//echo $_SESSION['success'];
	            //unset($_SESSION['success']);
				//header('location: index.php');
	}
		
		
	
}
	
	function search($user,$term){
		$q= "SELECT * FROM `users` AS u WHERE username LIKE '%$term%'  AND NOT EXISTS(SELECT blockee
                    FROM block AS b
                   WHERE blocker = u.username AND blockee='$user')";
        $sql=mysqli_query($this->db,$q);
		return $sql;
     
    
  }
	
	
	function hashtagsearch($term){
		$q= "SELECT * FROM `posts` WHERE body LIKE '%#$term%'";
        $sql=mysqli_query($this->db,$q);
		return $sql;
     
    
  }
	
	
	
	function exist($user,$friend){
	$q="SELECT * FROM `follow` WHERE follower='$user' AND following='$friend'";
	$results= mysqli_query($this->db,$q);
		
			if (mysqli_num_rows($results) == 1) {
				return FALSE;}
				else
					return TRUE;
	}


		function liked($user,$id){
	$q="SELECT * FROM `post_likes` WHERE username='$user' AND post_id='$id'";
	$results= mysqli_query($this->db,$q);
		
			if (mysqli_num_rows($results) >= 1) {
				return FALSE;}
				else
					return TRUE;

	}

		function likedcomment($user,$id){
	$q="SELECT * FROM `comment_likes` WHERE username='$user' AND comment_id='$id'";
	$results= mysqli_query($this->db,$q);

		
			if (mysqli_num_rows($results) >= 1) {
				return FALSE;}
				else
					return TRUE;

	}




		function likedreply($user,$id){
			print"//////";
			print $id;
			print $user;
			print"//////";
	$q="SELECT * FROM `reply_likes` WHERE username='$user' AND reply_id='$id'";
	$results= mysqli_query($this->db,$q);
		
			if (mysqli_num_rows($results) >= 1) {
				
			
				return FALSE;

				}
				else{
					return TRUE;
					
				}

	}
	
	
	function showposts($user){
		$q= "SELECT DISTINCT * FROM `posts` AS p INNER JOIN `follow` AS f ON p.username=f.following WHERE f.follower='$user' ORDER BY date DESC LIMIT 10" ;
        $sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));

		return $sql;
     
    
  }

  function showuserposts($user){
		$q= "SELECT * FROM `posts`  WHERE username='$user'" ;
        $sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));

		return $sql;
     
    
  }
	
	
  function following($value,$user){
	  echo $value;
	  
	
	  
	 // INSERT INTO `follow` (`follower`, `following`) VALUES ('nafise', 'fa'), ('fa', 'nafise');
	 $q="INSERT INTO `follow`  (`follower`, `following`) VALUES ('$user', '$value') 
	;";
	 mysqli_query($this->db,$q);
	  echo $user;
  }


  function block($value,$user){
	 // echo $value;
	  
	
	  
	 // INSERT INTO `follow` (`follower`, `following`) VALUES ('nafise', 'fa'), ('fa', 'nafise');
	 $q="INSERT INTO `block` (`blocker`, `blockee`) VALUES ('$user', '$value');";
	 mysqli_query($this->db,$q);


	 $q2="DELETE FROM `follow` WHERE following='$user' AND  follower='$value';";
	 mysqli_query($this->db,$q2);

	 $q3="DELETE FROM `follow` WHERE follower='$user' AND  following='$value';";
	 mysqli_query($this->db,$q3);
	 // echo $user;
  }
	 function post($body,$user){
	 // echo $value;
	  
	
	  
	 
	 $q="INSERT INTO `posts` (`body`, `username` , `date`) VALUES ('$body', '$user', NOW());";
	 mysqli_query($this->db,$q);
	  
  }
	function forgotpass($user){
		
	$q="SELECT * FROM `users` WHERE username='$user'";
	$results= mysqli_query($this->db,$q);
	
	//$_SESSION['forgot'] = $user;
	return $results;
	
	}
	function like($user,$id){
	$sql = "UPDATE posts SET likes=likes+1 WHERE id='$id'";
	$pluse = "UPDATE posts SET hotness=hotness+1 WHERE id='$id'";
		mysqli_query($this->db, $pluse);

    if (mysqli_query($this->db, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
		
		
		$sqll = "INSERT INTO `post_likes` (`id`, `username`, `post_id`) VALUES (NULL, '$user', '$id')";
		mysqli_query($this->db,$sqll);
	}


	function openprofile($profile){
		
		
			$_SESSION['profile'] = $profile;
		
            header('location: profile.php');
		
		}
	
	function opencomments($id){
		
		
			$_SESSION['post_id'] = $id;
		
            header('location: comment.php');
		
		
	}
		function openreply($id){
		
		
			$_SESSION['comment_id'] = $id;
		
            header('location: reply.php');
		
		
	}
	




		function showreply($id){
		
		$q= "SELECT * FROM `replies` WHERE comment_id='$id'" ;
        $sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));
	    
		return $sql;
		
		}
	
	function insertreply($reply,$user,$id){
		
		$postId="SELECT * FROM `comments` WHERE id='$id'";
    $getId=mysqli_query($this->db,$postId);
	$row = mysqli_fetch_array($getId,MYSQLI_BOTH);
	$pId=$row['post_id'];
    $pluse = "UPDATE posts SET hotness=hotness+1 WHERE id='$pId'";
		mysqli_query($this->db, $pluse);
		
		
	  $q="INSERT INTO `replies` (`reply_body`, `comment_id`,`username`) VALUES ('$reply', '$id','$user');";
	 mysqli_query($this->db,$q);
	}
	
	function likereply($user,$id){
	$replyId="SELECT * FROM `replies` WHERE id='$id'";
    $Id1=mysqli_query($this->db,$replyId);
	$row1= mysqli_fetch_array($Id1,MYSQLI_BOTH);
	$pId1=$row1['comment_id'];
	$postId="SELECT * FROM `comments` WHERE id='$pId1'";
    $getId=mysqli_query($this->db,$postId);
	$row = mysqli_fetch_array($getId,MYSQLI_BOTH);
	$pId=$row['post_id'];
    $pluse = "UPDATE posts SET hotness=hotness+1 WHERE id='$pId'";
		mysqli_query($this->db, $pluse);
		
	$sql = "UPDATE `replies` SET likes=likes+1 WHERE id='$id'";


    if (mysqli_query($this->db, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
		
		
		$sqll = "INSERT INTO `reply_likes` (`id`, `username`, `reply_id`) VALUES (NULL, '$user', '$id')";
		mysqli_query($this->db,$sqll);
	}
	
	function showcomments($id){
		
		$q= "SELECT * FROM `comments` WHERE post_id='$id'" ;
        $sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));
	    
		return $sql;
		
		}
	
	function insertcomment($comment,$user,$id){
		
		$pluse = "UPDATE posts SET hotness=hotness+1 WHERE id='$id'";
		mysqli_query($this->db, $pluse);
			
	  $q="INSERT INTO `comments` (`comment_body`, `post_id`,`username`) VALUES ('$comment', '$id','$user');";
	 mysqli_query($this->db,$q);
	}
	
	function likecomment($user,$id){
		
		
$postId="SELECT * FROM `comments` WHERE id='$id'";
    $getId=mysqli_query($this->db,$postId);
	$row = mysqli_fetch_array($getId,MYSQLI_BOTH);
	$pId=$row['post_id'];
    $pluse = "UPDATE posts SET hotness=hotness+1 WHERE id='$pId'";
		mysqli_query($this->db, $pluse);
   
	$sql = "UPDATE `comments` SET likes=likes+1 WHERE id='$id'";

    if (mysqli_query($this->db, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
		
		
		$sqll = "INSERT INTO `comment_likes` (`id`, `username`, `comment_id`) VALUES (NULL, '$user', '$id')";
		mysqli_query($this->db,$sqll);
	}
	
		function showhottest(){
		$q= "SELECT * FROM `posts`
		ORDER BY hotness DESC" ;
        $sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));

		return $sql;
     
    
  }
	
	function followback(){
		$q= "SELECT DISTINCT f3.follower FROM `follow` AS f3 INNER JOIN `follow` AS f4 ON f3.follower=f4.following AND f4.follower=f3.following WHERE f3.follower NOT IN( SELECT temp.follower FROM `follow` AS temp WHERE NOT EXISTS (SELECT f1.follower,f2.following FROM `follow` AS f1 INNER JOIN `follow` AS f2 ON f1.follower=f2.following AND f2.follower=f1.following WHERE f1.following=temp.following AND f1.follower=temp.follower ))";
        $sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));
		while ($r = mysqli_fetch_array( $sql,MYSQLI_BOTH)){
         echo $r['follower'];  print "\n";echo "<br>";
		}
	}


function activeusers()
{		
//$k= "SELECT DATEDIFF(day, '2017/08/25', '2011/08/25');"
 //$sqll=mysqli_query($this->db,$k)or die( mysqli_error($this->db));
 //$w = mysqli_fetch_array( $sqll,MYSQLI_BOTH);
 //echo $w;

//$d= "SELECT DATEDIFF(day, '2007-05-06 12:10:09', '2007-05-07 12:10:09');";
       // $sqlll=mysqli_query($this->db,$d)or die( mysqli_error($this->db));

$q= "


SELECT DISTINCT f2.follower FROM follow AS f2 WHERE f2.follower NOT IN(

SELECT f1.follower FROM follow AS f1 WHERE f1.following NOT IN(

SELECT temp.username FROM(SELECT u.username, u.date FROM `posts` AS p INNER JOIN `users` AS u ON p.username=u.username WHERE p.date >= u.date AND p.date < NOW() GROUP BY u.username 
HAVING COUNT(DISTINCT DATE(p.date)) >= DateDiff( NOW(), u.date )) AS temp))

";
        $sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));
		while ($r = mysqli_fetch_array( $sql,MYSQLI_BOTH)){
         echo $r['follower'];
		





//WHERE  posts.date >= '2019-01-01' and post.date < '2019-01-27'
//GROUP BY p.id
//HAVING COUNT(DISTINCT DATE(p.date)) >= 2;

// $q= "DATEDIFF(DAY, '1/1/2011', '3/1/2011');"

		}


}




function ten(){


			//$q= "SELECT temp.username  FROM  ( SELECT post_id, username FROM `comments` GROUP BY post_id, username HAVING COUNT(*)>10) AS temp GROUP BY temp.usrname HAVING COUNT()>3";
			$q= "SELECT * FROM (SELECT post_id, username FROM `comments` GROUP BY post_id, username HAVING COUNT(*)>=3) AS temp GROUP BY temp.username HAVING COUNT(*)>=2";

			$sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));
		while ($r = mysqli_fetch_array( $sql,MYSQLI_BOTH)){
         echo $r['username'];

         echo "<br>";

         

		}


}





function fakedetector()
{


$q="UPDATE users SET days = DateDiff( NOW(), date )";

		$sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));


$h="SELECT u.username,u.days,p.count  FROM users AS u INNER JOIN (SELECT username, COUNT(id) AS count FROM posts GROUP BY username) AS p ON p.username=u.username ";
$sqll=mysqli_query($this->db,$h)or die( mysqli_error($this->db));
return $sqll;


	


    
}






function hi($user){

	$q="SELECT DISTINCT *
FROM `perpost` AS `p`INNER JOIN `peruser` AS `u` ON p.liker= u.username
WHERE  p.count>0.5* u.count AND p.liker='$user'";


$sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));
		while ($r = mysqli_fetch_array( $sql,MYSQLI_BOTH)){
        print "user("; echo $r['liker']; print ")is a suspicious bot for user(" ;
         

         echo $r['poster'];print ")\n"; echo "<br>";

      

}
}




	function likecount($id){
	$q="SELECT likes FROM posts WHERE id='$id'";
	$sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));
	$row = mysqli_fetch_array($sql,MYSQLI_BOTH);
	echo $row['likes'];
	    
		return $sql;


	}

	function likecommentcount($id){
	$q="SELECT likes FROM comments WHERE id='$id'";
	$sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));
	$row = mysqli_fetch_array($sql,MYSQLI_BOTH);
	echo $row['likes'];
	    
		return $sql;


	}


function likereplycount($id){
	$q="SELECT likes FROM replies WHERE id='$id'";
	$sql=mysqli_query($this->db,$q)or die( mysqli_error($this->db));
	$row = mysqli_fetch_array($sql,MYSQLI_BOTH);
	echo $row['likes'];
	    
		return $sql;


	}




	function repeatedpost($user,$body){
			
	$q="SELECT * FROM `posts` WHERE username='$user' AND body='$body'";
	$results= mysqli_query($this->db,$q);
		
			if (mysqli_num_rows($results) >= 1) {
				
				print "NIST";
				return false;

				}
				else{
					return true;
					print "HAST";
				}

	}



function repeatedcomment($user,$body){
			
	$q="SELECT * FROM `comments` WHERE username='$user' AND comment_body='$body'";
	$results= mysqli_query($this->db,$q);
		
			if (mysqli_num_rows($results)>= 1) {
				
				
				return false;

				}
				else{
					return true;
					
				}

	}



	function repeatedreply($user,$body){
			
	$q="SELECT * FROM `replies` WHERE username='$user' AND reply_body='$body'";
	$results= mysqli_query($this->db,$q);
		
			if (mysqli_num_rows($results) >= 1) {
				
				
				return false;

				}
				else{
					return true;
					
				}

	}



function getfollowers($profile){

$q="SELECT * FROM `follow` WHERE following='$profile'";
$results= mysqli_query($this->db,$q);
return $results;

}


function getfollowings($profile){

$q="SELECT * FROM `follow` WHERE follower='$profile'";
$results= mysqli_query($this->db,$q);
return $results;

}

function getfollowerscount($profile){

$q="SELECT COUNT(*) AS count FROM `follow` GROUP BY following HAVING  following='$profile'";
$results= mysqli_query($this->db,$q);
$row = mysqli_fetch_array($results,MYSQLI_BOTH);
	echo $row['count'];
return $results;

}

function getfollowingscount($profile){

$q="SELECT COUNT(*) AS count FROM `follow` GROUP BY follower HAVING  follower='$profile'";
$results= mysqli_query($this->db,$q);
$row = mysqli_fetch_array($results,MYSQLI_BOTH);
	echo $row['count'];
return $results;

}








function loginManager($user,$pass){
	$q="SELECT * FROM `admin` WHERE username='$user' AND password='$pass'";
	$results= mysqli_query($this->db,$q);
		
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $user;
				$_SESSION['success'] = "You are now logged in";
				header('location: manager.php');
			
				}
		
}
	
		function loginAnalayzer($user,$pass){
	$q="SELECT * FROM `analyzer` WHERE username='$user' AND password='$pass'";
	$results= mysqli_query($this->db,$q);
		
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $user;
				$_SESSION['success'] = "You are now logged in";
				header('location: analyzer.php');
			
				}
		
}









	
}
?>