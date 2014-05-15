<?php

class WP_Redirect_Posts_Options {

    const OPTION_NAME = 'wp_redirect_posts';

    public static function configure_menu() {
        add_management_page( __( 'Redirect Posts' ), __( 'Redirect Posts' ), 'edit_others_pages', 'wp-redirect-posts', array( __CLASS__, 'show_options_page' ) );
    }

    public static function get_options() {
        return get_option( self::OPTION_NAME, array() );
    }

    public static function update_options( $options ) {
        update_option( self::OPTION_NAME, $options );
    }

    public static function show_options_page() {
        if ( !current_user_can( 'edit_others_pages' ) )  {
		    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	    }

        if ( !empty( $_POST ) ) {
            self::update_options( self::parse_options( $_POST ) );
        }

        $options = self::get_options();
        include( dirname( dirname( __FILE__ ) ) . '/views/options.php' );
    }

    public static function parse_options( $options ) {
        $ids = isset( $options['id'] ) ? $options['id'] : array();
        $types = isset( $options['type'] ) ? $options['type'] : array();
        $codes = isset( $options['code'] ) ? $options['code'] : array();
        $urls = isset( $options['url'] ) ? $options['url'] : array();
        
        $site_replace_base = isset( $options['site-replace-base'] ) ? $options['site-replace-base'] : '';
        $site_redirect_base = isset( $options['site-redirect-base'] ) ? $options['site-redirect-base'] : '';

        $redirects = array();
        foreach ( $ids as $index => $id ) {
            $type = $types[$index];
            $code = $codes[$index];
            $url = $urls[$index];

            if ( !empty( $id ) && !empty( $url ) ) {
                $redirects[$id] = array(
                    'type' => $type,
                    'id' => $id,
                    'code' => $code,
                    'url' => $url,
                );
            }
        }

        return array(
            'redirects' => $redirects,
            'site_replace_base' => $site_replace_base,
            'site_redirect_base' => $site_redirect_base,
        );
    }
}