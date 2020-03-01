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
                                      content="<?php the_time( 'd F Y' ); ?>"><?php the_time( 'd F Y' ); ?></span>
                &middot;
				<?php the_category( ', ' ) ?> &middot;
                <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span
                            itemprop="name"><?php the_author_posts_link(); ?></span></span>
            </div>
            <span itemprop="articleBody">
                                <?php the_content(); ?>
                                </span>
            <br>
			<?php if ( has_tag() ) : ?>
                <div class="homePageBoxDesc">
                    Etiketler:
					<?php the_tags( '', ', ' ); ?>
                </div>
			<?php endif; ?>
        </article>
    </div>
</div>
