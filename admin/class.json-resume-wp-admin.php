<?php

if ( ! class_exists( 'JSON_Resume_WP_Admin' ) ){

    class JSON_Resume_WP_Admin{

        private $json_resume_wp_options;

        public function __construct() {
            add_action( 'admin_menu', array( $this, 'json_resume_wp_add_plugin_page' ) );
            add_action( 'admin_init', array( $this, 'json_resume_wp_page_init' ) );
        }

        public function json_resume_wp_add_plugin_page() {
            add_management_page(
                'JSON Resume for WordPress', // page_title
                'JSON Resume', // menu_title
                'manage_options', // capability
                'json-resume-wp', // menu_slug
                array( $this, 'json_resume_wp_create_admin_page' ) // function
            );
        }

        public function json_resume_wp_create_admin_page() {
            $this->json_resume_wp_options = get_option( 'json_resume_wp_option_name' ); ?>

            <div class="wrap">
                <h2>JSON Resume for WordPress</h2>
                <p>
                    Salva seu currículo no formato 
                    <a href="https://jsonresume.org/" target="_blank">JSON resume</a> 
                    e cria um shortcode para mostrá-lo
                </p>
                <?php settings_errors(); ?>

                <form method="post" action="options.php">
                    <?php
                        settings_fields( 'json_resume_wp_option_group' );
                        do_settings_sections( 'json-resume-wp-admin' );
                        submit_button();
                    ?>
                </form>
            </div>
        <?php }

        public function json_resume_wp_page_init() {
            register_setting(
                'json_resume_wp_option_group', // option_group
                'json_resume_wp_option_name', // option_name
                array( $this, 'json_resume_wp_no_sanitize' ) // sanitize_callback
            );

            add_settings_section(
                'json_resume_wp_setting_section', // id
                'Settings', // title
                array( $this, 'json_resume_wp_section_info' ), // callback
                'json-resume-wp-admin' // page
            );

            add_settings_field(
                'resume_json', // id
                'JSON', // title
                array( $this, 'resume_json_callback' ), // callback
                'json-resume-wp-admin', // page
                'json_resume_wp_setting_section' // section
            );
        }

        public function json_resume_wp_sanitize($input) {
            $sanitary_values = array();
            if ( isset( $input['resume_json'] ) ) {
                $sanitary_values['resume_json'] = esc_textarea( $input['resume_json'] );
            }

            return $sanitary_values;
        }

        public function json_resume_wp_no_sanitize($input) {
            $values = array();
            if ( isset( $input['resume_json'] ) ) {
                $values['resume_json'] = $input['resume_json'];
            }

            return $values;
        }

        public function json_resume_wp_section_info() {
            
        }

        public function resume_json_callback() {
            printf(
                '<textarea class="large-text" rows="25" name="json_resume_wp_option_name[resume_json]" id="resume_json">%s</textarea>',
                isset( $this->json_resume_wp_options['resume_json'] ) ? esc_attr( $this->json_resume_wp_options['resume_json']) : ''
            );
        }
    }
}