<!DOCTYPE html>
<html>
<head>
    <title>Dictionary</title>
    <meta charset="utf-8" />
    <link href="dictionary1.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>My Dictionary</h1>
    <?php
    $filename="dictionary1.tsv";
    $lines=file($filename);
    $size=filesize($filename);
    ?>
<!-- Ex. 1: File of Dictionary -->
    <p>
        My dictionary has <?= sizeof($lines)?> total words
        and
        size of <?= $size?> bytes.
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's words</h2>
<!-- Ex. 2: Today’s Words & Ex 6: Query Parameters -->
        <?php
            $numberOfWords=3;
            function getWordsByNumber($listOfWords, $numberOfWords){
                $resultArray = array();
                $temp=$listOfWords;
                shuffle($temp);
                $resultArray=array_slice($temp,0,$numberOfWords);
//                implement here.
                return $resultArray;
            }
            if(isset($_GET["number_of_words"]))
                $numberOfWords=$_GET["number_of_words"];
            if(isset($numberOfWords)){
                if($numberOfWords==" ")
                    $numberOfWords=3;
            }
            $todaysWords=getWordsByNumber($lines,$numberOfWords);
        ?>
        
        <ol>
            <?php 
            foreach($todaysWords as $todaysWords1){
                $temp=explode("\t",$todaysWords1);
                ?>
                <li><?=$temp[0]." - ".$temp[1]?></li>
            <?php
            } 
            ?>
        </ol>
    </div>
    <div class="section">
        <h2>Searching Words</h2>
<!-- Ex. 3: Searching Words & Ex 6: Query Parameters -->
        <?php
            $startCharacter='C';
            function getWordsByCharacter($listOfWords, $startCharacter){
                $resultArray = array();
                foreach($listOfWords as $list){
                    $temp=explode("\t",$list);
                    $word=$temp[0];
                    if($word[0]==$startCharacter){
                        array_push($resultArray, $list);
                    }
                }
                return $resultArray;
            }

            if(isset($_GET["character"]))
                $startCharacter=$_GET["character"];

            if(isset($startCharacter)){
                if($startCharacter==" ")
                    $startCharacter='C';
                
            }
            $searchedWords=getWordsByCharacter($lines, $startCharacter);
        ?>
        <p>
            Words that started by <strong>'<?=$startCharacter?>'</strong> are followings :
        </p>
        <ol>
            <?php
                foreach($searchedWords as $search){
                    $temp=explode("\t",$search);
                    ?>
                    <li><?=$temp[0]." - ".$temp[1]?></li>
                <?php
                }
                ?>
        </ol>
    </div>
    <div class="section">
        <h2>List of Words</h2>
<!-- Ex. 4: List of Words & Ex 6: Query Parameters -->
        <?php
            $orderby=0;
            function getWordsByOrder($listOfWords, $orderby){
                $resultArray = $listOfWords;
                if($orderby==0){
                    sort($resultArray);
                }
                else if($orderby==1){
                    rsort($resultArray);

                }
//                implement here.
                return $resultArray;
            }
            if(isset($_GET["orderby"]))
                $orderby=$_GET["orderby"];
            if($orderby==" ")
                $orderby=0;
            $result=getWordsByOrder($lines,$orderby);
        ?>
        <p>
            All of words ordered by <strong>alphabetical order</strong> are followings :
        </p>
        <ol>
            <?php
                foreach($result as $line){
                    $temp=explode("\t",$line);
                    if(strlen($temp[0])>6){
                        ?>
                    <li class="long"><?=$temp[0]." - ".$temp[1]?></li>
                    <?php
                    }
                    else{
                        ?>
                        <li><?=$temp[0]." - ".$temp[1]?></li>
                    <?php
                    }
                    ?>
                
            <?php
                }
            ?>  
            
        </ol>
    </div>
    <div class="section">
        <h2>Adding Words</h2>
<!-- Ex. 5: Adding Words & Ex 6: Query Parameters -->
        <?php
        if(isset($_GET["newWord"])&&isset($_GET["meaning"])){
            $newWord=$_GET["newWord"];
            $meaning=$_GET["meaning"];
            $word="\n".$newWord."\t".$meaning;
            file_put_contents("dictionary1.tsv", $word, FILE_APPEND);
        }
        if(isset($newWord)&&isset($meaning)){
        ?>    
        <p>Adding a word <?=$word?> is success!</p>
        <?php
        }
        else{
        ?>
        <p>Input word or meaning of the word doesn't exist.</p>
        <?php
        }
        ?>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>