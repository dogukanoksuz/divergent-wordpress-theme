<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package divergent_Wordpress_theme
 */

function divergent_header_menu( string $menu_id ): void {
	foreach ( wp_get_nav_menu_items( $menu_id ) as $item ) {
		printf( '<li itemprop="name" role="menuitem" class="d-lg-block d-none"><a itemprop="url" href="%2$s" title="%1$s">%1$s</a></li>', $item->title, $item->url );
	}
}

function divergent_mobile_menu( string $menu_id ): void {
	foreach ( wp_get_nav_menu_items( $menu_id ) as $item ) {
		printf( '<li><a itemprop="url" href="%2$s" title="%1$s">%1$s</a></li>', $item->title, $item->url );
	}
}

function divergent_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

    <div class="comment-wrap">
        <div class="comment-img">
			<?php echo get_avatar( $comment, $args['avatar_size'], null, null, array(
				'class' => array(
					'img-responsive',
					'img-circle'
				)
			) ); ?>
        </div>
        <div class="comment-body">
            <h4 class="comment-author"><?php echo get_comment_author_link(); ?></h4>
            <span class="comment-date"><?php printf( __( '%1$s - %2$s', 'divergent' ), get_comment_date(), get_comment_time() ) ?></span>
			<?php if ( $comment->comment_approved == '0' ) { ?><em><i class="fa fa-spinner fa-spin"
                                                                      aria-hidden="true"></i> <?php _e( 'Yorumunuz onay bekliyor.', 'divergent' ); ?>
                </em><br/><?php } ?>
			<?php comment_text(); ?>
            <span class="comment-reply"> <?php comment_reply_link( array_merge( $args, array(
					'reply_text' => __( 'Cevapla', 'divergent' ),
					'depth'      => $depth,
					'max_depth'  => $args['max_depth']
				) ), $comment->comment_ID ); ?></span>
        </div>
    </div>
<?php }

// Enqueue comment-reply

add_action( 'wp_enqueue_scripts', 'divergent_public_scripts' );

function divergent_public_scripts() {
	if ( ! is_admin() ) {
		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
