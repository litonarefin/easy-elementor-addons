<?php
    namespace MasterAddons\Inc\Classes;
    use \Elementor\Plugin;
    use MasterAddons\Master_Elementor_Addons;
    use MasterAddons\Inc\Helper\Master_Addons_Helper;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 1/7/20
	 */

	class JLTMA_Ajax_Queries{

        public $loaded_templates = [];

        private static $instance = null;

        public static function get_instance() {
            if ( ! self::$instance ) {
                self::$instance = new self;
            }
            return self::$instance;
        }


		public function __construct() {
            
            // $this->loaded_templates[] = $this->loaded_templates;

            // Restrict Content
			add_action( 'wp_ajax_ma_el_restrict_content', array( $this, 'ma_el_restrict_content' ) );
            add_action( 'wp_ajax_nopriv_ma_el_restrict_content', array( $this, 'ma_el_restrict_content' ) );

            // Domain Checker
            add_action('wp_ajax_jltma_domain_checker', array( $this,'jltma_domain_checker' ));
            add_action('wp_ajax_nopriv_jltma_domain_checker', array( $this,'jltma_domain_checker' ));

            //Instagram Feed
            // add_action('wp_ajax_jltma_instafeed_load_more_action', [$this, 'jltma_instafeed_render_items' ] );
            // add_action('wp_ajax_nopriv_jltma_instafeed_load_more_action', [$this, 'jltma_instafeed_render_items'] );

            // Editor Saved Data
            add_action('elementor/editor/after_save', array($this, 'jltma_editor_global_values'), 10, 2);
            add_action('wp_footer', array($this, 'render_global_html'));
            add_action('elementor/css-file/post/enqueue', [$this, 'enqueue_template_scripts']);

        }


        public function enqueue_template_scripts($css_file) {
            // $css_file = \Elementor\Plugin::$instance->editor->get_post_id();
            // print_r($css_file);
            // $post_id = (int) $css_file->get_post_id();

            // loaded template stack
            // if ( \Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
                $this->loaded_templates[] = $post_id;
            // }

            // print_r($this->loaded_templates);
        }


        public function render_global_html(){

            if(!did_action('elementor/loaded')) {
                return;
            }

            if (empty($this->loaded_templates)) {
                return;
            }

            $global_settings = get_option('jltma_global_settings');
            // print_r($global_settings['reading_progress']['post_id']);
            print_r($this->loaded_templates);


            if(\Elementor\Plugin::instance()->editor->is_edit_mode() && is_singular()) {
                $this->loaded_templates[] = get_the_ID();
            }

            
// echo "Arefin Lis" . get_the_ID();
            $is_activated_extensions = Master_Elementor_Addons::activated_extensions();
            // print_r($is_activated_extensions);


            $html = '';
            



            


            foreach ($this->loaded_templates as $post_id) {
                // if (Shared::is_prevent_load_extension($post_id)) {
                //     continue;
                // }


                if (!Plugin::$instance->db->is_built_with_elementor($post_id)) {
                    continue;
                }

                $document = \Elementor\Plugin::$instance->documents->get($post_id);


                // Reading Progress Bar
                if ($is_activated_extensions('reading-progress-bar') == true) {
                    if ($document->get_settings('jltma_enable_reading_progress_bar') == 'yes' || isset($global_settings['reading_progress']['enabled'])) {
                        $reading_progress_html = '<div class="eael-reading-progress-wrap eael-reading-progress-wrap-' . ($document->get_settings('jltma_enable_reading_progress_bar') == 'yes' ? 'local' : 'global') . '">
                                <div class="eael-reading-progress eael-reading-progress-local eael-reading-progress-' . $document->get_settings('jltma_reading_progress_bar_position') . '">
                                    <div class="eael-reading-progress-fill"></div>
                                </div>
                                <div class="eael-reading-progress eael-reading-progress-global eael-reading-progress-' . @$global_settings['reading_progress']['position'] . '" style="height: ' . @$global_settings['reading_progress']['height']['size'] . 'px;background-color: ' . @$global_settings['reading_progress']['bg_color'] . ';">
                                    <div class="eael-reading-progress-fill" style="height: ' . @$global_settings['reading_progress']['height']['size'] . 'px;background-color: ' . @$global_settings['reading_progress']['fill_color'] . ';transition: width ' . @$global_settings['reading_progress']['animation_speed']['size'] . 'ms ease;"></div>
                                </div>
                            </div>';


                        if ($document->get_settings('jltma_enable_reading_progress_bar') != 'yes') {
                            if (get_post_status($global_settings['reading_progress']['post_id']) != 'publish') {
                                $reading_progress_html = '';
                            } else if ($global_settings['reading_progress']['display_condition'] == 'pages' && !is_page()) {
                                $reading_progress_html = '';
                            } else if ($global_settings['reading_progress']['display_condition'] == 'posts' && !is_single()) {
                                $reading_progress_html = '';
                            } else if ($global_settings['reading_progress']['display_condition'] == 'all' && !is_singular()) {
                                $reading_progress_html = '';
                            }
                        }

                        $html .= $reading_progress_html;
                    }
                }
            }

            echo $html;

        }

        public function jltma_editor_global_values( $post_id, $editor_data ){
            $document = Plugin::$instance->documents->get($post_id);
            $global_settings = get_option('jltma_global_settings');

            if ($document->get_settings('jltma_reading_progress_bar_enable_global') == 'yes') {
                $global_settings['reading_progress'] = [
                    'post_id'           => $post_id,
                    'enabled'           => $document->get_settings('jltma_reading_progress_bar_enable_global') === 'yes',
                    'display_condition' => $document->get_settings('jltma_reading_progress_bar_global_condition'),
                    'position'          => $document->get_settings('jltma_reading_progress_bar_position'),
                    'height'            => $document->get_settings('jltma_reading_progress_bar_height'),
                    'bg_color'          => $document->get_settings('jltma_reading_progress_bar_bg_color'),
                    'fill_color'        => $document->get_settings('jltma_reading_progress_bar_fill_color'),
                    'animation_speed'   => $document->get_settings('jltma_reading_progress_bar_animation_speed'),
                ];
            } else {
                if (isset($global_settings['reading_progress']['post_id']) && $global_settings['reading_progress']['post_id'] == $post_id) {
                    $global_settings['reading_progress'] = [];
                }
            }


            update_option('jltma_global_settings', $global_settings);
            update_post_meta($post_id, 'jltma_transient_elements', []);
        }


		public function ma_el_restrict_content() {

            parse_str( $_POST['fields'], $output );

            if ( !empty($_POST['fields'] )) {

                // Math Captcha
                if($_POST['restrict_type'] == 'math_captcha'){
                    if( $output['ma_el_rc_answer'] !== $output['ma_el_rc_answer_hd']){
                        die( json_encode( array(
                            "result" => "validate",
                            "output" => sprintf( __( '%1$s', MELA_TD ), $_POST['error_message'] )
                        ) ) );
                    }
                }

                // Password Protecion
                if($_POST['restrict_type'] == 'password'){
                    if( $_POST['content_pass'] !== $output['ma_el_restrict_content_pass']){
                        die( json_encode( array(
                            "result" => "validate",
                            "output" => sprintf( __( '%1$s', MELA_TD ), $_POST['error_message'] )
                        ) ) );
                    }
                }


                // Age Restrict
                if($_POST['restrict_type'] == 'age_restrict'){

                    $min_age = $_POST['restrict_age']['min_age'];

                    // Enter Age
                    if($_POST['restrict_age']['age_type'] == "enter_age"){

                        if( ( $output['ma_el_ra_year'] =="" ) || ($output['ma_el_ra_year'] < $min_age ) ) {
                            die( json_encode( array(
                                "result" => "validate" ,
                                "output" => sprintf( __( '%1$s', MELA_TD ), $_POST['error_message'] )
                            ) ) );
                        }
                    }

                    if($_POST['restrict_age']['age_type'] == "age_checkbox"){
                        // Checkbox Age Restriction
                        if( $output['ma_el_rc_check'] !="on"){
                            die( json_encode( array(
                                "result" => "validate",
                                "output" => sprintf( __( '%1$s', MELA_TD ), $_POST['error_message'] )
                            ) ) );
                        }
                    }

                    if($_POST['restrict_age']['age_type'] == "input_age"){

                        if( $output['ma_el_ra_day'] =="" || $output['ma_el_ra_month'] =="" || $output['ma_el_ra_year'] =="" ) {
                            die( json_encode( array(
                                "result" => "validate",
                                "output" => sprintf( __( '%1$s', MELA_TD ), $_POST['restrict_age']['empty_bday'] )
                            ) ) );
                        } else if( !checkdate( $output['ma_el_ra_month'], $output['ma_el_ra_day'], $output['ma_el_ra_year'] ) ) {
                            die( json_encode( array(
                                "result" => "validate",
                                "output" => sprintf( __( '%1$s', MELA_TD ), $_POST['restrict_age']['non_exist_bday'] )
                            ) ) );
                        } else{
                            $birthday = sprintf( "%04d-%02d-%02d", $output['ma_el_ra_year'], $output['ma_el_ra_month'], $output['ma_el_ra_day'] );
                            $today = new \DateTime();
                            $min = $today->modify( "-{$min_age} year" )->format( "Y-m-d" );

                            // Check if after the minimum age date
                            if( $birthday > $min ) {
                                die( json_encode( array(
                                    "result" => "validate",
                                    "output" => sprintf( __( '%1$s , minimum age %2$s', MELA_TD ), $min_age, $_POST['error_message'] )
                                ) ) );
                            }
                        }


                    }

                }

                die( json_encode( array(
                    "result" => "success",
                    "output" => ""
                ) ) );

            }// end if fields


		}



    public function jltma_domain_checker(){

            require_once MELA_PLUGIN_PATH . '/inc/classes/class-jltma-domain-checker.php';

            $succes_msg = $_POST['succes_msg'];
            $error_msg = $_POST['error_msg'];
            $not_found = $_POST['not_found'];
            $not_entered_domain = $_POST['not_entered_domain'];


            // check security field
            if( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ma-el-domain-checker' ) ) {
                wp_send_json_error(  __( 'Security Error.', MELA_TD ) );
            }


            if( ! isset( $_POST['domain'] ) ||  $_POST['domain'] == "" ){
                wp_send_json_error( $not_entered_domain );
            }

            $domain = str_replace( array( 'www.', 'http://' ), NULL, $_POST['domain'] );
            $split  = explode('.', $domain);
            if( count( $split ) == 1 ) {
                $domain = $domain . ".com";
            }
            $domain = preg_replace("/[^-a-zA-Z0-9.]+/", "", $domain);

            if( strlen( $domain ) > 0 ){


                // Class responsible for checking if a domain is registered
                $domain_check = new Master_Addons_Domain_Checker();
                $available    = $domain_check->is_available( $domain );

                switch ( $available ) {
                    case '1':
                        wp_send_json_success( sprintf( $succes_msg, '<strong>' .  $domain . '</strong> ' ) );
                        break;

                    case '0':
                        wp_send_json_error( sprintf( $error_msg, '<strong>' .  $domain . '</strong>' ) );
                        break;

                    default:
                        wp_send_json_error( $not_found );
                }

            }

            wp_send_json_error( __( 'Please enter a valid Domain name.', MELA_TD ) );
        }



    }

    // JLTMA_Ajax_Queries::get_instance();