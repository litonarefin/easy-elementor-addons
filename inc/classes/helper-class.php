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


		// Get all forms of Ninja Forms plugin
		public static function ma_el_get_ninja_forms() {
			if ( class_exists( 'Ninja_Forms' ) ) {
				$options = array();

				$contact_forms = Ninja_Forms()->form()->get_forms();

				if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {

					$i = 0;

					foreach ( $contact_forms as $form ) {
						if ( $i == 0 ) {
							$options[0] = esc_html__( 'Select a Contact form', MELA_TD );
						}
						$options[ $form->get_id() ] = $form->get_setting( 'title' );
						$i++;
					}
				}
			} else {
				$options = array();
			}

			return $options;
		}


		// Get all forms of WPForms plugin
		public static function ma_el_get_wpforms_forms() {
			if ( class_exists( 'WPForms' ) ) {
				$options = array();

				$args = array(
					'post_type'         => 'wpforms',
					'posts_per_page'    => -1
				);

				$contact_forms = get_posts( $args );

				if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {

					$i = 0;

					foreach ( $contact_forms as $post ) {
						if ( $i == 0 ) {
							$options[0] = esc_html__( 'Select a Contact form', MELA_TD );
						}
						$options[ $post->ID ] = $post->post_title;
						$i++;
					}
				}
			} else {
				$options = array();
			}

			return $options;
		}


		// get weForms
		public static function ma_el_get_weforms() {
			$wpuf_form_list = get_posts(array(
				'post_type' => 'wpuf_contact_form',
				'showposts' => 999,
			));

			$options = array();

			if (!empty($wpuf_form_list) && !is_wp_error($wpuf_form_list)) {
				$options[0] = esc_html__('Select weForm', MELA_TD);
				foreach ($wpuf_form_list as $post) {
					$options[$post->ID] = $post->post_title;
				}
			} else {
				$options[0] = esc_html__('Create a Form First', MELA_TD);
			}

			return $options;
		}

		// Get forms of Caldera plugin
		public static function ma_el_get_caldera_forms() {
			if ( class_exists( 'Caldera_Forms' ) ) {
				$options = array();

				$contact_forms = Caldera_Forms_Forms::get_forms( true, true );

				if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {

					$i = 0;

					foreach ( $contact_forms as $form ) {
						if ( $i == 0 ) {
							$options[0] = esc_html__( 'Select a Contact form', MELA_TD );
						}
						$options[ $form['ID'] ] = $form['name'];
						$i++;
					}
				}
			} else {
				$options = array();
			}

			return $options;
		}


		// Get forms of Gravity Forms plugin
		public static function ma_el_get_gravity_forms() {
			if ( class_exists( 'GFCommon' ) ) {
				$options = array();

				$contact_forms = \RGFormsModel::get_forms( null, 'title' );

				if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {

					$i = 0;

					foreach ( $contact_forms as $form ) {
						if ( $i == 0 ) {
							$options[0] = esc_html__( 'Select a Contact form', MELA_TD );
						}
						$options[ $form->id ] = $form->title;
						$i++;
					}
				}
			} else {
				$options = array();
			}

			return $options;
		}

		// Title Tags
		public static function ma_el_title_tags() {
			$title_tags = [
				'h1'   => esc_html__( 'H1', MELA_TD ),
				'h2'   => esc_html__( 'H2', MELA_TD ),
				'h3'   => esc_html__( 'H3', MELA_TD ),
				'h4'   => esc_html__( 'H4', MELA_TD ),
				'h5'   => esc_html__( 'H5', MELA_TD ),
				'h6'   => esc_html__( 'H6', MELA_TD ),
				'div'  => esc_html__( 'div', MELA_TD ),
				'span' => esc_html__( 'span', MELA_TD ),
				'p'    => esc_html__( 'p', MELA_TD ),
			];

			return $title_tags;
		}


	}