<?php
/*
	Search Page Template File
*/
  get_header();
  premiumphotography_title(); ?>
<div class="container container-premiumphotography "> 
  <?php if(have_posts()): ?>
  <div class="col-md-8 no-padding">
  	 <?php while(have_posts()): the_post(); ?>
     <!-- ALL POST -->
    <div class="col-md-12 home-page-post">
      <h3 class="premiumphotography-title"><?php the_title(); ?> </h3>
      <div class="col-md-12 no-padding">
        <div class="col-md-10 glyphicon-icon">
          <?php premiumphotography_entry_meta(); ?>
        </div>
        <div class="col-md-2 no-padding-left">
          <span class="comments-right"><?php if(comments_open() && (get_comments_number() != 0)) { ?><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); } ?></span>
        </div>
      </div>
      <div class="col-md-12 clearfix">
      	  <?php $premiumphotography_feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
			if($premiumphotography_feat_image!="") { ?>
            <img src="<?php echo $premiumphotography_feat_image;?>" class="img-responsive" alt="<?php echo get_the_title();?>" />
          <?php } ?> 
      </div>
      <div class="col-md-12 post-text">
        <p> <?php the_excerpt(); ?> </p>
      </div>
      <div class="col-md-12 read-more-text"> <a href="<?php the_permalink();?>"><?php _e('Continue Reading  >>','premium-photography'); ?></a> </div>
    </div>
    <!-- END ALL POST --> 
   <?php endwhile;?>
   <div class="clearfix"></div>
      <div class="pagination col-md-12">
        <div class="col-md-12">
            <?php if(get_option('posts_per_page ') < $wp_query->found_posts) { ?>
             <?php if(function_exists('faster_pagination')) {
					faster_pagination(); 
				  } else { ?>
            <nav class="premiumphotography-nav">
                <span class="premiumphotography-nav-previous"><?php previous_posts_link(); ?></span>
                <span class="premiumphotography-nav-next"><?php next_posts_link(); ?></span>
			</nav>
       <?php } } ?>    
        </div>
      </div>
  </div>
   <?php else: ?>
   <div class="col-md-8"><h3><?php _e('No Result Found.','premium-photography'); ?></h3></div>
  <?php endif; ?>
 <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>