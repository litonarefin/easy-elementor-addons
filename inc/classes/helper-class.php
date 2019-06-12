<?php
	namespace Elementor;

	class Master_Addons_Helper{

		/**
		 * Retrive the list of Contact Form 7 Forms [ if plugin activated ]
		 */

		public static function maad_el_retrive_cf7() {
			if ( function_exists( 'wpcf7' ) ) {
				$wpcf7_form_list = get_posts(array(
					'post_type' => 'wpcf7_contact_form',
					'showposts' => 999,
				));
				$options = array();
				$options[0] = esc_html__( 'Select a Form', MELA_TD );
				if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ){
					foreach ( $wpcf7_form_list as $post ) {
						$options[ $post->ID ] = $post->post_title;
					}
				} else {
					$options[0] = esc_html__( 'Create a Form First', MELA_TD );
				}
				return $options;
			}
		}

		public static function ma_get_page_templates( $type = '' ) {
			$args = [
				'post_type'         => 'elementor_library',
				'posts_per_page'    => -1,
			];

			if ( $type ) {
				$args['tax_query'] = [
					[
						'taxonomy' => 'elementor_library_type',
						'field'    => 'slug',
						'terms' => $type,
					]
				];
			}

			$page_templates = get_posts( $args );

			$options = array();

			if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
				foreach ( $page_templates as $post ) {
					$options[ $post->ID ] = $post->post_title;
				}
			}
			return $options;
		}




	}