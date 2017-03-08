<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>카테고리</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/header_test.css" />
		<link rel="stylesheet" href="fontello/css/fontello.css">
	</head>
	<body>
		<div id="wrapper">
			<header id="header">
				<!-- 프로필사진 -->
				<span class="profile">
					<img src="images/profile.jpg" alt="{{ site.url  }}/category" />
					<!-- 검색창 -->
					<div class="search">
						<form class="search-form" action="search.php" method="get">
							<input type="text" name="query" placeholder="제품을 검색하세요!">
							<input type="submit" value="search">
						</form>
					</div>
				</span>
				<!-- 카테고리/플레이리스트 분류 -->
				<ul class="link">
					<li><a href="{{ site.url }}/category" class="category"><span class="label">카테고리</span></a></li>
					<li><a href="{{ site.url }}/playlist" class="playlist"><span class="label">플레이리스트</span></a></li>
				</ul>
			</header>

			<!-- 검색결과 표시 -->
			<article id="searchresult">
					<!-- 제품리스트 출력 -->
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
					<div class="productbox">
						<img src=<?=$productimage?> alt="product image"/>
						<div class="namename">
							<h2><?=$productname?></h2>
	            <ul>
								<li id="count"><span><?="$count"?>회 등장</span></li>
	              <li id="video"><span>등장 영상 보기</span></li>
	            </ul>
						</div>

						<!-- 제품별 등장영상 출력 -->
						<?php
							$videosss = $array[2];
	            //print $videossss;
	            //print '<br>';
	            $videoss = $videosss[0];
	                		//print $videosss;
	                		//print '<br>';
	                		$videos = $videoss[0];
											?>
											<div>
											<ul>
											<?php
	                		foreach($videos as $video){
		                		//$videos=$array[2];
		                		//$videos = $videoss[0];
		                		//$video = $videos[0];//videos : 제목
		                		$title=$video[0];
	                			$link=$video[1];
	                			?>

	                				<li><span id="listlist">
														<a href=<?=$link?>><?=$title?></a>
													</span></li>


	                			<?php
	                		}
											?>

											</ul>
											</div>
											<?php
	                		//$thumbnail=$thumbnails[0];


											?>

										</div>
												<?php
	                	}
	                ?>


			</article>

			<footer id="footer">
				<a href="imyeonn@gmail.com" class="icon-mail"><span class="label">요청사항, 궁금한 점은 여기로!</span></a>
				<p>&copy; Hyeyeon. All rights reserved.</p>
			</footer>
		</div>
	</body>
</html>
