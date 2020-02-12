<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package divergent_Wordpress_theme
 */

?>

<article class="homePageBox">
    <div class="row">
        <div class="col-12 postContent">
            <h1 class="text-center">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h1>
            <div class="homePageBoxDesc">
                <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span
                            itemprop="name"><?php the_author_posts_link(); ?></span></span> tarafından yayınlanmıştır.
            </div>

            <br>
            <?php the_content(); ?>
    </div>
</article>
