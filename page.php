<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wtp
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
