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
            $queryy = "SELECT distinct product_name from category where 1";
            $resultt= mysql_query($queryy);
            $rows = mysql_num_rows($resultt);
            for($i=1;$i<$rows;$i++){
            	$temp = mysql_result($resultt, $i, 'product_name'); 
            	print("$temp <br>"); 
            }
            
            print $temp;
			

			

			//$rows=$rows->fetchAll();
			return $rows;
			$array0=array();
			$array1=array();//제품이름
			$array2=array();//등장횟수
			$array3=array();//등장타이틀, 등장링크 총
			$array4=array();//등장타이틀,등장링크 갯수
			$array5=array();//등장타이틀,등장링크
			
			$row=$rows[0];
			array_push($array1,$row);
		    $contents=$row['product_name'];

		    $counts=$this->db->query("SELECT count(product_name) from category where product_name='$contents'");
		    $counts=$counts->fetchAll();
		    $count=$counts['count(product_name)'];
		    array_push($array2,$count);
		    $videos=$this->db->query("SELECT title,link from category where product_name='$contents'");
		    $videos=$videos->fetchAll();
		    $video=$videos[0];
		    $videoname = $video['title'];
		    $videolink = $video['link'];
		    array_push($array5,array($videoname,$videolink));
		    array_push($array4,$array5);
		    array_push($array3,$array4);
			array_push($array0,array($array1,$array2,$array3));

		    return $array0;
		    
		    
            

        }
        public function returnHello(){
        	return "hello";
        }
	}
	

?>