<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package divergent_Wordpress_theme
 */

get_header();
?>

    <main id="Main">
        <div class="container">
            <div class="row">
                <section class="col-lg-8" id="Content">
					<?php divergent_breadcrumbs(); ?>
                    <h1 style="font-size:0.01em;text-indent:-9999px;margin:0;padding:0"><?php bloginfo( 'site_name' ); ?></h1>
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_type() );

						endwhile;
						echo '<nav>';
						divergent_pagination();
						echo '</nav>';
					else :
						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
                </section>
				<?php get_sidebar(); ?>
            </div>
        </div>
    </main>
<?php
get_footer();
