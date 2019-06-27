<?php
	namespace Elementor;

	use Elementor\Widget_Base;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 6/25/19
	 */

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Call_To_Action extends Widget_Base {

		public function get_name() {
			return 'ma-call-to-action';
		}

		public function get_title() {
			return esc_html__( 'MA Call to Action', MELA_TD);
		}

		public function get_icon() {
			return 'ma-el-icon eicon-call-to-action';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

			/**
			 * Master Call to Action: Content
			 */
			$this->start_controls_section(
				'ma_el_call_to_action_content_section',
				[
					'label' => esc_html__( 'Content', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_call_to_action_content',
				[
					'label' => esc_html__( 'CTA Content', MELA_TD ),
					'type' => Controls_Manager::TEXTAREA,
					'label_block' => true,
					'default' => esc_html__( 'Purchase Master Addons now and unlimited Options', MELA_TD ),
				]
			);


			$this->add_control(
				'ma_el_call_to_action_content_desc',
				[
					'label' => esc_html__( 'Description', MELA_TD ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', MELA_TD ),

					'condition' => [
						'ma_el_call_to_action_style_preset' => 'style2',
					],
				]
			);

			$this->add_control(
				'ma_el_call_to_action_button_text',
				[
					'label' => esc_html__( 'Button Text', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'Purchase Now', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_call_to_action_button_link',
				[
					'label' => __( 'Call To Action URL', MELA_TD ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://jeweltheme.com/shop/master-addons-elementor', MELA_TD ),
					'label_block' => true,
					'default' => [
						'url' => '#',
						'is_external' => true,
					],
				]
			);

			$this->end_controls_section();


			/**
			 * Master Addons: Dual Heading Content Section
			 */
			$this->start_controls_section(
				'ma_el_call_to_action_style',
				[
					'label' => esc_html__( 'Style Presets', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'ma_el_call_to_action_style_preset',
				[
					'label' => esc_html__( 'Style Preset', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'default' => 'style1',
					'options' => [
						'style1' => esc_html__( 'Style 1', MELA_TD ),
						'style2' => esc_html__( 'Style 2', MELA_TD ),
						'style3' => esc_html__( 'Style 3', MELA_TD ),
					],
				]
			);
			$this->end_controls_section();



			/*
				* Master Headlines First Part Styling Section
				*/
			$this->start_controls_section(
				'ma_el_call_to_action_styles',
				[
					'label' => esc_html__( 'Call to Action Style', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'ma_el_call_to_action_title_color',
				[
					'label'		=> esc_html__( 'Text Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#343434',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-action-content h3'
						=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'ma_el_call_to_action_bg_color',
				[
					'label' => __( 'Background', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#e4f1f9',
					'selectors' => [
						'{{WRAPPER}} .ma-el-alice-green-bg'
						=> 'background-color: {{VALUE}};',
					],
				]
			);


			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'ma_el_call_to_action_text_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .ma-el-action-content h3',
				]
			);

			$this->end_controls_section();



			$this->start_controls_section(
				'ma_el_call_to_action_button_section',
				[
					'label' => __('Button Style', MELA_TD),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);


			$this->start_controls_tabs( 'ma_el_call_to_action_button_style_tabs' );

			$this->start_controls_tab( 'ma_el_call_to_action_button_style_tab', [ 'label' => esc_html__( 'Normal',
				MELA_TD )
			] );

			$this->add_control(
				'ma_el_call_to_action_button_color',
				[
					'label'		=> esc_html__( 'Button Text Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-action-content .btn'
						=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'ma_el_call_to_action_button_bg_color',
				[
					'label'		=> esc_html__( 'Button Background Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#8dc63f',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-action-content .btn'
						=> 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab( 'ma_el_call_to_action_button_hover', [ 'label' => esc_html__( 'Hover',
				MELA_TD )
			] );

			$this->add_control(
				'ma_el_call_to_action_button_hover_color',
				[
					'label'		=> esc_html__( 'Button Text Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-action-content .btn:hover'
						=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'ma_el_call_to_action_button_bg_hover_color',
				[
					'label'		=> esc_html__( 'Button Hover Background Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#8dc63f',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-action-content .btn:hover'
						=> 'background-color: {{VALUE}};',
					],
				]
			);


			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();


			if(!apply_filters('ma_el/pro_enabled', false)) {

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
						'description' => '<span class="pro-feature"> Upgrade to  <a href="https://jeweltheme.com/shop/master-addons-elementor/" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
					]
				);

				$this->end_controls_section();
			}



		}

		protected function render() {
			$settings = $this->get_settings_for_display();
			?>

			<section class="section-content <?php echo ( $settings['ma_el_call_to_action_style_preset'] == 'style3'
			 )? "gradient-bg": "ma-el-alice-green-bg";?>">

				<?php if( $settings['ma_el_call_to_action_style_preset'] == 'style1' ) { ?>
                    <div class="content">
                        <div class="ma-el-action-content">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h3>
                                        <?php echo esc_html( $settings['ma_el_call_to_action_content'] ); ?>
                                    </h3>
                                </div>
                                <div class="col-lg-3 text-right">
                                    <a href="<?php echo esc_url( $settings['ma_el_call_to_action_button_link']['url'] ); ?>" class="btn">
                                        <?php echo esc_html( $settings['ma_el_call_to_action_button_text'] ); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

				<?php } else if( $settings['ma_el_call_to_action_style_preset'] == 'style2' ) { ?>
					<div class="content">
						<div class="ma-el-action-content style-02">
							<h3>
								<?php echo esc_html( $settings['ma_el_call_to_action_content'] ); ?>
							</h3>
							<p>
								<?php echo esc_html( $settings['ma_el_call_to_action_content'] ); ?>
							</p>
							<a href="<?php echo esc_url( $settings['ma_el_call_to_action_button_link']['url'] ); ?>" class="btn">
								<?php echo esc_html( $settings['ma_el_call_to_action_button_text'] ); ?>
							</a>
						</div>
					</div>

				<?php } else if( $settings['ma_el_call_to_action_style_preset'] == 'style3' ) { ?>

						<div class="content">
							<div class="ma-el-action-content">
								<div class="row">
									<div class="col-lg-8">
										<h3>
											<?php echo esc_html( $settings['ma_el_call_to_action_content'] ); ?>
										</h3>
									</div>
									<div class="col-lg-4 text-right">
										<a href="<?php echo esc_url( $settings['ma_el_call_to_action_button_link']['url'] ); ?>" class="btn">
											<?php echo esc_html( $settings['ma_el_call_to_action_button_text'] ); ?>
										</a>
									</div>
								</div>
							</div>
						</div>
				<?php } ?>

			</section>
	        <?php
		}
	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Call_To_Action() );