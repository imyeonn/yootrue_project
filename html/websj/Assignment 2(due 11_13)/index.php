<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Simple Timeline</title>
        <link rel="stylesheet" href="timeline.css">
    </head>
    <body>
        <div>
            <a href="index.php"><h1>Simple Timeline</h1></a>
            <div class="search">
                <!-- Ex 3: Modify forms -->
                <form class="search-form" action="index.php" method="get">
                    <input type="submit" value="search">
                    <input type="text" name="query" placeholder="Search">
                    <select name="type">
                        <option>Author</option>
                        <option>Content</option>
                    </select>
                </form>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <!-- Ex 3: Modify forms -->
                    <form class="write-form" action="add.php" method="post">
                        <input type="text" name="author" placeholder="Author">
                        <div>
                            <input type="text" name="contents" placeholder="Content">
                        </div>
                        <input type="submit" value="write">
                    </form>
                </div>
                <!-- Ex 3: Modify forms & Load tweets -->
                <?php
                include 'timeline.php';
                $timeline=new Timeline();
                if(!count($_GET)){
                    $rows=$timeline->loadTweets();
                }
                else{
                    if(isset($_GET["type"])&&isset($_GET["query"])){
                        $rows=$timeline->searchTweets($_GET["type"],$_GET["query"]);
                    }
                    else if(($_GET['query']=="")){
                        $rows=$timeline->loadTweets();
                    }
                    
                }
                foreach($rows as $row){

                        /*$contents=$row['contents'];
                        $replace = "<a href=\"index.php?type=Content&query=%23$1\">#$1</a>";
                        $contents=preg_replace("/#([_]*[a-zA-Z0-9가-힣]+[\w가-힣]*)/",$replace,$contents);
                        $row['contents']=$contents;*/
                        $hour = substr($row['time'], 11, 8);
                        $date = substr($row['time'], 8, 2);
                        $month = substr($row['time'], 5, 2);
                        $year = substr($row['time'], 0, 4);

                        $time = $hour." ".$date."/".$month."/".$year;
                        ?>

                    <div class="tweet">
                        <form class="delete-form" action="delete.php" method="post">
                            <input type="submit" value="delete">
                            <input type="hidden" name="no" value="<?=$row['no']?>">
                        </form>
                        <div class="tweet-info">
                            <span><?=$row['author']?></span>
                            <span><?=$time?></span>
                        </div>
                        <div class="tweet-content">
                            <?=$row['contents']?>
                        </div>
                    </div>
                <?php
                    }
                ?>            
            </div>
        </div>
    </body>
</html>
