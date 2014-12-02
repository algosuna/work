<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Johnnie Walker</title>
	<link href='http://fonts.googleapis.com/css?family=Montserrat|Oswald:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bxslider.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header>
		<div class="container">
			<img src="images/opentable.png" alt="OPENTABLE" width="204" height="40" class="logo">
			<p>Restaurant Reservations &ndash; Free &bull; Instant &bull; Confirmed</p>
			<img src="images/johnnie-walker-logo.png" width="206" height="63" alt="Johnnie Walker" class="sponsor-logo">
		</div><!-- end container -->
	</header>
	<div class="container">
		<section class="banner">
			<img src="images/article-bottle.png" width="161" height="364" alt="Bottle " class="bottle">
			<div class="content">
				<h3>A NIGHT OUT <span>ON THE TOWN</span></h3>
				<p>HOTSPOT IN</p>
				<h2>NEW YORK</h2>
				<ul class="cities">
					<li>New York</li>
					<li>New York</li>
					<li>New York</li>
					<li>New York</li>
					<li>New York</li>
					<li>New York</li>
				</ul>
			</div><!--end content -->
			<ul class="social">
				<li><a href=""><img src="images/twitter.png" alt="facebook"></a></li>
				<li><a href=""><img src="images/instagram.png" alt="instagram"></a></li>
				<li><a href=""><img src="images/youtube.png" alt="youtube"></a></li>
				<li><a href=""><img src="images/facebook.png" alt="facebook"></a></li>
			</ul><!--end .social -->
		</section><!--end banner-->
		<section class="main group">
			<div class="content">
				<a href="" class="backto">BACK TO MAIN PAGE</a>
				<div class="post group">
					<h1>BATHTUB GIN</h1>
					<div class="meta">
						<h6>Cuisine</h6>
						<p>Bar / Lounge</p>
						<h6 class="highlight">Dining Style</h6>
						<p>Casual Dining</p>
						</ul>
					</div><!--end meta-->
					<div class="text">
						<h6>Overview</h6>
						<p>Gin was the predominant drink in the USA during the prohibition era 1920's and many variations were created. "baththub gin" was developed in response to the poor-quality of alcohol that was available at the time</p>
					</div><!--end text-->
					<div class="address">
						<h6>Address</h6>
						<p>132 9th Avenue New York, NY 10011</p>
						<a href="">FIND A TABLE</a>
					</div><!--end address-->
				</div><!--end post-->
				<div class="post group">
					<h1>BRASSERIE COGNAC EAST</h1>
					<div class="meta">
						<h6>Cuisine</h6>
						<p>Tapas</p>
						<h6 class="highlight">Dining Style</h6>
						<p>Casual Elegant</p>
						</ul>
					</div><!--end meta-->
					<div class="text">
						<h6>Overview</h6>
						<p>Restauranteurs Vittorio Assaf and Fabio Granato brought their love for French culture and cuisine to New York City by giving the Big Apple an authentic slice of France when they opened in April 2008. The Brasserie style menu</p>
					</div><!--end text-->
					<div class="address">
						<h6>Address</h6>
						<p>963 Lexington Ave. New York, NY 10021</p>
						<a href="">FIND A TABLE</a>
					</div><!--end address-->
				</div><!--end post-->
			</div><!--end content-->
			<aside class="sidebar">
				<div class="box-ad">
					<img src="images/goldlabel.jpg" width="300" height="250" title="Gold Label">
				</div>
				<div class="recipe-slider">
					<h3>JOHNNIE WALKER RECIPES</h3>
					<p>Video Tutorials</p>
					<ul class="bxslider">
					  <li><img src="images/slider/slide-1.jpg" width="300" height="178" title="The Perfect Serve"></li>
					  <li><img src="images/slider/slide-2.jpg" width="300" height="178" title="The Perfect Serve2"></li>
					  <li><img src="images/slider/slide-3.jpg" width="300" height="178" title="The Perfect Serve3"></li>
					</ul>
					<span id="slider-prev"></span>
					<span id="slider-next"></span>
					<div class="foot">
						<a href="">explore more recipes</a>
					</div><!--end foot -->
				</div><!--end recipe-slider-->
				<div class="social-widget">
					<ul>
						<li><a href=""><img src="images/social-facebook.png" width="29" height="20" alt="facebook"></a></li>
						<li><a href=""><img src="images/social-twitter.png" width="29" height="20" alt="twitter"></a></li>
						<li><a href=""><img src="images/social-email.png" width="29" height="20" alt="email"></a></li>
					</ul>
				</div><!--end social-widget-->
				<div class="recipe-list">
					<h6>DOWNLOAD RECIPES</h6>
					<h3>COCKTAILS</h3>
					<div class="recipe">
						<img src="images/recipe-oldFashion.jpg" alt="OLD FASHIONED">
						<p>Two classics, together at last.</p>
						<img src="images/pdf-icon.gif" width="16" height="16" alt="" class="pdf">
					</div><!--end recipe-->
					<div class="foot">
						<a href="">SEE ALL RECIPES</a>
					</div><!-- end foot -->
				</div><!--end recipe-list -->
			</aside><!--end aside -->
		</section><!--end main -->
	</div><!--end container-->
	<script src="js/jquery.js"></script>
	<script src="js/jquery.bxslider.min.js"></script>
	<script>
		$('.bxslider').bxSlider({
		  nextSelector: '#slider-next',
		  prevSelector: '#slider-prev',
		  nextText: '<img src="images/right-arrow.png" alt="Next" width="13" height="21">',
		  prevText: '<img src="images/left-arrow.png" alt="Previous" width="13" height="21">',
		  captions: true
		});
		$(".banner .content h2").click(function(){
			$(".cities").toggle();
		})
	</script>
</body>
</html>