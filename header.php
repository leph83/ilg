<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wtp
 */

    $wtp_description = get_bloginfo( 'description', 'display' );
    $mainclass = 'transition-fade';
    if (is_user_logged_in()) {
        $mainclass = '';
    }

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <style>
        <?php //include(dirname(__FILE__).'/css/style.min.css'); ?>
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class('body  body--sticky-footer'); ?>>

    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wtp' ); ?></a>

    <input class="burger__input  hidden" type="checkbox" id="burger">

    <header class="header">
        <div class="header__content  lc  lc--2  lc--padding">

            <!-- Branding -->
            <div class="header__item  header__item--logo">

                <?php if (has_custom_logo()) : ?>
                    <?php // set image size of logo to halve of its actual size, retina for all ?>
                    <?php 
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $logo_src = wp_get_attachment_image_src( $custom_logo_id , 'medium' );
                    ?>

                    <a class="header__logolink  display--inline-block" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <img 
                            class="header__logo"
                            src="<?php echo esc_url( $logo_src[0] ); ?>" 
                            width="<?php echo floor($logo_src[1]/2); ?>" 
                            height="<?php echo floor($logo_src[2]/2); ?>" 
                            alt="<?php echo get_bloginfo( 'name' ) ; ?>"
                        >
                    </a>

                <?php endif; ?>


                <?php if ( display_header_text() ) : ?>
                    <?php if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif; ?>

                    <?php if ( $wtp_description || is_customize_preview() ) : ?>
                        <p class="site-description"> - 
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php echo $wtp_description; /* WPCS: xss ok. */ ?>
                        </a>
                        </p>
                    <?php endif; ?>

                <?php endif; ?>

            </div><!-- .site-branding -->

            <div class="header__item  header__item--nav">
                <?php if ( has_nav_menu('menu-1') ) : ?>
                    <!-- primary navigation -->
                    <nav class="main-navigation  h6">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'menu-1',
                                'menu_class'     => 'nav  nav--primary  ',
                                'container'      => false,
                                'walker'         => new Le_Walker_Nav_Menu(),
                            ) );
                        ?>
                    </nav><!-- #site-navigation -->
                <?php endif; ?>
            </div>

             <!-- hamburger -->
             <label for="burger" class="burger__label  burger__label--cross  hide--tablett">
                <span class="burger__lines">
                    <span class="burger__line"></span>
                    <span class="burger__line"></span>
                    <span class="burger__line"></span>
                </span>
             </label>

        </div>
    </header><!-- #masthead -->

    <main id="content" class="main  <?php echo $mainclass; ?>">

