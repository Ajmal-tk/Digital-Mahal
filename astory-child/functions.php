<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'astory' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

 function wpb_login_logo(){ ?>
	 
	 <style type="text/css">
	 #login h1 a, .login h1 a{
		 background-image: url("http://localhost/dmnew/wp-content/uploads/2022/08/site-logo.png");
		 height:155px;
		 width: 300px;
		 background-size: 220px 190px;
		 background-repeat: no-repeat;
		 padding-bottom:24px;
		 background-color: #b6cacb;
		 border: solid 1px #5f6266;
	 }
	 .login form{
		 margin-top: 0px;
	 }
	 </style>
 <?php }
 
	function wpb_login_logo_url(){
		return home_url();
	}
	add_filter('login_headerurl','wpb_login_logo_url');
	
	function wpb_login_logo_url_title(){
		return 'Digital Mahal Management System for Ananthayoor Mahal';
	}
	add_filter('login_headertitle','wpb_login_logo_url_title');
 
	add_action('login_enqueue_scripts','wpb_login_logo');
	
	function my_shortcode_function() { 
	$i = 'This is ajmal function'; 
	return $i; 
	} 
	
	add_shortcode('my-shortcode', 'my_shortcode_function');
	
	
	// Creating widget in this theme
	/*
	function wpb_widgets_init() {
 
    register_sidebar( array(
        'name'          => 'Custom Header Widget Area',
        'id'            => 'custom-header-widget',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
		) );
 
	   }
		add_action( 'widgets_init', 'wpb_widgets_init' ); */
	

// END ENQUEUE PARENT ACTION
  ?>

