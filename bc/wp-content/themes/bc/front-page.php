<?php
//	Template Name: Front Page Template
?>

<?php get_header(); ?>

<!-- Image Variables  -->
<?php
$top_banner = get_field('top_banner');
$middle_banner = get_field('middle_banner');
$bottom_banner = get_field('bottom_banner');
?>

<!-- Top Banner -->
<section class="nav-clear-point home-banner section" style="background-image: url('<?php echo $top_banner ?>')">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="home-banner-content text-center">
					<h1 class="text-white fw-400">THE SUSHI <strong>E<span class="ml40">PERIENCE</span></strong></h1>
					<h2 class="text-white">FRESH. INTERACTIVE. DELICIOUS</h2>
					<a href="/book-now/" class="btn btn-md btn-color-2 mt20">Book Your Experience Now <i class="fas fa-angle-right ml5"></i></a>
					<img src="/bc/wp-content/uploads/chopsticks.png" alt="The Sushi Experience" class="img-responsive"/>
				</div>
				<img src="/bc/wp-content/uploads/the-sushi-experience-mobile-logo.png" alt="The Sushi Experience" class="hidden-tablet hidden-desktop img-responsive"/>
				<a href="#" class="btn btn-md btn-color-2 mt20 mb30 hidden-desktop hidden-tablet">Book Your Experience Now <i class="fas fa-angle-right"></i></a>
			</div>
		</div>
	</div>
</section>

<!-- Bottom Callout -->
<section class="section pt30 m-pt10 pb20" id="top-cta-arrows" style="background-image: url('/bc/wp-content/uploads/book-now-sushi-experience-never-forget-bg.jpg');">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mln mrn pn hidden-mobile hidden-tablet">
				<a><span></span><span></span><span></span></a>	
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center mln mrn pn mtn m-p15">
				<h2 class="text-white ilb" style="vertical-align: -5px;">Learn More About The Sushi Experience</h2>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mln mrn pn m-mb10 t-mb10">
				<a><span></span><span></span><span></span></a>
			</div>
		</div>
	</div>
</section>

<!-- Middle Banner -->
<section class="section section-slant-bottom" style="background-image: url('<?php echo $middle_banner ?>');">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<h2 class="text-white">What Is The Sushi Experience?</h2>
				<p class="text-white">A unique service where a private chef creates fresh sushi rolls and appetizers at your house or event. The chef and his creations are the center of the event as your guests interact and watch how sushi is hand crafted for all to enjoy. </p>
				<a href="/about-the-experience/" class="btn btn-md btn-color-white-ghost mt20">Learn More <i class="fas fa-angle-right ml5"></i></a>
			</div>	
		</div>
	</div>
</section>

<section class="section ptn pb90" style="background-image: url('/bc/wp-content/uploads/never-before-sushi-experience-bg.jpg'); z-index: 1;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="video-callout-box">
					<h2 class="mb5 text-white">Are You Ready To Experience Sushi Like Never Before?</h2>
					<p class="mb30 mt30 text-white">Watch the video to see how The Sushi Experience can transform your next party or event to something that your guests won't soon forget. </p>
					<a href="/about-the-experience/" class="btn btn-md btn-color-white-ghost">Learn More <i class="fas fa-angle-right ml5"></i></a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="video-container"><iframe src="https://www.youtube.com/embed/3yjMvWiIpjY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Bottom Banner -->
<section class="section home-meet-chef-section" style="background-image: url('<?php echo $bottom_banner ?>');">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<h2 class="text-white">Meet Our Chef</h2>
				<p class="text-white">A great sushi chef has a great story. Learn more about Chef Vu and what his skills can bring to your next event. His personality and knowledge will get even non sushi lovers talking about sushi! </p>
				<a href="/meet-the-chef/" class="btn btn-md btn-color-white-ghost mt20">Read The Whole Story <i class="fas fa-angle-right ml5"></i></a>
			</div>
		</div>
	</div>
</section>

<!-- Bottom Contact Form -->
<?php echo do_shortcode ('[text-blocks id="bottom-cta-2"]') ?>

<?php get_footer(); ?>
