<?php
//  Template Name: Meet The Chef Template
?>

<!-- Image Variables  -->
<?php
$chef_image = get_field('chef_image');
?>

<?php get_header(); ?>

<!-- Top Video Banner -->
<section class="section tall-banner" data-vide-bg="mp4:/bc/wp-content/uploads/Vu-Tracking_2_1.mp4, ogv:/bc/wp-content/uploads/Vu-Tracking_2_1.mp4">
    <div class="row">
        <h1 class="text-center text-white d-p100">Meet The Chef</h1>
    </div>
</section>


<!-- About Chef Content -->
<section class="section" style="background-image: url('/bc/wp-content/uploads/meet-chef-vu-bg.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 hidden-mobile hidden-tablet">
                <img src="<?php echo $chef_image ?>" alt="The Sushi Experience" class="img-responsive"/>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                <h2 class="text-white">Where Excellence Meets Experience</h2>
                <p class="text-white about-titles">Meet Chef Vu</p>
                <p class="text-white">Vu comes from a cooking inspired Vietnamese culture where he grew up watching his family make all of the best Vietnamese dishes and sushi from scratch. Vu is one of the most personal chefs you have met and will easily fit into any event or party. He will ensure your event is a hit with your guest and will accommodate any special requests that your guests may have.  </p>
                <p class="text-white about-titles">Experience</p>
                <p class="text-white">Chef Vu was inspired at a young age watching culinary artists demonstrate their talents on shows like The Iron Chef. He knew he always wanted to be in the culinary field, and began his training in Pan Asian Cuisine during high school. Under numerous head chefs, he practiced traditional Asian cuisine but fell in-love with the art of sushi. Mastering the basics, and continuing to learn new concepts, he has honed his skills to a level that will create a delicious and fun experience. </p>
                <p class="text-white about-titles">Favorite Things</p>
                <p class="text-white mtn">Today, Vu loves spending time with his wife and daughter while traveling and exploring international cuisine. He enjoys his career as a firefighter paramedic, where he serves the community as a dedicated first responder. When he is not at the station, he is creating memorable Sushi Experiences at events all around South Florida.</p>
            </div>
        </div>
    </div>
</section>

<!-- Bottom CTA -->
<section class="section" style="background-image: url('/bc/wp-content/uploads/meet-the-chef-book-now-cta.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-center text-white">Want To Meet the Chef in Person?</h2>
                <p class="text-center"><a href="/book-now/" class="btn btn-md btn-color-white-ghost mt20">Book Now <i class="fas fa-angle-right ml5"></i></a></p>
            </div>
        </div>
    </div>
</section>

<!-- Image Gallery -->
<?php echo do_shortcode ('[gallery thumbnail="large" gutter="none" lightbox="services-photo" xxs="2" xs="2" sm="4" md="4" lg="4"]') ?>

<!-- Bottom Contact Form -->
<?php echo do_shortcode ('[text-blocks id="bottom-cta-2"]') ?>

<?php get_footer(); ?>