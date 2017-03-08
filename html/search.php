<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>카테고리</title>
		<link rel="stylesheet" href="search.css">
	</head>
	<body>
		<div>
			<div>
				<img src="images/home/u52.png" />
				<div class="search">
		            <!-- Ex 3: Modify forms -->
		            <form class="search-form" action="search.php" method="get">
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


			<!-- 여기부터 수정함 -->
			<article id="searchresult">
				<div>
					<?php
	                	include 'functions.php';
	                	$functions=new Functions();
	                	$query=$_GET['query'];

	                	$arrays=$functions->searchProducts($query);
	                	//var_dump($arrays);
	                	foreach($arrays as $array){
	                		$productinfo = $array[0];
	                		$productnames = $productinfo[0];
	                		$productname = $productnames[0];
	                		$productimage = $productnames[1];
	                		$counts = $array[1];
	                		$count = $counts[0];

	                		?>
	                		<img src=<?=$productimage?> alt="product image"/>
	                		<h2><?=$productname?></h2>
	                		<p>
	                			<span id="count"><?="$count"?>회 등장</span>
	                			<span id="video">등장 영상 보기</span>
	                		</p>
	                		<?php

	                		$videosss = $array[2];
	                		//print $videossss;
	                		//print '<br>';
	                		$videoss = $videosss[0];
	                		//print $videosss;
	                		//print '<br>';
	                		$videos = $videoss[0];

	                		foreach($videos as $video){
		                		//$videos=$array[2];
		                		//$videos = $videoss[0];
		                		//$video = $videos[0];//videos : 제목
		                		$title=$video[0];
	                			$link=$video[1];
	                			?>
	                			<p>
	                				<span id="list">
														<a href=<?=$link?>><?=$title?></a>
													</span>
	                			</p>

	                			<?php
	                		}

	                		//$thumbnail=$thumbnails[0];




	                	}
	                ?>

	            </div>
			</article>
		</div>

	</body>
</html>
