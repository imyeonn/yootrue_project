<?php
    include 'timeline.php';
    $timeline = new Timeline();
    # Ex 4 : Write a tweet
    try {
        $author=$_POST["author"];
        $contents=$_POST["contents"];
        $i=strlen($author);
        if($i<=20){
            if (preg_match("/^[a-zA-Z]+([\ \-]?[a-zA-Z]+)*$/",$author)) { //validate author & content
                $tweet=array();
                $author=htmlspecialchars($author, ENT_QUOTES);
                $contents=htmlspecialchars($contents, ENT_QUOTES);
                array_push($tweet,$author);
                array_push($tweet,$contents);
                $timeline->add($tweet);
                header("Location:index.php"); //redirect to index.php
            }
            else {
                header("Location:error.php");
            }
        }
        else{
            header("Location:error.php");
        }
        
    } catch(Exception $e) {
        echo $e;
         header("Location:error.php"); 
    }
?>
