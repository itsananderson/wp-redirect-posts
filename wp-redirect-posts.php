<?php

/*
 * Plugin Name: WP Redirect Posts
 * Description: WordPress plugin for redirecting arbitrary posts and pages
 * Plugin URI: http://wordpress.org/plugins/wp-redirect-posts/
 * Author Name: Will Anderson
 * Author URI: http://willi.am/
 */

require_once ( 'includes/wp-redirect-posts-resolver.php' );

class WP_Redirect_Posts {

    private static $redirect_resolver;

    public static function add_hooks() {
        add_action( 'parse_query', array( __CLASS__, 'parse_query' ) );
        self::$redirect_resolver = new WP_Redirect_Posts_Resolver(get_option( 'wp_redirect_posts', array()));
    }

    public static function parse_query( $wp_query ) {
        $redirect = self::$redirect_resolver->resolve( $wp_query );

        if ( !is_null( $redirect ) ) {
            wp_redirect( $redirect['url'], $redirect['status'] );
        }
    }
}

WP_Redirect_Posts::add_hooks();