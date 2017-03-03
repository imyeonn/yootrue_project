<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
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
				<div >
					<p>카테고리</p>
				</div>
				<div >
					<p>플레이리스트</p>
				</div>

			</div>
			<div style = "clear : both">

			</div>
			<article>
				<div>
					<?php
	                	include 'functions.php';
	                	$functions=new Functions();
	                	$query=$_GET['query'];
	                	$arrays=$function->searchProducts($query);
	                	foreach($arrays as $array){
	                		$productnames=$array[0];
	                		$productname=$productnames[0];
	                		$counts=$array[1];
	                		$count=$counts[0];
	                		$videos=$array[2];
	                		$thumbnails=$array[3];
	                		$thumbnail=$thumbnails[0];
	                		?>
	                		<img src=<?=$thumbnail?> alt="product image"/>
	                		<p><?=$productname?></p>
	                		<p>
	                			<span><?="$count"?>회 등장</span>
	                			<span>등장 영상 보기</span>
	                		</p>
	                		<?
	                		foreach($videos as $video){
	                			$title=$video[0];
	                			$link=$video[1];
	                			?>
	                			<p>
	                				<a href="<?=$link?>"><?=$title?> </a>
	                			</p>

	                			<?php
	                		}
	                	}
	                ?>
	                               
	            </div>
			</article>
		</div>

	</body>
</html>