<?php
	namespace Elementor;
	use Elementor\Widget_Base;

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Team_Members_Carousel extends Widget_Base {

		public function get_name() {
			return 'ma-team-members-slider';
		}

		public function get_title() {
			return esc_html__( 'MA Team Members', MELA_TD);
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
					'placeholder' => __( 'https://your-link.com', MELA_TD ),
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
					'placeholder' => __( 'https://your-link.com', MELA_TD ),
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
					'placeholder' => __( 'https://your-link.com', MELA_TD ),
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
					'placeholder' => __( 'https://your-link.com', MELA_TD ),
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
					'placeholder' => __( 'https://your-link.com', MELA_TD ),
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
			if ( ma_el_fs()->can_use_premium_code__premium_only() ) {
				$this->add_control(
					'ma_el_team_carousel_preset',
					[
						'label' => esc_html__( 'Style Preset', MELA_TD ),
						'type' => Controls_Manager::SELECT,
						'default' => '-circle',
						'options' => [
							'-default'     => esc_html__( 'Team Carousel', MELA_TD ),
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
							'-default'           => esc_html__( 'Team Carousel', MELA_TD ),
							'-circle'                     => esc_html__( 'Circle Gradient', MELA_TD ),
							'-content-hover'              => esc_html__( 'Content on Hover', MELA_TD ),
							'-pro-team-slider-1'          => esc_html__( 'Social Left on Hover (Pro)', MELA_TD ),
							'-pro-team-slider-2'          => esc_html__( 'Content Drawer (Pro)', MELA_TD ),
						],
						'description' => sprintf( '2+ more Variations on <a href="%s" target="_blank">%s</a>',
							esc_url_raw( admin_url('admin.php?page=master-addons-settings-pricing') ),
							__( 'Upgrade Now', MELA_TD ) )
					]
				);

			}

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
						'{{WRAPPER}} .ma-el-team-member-basic, {{WRAPPER}} .ma-el-team-member-circle, {{WRAPPER}} .ma-el-team-member-social-left, {{WRAPPER}} .ma-el-team-member-rounded' => 'background: {{VALUE}};',
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
				]
			);

			$this->start_controls_tabs( 'ma_el_team_carousel_social_icons_style_tabs' );

			$this->start_controls_tab( 'ma_el_team_carousel_social_icon_control',
				[ 'label' => esc_html__( 'Normal', MELA_TD ) ]
			);

			$this->add_control(
				'ma_el_team_carousel_social_color_1',
				[
					'label' => esc_html__( 'Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-social-left .ma-el-team-member-social li a' => 'background: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_carousel_preset' => '-social-left',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'ma_el_team_carousel_social_icon_hover_control',
				[ 'label' => esc_html__( 'Hover', MELA_TD ) ]
			);

			$this->add_control(
				'ma_el_team_carousel_social_hover_color_1',
				[
					'label' => esc_html__( 'Hover Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ff6d55',
					'selectors' => [
						'{{WRAPPER}} .ma-el-team-member-social-left .ma-el-team-member-social li a:hover' => 'background: {{VALUE}};',
					],
					'condition' => [
						'ma_el_team_carousel_preset' => '-social-left'
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
							<?php echo $member['ma_el_team_carousel_description']; ?>
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