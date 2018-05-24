<?php get_header(); ?>
<section class="section">
  <div class="container">
    <div class="row">

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <h2 class="text-color-1">Displaying Search Results For: <span class="text-color-2" style="text-decoration: underline"><?php echo $_GET["s"]; ?></span> </h2>
        <?php if ( have_posts() ) : ?>
          <ul class="list-unstyled">
					 <?php while (have_posts()) : the_post(); ?>
             <li class="mbxl">
               <h4 class="mbn"><a class="link-color-2" href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
               <p class="mbn"><a class="link-color-1" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_permalink(); ?></a></p>
               <p><?php the_excerpt(); ?></p>
             </li>
				   <?php endwhile; ?>
         </ul>
				<?php endif; ?>

      </div>

    </div>
  </div>
</section>
<?php get_footer(); ?>
