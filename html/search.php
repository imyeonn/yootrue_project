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
		<title>카테고리</title>
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
							<?php
								if(isset($_GET['query'])){
							?>
							<input class="input" type="text" name="query" placeholder="<?=$_GET['query']?>">
							<?php
								;}else{
									?>

							<input class="input" type="text" name="query" placeholder="제품을 검색하세요!">
							<?php
							;}
							?>
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

			<div id="sorting">
				<form class="search-form" action="search.php" method="get">
					<select id="order" required="required" onchange="javascript:selectEvent(this,'<?=$_GET['query']?>')">
						<option value="sort" selected>정렬</option>
						<option value="order">가나다순</option>
						<option value="latest">최신순</option>
					</select>
					<input type="hidden" name="order">
					<input type="hidden" name="query">
				</form>
			</div>

			<div class="blank">
			</div>

			<!-- 검색결과 표시 -->
			<article id="searchresult">
					<!-- 제품리스트 출력 -->
					<?php
						include 'functions.php';
						$functions=new Functions();
				        $query=$_GET['query'];
				        $position = 0;
			      		if ($query==""){
			      			print "찾는 제품이 없습니다.";
			      		}
			      		else{
				        //var_dump($arrays);
			      			$arrays=$functions->searchProducts($query);
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

	              <li><a href=<?=$link?>><span id="listlist" class"list"><?=$date?> | <?=$title?></span></a></li>
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
	       	}
	      ?>
			</article>

			<div class="blank"></div>

			<div id="forline">
			</div>

			<footer id="footer">
				<a href="mailto:imyeonn@gmail.com" class="icon-mail"><span class="label">요청사항, 궁금한 점은 여기에 남겨주세요!</span></a>
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
		 function selectEvent(selectObj,query){
		 	var input = document.getElementsByName('order')[0];
		 	var input2 = document.getElementsByName('query')[1];
		 	input.value=selectObj.value;
		 	input2.value=query;
		 	//alert("order = " +input.value + " query = " + input2.value);
		 	//var url= "./View.do?jubsu_date="+jubsu_date+"&jindan_name="+encodeURI(encodeURIComponent(jindan_name));

		 	var link = "search.php?order="+selectObj.value+"&query="+query;
		 	var query1 = encodeURIComponent(query);
		 	var link = "search.php?order="+selectObj.value+"&query="+query1;

		 	location.href=link;


		 }


	 	</script>
	</body>
</html>
