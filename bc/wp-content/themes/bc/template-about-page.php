<?php
//  Template Name: About Page Template
?>

<?php get_header(); ?>

<!-- Basic Package -->
<?php
$basic_package_image = get_field('basic_package_image');
$basic_package_description = get_field('basic_package_description');
$basic_package_rolls = get_field('basic_package_rolls');
$basic_package_nigris = get_field('basic_package_nigris');
$basic_package_price = get_field('basic_package_price');
?>

<!-- Standard Package -->
<?php
$standard_package_image = get_field('standard_package_image');
$standard_package_description = get_field('standard_package_description');
$standard_package_rolls = get_field('standard_package_rolls');
$standard_package_nigris = get_field('standard_package_nigris');
$standard_package_price = get_field('standard_package_price');
?>

<!-- Premium Package -->
<?php
$premium_package_image = get_field('premium_package_image');
$premium_package_description = get_field('premium_package_description');
$premium_package_rolls = get_field('premium_package_rolls');
$premium_package_nigris = get_field('premium_package_nigris');
$premium_package_price = get_field('premium_package_price');
?>

<!-- Custom Package -->
<?php
$custom_package_image = get_field('custom_package_image');
$custom_package_description = get_field('custom_package_description');
$custom_package_price = get_field('custom_package_price');
?>

<!-- Image Variables  -->
<?php
$top_banner = get_field('top_banner');
?>

<!-- Top Banner -->
<section class="section p100 m-p20 text-center" style="background-image: url('<?php echo $top_banner ?>')">
    <div class="container">
        <div class="row">
            <h1 class="text-white pt100 m-pt50 fw-600 lh1">About The Experience</h1>
            <a href="/book-now/" class="btn btn-md btn-color-2 mb50 mt20">Book Your Experience Now <i class="fas fa-angle-right ml5"></i></a>
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
                <h2 class="text-white ilb" style="vertical-align: -5px;">What's Included &amp; How It Works</h2>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mln mrn pn m-mb10 t-mb10">
                <a><span></span><span></span><span></span></a>
            </div>
        </div>
    </div>
</section>

<!-- About The Sushi Experience -->
<section class="section" style="background-image: url('/bc/wp-content/uploads/what-is-the-sushi-experience-bg-1.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 hidden-mobile hidden-tablet">
                    <div class="video-container mb40"><iframe src="https://www.youtube.com/embed/3yjMvWiIpjY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 m-mtn t-mtn">
                    <h2 class="text-white">What Is The Sushi Experience?</h2>
                    <p class="text-white">Looking for something unique, fun, and memorable for your next event? Sometimes you just need something extra to bring a birthday party, bachelor / bridal party, or any celebration to the next level without having to do extra work. Let The Sushi Experience cater your next event and get your guests interacting with sushi!</p>
                    <p class="text-white">The Sushi Experience is an all inclusive offering where we provide everything needed for an incredible sushi journey. Our chef will arrive at your event fully prepared with fresh fish, rice, sauces, plates, and more. </p>
                    <p class="text-white">Once he is setup, he will make sushi throughout the event and catering to your guest's needs. Guests can interact with the chef and watch the sushi being prepared, request custom rolls, and most importantly eat the rolls as they are completed!</p>
                    <p class="text-white">The chef will have clearly marked trays where the sushi will be displayed so all of your guests will know exactly which rolls they are enjoying. At the end of event the chef will clean everything up and leave all remaining completed sushi for you to enjoy for the rest of your event.</p>
                </div>
            </div>
        </div>
</section>

<!-- // How It Works -->
<?php echo do_shortcode ('[text-blocks id="how-it-works-mobile"]') ?>
<?php echo do_shortcode ('[text-blocks id="how-it-works-desktop"]') ?>

<!-- What's on The Menu -->
<section class="section pl40 pr40" style="background-image: url('/bc/wp-content/uploads/the-sushi-experience-contact-bg.jpg')">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="text-center text-color-2" id="package-menu"><strong>What's On The Menu?</strong></h2>
            <p class="text-center pt20 pb30">We have put together three unique packages of sushi at affordable price points to meet your event's needs. All of our sushi is made is of the highest quality, sushi grade fish that we bring to your event and make onsite. If you would like something custom, please look over our menu below and do not hesitate to contact us with any questions. </p> 
            <?php echo do_shortcode ('[text-blocks id="whats-included"]') ?>
            <div class="block-grid  block-grid-all-pop block-grid-xxs-1 block-grid-xs-1 block-grid-sm-2 block-grid-md-2 block-grid-lg-4 ">
                <div class="block-grid-item " style="opacity: 1; transform: scale(1);">
                    <a href="/book-now/">
                        <div class="bc-card match-height"><img src="<?php echo $basic_package_image ?>" class="img-responsive" alt="The Sushi Experience Basic Package">
                            <div class="content">
                                <div class="title-bg">
                                    <h3 class="title text-white">Basic</h3>
                                </div>
                                <p class="pt30 match-height-1"><?php echo $basic_package_description ?></p>
                                <p class="match-height-2"><b>Rolls: </b><?php echo $basic_package_rolls?></p>
                                <p class="match-height-3"><b>Nigris: </b><?php echo $basic_package_nigris ?></p>
                                <a href="/bc/wp-content/uploads/The-Sushi-Experience-Menu.pdf" class="pb30" target="_blank"><strong>View Printable Menu With Ingredients</strong><i class="fas fa-angle-double-right ml10"></i></a>
                                <p class="mt10 fixed-price"><b>Price: </b><?php echo $basic_package_price ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="block-grid-item " style="opacity: 1; transform: scale(1);">
                    <a href="/book-now/">
                        <div class="bc-card match-height"><img src="<?php echo $standard_package_image ?>" class="img-responsive" alt="The Sushi Experience Standard Package">
                            <div class="content">
                                <div class="title-bg">
                                    <h3 class="title text-white">Standard</h3>
                                </div>
                                <p class="pt30 match-height-1"><?php echo $standard_package_description ?></p>
                                <p class="match-height-2"><strong>Rolls: </strong><?php echo $standard_package_rolls?></p>
                                <p class="match-height-3"><strong>Nigris: </strong><?php echo $standard_package_nigris ?></p>
                                <a href="/bc/wp-content/uploads/The-Sushi-Experience-Menu.pdf" target="_blank"><strong>View Printable Menu With Ingredients</strong><i class="fas fa-angle-double-right ml10"></i></a>
                                <p class="mt10 fixed-price"><strong>Price: </strong><?php echo $standard_package_price ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="block-grid-item " style="opacity: 1; transform: scale(1);">
                    <a href="/book-now/">
                        <div class="bc-card match-height"><img src="<?php echo $premium_package_image ?>" class="img-responsive" alt="The Sushi Experience Premium Package">
                            <div class="content">
                                <div class="title-bg">
                                    <h3 class="title text-white">Premium</h3>
                                </div>
                                <p class="pt30 match-height-1"><?php echo $premium_package_description ?></p>
                                <p class="match-height-2"><strong>Rolls: </strong><?php echo $premium_package_rolls?></p>
                                <p class="match-height-3"><strong>Nigris: </strong><?php echo $premium_package_nigris ?></p>
                                <a href="/bc/wp-content/uploads/The-Sushi-Experience-Menu.pdf" target="_blank"><strong>View Printable Menu With Ingredients</strong><i class="fas fa-angle-double-right ml10"></i></a>
                                <p class="mt10 fixed-price"><strong>Price: </strong><?php echo $premium_package_price ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="block-grid-item " style="opacity: 1; transform: scale(1);">
                    <a href="/book-now/">
                        <div class="bc-card match-height"><img src="<?php echo $custom_package_image ?>" class="img-responsive" alt="The Sushi Experience Custom Package">
                            <div class="content">
                                <div class="title-bg">
                                    <h3 class="title text-white">Custom</h3>
                                </div>
                                <p class="pt30 match-height-1"><?php echo $custom_package_description ?></p>
                                <a href="/bc/wp-content/uploads/The-Sushi-Experience-Menu.pdf" target="_blank"><strong>View Printable Menu With Ingredients</strong><i class="fas fa-angle-double-right ml10"></i></a>
                                <p class="mt10 fixed-price"><strong>Price: </strong><?php echo $custom_package_price ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <a href="/book-now/">
                <h2 class="text-center text-color-2 pt30">Ready to Get Started?</h4>
                <div class="text-center">
                    <a href="/book-now/" class="btn btn-md btn-color-2">Create Your Own Sushi Experience <i class="fas fa-angle-right ml5"></i></a>
                </div>
            </a>
        </div>
    </div>
</section>
<!-- Image Gallery -->
<?php echo do_shortcode ('[gallery thumbnail="large" gutter="none" lightbox="services-photo" xxs="2" xs="2" sm="4" md="4" lg="4"]') ?>

<!-- Bottom Contact Form -->
<?php echo do_shortcode ('[text-blocks id="bottom-cta-2"]') ?>

<?php get_footer(); ?>

