<?php
	namespace Elementor;
	use Elementor\Widget_Base;

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Team_Members_Carousel extends Widget_Base {

		public function get_name() {
			return 'ma-team-members-slider';
		}

		public function get_title() {
			return esc_html__( 'MA Team Members Carousel', MELA_TD);
		}

		public function get_icon() {
			return 'ma-el-icon eicon-person';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		public function get_script_depends() {
			return [ 'jquery-slick', 'gridder' ];
		}

		public function get_style_depends() {
			return [ 'gridder' ];
		}


		protected function _register_controls() {

			$this->start_controls_section(
				'section_team_carousel',
				[
					'label' => esc_html__( 'Contents', MELA_TD ),
				]
			);

			$team_repeater = new Repeater();

			/*
			* Team Member Image
			*/
			$team_repeater->add_control(
				'ma_el_team_carousel_image',
				[
					'label' => __( 'Image', MELA_TD ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);
			$team_repeater->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail',
					'default' => 'full',
					'condition' => [
						'ma_el_team_carousel_image[url]!' => '',
					],
				]
			);

			$team_repeater->add_control(
				'ma_el_team_carousel_name',
				[
					'label' => esc_html__( 'Name', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'John Doe', MELA_TD ),
				]
			);

			$team_repeater->add_control(
				'ma_el_team_carousel_designation',
				[
					'label' => esc_html__( 'Designation', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'My Designation', MELA_TD ),
				]
			);

			$team_repeater->add_control(
				'ma_el_team_carousel_description',
				[
					'label' => esc_html__( 'Description', MELA_TD ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Add team member details here', MELA_TD ),
				]
			);

			$team_repeater->add_control(
				'ma_el_team_carousel_enable_social_profiles',
				[
					'label' => esc_html__( 'Display Social Profiles?', MELA_TD ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

			$team_repeater->add_control(
				'ma_el_team_carousel_facebook_link',
				[
					'label' => __( 'Facebook URL', MELA_TD ),
					'type' => Controls_Manager::URL,
					'condition' => [
						'ma_el_team_carousel_enable_social_profiles!' => '',
					],
					'placeholder' => __( 'https://master-addons.com', MELA_TD ),
					'label_block' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
					],
				]
			);

			$team_repeater->add_control(
				'ma_el_team_carousel_twitter_link',
				[
					'label' => __( 'Twitter URL', MELA_TD ),
					'type' => Controls_Manager::URL,
					'condition' => [
						'ma_el_team_carousel_enable_social_profiles!' => '',
					],
					'placeholder' => __( 'https://master-addons.com', MELA_TD ),
					'label_block' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
					],
				]
			);

			$team_repeater->add_control(
				'ma_el_team_carousel_instagram_link',
				[
					'label' => __( 'Instagram URL', MELA_TD ),
					'type' => Controls_Manager::URL,
					'condition' => [
						'ma_el_team_carousel_enable_social_profiles!' => '',
					],
					'placeholder' => __( 'https://master-addons.com', MELA_TD ),
					'label_block' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
					],
				]
			);

			$team_repeater->add_control(
				'ma_el_team_carousel_linkedin_link',
				[
					'label' => __( 'Linkedin URL', MELA_TD ),
					'type' => Controls_Manager::URL,
					'condition' => [
						'ma_el_team_carousel_enable_social_profiles!' => '',
					],
					'placeholder' => __( 'https://master-addons.com', MELA_TD ),
					'label_block' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
					],
				]
			);

			$team_repeater->add_control(
				'ma_el_team_carousel_dribbble_link',
				[
					'label' => __( 'Dribbble URL', MELA_TD ),
					'type' => Controls_Manager::URL,
					'condition' => [
						'ma_el_team_carousel_enable_social_profiles!' => '',
					],
					'placeholder' => __( 'https://master-addons.com', MELA_TD ),
					'label_block' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
					],
				]
			);


			$this->add_control(
				'team_carousel_repeater',
				[
					'label' => esc_html__( 'Team Carousel', MELA_TD ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $team_repeater->get_controls(),
					'title_field' => '{{{ ma_el_team_carousel_name }}}',
					'default' => [
						[
							'ma_el_team_carousel_name' => __( 'Member #1', MELA_TD ),
							'ma_el_team_carousel_description' => __( 'Add team member details here', MELA_TD ),
						],
						[
							'ma_el_team_carousel_name' => __( 'Member #2', MELA_TD ),
							'ma_el_team_carousel_description' => __( 'Add team member details here', MELA_TD ),
						],
						[
							'ma_el_team_carousel_name' => __( 'Member #3', MELA_TD ),
							'ma_el_team_carousel_description' => __( 'Add team member details here', MELA_TD ),
						],
						[
							'ma_el_team_carousel_name' => __( 'Member #4', MELA_TD ),
							'ma_el_team_carousel_description' => __( 'Add team member details here', MELA_TD ),
						],
					]
				]
			);


			$this->end_controls_section();

			/*
			* Team Members Styling Section
			*/
			$this->start_controls_section(
				'ma_el_section_team_carousel_styles_preset',
				[
					'label' => esc_html__( 'General Styles', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);

			// Premium Version Codes
			if ( ma_el_fs()->can_use_premium_code() ) {
				$this->add_control(
					'ma_el_team_carousel_preset',
					[
						'label' => esc_html__( 'Style Preset', MELA_TD ),
						'type' => Controls_Manager::SELECT,
						'default' => '-circle',
						'options' => [
							'-default'              => esc_html__( 'Team Carousel', MELA_TD ),
							'-circle'               => esc_html__( 'Circle Gradient', MELA_TD ),
							'-social-left'          => esc_html__( 'Social Left on Hover', MELA_TD ),
							'-content-hover'        => esc_html__( 'Content on Hover', MELA_TD ),
							'-content-drawer'       => esc_html__( 'Content Drawer', MELA_TD ),
						],
					]
				);

			} else{
				$this->add_control(
					'ma_el_team_carousel_preset',
					[
						'label' => esc_html__( 'Style Preset', MELA_TD ),
						'type' => Controls_Manager::SELECT,
						'default' => '-circle',
						'options' => [
							'-default'                    => esc_html__( 'Team Carousel', MELA_TD ),
							'-circle'                     => esc_html__( 'Circle Gradient', MELA_TD ),
							'-content-hover'              => esc_html__( 'Content on Hover', MELA_TD ),
//							'-pro-team-slider-1'          => esc_html__( 'Social Left on Hover (Pro)', MELA_TD ),
//							'-pro-team-slider-2'          => esc_html__( 'Content Drawer (Pro)', MELA_TD ),
							'-social-left'          => esc_html__( 'Social Left on Hover', MELA_TD ),
							'-content-drawer'       => esc_html__( 'Content Drawer', MELA_TD ),
						],
						'description' => sprintf( '2+ more Variations on <a href="%s" target="_blank">%s</a>',
							esc_url_raw( admin_url('admin.php?page=master-addons-settings-pricing') ),
							__( 'Upgrade Now', MELA_TD ) )
					]
				);

			}


			$this->add_responsive_control(
				'ma_el_team_carousel_item_gap',
				[
					'label' => __( 'Item Padding', MELA_TD ),
					'type' => Controls_Manager::SLIDER,
					'size_units'    => ['px', '%' ,'em'],
					'condition' => [
						'ma_el_team_carousel_preset' => ['-default','-circle','-content-drawer']
					],
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-carousel-wrapper .slick-track .ma-el-team-carousel-default-inner,
						{{WRAPPER}} .ma-el-team-carousel-wrapper .slick-track .ma-el-team-carousel-circle-inner,
						{{WRAPPER}} .gridder .gridder-list' => 'padding: {{SIZE}}{{UNIT}};'
					]
				]
			);


			$this->add_control(
				'ma_el_team_carousel_avatar_bg',
				[
					'label' => esc_html__( 'Avatar Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#826EFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-circle .ma-el-team-member-thumb svg.team-avatar-bg' => 'fill: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_carousel_preset' => '-circle',
					],
				]
			);

			$this->add_control(
				'ma_el_team_carousel_bg',
				[
					'label' => esc_html__( 'Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#f9f9f9',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-basic, 
						{{WRAPPER}} .ma-el-team-member-circle, 
						{{WRAPPER}} .ma-el-team-member-social-left, 
						{{WRAPPER}} .ma-el-team-member-rounded' => 'background: {{VALUE}};',
						'{{WRAPPER}} .gridder .gridder-show' => 'background-color: {{VALUE}};',
					],
				]
			);


			$this->end_controls_section();


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
						'{{WRAPPER}} .ma-el-team-member-about,
						{{WRAPPER}} .gridder-expanded-content p.ma-el-team-member-desc' => 'color: {{VALUE}};',
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
				'section_carousel_settings',
				[
					'label' => esc_html__( 'Carousel Settings', MELA_TD ),
				]
			);

			$slides_per_view = range( 1, 6 );
			$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

			$this->add_control(
				'ma_el_team_per_view',
				[
					'type'           => Controls_Manager::SELECT,
					'label'          => esc_html__( 'Columns', MELA_TD ),
					'options'        => $slides_per_view,
					'default'        => '3',
				]
			);

			$this->add_control(
				'ma_el_team_slides_to_scroll',
				[
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Items to Scroll', MELA_TD ),
					'options'   => $slides_per_view,
					'default'   => '1',
				]
			);

			$this->add_control(
				'ma_el_team_carousel_nav',
				[
					'label' => esc_html__( 'Navigation Style', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'default' => 'arrows',
					'separator' => 'before',
					'options' => [
						'arrows' => esc_html__( 'Arrows', MELA_TD ),
						'dots' => esc_html__( 'Dots', MELA_TD ),

					],
				]
			);


			$this->start_controls_tabs( 'ma_el_team_carousel_navigation_tabs' );

			$this->start_controls_tab( 'ma_el_team_carousel_navigation_control', [ 'label' => esc_html__( 'Normal', MELA_TD
			) ] );

			$this->add_control(
				'ma_el_team_carousel_arrow_color',
				[
					'label' => esc_html__( 'Arrow Background', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#b8bfc7',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-carousel-prev, {{WRAPPER}} .ma-el-team-carousel-next' => 'background: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_carousel_nav' => 'arrows',
					],
				]
			);

			$this->add_control(
				'ma_el_team_carousel_dot_color',
				[
					'label' => esc_html__( 'Dot Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#8a8d91',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-carousel-wrapper .slick-dots li button' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_carousel_nav' => 'dots',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'ma_el_team_carousel_social_icon_hover', [ 'label' => esc_html__( 'Hover', MELA_TD )
			] );

			$this->add_control(
				'ma_el_team_carousel_arrow_hover_color',
				[
					'label' => esc_html__( 'Arrow Hover', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#917cff',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-carousel-prev:hover, {{WRAPPER}} .ma-el-team-carousel-next:hover' =>
							'background: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_carousel_nav' => 'arrows',
					],
				]
			);

			$this->add_control(
				'ma_el_team_carousel_dot_hover_color',
				[
					'label' => esc_html__( 'Dot Hover', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#8a8d91',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-carousel-wrapper .slick-dots li.slick-active button, {{WRAPPER}} .ma-el-team-carousel-wrapper .slick-dots li button:hover' => 'background: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_carousel_nav' => 'dots',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'ma_el_team_transition_duration',
				[
					'label'   => esc_html__( 'Transition Duration', MELA_TD ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 1000,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'ma_el_team_autoplay',
				[
					'label'     => esc_html__( 'Autoplay', MELA_TD ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
				]
			);

			$this->add_control(
				'ma_el_team_autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', MELA_TD ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 5000,
					'condition' => [
						'ma_el_team_autoplay' => 'yes',
					],
				]
			);

			$this->add_control(
				'ma_el_team_loop',
				[
					'label'   => esc_html__( 'Infinite Loop', MELA_TD ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

			$this->add_control(
				'ma_el_team_pause',
				[
					'label'     => esc_html__( 'Pause on Hover', MELA_TD ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'condition' => [
						'ma_el_team_autoplay' => 'yes',
					],
				]
			);

			$this->end_controls_section();



			if ( ma_el_fs()->is_not_paying() ) {

				$this->start_controls_section(
					'maad_el_section_pro',
					[
						'label' => esc_html__( 'Upgrade to Pro Version for More Features', MELA_TD )
					]
				);

				$this->add_control(
					'maad_el_control_get_pro',
					[
						'label' => esc_html__( 'Unlock more possibilities', MELA_TD ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'1' => [
								'title' => esc_html__( '', MELA_TD ),
								'icon' => 'fa fa-unlock-alt',
							],
						],
						'default' => '1',
						'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
					]
				);

				$this->end_controls_section();
			}




			$this->start_controls_section(
				'ma_el_team_carousel_social_section',
				[
					'label' => __('Social', MELA_TD),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'ma_el_team_carousel_preset' => ['-social-left', '-default'],
					],
				]
			);

			$this->start_controls_tabs( 'ma_el_team_carousel_social_icons_style_tabs' );

			$this->start_controls_tab( 'ma_el_team_carousel_social_icon_control',
				[ 'label' => esc_html__( 'Normal', MELA_TD ) ]
			);

			$this->add_control(
				'ma_el_team_carousel_social_icon_color',
				[
					'label' => esc_html__( 'Icon Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-social li a' => 'color: {{VALUE}};'
					],
				]
			);

			$this->add_control(
				'ma_el_team_carousel_social_color_1',
				[
					'label' => esc_html__( 'Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-social-left .ma-el-team-member-social li a' => 'background: {{VALUE}};'
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'ma_el_team_carousel_social_icon_hover_control',
				[ 'label' => esc_html__( 'Hover', MELA_TD ) ]
			);

			$this->add_control(
				'ma_el_team_carousel_social_icon_hover_color',
				[
					'label' => esc_html__( 'Icon Hover Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-social li a:hover' => 'color: {{VALUE}};'
					],
				]
			);


			$this->add_control(
				'ma_el_team_carousel_social_hover_bg_color_1',
				[
					'label' => esc_html__( 'Hover Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ff6d55',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-social-left .ma-el-team-member-social li a:hover' => 'background: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();


			if ( ma_el_fs()->is_not_paying() ) {

				$this->start_controls_section(
					'ma_el_section_pro_style_section',
					[
						'label' => esc_html__( 'Upgrade to Pro Version for More Features', MELA_TD ),
						'tab' => Controls_Manager::TAB_STYLE
					]
				);

				$this->add_control(
					'ma_el_control_get_pro_style_tab',
					[
						'label' => esc_html__( 'Unlock more possibilities', MELA_TD ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'1' => [
								'title' => esc_html__( '', MELA_TD ),
								'icon' => 'fa fa-unlock-alt',
							],
						],
						'default' => '1',
						'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with 
Customization Options.</span>'
					]
				);

				$this->end_controls_section();
			}


		}


		protected function render() {
			$settings = $this->get_settings_for_display();

			$team_carousel_classes = $this->get_settings_for_display('ma_el_team_carousel_image_rounded');

			$team_preset = $settings['ma_el_team_carousel_preset'];


			$this->add_render_attribute(
				'ma_el_team_carousel',
				[
					'class' => [ 'ma-el-team-carousel-wrapper', 'ma-el-team-carousel' . $team_preset ],
					'data-team-preset' => $team_preset,
					'data-carousel-nav' => $settings['ma_el_team_carousel_nav'],
					'data-slidestoshow' => $settings['ma_el_team_per_view'],
					'data-slidestoscroll' => $settings['ma_el_team_slides_to_scroll'],
					'data-speed' => $settings['ma_el_team_transition_duration'],
				]
			);

			if ( $settings['ma_el_team_autoplay'] == 'yes' ) {
				$this->add_render_attribute( 'ma_el_team_carousel', 'data-autoplay', "true");
				$this->add_render_attribute( 'ma_el_team_carousel', 'data-autoplayspeed', $settings['ma_el_team_autoplay_speed'] );
			}

			if ( $settings['ma_el_team_pause'] == 'yes' ) {
				$this->add_render_attribute( 'ma_el_team_carousel', 'data-pauseonhover', "true" );
			}

			if ( $settings['ma_el_team_loop'] == 'yes' ) {
				$this->add_render_attribute( 'ma_el_team_carousel', 'data-loop', "true");
			}
			?>



			<?php if( $team_preset == '-content-drawer' ) { ?>

                <!-- Gridder navigation -->
                <ul class="gridder">

					<?php foreach ( $settings['team_carousel_repeater'] as $key => $member ) {

						$team_carousel_image = $member['ma_el_team_carousel_image'];
						$team_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_carousel_image['id'], 'thumbnail', $member );
						if( empty( $team_carousel_image_url ) ) :
							$team_carousel_image_url = $team_carousel_image['url'];
						else:
							$team_carousel_image_url = $team_carousel_image_url;
						endif;

						?>

                        <li class="gridder-list" data-griddercontent="#ma-el-team<?php echo $key+1;?>">
                            <img src="<?php echo esc_url($team_carousel_image_url); ?>" class="circled"
                                 alt="<?php echo $member['ma_el_team_carousel_name']; ?>">
                            <div class="ma-team-drawer-hover-content">

                                <h2 class="ma-el-team-member-name">
                                    <?php echo $member['ma_el_team_carousel_name'];?>
                                </h2>

                                <span class="ma-el-team-member-designation">
                                    <?php echo $member['ma_el_team_carousel_designation']; ?>
                                </span>
                            </div>
                        </li>

					<?php } ?>
                </ul>

                <!-- Gridder content -->
				<?php foreach ( $settings['team_carousel_repeater'] as $key => $member ) { ?>

                    <div id="ma-el-team<?php echo $key+1;?>" class="gridder-content">
                        <div class="content-left">
                            <span class="ma-el-team-member-designation"><?php echo $member['ma_el_team_carousel_designation']; ?></span>
                            <h2 class="ma-el-team-member-name"><?php echo $member['ma_el_team_carousel_name'];?></h2>
							<p class="ma-el-team-member-desc">
                                <?php echo $this->parse_text_editor( $member['ma_el_team_carousel_description'] ); ?>
                            </p>
                        </div>

                        <div class="content-right">
							<?php if ( $member['ma_el_team_carousel_enable_social_profiles'] == 'yes' ): ?>
                                <ul class="list-inline ma-el-team-member-social">

									<?php if ( ! empty( $member['ma_el_team_carousel_facebook_link']['url'] ) ) : ?>
										<?php $target = $member['ma_el_team_carousel_facebook_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                        <li>
                                            <a href="<?php echo esc_url( $member['ma_el_team_carousel_facebook_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-facebook"></i></a>
                                        </li>
									<?php endif; ?>

									<?php if ( ! empty( $member['ma_el_team_carousel_twitter_link']['url'] ) ) : ?>
										<?php $target = $member['ma_el_team_carousel_twitter_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                        <li>
                                            <a href="<?php echo esc_url( $member['ma_el_team_carousel_twitter_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-twitter"></i></a>
                                        </li>
									<?php endif; ?>

									<?php if ( ! empty( $member['ma_el_team_carousel_instagram_link']['url'] ) ) : ?>
										<?php $target = $member['ma_el_team_carousel_instagram_link']['is_external'] ?
											' target="_blank"' : ''; ?>
                                        <li>
                                            <a href="<?php echo esc_url(
												$member['ma_el_team_carousel_instagram_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-instagram"></i></a>
                                        </li>
									<?php endif; ?>

									<?php if ( ! empty( $member['ma_el_team_carousel_linkedin_link']['url'] ) ) : ?>
										<?php $target = $member['ma_el_team_carousel_linkedin_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                        <li>
                                            <a href="<?php echo esc_url( $member['ma_el_team_carousel_linkedin_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-linkedin"></i></a>
                                        </li>
									<?php endif; ?>

									<?php if ( ! empty( $member['ma_el_team_carousel_dribbble_link']['url'] ) ) : ?>
										<?php $target = $member['ma_el_team_carousel_dribbble_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                        <li>
                                            <a href="<?php echo esc_url( $member['ma_el_team_carousel_dribbble_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-dribbble"></i></a>
                                        </li>
									<?php endif; ?>

                                </ul>
							<?php endif; ?>
                        </div>
                    </div>
				<?php } ?>

			<?php } else { ?>


                <div <?php echo $this->get_render_attribute_string( 'ma_el_team_carousel' ); ?>>

                        <?php foreach ( $settings['team_carousel_repeater'] as $key => $member ) :

                            $team_carousel_image = $member['ma_el_team_carousel_image'];
                            $team_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_carousel_image['id'], 'thumbnail', $member );
                            if( empty( $team_carousel_image_url ) ) : $team_carousel_image_url = $team_carousel_image['url']; else: $team_carousel_image_url = $team_carousel_image_url; endif;

                            ?>
                            <div class="ma-el-team-carousel<?php echo $team_preset; ?>-inner">
                                <div class="ma-el-team-member<?php echo $team_preset; ?> text-center">
                                    <div class="ma-el-team-member-thumb">
                                        <?php if( $team_preset == '-circle' ) : ?>
<!--                                            <svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">-->
<!--                                                <path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>-->
<!--                                            </svg>-->
<!--                                            <svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">-->
<!--                                                <path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>-->
<!--                                            </svg>-->
<!--                                            <svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">-->
<!--                                                <path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>-->
<!--                                            </svg>-->

                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="125" height="125" viewBox="0 0 125 125">
                                                <image id="Vector_Smart_Object" data-name="Vector Smart Object" y="1" width="125" height="121" xlink:href="data:img/png;base64,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"/>
                                            </svg>



                                        <?php endif; ?>
                                        <img src="<?php echo esc_url($team_carousel_image_url); ?>" class="circled"
                                             alt="<?php echo $member['ma_el_team_carousel_name']; ?>">
                                    </div>
                                    <div class="ma-el-team-member-content">
                                        <h2 class="ma-el-team-member-name"><?php echo $member['ma_el_team_carousel_name'];
                                            ?></h2>
                                        <span class="ma-el-team-member-designation"><?php echo $member['ma_el_team_carousel_designation']; ?></span>
                                        <p class="ma-el-team-member-about">
                                            <?php echo $member['ma_el_team_carousel_description']; ?>
                                        </p>
                                        <?php if ( $member['ma_el_team_carousel_enable_social_profiles'] == 'yes' ): ?>
                                            <ul class="list-inline ma-el-team-member-social">

                                                <?php if ( ! empty( $member['ma_el_team_carousel_facebook_link']['url'] ) ) : ?>
                                                    <?php $target = $member['ma_el_team_carousel_facebook_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                                    <li>
                                                        <a href="<?php echo esc_url( $member['ma_el_team_carousel_facebook_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ( ! empty( $member['ma_el_team_carousel_twitter_link']['url'] ) ) : ?>
                                                    <?php $target = $member['ma_el_team_carousel_twitter_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                                    <li>
                                                        <a href="<?php echo esc_url( $member['ma_el_team_carousel_twitter_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-twitter"></i></a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ( ! empty( $member['ma_el_team_carousel_instagram_link']['url'] ) ) : ?>
                                                    <?php $target = $member['ma_el_team_carousel_instagram_link']['is_external'] ?
                                                        ' target="_blank"' : ''; ?>
                                                    <li>
                                                        <a href="<?php echo esc_url(
                                                            $member['ma_el_team_carousel_instagram_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-instagram"></i></a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ( ! empty( $member['ma_el_team_carousel_linkedin_link']['url'] ) ) : ?>
                                                    <?php $target = $member['ma_el_team_carousel_linkedin_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                                    <li>
                                                        <a href="<?php echo esc_url( $member['ma_el_team_carousel_linkedin_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-linkedin"></i></a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ( ! empty( $member['ma_el_team_carousel_dribbble_link']['url'] ) ) : ?>
                                                    <?php $target = $member['ma_el_team_carousel_dribbble_link']['is_external'] ? ' target="_blank"' : ''; ?>
                                                    <li>
                                                        <a href="<?php echo esc_url( $member['ma_el_team_carousel_dribbble_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-dribbble"></i></a>
                                                    </li>
                                                <?php endif; ?>

                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                </div>

			<?php } ?>


			<?php
		}

	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Team_Members_Carousel() );