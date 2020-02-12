<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
                    <!--<nav aria-label="breadcrumb">
                        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                            <?php /*divergent_breadcrumbs(); */?>
                        </ol>
                    </nav>-->
                    <h1 style="font-size:0.01em;text-indent:-9999px;margin:0;padding:0"><?php bloginfo('site_name'); ?></h1>
                    <?php
                    if (have_posts()) :
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();
                            /*
                             * Include the Post-Type-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                             */
                            get_template_part('template-parts/content', get_post_type());

                        endwhile;
                        echo '<nav>';
                        divergent_pagination();
                        echo '</nav>';
                    else :
                        get_template_part('template-parts/content', 'none');

                    endif;
                    ?>
                </section>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </main>
<?php
get_footer();
