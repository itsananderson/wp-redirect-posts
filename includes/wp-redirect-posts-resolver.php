<?php

class WP_Redirect_Posts_Resolver {

    private $options;
    
    public function __construct( $options ) {
        $this->WP_Redirect_Posts_Resolver( $options );
    }

    public function WP_Redirect_Posts_Resolver( $options ) {
        $this->options = $options;
    }

    public function resolve( $post_id ) {
        if ( isset( $this->options['redirects'][$post_id] ) ) {
            $redirect_option = $this->options['redirects'][$post_id];
            switch ( $redirect_option['type'] ) {
                case 'site':
                    $permalink = get_permalink($post_id);
                    $url = str_replace( $this->options['site_replace_base'], $this->options['site_redirect_base'], $permalink);
                    break;
                case 'post':
                    $url = get_permalink( intval( $redirect_option['value'] ) );
                    break;
                case 'rel':
                    $url = site_url( $redirect_option['value'] );
                    break;
                case 'abs':
                default:
                    $url = $redirect_option['url'];
            }
            $status = isset( $redirect_option['status'] ) ? intval( $redirect_option['status'] ) : 302;
            return array( 'url' => $url, 'status' => $status );
        }
        
        return null;
    }
}