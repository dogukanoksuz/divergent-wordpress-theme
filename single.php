<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package divergent_Wordpress_theme
 */

get_header();
?>

    <main id="Main">
        <div class="container">
            <div class="row">
                <section class="col-lg-8" id="Content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                            <?php divergent_breadcrumbs(); ?>
                        </ol>
                    </nav>
                    <?php
                    while (have_posts()) :
                        the_post();

                        get_template_part('template-parts/content-single', get_post_type());

                        the_post_navigation();

                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>
                </section>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </main>

<?php
get_footer();
