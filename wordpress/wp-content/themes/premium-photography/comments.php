<?php
/**
 * The template for displaying Comments.
 *
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return; ?>
<div class="clearfix"></div>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
    <div class="col-md-12 comments-blog">
    <h5><?php echo get_comments_number(); _e('COMMENTS','premium-photography'); ?> </h5>
    <ul class="col-md-12 comments-post-blog">
    <?php wp_list_comments( array( 'callback' => 'premiumphotography_comment', 'short_ping' => true, 'style' => 'ul' ) ); ?>
    </ul>
       <?php paginate_comments_links(); ?> 
    </div>    
	<?php endif; // have_comments()
 if(comments_open()) :
 comment_form();
 endif; // have_comments() ?>
</div><!-- #comments .comments-area -->
