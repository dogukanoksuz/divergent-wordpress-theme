<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package divergent_Wordpress_theme
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!--
        .___                   __                          __
      __| _/____   ____  __ __|  | _______    ____   ____ |  | __  ________ __________
     / __ |/  _ \ / ___\|  |  \  |/ /\__  \  /    \ /  _ \|  |/ / /  ___/  |  \___   /
    / /_/ (  <_> ) /_/  >  |  /    <  / __ \|   |  (  <_> )    <  \___ \|  |  //    /
    \____ |\____/\___  /|____/|__|_ \(____  /___|  /\____/|__|_ \/____  >____//_____ \
         \/     /_____/            \/     \/     \/            \/     \/            \/

                            by dogukanoksuz // theme divergent SEO
                                   https://dogukan.dev
     -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <link rel="canonical" href="<?php bloginfo( 'siteurl' ); ?>">

	<?php wp_head();
	$divergent_options = get_option( 'divergent' );
	echo $divergent_options['head-tags']; ?>
</head>
<body <?php body_class(); ?>>
<header id="Header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <section class="brand">
                    <a href="<?php bloginfo( 'siteurl' ); ?>">
                        <div class="logo">
                            <img src="<?php echo $divergent_options['logo']['url']; ?>" alt="<?php bloginfo( 'title' ); ?>">
                        </div>
                    </a>
                </section>
                <nav class="headerNav">
                    <ul itemtype="https://schema.org/SiteNavigationElement" role="menu">
						<?php divergent_header_menu( 'menu-1' ); ?>
                        <li class="mobile-menu d-lg-none d-md-block"><a href="#"><i class="fas fa-ellipsis-h"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="drawer">
        <div class="drawerHeader clearfix">
            <a href="#" class="drawerHeader__logo">
                <div class="logo" style="float:left;">
                    <img src="<?php echo $divergent_options['logo']['url']; ?>" alt="<?php bloginfo( 'title' ); ?>">
                </div>
            </a>
            <div class="drawerClose"><i class="fas fa-chevron-left"></i></div>
        </div>
        <ul class="drawerMenu">
			<?php divergent_mobile_menu( 'menu-1' ); ?>
        </ul>
    </div>
</header>

<div class="marginSeperator"></div>
