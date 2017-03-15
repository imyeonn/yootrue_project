<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>beautu</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no"/>
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="fontello/css/fontello.css">
	</head>
	<body>
		<div id="wrapper">
			<header id="header">
				<!-- 프로필사진 -->
				<span class="profile">
					<a href="category.html"><img src="images/profile.jpg" alt="{{ site.url  }}/category" /></a>
					<!-- 검색창 -->
					<div id="search">
						<form class="search-form" action="search.php" method="get">
							<input class="input" type="text" name="query" placeholder="제품을 검색하세요!">
							<input class="icon-search" type="image" src="images/search.jpg" value="">
						</form>
					</div>
				</span>
				<!-- 카테고리/플레이리스트 분류 -->
				<ul class="link">
					<li><a href="category.html" class="category"><span class="label">카테고리</span></a></li>
					<li><a href="playlist.php" class="playlist"><span class="label">플레이리스트</span></a></li>
				</ul>
			</header>

			<div class="blank">
			</div>

			<!-- 정렬방식 설정 -->
			<div id="sorting">
				<form class="search-form" action="playlist.php" method="get">
					<select id="order" required="required" onchange="javascript:selectEvent(this)">
						<?php
							$sort=$_GET['order'];
							if($sort=="order"){
						?>
						<option value="sort">정렬</option>
						<option value="order" selected>가나다순</option>
						<option value="latest">최신순</option>
						<?php
							;}else if ($sort=="latest"){

							 ?>
						<option value="sort" >정렬</option>
						<option value="order">가나다순</option>
						<option value="latest" selected>최신순</option>
						<?php
							;}else{
							?>
						<option value="sort" selected>정렬</option>
						<option value="order">가나다순</option>
						<option value="latest">최신순</option>
							<?php	
							;}
							?>
							
					</select>
					<input type="hidden" name="order">
				</form>
			</div>

			<div class="blank">
			</div>

			<!-- 플레이리스트 표시 -->
			<article id="playlist">
				<?php
					include 'functions.php';
						$functions=new Functions();
						$query=$_GET['query'];
						$arrays=$functions->loadVideo();
						//var_dump($arrays);
						$position=0;
						foreach($arrays as $array){
							$videoinfos = $array[0];
							$videoinfo = $videoinfos[0];
							$title = $videoinfo[0];
							$thumbnail = $videoinfo[1];
							$date = $videoinfo[2];
							$min = $videoinfo[3];
							$sec = $videoinfo[4];
							$link = $videoinfo[5];
				?>
				<div class="playbox">
					<a href=<?=$link?>><span class="thumbnail"><img src=<?=$thumbnail?> alt="videoimage"/></span></a>
					<div class="namename">
						<a href=<?=$link?>><h2><?=$title?></h2></a>
						<ul>
							<li id="date"><span><?=$date?></span></li>
							<li id="runtime"><span><?=$min?>:<?=$sec?></span></li>
						</ul>
						<ul>
							<li id="product"><span class="show" name =<?="$position"?>>제품 목록</span></li>
						</ul>
					</div>

					<!-- 제품목록 출력 -->
					<div id="productlist" class = 'target wrapper2'>
						<ul class="icons">
					<?php
						$productss = $array[1];
						$products = $productss[0];
						foreach($products as $product){
							$productname = $product[0];
							$productlink = $product[1];
					?>

					<li><a href=<?=$productlink?>><span id="listlist" class="list"><?=$productname?></span></a></li>
						<?php
							}
						?>
							</ul>
						</div>
					</div>
					<?php
						$position++;
						}
					?>
					</ul>
				</div>
			</article>

			<div id="forline">
			</div>

			<footer id="footer">
				<a href="imyeonn@gmail.com" class="icon-mail"><span class="label">요청사항, 궁금한 점은 여기에 남겨주세요!</span></a>
				<p>&copy; Beautu. All rights reserved.</p>
			</footer>
		</div>

	<script type="text/javascript">

		 var spans = document.getElementsByClassName('show');
		 for(var i =0;i<spans.length;i++){
		 	var position = spans[i].getAttribute('name');
		 	//alert("position : "+position);
		 	//spans[i].addEventListener('click',function(){changevisible(position)});
		 	var query = "spans["+i+"].addEventListener('click', function(){changevisible("+position+");}, false)";
		 	eval(query);

		 }
		 function changevisible(position){
		  var wrappers=document.getElementsByClassName('target');
		  if (wrappers[position].className=="target wrapper2"){
		    wrappers[position].className="target wrapper1";
		  }
		  else if(wrappers[position].className=="target wrapper1"){
		    wrappers[position].className="target wrapper2";
		  }
		 }
		 function selectEvent(selectObj){
		 	var input = document.getElementsByName('order')[0];
		 	input.value=selectObj.value;
		 	var link = "playlist.php?order="+selectObj.value;
		 	location.href=link;
		 }
	 	</script>
	</body>
</html>
