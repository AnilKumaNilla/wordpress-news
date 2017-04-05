<?php 
/*
	Page Template File
*/
get_header(); ?>
<div class="banner-bg">
  <div class="container container-premiumphotography">
    <h1 class="banner-text"><?php the_title(); ?></h1>
  </div>
</div>
<div class="container container-premiumphotography "> 
  <?php if(have_posts()): ?>
   <?php while(have_posts()): the_post(); ?>
  <!-- ALL POST -->
  <div class="col-md-8 no-padding">
    <div class="col-md-12 home-page-post">
      <div class="col-md-12 clearfix">
      	  <?php $premiumphotography_feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
			if($premiumphotography_feat_image!="") { ?>
            <img src="<?php echo $premiumphotography_feat_image;?>" class="img-responsive" alt="<?php echo get_the_title();?>" />
          <?php } ?> 
      </div>
      <div class="col-md-12 post-text">
        <?php the_content(); ?>
      </div>
    </div>
     <?php comments_template( '', true ); ?>
  </div>
  <!-- END ALL POST --> 
   <?php endwhile; ?>
  <?php endif;?>
 <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>