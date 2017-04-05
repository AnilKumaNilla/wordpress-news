<!-- footer -->
<?php 
/*
	Footer file of our theme
*/
$premiumphotography_options = get_option( 'premiumphotography_theme_options' ); ?>
<div class="col-md-12 copyright-footer">
  <div class="container container-full-premiumphotography">
    <div class="col-md-8">
    <p class='footer-font'>
      <?php if(!empty($premiumphotography_options['footertext'])) { 
				echo wp_filter_nohtml_kses($premiumphotography_options['footertext']).' ';
			}
			echo "Powered by <a href='http://fasterthemes.com/wordpress-themes/premiumphotography' target='_blank'>".__('Premium Photography WordPress Theme','premium-photography')."</a>"; ?>
     </p>
    </div>
  </div>
</div>
<!-- footer End--> 
<?php wp_footer(); ?>
</body>
</html>