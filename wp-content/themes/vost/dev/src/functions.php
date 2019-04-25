<?php

$showmenu = true;
//remover items menu
function remove_menus(){
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'jetpack' );                    //Jetpack* 
  //remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'themes.php' );                 //Appearance
  remove_menu_page( 'plugins.php' );                //Plugins
  remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
  remove_menu_page( 'profile.php' );        //profile
  
}
if(current_user_can('editor')) {
	add_action( 'admin_menu', 'remove_menus' );
	add_filter('acf/settings/show_admin', '__return_false');
	add_action( 'admin_init', 'custom_menu_page_removing' );
}
function custom_menu_page_removing() {
		remove_menu_page('vc-general'); //vc
		remove_menu_page('vc-welcome'); //vc
}

//acf load from json
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/acf';
    // return
    return $paths;
    
}

//acf save to json
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf';
    
    
    // return
    return $path;
    
}


//add active to menu posts
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}


remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Disable jQuery Migrate in WordPress.
 *
 * @author Guy Dumais.
 * @link https://en.guydumais.digital/disable-jquery-migrate-in-wordpress/
 */
add_filter( 'wp_default_scripts', $af = static function( &$scripts) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
    }    
}, PHP_INT_MAX );
unset( $af );


add_filter('show_admin_bar', '__return_false');
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

//add jquery (slickjs requirement)
wp_enqueue_script("jquery");

//widgets footer

register_sidebar(
		array(
    'name' => 'widget_footer1',
    'before_widget' => '<div class = "footer-section">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
		));
register_sidebar(
		array(
			'name' => 'widget_footer2',
			'before_widget' => '<div class = "footer-section">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			)

);

function wpb_custom_new_menu() {
  register_nav_menus( 
    array(
      'header'	=>	__( 'header Menu', 'header' ),
      'footer'	=>	__( 'footer Menu', 'footer' ), // Register the Primary menu
      // Copy and paste the line above right here if you want to make another menu, 
      // just change the 'primary' to another name
    )
  );
  }
  add_action( 'init', 'wpb_custom_new_menu' );