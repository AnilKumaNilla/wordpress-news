<?php
/**
 * About Widgets
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return array $education_base_course_column_number
 *
 */
if ( !function_exists('education_base_course_column_number') ) :
    function education_base_course_column_number() {
        $education_base_course_column_number =  array(
            1 => __( '1', 'education-base' ),
            2 => __( '2', 'education-base' ),
            3 => __( '3', 'education-base' ),
            4 =>  __( '4', 'education-base' )
        );
        return apply_filters( 'education_base_course_column_number', $education_base_course_column_number );
    }
endif;

/**
 * Class for adding About Section Widget
 *
 * @package Acme Themes
 * @subpackage Education Base
 * @since 1.0.0
 */
if ( ! class_exists( 'Education_base_course' ) ) {

    class Education_base_course extends WP_Widget {
        /*defaults values for fields*/

        private function defaults(){
            /*defaults values for fields*/
            $defaults = array(
                'unique_id'     => '',
                'title'         => '',
                'page_id'       => '',
                'post_number'   => 3,
                'column_number' => 3,
                'read_more_text'        => __( 'Read More', 'education-base' )
            );
            return $defaults;
        }

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'education_base_course',
                /*Widget name will appear in UI*/
                __('AT Course Section', 'education-base'),
                /*Widget description*/
                array( 'description' => __( 'Show About Section.', 'education-base' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            $read_more_text = esc_attr( $instance[ 'read_more_text' ] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>" />
                <br />
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.','education-base')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Parent Page For About', 'education-base' ); ?>:</label>
                <br />
                <small><?php _e( 'Select parent page and its subpages will display in the frontend. If pages does not have any subpages, then selected single page will display', 'education-base' ); ?></small>
                <?php
                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                $args = array(
                    'selected'              => $page_id,
                    'name'                  => $this->get_field_name( 'page_id' ),
                    'id'                    => $this->get_field_id( 'page_id' ),
                    'class'                 => 'widefat',
                    'show_option_none'      => __('Select Page','education-base'),
                );
                wp_dropdown_pages( $args );
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Post Number', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'column_number' ); ?>"><?php _e( 'Column Number', 'education-base' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'column_number' ); ?>" name="<?php echo $this->get_field_name( 'column_number' ); ?>" >
                    <?php
                    $education_base_course_column_numbers = education_base_course_column_number();
                    foreach ( $education_base_course_column_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_attr( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'read_more_text' ); ?>"><?php _e( 'Read More Text', 'education-base' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'read_more_text' ); ?>" name="<?php echo $this->get_field_name( 'read_more_text' ); ?>" type="text" value="<?php echo $read_more_text; ?>" />
            </p>
            <?php
        }
        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'unique_id' ] = sanitize_key( $new_instance[ 'unique_id' ] );
            $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
            $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );
            $instance[ 'read_more_text' ] = sanitize_text_field( $new_instance[ 'read_more_text' ] );

            return $instance;
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return array
         *
         */
        public function widget($args, $instance) {
            if( isset( $args['id'] ) ){
                $education_base_sidebar_id = $args['id'];
            }
            else{
                $education_base_sidebar_id = 'education-base-home';
            }
            $init_animate_title = '';
            $init_animate_content = '';
            if ( 'education-base-home' == $education_base_sidebar_id ){
                $init_animate_title = "init-animate slideInUp1";
                $init_animate_content = "init-animate slideInUp1";
            }
            $instance = wp_parse_args( (array) $instance, $this->defaults());

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            $read_more_text = esc_html( $instance[ 'read_more_text' ] );

            echo $args['before_widget'];
            ?>
            <section id="<?php echo $unique_id;?>" class="acme-widgets popular-course">
                <div class="container">
                    <div class="main-title <?php echo esc_attr( $init_animate_title ); ?>">
                        <?php
                        if( !empty( $title ) ) {
                            echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                        }
                        ?>
                    </div>
                    <div class="row">
                        <?php if( !empty ( $page_id ) ) :
                        $education_base_child_page_args = array(
                            'post_parent'         => $page_id,
                            'posts_per_page'      => $post_number,
                            'post_type'           => 'page',
                            'no_found_rows'       => true,
                            'post_status'         => 'publish'
                        );
                        $course_query = new WP_Query( $education_base_child_page_args );
                        if ( !$course_query->have_posts() ){
                            $education_base_child_page_args = array(
                                'page_id'         => $page_id,
                                'posts_per_page'      => 1,
                                'post_type'           => 'page',
                                'no_found_rows'       => true,
                                'post_status'         => 'publish'
                            );
                            $course_query = new WP_Query( $education_base_child_page_args );
                            $course_number = 1;
                        }
                        /*The Loop*/
                        if ( $course_query->have_posts() ):
                            $i = 1;
                            global $education_base_read_more_text;
                            $education_base_read_more_text = $read_more_text;
                            while( $course_query->have_posts() ):$course_query->the_post();
                                if( 1 == $column_number ){
                                    $init_animate_content .= " col-sm-12";
                                } 
                                elseif( 2 == $column_number ){
                                    $init_animate_content .= " col-sm-6";
                                } 
                                elseif( 3 == $column_number ){
                                    $init_animate_content .= " col-sm-12 col-md-4";
                                } 
                                else{
                                    $init_animate_content .= " col-sm-12 col-md-3";
                                } 
                                ?>
                                <div class="course-item-wrapper <?php echo $init_animate_content; ?>">
                                    <?php get_template_part( 'template-parts/content', 'course' );?>
                                </div>
                                <?php 
                                if( 0 == $i % $column_number ){
                                    echo "<div class='clearfix'></div>";
                                }
                                $i++;
                            endwhile;
                        else:
                            /*do nothing for now*/
                        endif;
                        endif;
                        wp_reset_postdata();
                    ?>
                    </div>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class Education_base_course ends here
}
/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_course' ) ) :

    function education_base_course() {
        register_widget( 'Education_base_course' );
    }
endif;
add_action( 'widgets_init', 'education_base_course' );