<?php
	namespace Elementor;
	use Elementor\Widget_Base;

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Team_Members extends Widget_Base {

		public function get_name() {
			return 'ma-team-members';
		}

		public function get_title() {
			return esc_html__( 'MA Team Member', MELA_TD);
		}

		public function get_icon() {
			return 'ma-el-icon eicon-lock-user';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

			/**
			 * Team Member Content Section
			 */
			$this->start_controls_section(
				'ma_el_team_content',
				[
					'label' => esc_html__( 'Content', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_team_member_image',
				[
					'label' => __( 'Image', MELA_TD ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail',
					'default' => 'full',
					'condition' => [
						'ma_el_team_member_image[url]!' => '',
					],
				]
			);

			$this->add_control(
				'ma_el_team_member_name',
				[
					'label' => esc_html__( 'Name', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'John Doe', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_team_member_designation',
				[
					'label' => esc_html__( 'Designation', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'My Designation', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_team_member_description',
				[
					'label' => esc_html__( 'Description', MELA_TD ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Add team member details here', MELA_TD ),
				]
			);
			$this->end_controls_section();
			/*
			* Team member Social profiles section
			*/

			$this->start_controls_section(
				'ma_el_section_team_member_social_profiles',
				[
					'label' => esc_html__( 'Social Profiles', MELA_TD )
				]
			);
			$this->add_control(
				'ma_el_team_member_enable_social_profiles',
				[
					'label' => esc_html__( 'Display Social Profiles?', MELA_TD ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);


			$this->add_control(
				'ma_el_team_member_social_profile_links',
				[
					'type' => Controls_Manager::REPEATER,
					'condition' => [
						'ma_el_team_member_enable_social_profiles!' => '',
					],
					'default' => [
						[
							'social' => 'fa fa-facebook',
						],
						[
							'social' => 'fa fa-twitter',
						],
						[
							'social' => 'fa fa-google-plus',
						],
						[
							'social' => 'fa fa-linkedin',
						],
					],
					'fields' => [
						[
							'name' => 'social',
							'label' => esc_html__( 'Icon', MELA_TD ),
							'type' => Controls_Manager::ICON,
							'label_block' => true,
							'default' => 'fa fa-wordpress',
							'include' => [
								'fa fa-apple',
								'fa fa-behance',
								'fa fa-bitbucket',
								'fa fa-codepen',
								'fa fa-delicious',
								'fa fa-digg',
								'fa fa-dribbble',
								'fa fa-envelope',
								'fa fa-facebook',
								'fa fa-flickr',
								'fa fa-foursquare',
								'fa fa-github',
								'fa fa-google-plus',
								'fa fa-houzz',
								'fa fa-instagram',
								'fa fa-jsfiddle',
								'fa fa-linkedin',
								'fa fa-medium',
								'fa fa-pinterest',
								'fa fa-product-hunt',
								'fa fa-reddit',
								'fa fa-shopping-cart',
								'fa fa-slideshare',
								'fa fa-snapchat',
								'fa fa-soundcloud',
								'fa fa-spotify',
								'fa fa-stack-overflow',
								'fa fa-tripadvisor',
								'fa fa-tumblr',
								'fa fa-twitch',
								'fa fa-twitter',
								'fa fa-vimeo',
								'fa fa-vk',
								'fa fa-whatsapp',
								'fa fa-wordpress',
								'fa fa-xing',
								'fa fa-yelp',
								'fa fa-youtube',
							],
						],
						[
							'name' => 'link',
							'label' => esc_html__( 'Link', MELA_TD ),
							'type' => Controls_Manager::URL,
							'label_block' => true,
							'default' => [
								'url' => '',
								'is_external' => 'true',
							],
							'placeholder' => esc_html__( 'Place URL here', MELA_TD ),
						],
					],
					'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'fa fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
				]
			);
			$this->end_controls_section();



//
//			if(!apply_filters('maad_el/pro_enabled', false)) {
//
//				$this->start_controls_section(
//					'maad_el_section_pro',
//					[
//						'label' => esc_html__( 'Upgrade to Pro Version for More Features', MELA_TD )
//					]
//				);
//
//				$this->add_control(
//					'maad_el_control_get_pro',
//					[
//						'label' => esc_html__( 'Unlock more possibilities', MELA_TD ),
//						'type' => Controls_Manager::CHOOSE,
//						'options' => [
//							'1' => [
//								'title' => esc_html__( '', MELA_TD ),
//								'icon' => 'fa fa-unlock-alt',
//							],
//						],
//						'default' => '1',
//						'description' => '<span class="pro-feature"> Upgrade to  <a href="https://jeweltheme.com/shop/master-addons-elementor/" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
//					]
//				);
//
//				$this->end_controls_section();
//			}
//


			/*
			* Team Members Styling Section
			*/
			$this->start_controls_section(
				'ma_el_section_team_members_styles_preset',
				[
					'label' => esc_html__( 'General Styles', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);
			$this->add_control(
				'ma_el_team_members_preset',
				[
					'label' => esc_html__( 'Style Preset', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'default' => '-basic',
					'options' => [
						'-basic' => esc_html__( 'Basic', MELA_TD ),
						'-circle' => esc_html__( 'Circle Gradient', MELA_TD ),
						'-social-left' => esc_html__( 'Social Left on Hover', MELA_TD ),
						'-rounded' => esc_html__( 'Rounded', MELA_TD ),
						'-content-hover' => esc_html__( 'Content on Hover', MELA_TD ),
						'-style6' => esc_html__( 'Style 6', MELA_TD ),
					],
				]
			);

			$this->add_control(
				'ma_el_team_members_avatar_bg',
				[
					'label' => esc_html__( 'Avatar Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#826EFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-circle .ma-el-team-member-thumb svg.team-avatar-bg' => 'fill: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_members_preset' => '-circle',
					],
				]
			);

			$this->add_control(
				'ma_el_team_members_bg',
				[
					'label' => esc_html__( 'Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#f9f9f9',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-basic, {{WRAPPER}} .ma-el-team-member-circle, {{WRAPPER}} .ma-el-team-member-social-left, {{WRAPPER}} .ma-el-team-member-rounded' => 'background: {{VALUE}};',
					],
				]
			);


			$this->end_controls_section();


			// Name, Designation , About Font Color and Typography

			$this->start_controls_section(
				'section_team_carousel_name',
				[
					'label' => __('Name', MELA_TD),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'ma_el_title_color',
				[
					'label' => __('Color', MELA_TD),
					'type' => Controls_Manager::COLOR,
					'default' => '#000',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-name' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ma-el-team-member-name',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_team_member_designation',
				[
					'label' => __('Designation', MELA_TD),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'ma_el_designation_color',
				[
					'label' => __('Color', MELA_TD),
					'type' => Controls_Manager::COLOR,
					'default' => '#8a8d91',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-designation' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'designation_typography',
					'selector' => '{{WRAPPER}} .ma-el-team-member-designation',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_team_carousel_description',
				[
					'label' => __('Description', MELA_TD),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'ma_el_description_color',
				[
					'label' => __('Color', MELA_TD),
					'type' => Controls_Manager::COLOR,
					'default' => '#8a8d91',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-about' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'ma_el_description_typography',
					'selector' => '{{WRAPPER}} .ma-el-team-member-about',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'ma_el_team_member_social_section',
				[
					'label' => __('Social', MELA_TD),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'ma_el_team_members_social_icons_style_tabs' );

			$this->start_controls_tab( 'ma_el_team_members_social_icon_tab', [ 'label' => esc_html__( 'Normal',
				MELA_TD )
			] );

			$this->add_control(
				'ma_el_team_member_social_color_1',
				[
					'label' => esc_html__( 'Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-social-left .ma-el-team-member-social li a' => 'background: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_members_preset' => '-social-left',
					],
				]
			);

			$this->add_control(
				'ma_el_team_member_social_color_2',
				[
					'label' => esc_html__( 'Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#272c44',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-rounded .ma-el-team-member-social li a' => 'background: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_members_preset' => '-rounded',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'ma_el_team_members_social_icon_hover', [ 'label' => esc_html__( 'Hover',
				MELA_TD )
			] );

			$this->add_control(
				'ma_el_team_member_social_hover_color_1',
				[
					'label' => esc_html__( 'Hover Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ff6d55',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-social-left .ma-el-team-member-social li a:hover' => 'background: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_members_preset' => '-social-left'
					],
				]
			);

			$this->add_control(
				'ma_el_team_member_social_hover_color_2',
				[
					'label' => esc_html__( 'Hover Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ff6d55',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-rounded .ma-el-team-member-social li a:hover' => 'background: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_members_preset' => '-rounded'
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();


		}
		protected function render() {
			$settings = $this->get_settings_for_display();
			$team_member_image = $this->get_settings_for_display( 'ma_el_team_member_image' );
			$team_member_image_url_src = wp_get_attachment_image_src( $team_member_image['id'], 'master_addons_team_thumb', $settings );
			if( empty( $team_member_image_url_src ) ) {
				$team_member_image_url = $team_member_image['url'];
			} else {
				$team_member_image_url = $team_member_image_url_src[0];
			}

			?>

			<?php if( $settings['ma_el_team_members_preset'] == '-style6' ) { ?>

                <div id="ma-el-team-member-slider" class="ma-el-team-member-slider owl-carousel owl-theme">
                    <div class="ma-el-member-container">
                        <div class="ma-el-inner-container">
                            <img src="<?php echo esc_url($team_member_image_url); ?>" alt="<?php echo $settings['ma_el_team_member_name']; ?>">
                            <div class="ma-el-member-details">
                                <h4 class="name">
                                    <?php echo $settings['ma_el_team_member_name']; ?>
                                </h4>
                                <p class="designation">
                                    <?php echo $settings['ma_el_team_member_designation']; ?>
                                </p>
                                <p>
                                    <?php echo $settings['ma_el_team_member_description']; ?>
                                </p>

                                <div class="member-social-link">

                                    <?php if ( $settings['ma_el_team_member_enable_social_profiles'] == 'yes' ): ?>
                                        <?php foreach ( $settings['ma_el_team_member_social_profile_links'] as $item ) : ?>
                                            <?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
                                                <a href="<?php echo esc_attr( $item['link']['url'] ); ?>"
                                                    <?php echo $target; ?>>
                                                    <i class="<?php echo esc_attr($item['social'] ); ?>"></i>
                                                </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            </div><!-- /.member-details -->
                        </div><!-- /.inner-container -->
                    </div><!-- /.member-container -->
                </div><!-- /.ma-el-team-member-slider -->

            <?php } else{ ?>


                <div id="ma-el-team-member-<?php echo esc_attr($this->get_id()); ?>" class="ma-el-team-item">
                    <div class="ma-el-team-member<?php echo $settings['ma_el_team_members_preset']; ?>">
                        <div class="ma-el-team-member-thumb">
                            <?php if( $settings['ma_el_team_members_preset'] == '-circle' ) : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
                                    <path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
                                    <path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
                                    <path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
                                </svg>
                            <?php endif; ?>
                            <img src="<?php echo esc_url($team_member_image_url); ?>" class="circled" alt="<?php echo
                            $settings['ma_el_team_member_name']; ?>">
                        </div>
                        <div class="ma-el-team-member-content">
                            <h2 class="ma-el-team-member-name"><?php echo $settings['ma_el_team_member_name']; ?></h2>
                            <span class="ma-el-team-member-designation"><?php echo $settings['ma_el_team_member_designation'];
                                ?></span>
                            <p class="ma-el-team-member-about">
                                <?php echo $settings['ma_el_team_member_description']; ?>
                            </p>
                            <?php if ( $settings['ma_el_team_member_enable_social_profiles'] == 'yes' ): ?>
                                <ul class="list-inline ma-el-team-member-social">
                                    <?php foreach ( $settings['ma_el_team_member_social_profile_links'] as $item ) : ?>

                                        <?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
                                        <li>
                                            <a href="<?php echo esc_attr( $item['link']['url'] ); ?>"<?php echo $target; ?>><i class="<?php echo esc_attr($item['social'] ); ?>"></i></a>
                                        </li>

                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php } ?>


			<?php
		}

		protected function _content_template() { ?>

            <# if ( '-style6' == settings.ma_el_team_members_preset ) { #>

                <div id="ma-el-team-member-slider" class="ma-el-team-member-slider owl-carousel owl-theme">

                    <div class="item">
                        <div class="member-container">
                            <div class="inner-container">
                                <img src="{{ settings.ma_el_team_member_image.url }}" alt="{{ settings.ma_el_team_member_name }}">
                                <div class="member-details">
                                    <h4 class="name">
                                        {{ settings.ma_el_team_member_name }}
                                    </h4>
                                    <p class="designation">
                                        {{ settings.ma_el_team_member_designation }}
                                    </p>
                                    <p>
                                        {{ settings.ma_el_team_member_description }}
                                    </p>
                                    <div class="member-social-link">

                                        <# if ( 'yes' == settings.ma_el_team_member_enable_social_profiles ) { #>

                                            <# _.each( settings.ma_el_team_member_social_profile_links, function( item, index ) { #>

                                            <# var target = item.link.is_external ? ' target="_blank"' : '' #>

                                                <a href="{{ item.link.url }}" {{{ target }}}><i class="{{ item.social }}"></i></a>

                                            <# }); #>

                                        <# } #>


                                    </div>
                                </div><!-- /.member-details -->
                            </div><!-- /.inner-container -->
                        </div><!-- /.member-container -->
                    </div><!-- /.item -->

                </div><!-- /.ma-el-team-member-slider -->

            <# } else{ #>


                    <div id="ma-el-team-member" class="ma-el-team-item">
                        <div class="ma-el-team-member{{ settings.ma_el_team_members_preset }}">
                            <div class="ma-el-team-member-thumb">
                                <# if ( '-circle' == settings.ma_el_team_members_preset ) { #>
                                <svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
                                    <path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
                                    <path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
                                    <path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
                                </svg>
                                <# } #>
                                <img src="{{ settings.ma_el_team_member_image.url }}" class="circled" alt="{{ settings
                                .ma_el_team_member_name }}">
                            </div>
                            <div class="ma-el-team-member-content">
                                <h2 class="ma-el-team-member-name">{{{ settings.ma_el_team_member_name }}}</h2>
                                <span class="ma-el-team-member-designation">{{{ settings.ma_el_team_member_designation
                                    }}}</span>
                                <p class="ma-el-team-member-about">{{{ settings.ma_el_team_member_description }}}</p>
                                <# if ( 'yes' == settings.ma_el_team_member_enable_social_profiles ) { #>
                                <ul class="list-inline ma-el-team-member-social">
                                    <# _.each( settings.ma_el_team_member_social_profile_links, function( item, index ) { #>

                                    <# var target = item.link.is_external ? ' target="_blank"' : '' #>
                                    <li>
                                        <a href="{{ item.link.url }}" {{{ target }}}><i class="{{ item.social }}"></i></a>
                                    </li>

                                    <# }); #>
                                </ul>
                                <# } #>
                            </div>
                        </div>
                    </div>

            <# } #>



			<?php
		}

	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Team_Members() );