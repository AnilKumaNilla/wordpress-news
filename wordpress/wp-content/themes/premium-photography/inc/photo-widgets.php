<?php 
// register widget
add_action('widgets_init', create_function('', 'return register_widget("premiumphotography_category_posts");'));

class premiumphotography_category_posts extends WP_Widget {
	// constructor
		function __construct() {
			 parent::__construct(false, $name = __('Photostream', 'premium-photography') );
		}
	
	// widget form creation
	function form($instance) {
	
	// Check values
	if( $instance) {
		 $premiumphotography_title = esc_attr($instance['title']);
		 $premiumphotography_no_of_posts = esc_attr($instance['no_of_posts']);
		 $premiumphotography_category_id = esc_attr($instance['category']);
		
	} else {
		 $premiumphotography_title = '';
		 $premiumphotography_no_of_posts = '';
		 $premiumphotography_category_id = '';
	}
	?>
	<!--- T I T L E ---->
	<p>
	  <label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('Widget Title', 'premium-photography'); ?>
	  </label>
	  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $premiumphotography_title; ?>" />
	</p>
	<!--- P O S T   N U M B E R ---->
	<p>
	  <label for="<?php echo $this->get_field_id('no_of_posts'); ?>">
		<?php _e('No. of posts', 'premium-photography'); ?>
	  </label>
	  <input class="widefat" id="<?php echo $this->get_field_id('no_of_posts'); ?>" name="<?php echo $this->get_field_name('no_of_posts'); ?>" type="text" value="<?php echo $premiumphotography_no_of_posts; ?>" />
	</p>
	<!--- C A T E G O R Y ---->
	<p>
	  <label for="<?php echo $this->get_field_id('category'); ?>">
		<?php _e('Category', 'premium-photography'); ?>
	  </label>
	  <select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
	   <?php  
		$premiumphotography_args = array(
			'type'                     => 'post',
			'taxonomy'                 => 'category',
		); 
		$premiumphotography_categories = get_categories( $premiumphotography_args );
		foreach($premiumphotography_categories as $premiumphotography_category){
			if($premiumphotography_category_id==$premiumphotography_category->term_id)
				$premiumphotography_selected = 'selected';	
			else
				$premiumphotography_selected = '';
		?>
			<option value="<?php echo $premiumphotography_category->term_id;?>" <?php echo $premiumphotography_selected;?>><?php echo $premiumphotography_category->name;?></option>
		<?php }
		?>
	  </select>
	</p>
	
	<?php
	}
	
	// update widget
	function update($new_instance, $old_instance) {
		$premiumphotography_instance = $old_instance;
		// Fields
		$premiumphotography_instance['title'] = strip_tags($new_instance['title']);
		$premiumphotography_instance['no_of_posts'] = strip_tags($new_instance['no_of_posts']);
		$premiumphotography_instance['category'] = strip_tags($new_instance['category']);
		return $premiumphotography_instance;
	}
	
	// widget display
	function widget($args, $instance) {
	   extract( $args );
	   // these are the widget options
	   $premiumphotography_title = apply_filters('widget_title', $instance['title']);
	   $premiumphotography_no_of_posts = esc_attr($instance['no_of_posts']);
	   $premiumphotography_category = esc_attr($instance['category']);
	   
	   echo $before_widget;
	   // Check if title is set
	   if ( $premiumphotography_title ) {
		  echo $before_title . $premiumphotography_title . $after_title;
	   }?>
		<ul class="photostream-widget">
		    <?php 
			$premiumphotography_args = array(
									'post_type' => 'post',
									'category__in' => $premiumphotography_category,
									'posts_per_page' => $premiumphotography_no_of_posts,
									'meta_query' => array(
										   array(
											   'key' => '_thumbnail_id',
											   'value' => '',
											   'compare' => '!=',
										   )
									  )
								);
			
			$premiumphotography_query = new WP_Query($premiumphotography_args);
			if($premiumphotography_query->have_posts()):
				while($premiumphotography_query->have_posts()): $premiumphotography_query->the_post();
					$premiumphotography_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'thumbail' );
					?>
						<li><a href="<?php the_permalink();?>"><img src="<?php echo $premiumphotography_feat_image[0];?>" class="img-responsive" alt="<?php echo get_the_title();?>" /></a></li>
				 	<?php
				endwhile;
			endif;
			?>
		</ul>
		<?php echo $after_widget;?>
		<div class="clearfix"></div>
        <?php
	}
} ?>