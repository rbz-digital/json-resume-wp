<?php

/**
 * Plugin Name: JSON Resume for WordPress
 * Plugin URI: https://github.com/rafael-business/json-resume-wp
 * Description: Salva seu currículo no formato "JSON resume" e cria um shortcode para mostrá-lo
 * Version: 1.0.0
 * Requires at least: 5.6
 * Author: Rafael dos Santos
 * Author URI: https://rafael.work
 * Licence: GPL v2 or later
 * Licence URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: json-resume-wp
 * Domain Path: /languages
 */

/*
    JSON Resume for WordPress is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    any later version.

    JSON Resume for WordPress is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with JSON Resume for WordPress. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if ( ! defined( 'ABSPATH' ) ){
    exit;
}

if ( ! class_exists( 'JSON_Resume_WP' ) ){

    class JSON_Resume_WP{

        function __construct(){

            $this->define_constants();
            $this->load_textdomain();

            require_once( JSON_Resume_WP_PATH . 'admin/class.json-resume-wp-admin.php' );
            $JSON_Resume_WP_Admin = new JSON_Resume_WP_Admin();

            require_once( JSON_Resume_WP_PATH . 'public/class.json-resume-wp-public.php' );
            $JSON_Resume_WP_Public = new JSON_Resume_WP_Public();
        }

        public function load_textdomain() {
            $path = dirname( plugin_basename(__FILE__)) . '/languages';
            $result = load_plugin_textdomain( dirname( plugin_basename(__FILE__)), false, $path );
         
            if (!$result) {
                $locale = apply_filters('plugin_locale', get_locale(), dirname( plugin_basename(__FILE__)));
                die("Could not find $path/" . dirname( plugin_basename(__FILE__)) . "-$locale.mo.");
            }
        }

        public function define_constants(){

            define( 'JSON_Resume_WP_PATH', plugin_dir_path( __FILE__ ) );
            define( 'JSON_Resume_WP_URL', plugin_dir_url( __FILE__ ) );
            define( 'JSON_Resume_WP_VERSION', '1.0.0' );
        }

        public static function uninstall(){
            
        }
    }
}

if ( class_exists( 'JSON_Resume_WP' ) ){

    register_uninstall_hook( __FILE__, array( 'JSON_Resume_WP', 'uninstall' ) );
    $JSON_Resume_WP = new JSON_Resume_WP();
}