<?php
/**
 * Custom post types functions
 */

add_action( 'init', 'create_testimonial_post_type' );

/****************
 * TESTIMONIALS *
 ****************/
function create_testimonial_post_type() {
    $args = array(
                  'description' => 'Testimonial Post Type',
                  'show_ui' => true,
                  'menu_position' => 4,
                  'exclude_from_search' => true,
                  'labels' => array(
                                    'name'=> 'Testimonials',
                                    'singular_name' => 'Testimonials',
                                    'add_new' => 'Add New Testimonial',
                                    'add_new_item' => 'Add New Testimonial',
                                    'edit' => 'Edit Testimonials',
                                    'edit_item' => 'Edit Testimonial',
                                    'new-item' => 'New Testimonial',
                                    'view' => 'View Testimonials',
                                    'view_item' => 'View Testimonial',
                                    'search_items' => 'Search Testimonials',
                                    'not_found' => 'No Testimonials Found',
                                    'not_found_in_trash' => 'No Testimonials Found in Trash',
                                    'parent' => 'Parent Testimonial'
                                   ),
                 'public' => true,
                 'capability_type' => 'post',
                 'hierarchical' => false,
                 'rewrite' => true,
                 'supports' => array('title', 'editor', 'thumbnail', 'revisions')
                 );
    register_post_type( 'testimonial' , $args );
}

add_filter("manage_edit-testimonial_columns", "testimonial_edit_columns");
 
function testimonial_edit_columns($columns){
   $columns = array(
                    "cb" => "<input type='checkbox' />",
                    "title" => __("Title"),
                    "testominal" => __("Testimonial"),
                    "testominal_author" => __("Author"),
                    "occupation" => __("Occupation"),
                    "show_hide" => __("Show/Hide")
                   );
 
   return $columns;
}
 
add_action("manage_testimonial_posts_custom_column",  "testimonial_custom_columns");
 
function testimonial_custom_columns($column){
  global $post;
  switch ($column){
                 case "testominal":
                     echo get_field( 'testimonial' );
                 break;
                 case "testominal_author":
                     echo get_field( 'author' );
                 break;
                 case "occupation":
                     echo get_field( 'occupation_project' );
                 break;
                 case "show_hide":
                     if( get_field('show_hide') ) { echo "Hide"; }else{ echo "Show"; }
                 break;
   }
}