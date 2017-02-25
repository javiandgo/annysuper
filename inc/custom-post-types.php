<?php 


add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'recetas',
    array(
      'labels' => array(
        'name' => __( 'Recetas' ),
        'singular_name' => __( 'Receta' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}



