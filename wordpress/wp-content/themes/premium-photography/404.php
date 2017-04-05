<?php 
/*
	404 Page Template File
*/
get_header();?>
<div class="container container-premiumphotography "> 
  <div class="col-md-8">
    <header class="page-header">
        <h1 class="page-title"><?php _e( 'Not Found', 'premium-photography' ); ?></h1>
    </header>
    <div class="page-content">
        <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'premium-photography' ); ?></p>
        <?php get_search_form(); ?>
    </div><!-- .page-content -->
  </div>
<?php get_sidebar();
  get_footer();?>