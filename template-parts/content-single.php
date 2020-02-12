<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package divergent_Wordpress_theme
 */

?>

<div class="homePageBox">
    <div class="row">
        <article class="col-12 postContent" itemscope itemtype="http://schema.org/Article">
            <h1 class="text-center" itemprop="name">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h1>
            <div class="homePageBoxDesc">
                                <span itemprop="datePublished"
                                      content="{{ $post->created_at->toAtomString() }}"><?php the_time('d F Y'); ?></span> &middot;
                <?php the_category(', ') ?> &middot;
                <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span
                            itemprop="name"><?php the_author_posts_link(); ?></span></span>
            </div>
            <div class="addthis_inline_share_toolbox" style="margin-top:10px; margin-bottom: 10px; margin-left: -2px;"></div>
            <span itemprop="articleBody">
                                <?php the_content(); ?>
                                </span>
            <br>
            <?php if(has_tag()) : ?>
            <div class="homePageBoxDesc">
                Etiketler:
                <?php the_tags(', '); ?>
            </div>
            <?php endif; ?>
        </article>
    </div>
</div>
<div class="box">
    <h4 class="boxTitle">
        Belki ilginizi çeker?
    </h4>
    <style>
        .random-post img {
            max-width: 100%;
        }
    </style>
    <?php
    $args = array( 'numberposts' => 3, 'order'=> 'desc', 'orderby' => 'rand' );
    $goster_baskan = get_posts( $args );
    echo '<ul class="row random-posts">';
    foreach ($goster_baskan as $post) : setup_postdata($post); ?>
        <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12 random-post">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php divergent_post_thumbnail(0); ?>
                <br><?php the_title(); ?>
            </a>
        </li>
    <?php endforeach; echo '</ul>'; wp_reset_query(); ?>
</div>

