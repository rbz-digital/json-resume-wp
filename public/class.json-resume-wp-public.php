<?php

if ( ! class_exists( 'JSON_Resume_WP_Public' ) ){

    class JSON_Resume_WP_Public{

        public $resume;

        public function __construct() {

            $resume = $this->opt_array( get_option( 'json_resume_wp_option_name' ) );
            $this->resume = json_decode( $resume['resume_json'], true );

            add_shortcode( 'my-resume', array( $this, 'json_resume_wp_shortcode' ) );
        }

        public function opt_array( $opts ){
            return isset( $opts ) && ! empty( $opts ) && is_array( $opts ) ? $opts : [];
        }

        public function json_resume_wp_shortcode( $atts ){

            $attributes = shortcode_atts( array(
                'exclude' => ''
            ), $atts );

            // TODO: exclude sections

            $sections = array();
            foreach ( $this->resume as $name => $content ) {
                
                $sections[$name] = $content;
            }

            ob_start();
            require_once( JSON_Resume_WP_PATH . 'public/templates/simple.php' );
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }

        public function dt( $dt ){

            return date( 'm/Y', strtotime( $dt ) );
        }
    }
}