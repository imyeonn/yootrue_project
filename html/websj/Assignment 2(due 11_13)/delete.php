<?php
	include 'timeline.php';
	$timeline=new Timeline();
	# Ex 5 : Delete a tweet
	try {
	    $no=$_POST["no"];
	    $timeline->delete($no);
	    header("Location:index.php");
	    
	} catch(Exception $e) {
	     header("Loaction:error.php"); 
	}
?>
