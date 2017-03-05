<!DOCTYPE html>
<html>
	<head>
		><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>카테고리</title>
		<link rel="stylesheet" href="search.css">
	</head>
	<body>
		<div>
			<div>
				<img src="images/home/u52.png" />
				<div class="search">
		            <!-- Ex 3: Modify forms -->
		            <form class="search-form" action="index.html" method="get">
		                <input type="text" name="query" placeholder="제품명검색">
		                <input type="submit" value="search">
		            </form>
		        </div>
			</div>

			<div style = "clear : both">
				<div>
					<p>카테고리</p>
				</div>
				<div>
					<p>플레이리스트</p>
				</div>
			</div>
			<div>
				<p>정렬</p>
			</div>
			<article>
				
					<?php
						include 'functions.php';
	                	$functions=new Functions();
	                	$query=$_GET['query'];
	                	$arrays=$functions->loadVideo();
	                	//var_dump($arrays);
	                	foreach($arrays as $array){
	                		$videoinfos = $array[0];
	                		$videoinfo = $videoinfos[0];
	                		$title = $videoinfo[0];
	                		$thumbnail = $videoinfo[1];
	                		$date = $videoinfo[2];
	                		$min = $videoinfo[3];
	                		$sec = $videoinfo[4];
	                	?>
	                	<div>
		                	<img src=<?=$thumbnail?> alt="videoimage"/>
		                	<p><?=$title?></p>
		                	<p><?=$date?></p>
		                	<p>
		                		<span></span>
		                		<span><?=$min?>:<?=$sec?></span>
		                	</p>
		                	<p>사용제품</p>

	                	<?
	                		$productss = $array[1];
	                		
	                		$products = $productss[0];
	                		foreach($products as $product){
	                			$productname = $product[0];
	                			$productlink = $product[1];
	                			?>
	                			<p>
	                				<a href=<?=$productlink?>><?=$productname?> </a>
	                			</p>
	                		<?php
	                		}
	                	}
	                ?>
			</article>
		</div>
	</body>
</html>