<?php

/*
* Default Single Page Template
*/

?>

<?php get_header(); ?>
<?php echo do_shortcode('[page_banner title="' . 'Blog' . '"]'); ?>
<section class="section">
	<div class="container">
		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<h2><?php echo get_the_title(); ?></h2>
				<?php
					if ( have_posts() ) :
						while (have_posts()) : the_post();
					  the_content();
					  endwhile;
					endif;
				?>
				<h4 class="mb5 mt20">Share This Post:</h4>
        		<?php echo do_shortcode('[share_links size="md"]'); ?>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<?php echo do_shortcode('[address_loop class="sidebar-schema" hours="true"]'); ?>
				<?php echo do_shortcode('[hr type="blank"]'); ?>
				<?php echo do_shortcode('[contact-form-7 id="1221" title="Sidebar Contact Form"]');?>
			</div>

		</div>
	</div>
</section>
<?php get_footer(); ?>
