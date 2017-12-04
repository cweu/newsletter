<?php

/*

@package OnWeb Noelhuis

  ===========================
    ADMIN ENQUEUE FUNCTIONS
  ===========================
*/


/*

@package OnWeb Noelhuis

  ===========================
    FRONT-END ENQUEUE FUNCTIONS
  ===========================
*/

function onweb_load_scripts(){
  // wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.3.7', 'all' );
  wp_enqueue_style( 'noelhuis', get_template_directory_uri() . '/css/noelhuis.css', array(), '1.0.0', 'all' );
  wp_deregister_script( 'jqeury' );
  wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, '', true );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'botstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js',  array('jquery'), '3.3.7', 'all' );
}

add_action( 'wp_enqueue_scripts', 'onweb_load_scripts' );
