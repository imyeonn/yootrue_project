<!DOCTYPE html>
<html>
	<head>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90403003-2', 'auto');
  ga('send', 'pageview');

		</script>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>뷰투 Beautu</title>
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
					<div class="search">
						<form class="search-form" action="search.php" method="get">
							<input class="input" type="text" name="query" placeholder="제품을 검색하세요!">
							<input class="icon-search" type="image" src="images/search.jpg" value="">
						</form>
					</div>
				</span>
				<!-- 카테고리/플레이리스트 분류 -->
				<ul class="link">
					<li id="label-live"><a href="category.html" class="category"><span class="label">카테고리</span></a></li>
					<li><a href="playlist.php" class="playlist"><span class="label">플레이리스트</span></a></li>
				</ul>
			</header>

		<div class="blank"></div>

		<span id="category-depth">
			<a href="category.html"><div class="back"><img src="images/back.png" /></div></a>
			<div class="depths-box">

			<?php
				$query=$_GET['query'];
				$code= str_replace("'", '', $query);
			    if($code=='B0101'){
			?>
				<div class="depths">스킨케어 > 스킨,미스트</div>
			<?php
				;}else if ($code=='B0102'){
				?>
				<div class="depths">스킨케어 > 로션, 크림</div>
			<?php
				;}else if ($code=='B0103'){
			?>
			<div class="depths">스킨케어 > 에센스, 세럼, 오일</div>
			<?php
				;}else if ($code=='B0104'){
			?>
			<div class="depths">스킨케어 > 기타</div>

			<?php
				;}else if ($code=='B0201'){
			?>
			<div class="depths">베이스 메이크업 > 선케어</div>
			<?php
				;}else if ($code=='B0202'){
			?>
			<div class="depths">베이스 메이크업 > 베이스</div>
			<?php
				;}else if ($code=='B0203'){
			?>
			<div class="depths">베이스 메이크업 > 컨실러</div>
			<?php
				;}else if ($code=='B0204'){
			?>
			<div class="depths">베이스 메이크업 > 파운데이션</div>
			<?php
				;}else if ($code=='B0205'){
			?>
			<div class="depths">베이스 메이크업 > 파우더, 팩트</div>
			<?php
				;}else if ($code=='B0301'){
			?>
			<div class="depths">포인트 메이크업 > 아이브로우</div>
			<?php
				;}else if ($code=='B0302'){
			?>
			<div class="depths">포인트 메이크업 > 아이베이스, 섀도우</div>
			<?php
				;}else if ($code=='B0303'){
			?>
			<div class="depths">포인트 메이크업 > 아이라이너</div>
			<?php
				;}else if ($code=='B0304'){
			?>
			<div class="depths">포인트 메이크업 > 마스카라</div>
			<?php
				;}else if ($code=='B0305'){
			?>
			<div class="depths">포인트 메이크업 > 치크, 하이라이터, 섀딩</div>
			<?php
				;}else if ($code=='B0306'){
			?>
			<div class="depths">포인트 메이크업 > 립스틱</div>
			<?php
				;}else if ($code=='B0307'){
			?>
			<div class="depths">포인트 메이크업 > 립틴트, 리퀴드립</div>
			<?php
				;}else if ($code=='B0308'){
			?>
			<div class="depths">포인트 메이크업 > 립글로스</div>

			<?php
				;}?>
			</div>
		</span>

		<div class="blank"></div>

			<!-- 검색결과 표시 -->
			<div id="sorting">
				<form class="search-form" action="search.php" method="get">
					<select id="order" required="required" onchange="javascript:selectEvent(this,'<?=$_GET['query']?>')">
						<?php
							$sort=$_GET['order'];
							if($sort=="order"){
						?>
						<option value="sort">정렬</option>
						<option value="order" selected>가나다순</option>
						<option value="latest">최신순</option>
						<option value="popular">등장횟수순</option>
						<?php
							;}else if($sort=="latest"){
						?>
						<option value="sort" >정렬</option>
						<option value="order">가나다순</option>
						<option value="latest" selected>최신순</option>
						<option value="popular">등장횟수순</option>
						<?php
							;}else if($sort=="popular"){
						?>
						<option value="sort">정렬</option>
						<option value="order">가나다순</option>
						<option value="latest">최신순</option>
						<option value="popular" selected>등장횟수순</option>
						<?php
							;}else{
						?>
						<option value="sort" selected>정렬</option>
						<option value="order">가나다순</option>
						<option value="latest">최신순</option>
						<option value="popular">등장횟수순</option>
						<?php
							;}
						?>
					</select>
					<input type="hidden" name="order">
					<input type="hidden" name="query">
				</form>
			</div>
			<div class="blank"></div>

			<article id="searchresult">
					<!-- 제품리스트 출력 -->
					<?php
						include 'functions.php';
						$functions=new Functions();
						$query=$_GET['query'];
						$position = 0;
					    $arrays=$functions->searchCategory($query);
				        //var_dump($arrays);
			         	foreach($arrays as $array){
				          $productinfo = $array[0];
				          $productnames = $productinfo[0];
				          $productname = $productnames[0];
				          $productimage = $productnames[1];
				          $productlink = $productnames[2];
				          $productcount = $productnames[3];
     			?>
					<div class="productbox">
						<a href=<?=$productlink?>><span class="imagebox">
							<span class="imgbox">
								<img src=<?=$productimage?> onERROR="this.src='images/alt_productimage.png'"/>
							</span>
						</span></a>


						<div class="namename">
						<a href=<?=$productlink?>><h2 -ms-overflow-style: none;><?=$productname?></h2></a>
	           <ul>
							<li id="count"><span><?="$productcount"?>회 등장</span></li>
	             <li id="video" class = "show" name =<?="$position"?>><span>등장 영상 보기</span></li>
	           </ul>
					</div>

						<!-- 제품별 등장영상 출력 -->
						<?php
							$videosss = $array[1];
				            //print $videossss;
				            //print '<br>';
				            $videoss = $videosss[0];
				            //print $videosss;
				            //print '<br>';
				            $videos = $videoss[0];
						?>
						<div id="videolist" class = 'target wrapper2'>
							<ul class="icons">
								<?php
									foreach($videos as $video){
		              	//$videos=$array[2];
		                //$videos = $videoss[0];
		                //$video = $videos[0];//videos : 제목
		                $title=$video[0];
	                	$link=$video[1];
	                	$date=$video[2];
	              ?>

	              <li><a href=<?=$link?>><span id="listlist" class="list"><?=$date?> | <?=$title?></span></a></li>
									<?php
	                	}
	                	$position++;
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

			<div class="blank"></div>

			<div id="forline"></div>

			<footer id="footer">
				<a href="mailto:imyeonn@gmail.com" class="icon-mail"><span class="label">요청사항, 궁금한 점은 여기에 남겨주세요!</span></a>
				<p>by Beautu</p>
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
		 function selectEvent(selectObj,query){
		 	var input = document.getElementsByName('order')[0];
		 	var input2 = document.getElementsByName('query')[1];
		 	input.value=selectObj.value;
		 	input2.value=query;
		 	var link = "category.php?order="+selectObj.value+"&query="+query;
		 	location.href=link;
		 }


	 	</script>
	</body>
</html>
