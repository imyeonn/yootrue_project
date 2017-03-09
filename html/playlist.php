<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>카테고리</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no"/>
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

			<div class="blank">
			</div>

			<div>
				<p>정렬</p>
			</div>

			<!-- 플레이리스트 표시 -->
			<article id="playlist">
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
				<div class="playbox">
					<span class="thumbnail"><img src=<?=$thumbnail?> alt="videoimage"/></span>
					<div class="namename">
						<h2><?=$title?></h2>
						<ul>
							<li id="date"><span><?=$date?></span></li>
							<li id="runtime"><span><?=$min?>:<?=$sec?></span></li>
						</ul>
						<ul>
							<li id="product"><span>제품 목록</span></li>
						</ul>
					</div>

					<!-- 제품목록 출력 -->
					<?php
						$productss = $array[1];

						$products = $productss[0];
						foreach($products as $product){
							$productname = $product[0];
							$productlink = $product[1];
					?>

					<!-- 자바스크립트 추가부분 -->
					<p>
						<a href=<?=$productlink?>><?=$productname?> </a>
					</p>
				<?php
				}
			}
		?>
				</div>

			</article>
			<footer id="footer">
				<a href="imyeonn@gmail.com" class="icon-mail"><span class="label">요청사항, 궁금한 점은 여기에 남겨주세요!</span></a>
				<p>&copy; Hyeyeon. All rights reserved.</p>
			</footer>
	</div>
	</body>
</html>
