<?php
	class functions{
		private $db;
		function __construct()
        {
            # You can change mysql username or password
            
            $db_server = mysql_connect("localhost", "imyeonn", "c12345678"); 
			if(!$db_server) die ("Unable to connect to MySQL :" . mysql_error());
			mysql_select_db("imyeonn") or die("Unable to select Database : " . mysql_error());

            //$regsqli = new mysqli("localhost", "imyeonn", "c12345678", "imyeonn");
			//mysql_set_charset("euckr",$regsqli);
			//$regsqli->set_charset("utf8");
			mysql_set_charset("utf8",$db_server);
            mysql_query("set session character_set_connection=utf8;");
			mysql_query("set session character_set_results=utf8;");
			mysql_query("set session character_set_client=utf8;");
        }

        
        public function searchProducts($query) // This function load tweets meeting conditions
        {
            //Fill out here
            //$rows=$this->db->query("SELECT distinct product_name from category where product_name like '%$query%' order by product_name ASC");
            //$rows=$this->db->query("SELECT title from category where 1");
            //$rows=$rows->fetchAll();
            if(isset($_GET["query"])){
            	$query0=$_GET["query"];
            	if($numberOfWords==" ")
            		$query="none";

            }
            $query = str_replace("\"", '', $query);
            $latest = false;
            $order = false;
            $popular = false;
        	if(isset($_GET["order"])){
            	if($_GET["order"]=="latest")
            		$latest = true;
            	else if($_GET["order"]=="order")
            		$order = true;
                else if($_GET["order"]=="popular")
                    $popular = true;
            	
            }
            $query1 = "SELECT distinct product_name, product_pics,product_link, count(product_name) from category where product_name like '%$query%' group by product_name order by product_name ASC";
            if($latest)
            	$query1 = "SELECT distinct product_name, product_pics,product_link,count(product_name),max(date) from category where product_name like '%$query%' group by product_name order by max(date) DESC";
            else if($order)
            	$query1 = "SELECT distinct product_name, product_pics,product_link, count(product_name) from category where product_name like '%$query%' group by product_name order by product_name ASC";
            else if($popular)
                $query1 = "SELECT distinct product_name, product_pics,product_link, count(product_name) from category where product_name like '%$query%' group by product_name order by count(product_name) DESC";
            $result1= mysql_query($query1);
            $rows1 = mysql_num_rows($result1);
            //$r=mysql_fetch_array($result1); 
            $array0=array();
            for($i=0;$i<$rows1;$i++){
            	$array1=array();//제품이름,이미지,등장횟수
				$array2=array();//등장타이틀, 등장링크 총
				$array3=array();//등장타이틀,등장링크 갯수
				$array4=array();//등장타이틀,등장링크
            	$product_name = mysql_result($result1, $i, 'product_name'); 
            	$product_pics = mysql_result($result1, $i, 'product_pics');
                $product_link = mysql_result($result1, $i, 'product_link');
                $product_count = mysql_result($result1, $i, 'count(product_name)');
            	array_push($array1,array($product_name,$product_pics,$product_link,$product_count));
		    	$query3 = "SELECT title,link,date from category where product_name='$product_name'";
			    $result3 = mysql_query($query3);
			    $rows2 = mysql_num_rows($result3);
			    for($j=0;$j<$rows2;$j++){
			    	$videoname = mysql_result($result3, $j, 'title');
				    $videolink = mysql_result($result3, $j, 'link');
                    $videodate = mysql_result($result3, $j, 'date');
				    $videoname = $videoname;
			    	$videolink = $videolink;
				    array_push($array4,array($videoname,$videolink,$videodate));	
			    }
			    array_push($array3,$array4);
			    array_push($array2,$array3);
				array_push($array0,array($array1,$array2));

            }
            //return $rows;
			
			//array_push($array1,$row);
			
			//$row=$rows[0];
		    //$contents=$row['product_name'];
		    //$counts=$this->db->query("SELECT count(product_name) from category where product_name='$contents'");
		    //$counts=$counts->fetchAll();

		    

		    
		    //$videos=$this->db->query("SELECT title,link from category where product_name='$contents'");
		    //$videos=$videos->fetchAll();
		    //$video=$videos[0];
		    //$videoname = $video['title'];
		    //$videolink = $video['link'];		    
		    return $array0;
		    
		    
            

        }
        public function searchCategory($query){
        	if(isset($_GET["query"])){
            	$query0=$_GET["query"];
            	if($numberOfWords==" ")
            		$query="none";

            }
            $query = str_replace("'", '', $query);
            $latest = false;
            $order = false;
        	$popular = false;
            if(isset($_GET["order"])){
                if($_GET["order"]=="latest")
                    $latest = true;
                else if($_GET["order"]=="order")
                    $order = true;
                else if($_GET["order"]=="popular")
                    $popular = true;
                
            }
            $query1 = "SELECT distinct product_name, product_pics,product_link,count(product_name) from category where product_code ='$query' group by product_name order by product_name ASC";
            if($latest)
                $query1 = "SELECT distinct product_name, product_pics,product_link,count(product_name),max(date) from category where product_code ='$query' group by product_name order by max(date) DESC";
            else if($order)
                $query1 = "SELECT distinct product_name, product_pics,product_link,count(product_name) from category where product_code ='$query' group by product_name order by product_name ASC";
            else if($popular)
                $query1 = "SELECT distinct product_name, product_pics,product_link,count(product_name) from category where product_code ='$query' group by product_name order by count(product_name) DESC";
            
            	
            $result1= mysql_query($query1);
            $rows1 = mysql_num_rows($result1);
            //$r=mysql_fetch_array($result1); 
            $array0=array();
            for($i=0;$i<$rows1;$i++){
            	$array1=array();//제품이름,이미지,제품링크,등장횟수
				$array2=array();//등장타이틀, 등장링크 총
				$array3=array();//등장타이틀,등장링크 갯수
				$array4=array();//등장타이틀,등장링크
            	$product_name = mysql_result($result1, $i, 'product_name'); 
            	$product_pics = mysql_result($result1, $i, 'product_pics');
                $product_link = mysql_result($result1, $i, 'product_link');
            	$product_count = mysql_result($result1, $i, 'count(product_name)');
                array_push($array1,array($product_name,$product_pics,$product_link,$product_count));
            	
		    	$query3 = "SELECT title,link,date from category where product_name='$product_name'";
			    $result3 = mysql_query($query3);
			    $rows2 = mysql_num_rows($result3);
			    for($j=0;$j<$rows2;$j++){
			    	$videoname = mysql_result($result3, $j, 'title');
				    $videolink = mysql_result($result3, $j, 'link');
                    $videodate = mysql_result($result3, $j, 'date');
				    $videoname = $videoname;
			    	$videolink = $videolink;
				    array_push($array4,array($videoname,$videolink,$videodate));	
			    }
			    array_push($array3,$array4);
			    array_push($array2,$array3);
				array_push($array0,array($array1,$array2));

            }
            //return $rows;
			
			//array_push($array1,$row);
			
			//$row=$rows[0];
		    //$contents=$row['product_name'];
		    //$counts=$this->db->query("SELECT count(product_name) from category where product_name='$contents'");
		    //$counts=$counts->fetchAll();

		    

		    
		    //$videos=$this->db->query("SELECT title,link from category where product_name='$contents'");
		    //$videos=$videos->fetchAll();
		    //$video=$videos[0];
		    //$videoname = $video['title'];
		    //$videolink = $video['link'];		    
		    return $array0;
        }
        public function loadVideo(){
        	$latest = false;
            $order = false;
        	if(isset($_GET["order"])){
            	if($_GET["order"]=="latest")
            		$latest = true;
            	else if($_GET["order"]=="order")
            		$order = true;
            }
            $query1 = "SELECT * from video where 1 order by date DESC";
            if($latest)
            	$query1 = "SELECT * from video where 1 order by date DESC";
            else if($order)
            	$query1 = "SELECT * from video where 1 order by title ASC";
        	$result1= mysql_query($query1);
            $rows1 = mysql_num_rows($result1);
            $array0=array();
			for($i=0;$i<$rows1;$i++){
				$array1=array();//동영상이름,이미지,날짜,길이
				$array2=array();//등장제품이름, 등장링크 총
				$array3=array();//등장제품이름,등장링크
            	$title = mysql_result($result1, $i, 'title'); 
            	$thumbnail = mysql_result($result1, $i, 'thumbnail');
            	$date = mysql_result($result1, $i, 'date');
            	$min = mysql_result($result1, $i, 'min');
            	$sec = mysql_result($result1, $i, 'sec');
            	$link = mysql_result($result1, $i, 'link');
            	array_push($array1,array($title,$thumbnail,$date,$min,$sec,$link));

            	$query2 = "SELECT product_name,product_link from category where title='$title'";
		    	$result2 = mysql_query($query2);
		    	$rows2 = mysql_num_rows($result2);
		    	//$temp6 = mysql_result($result2);
			    for($j=0;$j<$rows2;$j++){
			    	$productname = mysql_result($result2, $j, 'product_name');
				    $productlink = mysql_result($result2, $j, 'product_link');
				    array_push($array3,array($productname,$productlink));	
			    }
			    array_push($array2,$array3);
				array_push($array0,array($array1,$array2));

            }
            return $array0;

        }
	}
	
	

?>