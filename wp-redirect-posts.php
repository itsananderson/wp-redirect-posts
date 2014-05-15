<?php

/*
 * Plugin Name: WP Redirect Posts
 * Description: WordPress plugin for redirecting arbitrary posts and pages
 * Plugin URI: http://wordpress.org/plugins/wp-redirect-posts/
 * Author Name: Will Anderson
 * Author URI: http://willi.am/
 */

require_once ( 'includes/wp-redirect-posts-options.php' );
require_once ( 'includes/wp-redirect-posts-resolver.php' );

class WP_Redirect_Posts {

    private static $redirect_resolver;

    public static function start() {
        add_action( 'wp', array( __CLASS__, 'redirect_posts' ) );
        add_action( 'admin_menu', array( 'WP_Redirect_Posts_Options', 'configure_menu' ) );
        self::$redirect_resolver = new WP_Redirect_Posts_Resolver( WP_Redirect_Posts_Options::get_options() );
    }

    public static function redirect_posts() {
        global $post;

        if ( is_singular() ) {
            $redirect = self::$redirect_resolver->resolve( $post->ID );

            if ( !is_null( $redirect ) ) {
                wp_redirect( $redirect['url'], $redirect['code'] );
            }
        }
    }
}

WP_Redirect_Posts::start();