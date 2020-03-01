<?php if ( post_password_required() ) {
	return;
} ?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) { ?>
        <h4 class="comments-title"><?php comments_number( __( 'Yorum Yok', 'divergent' ), __( '1 Yorum', 'divergent' ), '% ' . __( 'Yorum', 'divergent' ) ); ?></h4>
        <span class="title-line"></span>
        <ol class="comment-list">
			<?php wp_list_comments( array(
				'avatar_size' => 70,
				'style'       => 'ul',
				'callback'    => 'divergent_comments',
				'type'        => 'all'
			) ); ?>
        </ol>
		<?php the_comments_pagination( array(
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i> <span class="screen-reader-text">' . __( '&laquo; Önceki', 'divergent' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Sonraki &raquo;', 'divergent' ) . '</span> <i class="fa fa-angle-right" aria-hidden="true"></i>',
		) ); ?>
	<?php } ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
        <p class="no-comments"><?php _e( 'Bu gönderi için yorumlar kapalıdır.', 'divergent' ); ?></p>
	<?php } ?>

	<?php
	ob_start();
	$commenter = wp_get_current_commenter();
	$req       = true;
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$comments_arg = array(
		'form'                => array(
			'class' => 'form-horizontal'
		),
		'fields'              => apply_filters( 'comment_form_default_fields', array(
			'autor' => '<div class="form-group">' . '<label for="author">' . __( 'İsim', 'divergent' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
			           '<input id="author" name="author" class="form-control" type="text" value="" size="30"' . $aria_req . ' />' .
			           '<p id="d1" class="text-danger"></p>' . '</div>',
			'email' => '<div class="form-group">' . '<label for="email">' . __( 'E-posta', 'divergent' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
			           '<input id="email" name="email" class="form-control" type="text" value="" size="30"' . $aria_req . ' />' .
			           '<p id="d2" class="text-danger"></p>' . '</div>',
			'url'   => ''
		) ),
		'comment_field'       => '<div class="form-group">' . '<label for="comment">' . __( 'Yorum', 'divergent' ) . '</label><span>*</span>' .
		                         '<textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true"></textarea><p id="d3" class="text-danger"></p>' . '</div>',
		'comment_notes_after' => '',
		'class_submit'        => 'btn btn-primary'
	); ?>
	<?php comment_form( $comments_arg );
	echo str_replace( 'class="comment-form"', 'class="comment-form" name="commentForm" onsubmit="return validateForm();"', ob_get_clean() );
	?>

    <script>
        /*
		basic javascript form validation
		For more information: https://getbootstrap.com/docs/4.3/components/forms/#validation
		*/
        function validateForm() {
            var form = document.forms.commentForm,
                x = form.author.value,
                y = form.email.value,
                z = form.comment.value,
                flag = true,
                d1 = document.getElementById("d1"),
                d2 = document.getElementById("d2"),
                d3 = document.getElementById("d3");

            if (x === null || x === "") {
                d1.innerHTML = "<?php echo __( 'İsim gereklidir.', 'divergent' ); ?>";
                flag = false;
            } else {
                d1.innerHTML = "";
            }

            if (y === null || y === "") {
                d2.innerHTML = "<?php echo __( 'E-posta gereklidir.', 'divergent' ); ?>";
                flag = false;
            } else {
                d2.innerHTML = "";
            }

            if (z === null || z === "") {
                d3.innerHTML = "<?php echo __( 'Yorum alanı boş bırakılamaz.', 'divergent' ); ?>";
                flag = false;
            } else {
                d3.innerHTML = "";
            }

            return flag;

        }
    </script>
</div>
