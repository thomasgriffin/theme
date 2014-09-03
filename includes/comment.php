<?php
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own shopfront_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */

function affwp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	
	<li class="post pingback">
		<section class="section columns-3 columns">
			<div class="col left"></div>
			<div class="primary col content-area">
				<p><?php _e( 'Pingback:', 'affwp' ); ?> <?php comment_author_link(); ?>
				</p>
			</div>
			<div class="col right"></div>
		</section>

	<?php
			break;
		default :
	?>
	
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

			<div class="avatar-wrap">
				<?php
					$avatar_size = 72;
						
					if ( '0' != $comment->comment_parent ) {
						$avatar_size = 48;
					}	

					if ( get_option( 'show_avatars' ) ) {
						echo get_avatar( $comment, $avatar_size );
					}
				?>
			</div>
		

			

			<article id="comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-author vcard">
				<?php printf( __( '%1$s', 'affwp' ), sprintf( '<span class="fn">%s</span>', get_comment_author_link() ) ); ?>

				<div class="entry-date">
					<?php

						printf( __( '%1$s', 'affwp' ),
							
							sprintf( '<time pubdate datetime="%1$s">%2$s</time>',
								get_comment_time( 'c' ),
								
								sprintf( __( '%1$s', 'affwp' ), get_comment_date() )
							)
						); 
					?>
					
				</div>
			</div>
			
				<div class="comment-content">

					<?php comment_text(); ?>

					<div class="reply">

						<?php 
							comment_reply_link( array_merge( $args, 
							array( 
								'reply_text' => __( 'Reply', 'affwp' ), 
								'depth' => $depth, 
								'max_depth' => $args['max_depth']
							) ) ); 
						?>
					</div>
				</div>
			</article>

	



	<?php if ( $comment->comment_approved == '0' ) : ?>
		<p class="comment-awaiting-moderation">
			<?php _e( 'Your comment is awaiting moderation.', 'affwp' ); ?>
		</p>
	<?php endif; ?>
	
	<?php
			break;
	endswitch;
}