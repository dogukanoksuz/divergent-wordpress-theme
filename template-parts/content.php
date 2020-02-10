<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package divergent_Wordpress_theme
 */

?>

<article class="homePageBox" itemscope itemtype="http://schema.org/Article">
    <div class="row">
        <div class="col-sm-5 mb-md-4 mb-sm-4 mb-4">
            <?php divergent_post_thumbnail(); ?>
        </div>
        <div class="col-sm-7">
            <?php
            if (is_singular()) :
                the_title('<h2 itemprop="name">', '</h2>');
            else :
                the_title('<h2 itemprop="name"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
            endif; ?>
            <p itemprop="articleBody"><?php divergent_excerpt(230) ?></p>
        </div>
        <div class="col-12">
            <div class="homePageBoxDesc">
                <span itemprop="datePublished"
                      content="{{ $post->created_at->toAtomString() }}"><?php the_time('d F Y'); ?></span> &middot;
                <?php the_category(', ') ?> &middot;
                <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span
                            itemprop="name"><?php the_author_posts_link(); ?></span></span>
            </div>
        </div>
    </div>
</article>
