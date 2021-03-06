<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package divergent_Wordpress_theme
 */

if ( ! function_exists( 'divergent_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function divergent_post_thumbnail( $link = 1 ) {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		$thumbnail_url = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'archive-thumbnail' )[0] : get_template_directory_uri() . "/dist/img/nothumb.jpg";

		if ( $link == 0 ): ?>
            <img itemprop="image" alt="<?php the_title(); ?>"
                 src="<?php echo $thumbnail_url ?>"><br>
		<?php else: ?>
            <a href="<?php the_permalink(); ?>">
                <img itemprop="image" alt="<?php the_title(); ?>"
                     src="<?php echo $thumbnail_url ?>">
            </a>
		<?php endif;
	}
endif;

function divergent_excerpt( $char ) {
	$content = strip_tags( strip_shortcodes( wp_trim_words( get_the_content(), 30 ) ) );
	echo $content;
}

function divergent_pagination( WP_Query $wp_query = null, $echo = true ) {
	if ( null === $wp_query ) {
		global $wp_query;
	}

	$pages = paginate_links( [
			'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'       => '?paged=%#%',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'type'         => 'array',
			'show_all'     => false,
			'end_size'     => 4,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => __( '«' ),
			'next_text'    => __( '»' ),
			'add_args'     => false,
			'add_fragment' => ''
		]
	);

	if ( is_array( $pages ) ) {
		$pagination = '<div class="pagination float-left"><ul class="pagination">';

		foreach ( $pages as $page ) {
			$pagination .= '<li class="page-item' . ( strpos( $page, 'current' ) !== false ? ' active' : '' ) . '"> ' . str_replace( 'page-numbers', 'page-link', $page ) . '</li>';
		}

		$pagination .= '</ul></div>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}

	return null;
}

function divergent_breadcrumbs() {
	if ( get_option( 'divergent' )['breadcrumb'] == false ) {
		return;
	}

	echo '<nav aria-label="breadcrumb">
                        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

	$text['home']     = "Anasayfa"; // text for the 'Home' link
	$text['category'] = '"%s" kategorisi'; // text for a category page
	$text['search']   = '"%s" için arama sonuçları'; // text for a search results page
	$text['tag']      = '"%s" etiketi'; // text for a tag page
	$text['author']   = '%s tarafından gönderilen yazılar'; // text for an author page
	$text['404']      = '404 Sayfa Bulunamadı'; // text for the 404 page
	$text['page']     = '%s. Sayfa'; // text 'Page N'
	$text['cpage']    = 'Yorum Sayfası: %s'; // text 'Comment Page N'

	$wrap_before = ''; // the opening wrapper tag
	$wrap_after  = ''; // the closing wrapper tag
	$sep         = ''; // separator between crumbs
	$before      = ''; // tag before the current crumb
	$after       = ''; // tag after the current crumb

	$show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_current   = 1; // 1 - show current page title, 0 - don't show
	$show_last_sep  = 1; // 1 - show last separator, when current page title is not displayed, 0 - don't show

	global $post;
	$home_url  = home_url( '/' );
	$link      = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"
                                class="breadcrumb-item">';
	$link      .= '<a itemprop="item" href="%1$s"><span itemprop="name">%2$s</span></a>';
	$link      .= '<meta itemprop="position" content="%3$s" />';
	$link      .= '</li>';
	$parent_id = ( $post ) ? $post->post_parent : '';
	$home_link = sprintf( $link, $home_url, $text['home'], 1 );

	if ( is_home() || is_front_page() ) {

		if ( $show_on_home ) {
			echo $wrap_before . $home_link . $wrap_after;
		}

	} else {

		$position = 0;

		echo $wrap_before;

		if ( $show_home_link ) {
			$position += 1;
			echo $home_link;
		}

		if ( is_category() ) {
			$parents = get_ancestors( get_query_var( 'cat' ), 'category' );
			foreach ( array_reverse( $parents ) as $cat ) {
				$position += 1;
				if ( $position > 1 ) {
					echo $sep;
				}
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
			}
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$cat      = get_query_var( 'cat' );
				echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) {
						echo $sep;
					}
					echo $before . sprintf( $link, get_category_link( $cat ), sprintf( $text['category'], single_cat_title( '', false ) ), single_cat_title( '', false ) ) . $after;
				} elseif ( $show_last_sep ) {
					echo $sep;
				}
			}

		} elseif ( is_search() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $show_home_link ) {
					echo $sep;
				}
				echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) {
						echo $sep;
					}
					echo $before . $sep . sprintf( $link, $home_url . "?s=" . get_search_query(), sprintf( $text['search'], get_search_query() ), $position ) . $after;
				} elseif ( $show_last_sep ) {
					echo $sep;
				}
			}

		} elseif ( is_year() ) {
			if ( $show_home_link && $show_current ) {
				echo $sep;
			}
			if ( $show_current ) {
				echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ), $position );
			} elseif ( $show_home_link && $show_last_sep ) {
				echo $sep;
			}

		} elseif ( is_month() ) {
			if ( $show_home_link ) {
				echo $sep;
			}
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ), $position );
			if ( $show_current ) {
				echo $sep . $before . sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ), $position ) . $after;
			} elseif ( $show_last_sep ) {
				echo $sep;
			}

		} elseif ( is_day() ) {
			if ( $show_home_link ) {
				echo $sep;
			}
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ), $position ) . $sep;
			$position += 1;
			echo sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ), $position );
			if ( $show_current ) {
				echo $sep . $before . sprintf( $link, get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ), get_the_time( 'd' ), $position ) . $after;
			} elseif ( $show_last_sep ) {
				echo $sep;
			}

		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$position  += 1;
				$post_type = get_post_type_object( get_post_type() );
				if ( $position > 1 ) {
					echo $sep;
				}
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
				if ( $show_current ) {
					echo $sep . $before . sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position ) . $after;
				} elseif ( $show_last_sep ) {
					echo $sep;
				}
			} else {
				$cat       = get_the_category();
				$catID     = $cat[0]->cat_ID;
				$parents   = get_ancestors( $catID, 'category' );
				$parents   = array_reverse( $parents );
				$parents[] = $catID;
				foreach ( $parents as $cat ) {
					$position += 1;
					if ( $position > 1 ) {
						echo $sep;
					}
					echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
				}
				if ( get_query_var( 'cpage' ) ) {
					$position += 1;
					echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
					echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
				} else {
					if ( $show_current ) {
						echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
					} elseif ( $show_last_sep ) {
						echo $sep;
					}
				}
			}

		} elseif ( is_post_type_archive() ) {
			$post_type = get_post_type_object( get_post_type() );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $position > 1 ) {
					echo $sep;
				}
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
				echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
			} else {
				if ( $show_home_link && $show_current ) {
					echo $sep;
				}
				if ( $show_current ) {
					echo $before . sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position ) . $after;
				} elseif ( $show_home_link && $show_last_sep ) {
					echo $sep;
				}
			}

		} elseif ( is_attachment() ) {
			$parent    = get_post( $parent_id );
			$cat       = get_the_category( $parent->ID );
			$catID     = $cat[0]->cat_ID;
			$parents   = get_ancestors( $catID, 'category' );
			$parents   = array_reverse( $parents );
			$parents[] = $catID;
			foreach ( $parents as $cat ) {
				$position += 1;
				if ( $position > 1 ) {
					echo $sep;
				}
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
			}
			$position += 1;
			echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
			if ( $show_current ) {
				echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
			} elseif ( $show_last_sep ) {
				echo $sep;
			}

		} elseif ( is_page() && ! $parent_id ) {
			if ( $show_home_link && $show_current ) {
				echo $sep;
			}
			if ( $show_current ) {
				echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
			} elseif ( $show_home_link && $show_last_sep ) {
				echo $sep;
			}

		} elseif ( is_page() && $parent_id ) {
			$parents = get_post_ancestors( get_the_ID() );
			foreach ( array_reverse( $parents ) as $pageID ) {
				$position += 1;
				if ( $position > 1 ) {
					echo $sep;
				}
				echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
			}
			if ( $show_current ) {
				echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
			} elseif ( $show_last_sep ) {
				echo $sep;
			}

		} elseif ( is_tag() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$tagID    = get_query_var( 'tag_id' );
				echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) {
					echo $sep;
				}
				if ( $show_current ) {
					echo $before . sprintf( '&nbsp;/&nbsp;' . $text['tag'], single_tag_title( '', false ) ) . $after;
				} elseif ( $show_home_link && $show_last_sep ) {
					echo $sep;
				}
			}

		} elseif ( is_author() ) {
			$author = get_userdata( get_query_var( 'author' ) );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) {
					echo $sep;
				}
				if ( $show_current ) {
					echo $before . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position ) . $after;
				} elseif ( $show_home_link && $show_last_sep ) {
					echo $sep;
				}
			}

		} elseif ( is_404() ) {
			if ( $show_home_link && $show_current ) {
				echo $sep;
			}
			if ( $show_current ) {
				echo $before . $text['404'] . $after;
			} elseif ( $show_last_sep ) {
				echo $sep;
			}

		} elseif ( has_post_format() && ! is_singular() ) {
			if ( $show_home_link && $show_current ) {
				echo $sep;
			}
			echo get_post_format_string( get_post_format() );
		}

		echo $wrap_after;

		echo '</ol>
                    </nav>';
	}
}
