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
	$args          = array( 'numberposts' => 3, 'order' => 'desc', 'orderby' => 'rand' );
	$goster_baskan = get_posts( $args );
	echo '<ul class="row random-posts">';
	foreach ( $goster_baskan as $post ) : setup_postdata( $post ); ?>
        <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12 random-post">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php divergent_post_thumbnail( 0 ); ?>
                <br><?php the_title(); ?>
            </a>
        </li>
	<?php endforeach;
	echo '</ul>';
	wp_reset_query(); ?>
</div>
