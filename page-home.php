<?php
/**
* Template Name: Homepage
*/

get_header();
?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>

	<?php get_template_part( 'template-parts/content', 'page' ); ?>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>

<?php endwhile; ?>

<?php
get_sidebar();
get_footer();
