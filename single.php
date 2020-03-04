<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wtp
 */

get_header();
?>

<?php while ( have_posts() ) : ?>

	<?php the_post(); ?>

	<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

	<?php the_post_navigation(); ?>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>

<?php endwhile; ?>

<?php
get_sidebar();
get_footer();
