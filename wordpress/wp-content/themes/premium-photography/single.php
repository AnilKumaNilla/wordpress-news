<?php 
/*
	Single Post Template File
*/
get_header();
premiumphotography_title(); ?>
<div class="container container-premiumphotography "> 
  <?php if(have_posts()):
   while(have_posts()): the_post();?>
  <!-- ALL POST -->
  <div class="col-md-8 no-padding" id="post-<?php echo get_the_ID();?>">
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
        <?php the_content();?>
      </div>
    </div>
    <?php wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'premium-photography' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) ); ?>
    <div class="col-md-12">
        <div class="col-md-12"> 
            <div class="single-pagination">
                <nav class="premiumphotography-nav">
                   <span class="premiumphotography-nav-previous"><?php previous_post_link(); ?></span>
                   <span class="premiumphotography-nav-next"><?php next_post_link(); ?></span>
                </nav><!-- .nav-single -->
            </div>
        </div>
    </div>
    <?php comments_template( '', true ); ?>
  </div>
   <?php endwhile; ?>
   <!-- END ALL POST -->
  <?php endif;
    get_sidebar(); ?>
</div>
<?php get_footer(); ?>