<?php

class WP_Redirect_Posts_Resolver {

    private $options;

    public function WP_Redirect_Posts_Resolver( $options ) {
        $this->options = $options;
    }

    public function __construct( $options ) {
        $this->WP_Redirect_Posts_Resolver( $options );
    }

    public function redirect( $wp_query ) {
        if ( $wp_query->is_singular ) {
            if ( isset( $this->options[$wp_query->queried_object_id] ) ) {
                $redirect_option = $this->options[$wp_query->queried_object_id];
                switch ( $redirect_option['type'] ) {
                    case 'post':
                        $url = get_permalink( intval( $redirect_option['value'] ) );
                        break;
                    case 'rel':
                        $url = site_url( $redirect_option['value'] );
                        break;
                    case 'abs':
                    default:
                        $url = $redirect_option['value'];
                }
                $status = isset( $redirect_option['status'] ) ? intval( $redirect_option['status'] ) : 302;
                return array( 'url' => $url, 'status' => $status );
            }
        }
        return null;
    }
}