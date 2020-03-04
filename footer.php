<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wtp
 */

?>

</main><!-- #content -->

<footer class="footer  padding-top  padding-bottom">
    <div class="footer__content  lc  lc--padding  ">
    	<div class="footer__item">
    		&copy;2020 - <?php bloginfo( 'name' ); ?>
    	</div>

    	<?php if ( has_nav_menu('menu-2') ) : ?>
            <div class="footer__item">
                <?php wp_nav_menu( array(
                    'theme_location' => 'menu-2',
                    'depth'          => 1,
                    'menu_class'     => 'nav  nav--footer',
                    'container'      => false,
                    'walker'         => new Le_Walker_Nav_Menu(),
                ) ); ?>
            </div>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>