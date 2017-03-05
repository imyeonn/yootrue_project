<?php
	class functions{
		private $db;
		function __construct()
        {
            # You can change mysql username or password
            $this->db = new PDO("mysql:host=localhost;dbname=imyeonn", "imyeonn", "c12345678");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
			$query1 = "SELECT distinct product_name, product_pics from category where product_name like '%$query%' order by product_name ASC";
            $result1= mysql_query($query1);
            $rows1 = mysql_num_rows($result1);
            //$r=mysql_fetch_array($result1); 
            $array0=array();
            for($i=0;$i<$rows1;$i++){
            	$array1=array();//제품이름,이미지
				$array2=array();//등장횟수
				$array3=array();//등장타이틀, 등장링크 총
				$array4=array();//등장타이틀,등장링크 갯수
				$array5=array();//등장타이틀,등장링크
            	$product_name = mysql_result($result1, $i, 'product_name'); 
            	$product_pics = mysql_result($result1, $i, 'product_pics');
            	array_push($array1,array($product_name,$product_pics));
            	$query2 = "SELECT count(product_name) from category where product_name='$product_name'";
		    	$result2 = mysql_query($query2);
		    	$temp3 = mysql_result($result2, 0);
		    	$count=$temp3;
		    	array_push($array2,$count);
		    	$query3 = "SELECT title,link from category where product_name='$product_name'";
			    $result3 = mysql_query($query3);
			    $rows2 = mysql_num_rows($result3);
			    for($j=0;$j<$rows2;$j++){
			    	$videoname = mysql_result($result3, $j, 'title');
				    $videolink = mysql_result($result3, $j, 'link');
				    $videoname = $videoname;
			    	$videolink = $videolink;
				    array_push($array5,array($videoname,$videolink));	
			    }
			    array_push($array4,$array5);
			    array_push($array3,$array4);
				array_push($array0,array($array1,$array2,$array3));

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
        	$query1 = "SELECT * from video where 1";
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
            	array_push($array1,array($title,$thumbnail,$date,$min,$sec));

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