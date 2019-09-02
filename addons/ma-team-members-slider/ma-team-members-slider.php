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