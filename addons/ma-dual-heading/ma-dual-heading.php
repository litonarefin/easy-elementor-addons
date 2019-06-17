<?php
	namespace Elementor;
	use Elementor\Widget_Base;

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Dual_Heading extends Widget_Base {

		public function get_name() {
			return 'ma-dual-heading';
		}

		public function get_title() {
			return esc_html__( 'MA Dual Heading', MELA_TD );
		}

		public function get_icon() {
			return 'ma-el-icon eicon-type-tool';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

			/**
			 * Master Addons: Dual Heading Content Section
			 */
			$this->start_controls_section(
				'ma_el_dual_heading_style',
				[
					'label' => esc_html__( 'Style Preset', MELA_TD ),
				]
			);
			$this->add_control(
				'ma_el_dual_heading_styles_preset',
				[
					'label' => esc_html__( 'Style Preset', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'default' => '-style2',
					'options' => [
						'-style1' => esc_html__( 'Style 1', MELA_TD ),
						'-style2' => esc_html__( 'Style 2', MELA_TD ),
					],
				]
			);
			$this->end_controls_section();




			/**
			 * Master Addons: Dual Heading Content Section
			 */
			$this->start_controls_section(
				'ma_el_dual_heading_content',
				[
					'label' => esc_html__( 'Content', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_dual_first_heading',
				[
					'label' => esc_html__( 'First Heading', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'First', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_dual_second_heading',
				[
					'label' => esc_html__( 'Second Heading', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'Second', MELA_TD ),
				]
			);




			$this->add_control(
				'ma_el_dual_heading_title_link',
				[
					'label' => __( 'Heading URL', MELA_TD ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', MELA_TD ),
					'label_block' => true,
					'default' => [
						'url' => '#',
						'is_external' => true,
					],
				]
			);

			$this->add_control(
				'ma_el_dual_heading_description',
				[
					'label'       => __( 'Sub Heading', MELA_TD ),
					'type'        => Controls_Manager::TEXTAREA,
					'label_block' => true,
					'dynamic'     => [ 'active' => true ],
					'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto modi vel repudiandae reiciendis, cupiditate quod voluptatibus, placeat ad assumenda molestiae alias quisquam', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_dual_heading_icon_show',
				[
					'label' => esc_html__( 'Enable Icon', MELA_TD ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'return_value' => 'yes',
					'condition' => [
						'ma_el_dual_heading_styles_preset' => '-style1',
					],
				]
			);

			$this->add_control(
				'ma_el_dual_heading_icon',
				[
					'label'     => __( 'Icon', MELA_TD ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-wordpress',
					'condition' => [
						'ma_el_dual_heading_icon_show' => 'yes'
					]
				]
			);


			$this->end_controls_section();


			/*
			* Master Addons: Dual Heading Styling Section
			*/
			$this->start_controls_section(
				'ma_el_dual_heading_styles_general',
				[
					'label' => esc_html__( 'General Styles', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);


			$this->add_control(
				'ma_el_dual_heading_icon_color',
				[
					'label'		=> esc_html__( 'Icon Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#132C47',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-icon' => 'color: {{VALUE}};',
					],
					'condition' => [
						'ma_el_dual_heading_styles_preset' => '-style1',
					],
				]
			);

			$this->add_responsive_control(
				'ma_el_dual_heading_alignment',
				[
					'label' => esc_html__( 'Alignment', MELA_TD ),
					'type' => Controls_Manager::CHOOSE,
					'label_block' => true,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', MELA_TD ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', MELA_TD ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', MELA_TD ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'center',
					'label_block' => true,
					'selectors' => [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

			/*
				* Master Addons: Dual Heading First Part Styling Section
				*/
			$this->start_controls_section(
				'ma_el_dual_first_heading_styles',
				[
					'label' => esc_html__( 'First Heading', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'ma_el_dual_heading_first_text_color',
				[
					'label'		=> esc_html__( 'Text Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#ffffff',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title a .first-heading'
						=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'ma_el_dual_heading_first_bg_color',
				[
					'label' => __( 'Background', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#704aff',
					'selectors' => [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title a .first-heading'
						=> 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'ma_el_dual_first_heading_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title a .first-heading,{{WRAPPER}} .ma-el-section-title',
				]
			);

			$this->end_controls_section();

			/*
			* Master Addons: Dual Heading Second Part Styling Section
			*/
			$this->start_controls_section(
				'ma_el_dual_second_heading_styles',
				[
					'label' => esc_html__( 'Second Heading', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'ma_el_dual_heading_second_text_color',
				[
					'label'		=> esc_html__( 'Text Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#132C47',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title a .second-heading' =>
							'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'ma_el_dual_heading_second_bg_color',
				[
					'label' => __( 'Background', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title a .second-heading' =>
							'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'ma_el_dual_second_heading_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title a .second-heading,{{WRAPPER}} .ma-el-section-description',
				]
			);


			$this->end_controls_section();

			/*
				* Master Addons: Dual Heading description Styling Section
			*/
			$this->start_controls_section(
				'ma_el_dual_heading_description_styles',
				[
					'label' => esc_html__( 'Sub Heading', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'ma_el_dual_heading_description_text_color',
				[
					'label'		=> esc_html__( 'Text Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#989B9E',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-description' =>
							'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'ma_el_dual_heading_description_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-description',
				]
			);

			$this->end_controls_section();
		}

		protected function render() {
			$settings = $this->get_settings_for_display();

			?>


			<?php if( $settings['ma_el_dual_heading_styles_preset'] == '-style1' ) { ?>

                <div class="ma-el-sec-head-container">
                    <div class="ma-el-sec-head-style">
                        <h2 class="ma-el-section-title">
                            <span><?php echo esc_html( $settings['ma_el_dual_first_heading'] );
	                            ?></span> <?php echo esc_html( $settings['ma_el_dual_second_heading'] ); ?>
                        </h2><!-- /.section-title -->

                        <div class="ma-el-section-description">
	                        <?php echo esc_html( $settings['ma_el_dual_heading_description'] ); ?>
                        </div><!-- /.section-description -->
                    </div><!-- /.sec-head-style -->
                </div><!-- /.sec-head-container -->

            <?php } else { ?>

                <div id="ma-el-heading-<?php echo esc_attr($this->get_id()); ?>" class="ma-el-dual-heading">
                    <div class="ma-el-dual-heading-wrapper">
						<?php if ( $settings['ma_el_dual_heading_icon_show'] == 'yes' ) : ?>
                            <span class="ma-el-dual-heading-icon"><i class="<?php echo esc_attr( $settings['ma_el_dual_heading_icon'] ); ?>"></i></span>
						<?php endif; ?>
                        <h1 class="ma-el-dual-heading-title">
                            <a href="<?php echo esc_url( $settings['ma_el_dual_heading_title_link']['url'] ); ?>">
							<span class="first-heading"><?php echo esc_html( $settings['ma_el_dual_first_heading'] );
								?></span><span class="second-heading"><?php echo esc_html( $settings['ma_el_dual_second_heading'] ); ?></span>
                            </a>
                        </h1>
						<?php if ( $settings['ma_el_dual_heading_description'] != "" ) : ?>
                            <p class="ma-el-dual-heading-description"><?php echo esc_html( $settings['ma_el_dual_heading_description'] ); ?></p>
						<?php endif; ?>
                    </div>
                </div>
            <?php } ?>


			<?php
		}

		protected function _content_template() { ?>

            <# if ( '-style1' == settings.ma_el_dual_heading_styles_preset ) { #>

                <div class="ma-el-sec-head-container">
                    <div class="ma-el-sec-head-style">
                        <h2 class="ma-el-section-title">
                            <span>{{{ settings.ma_el_dual_first_heading }}}</span> {{{ settings.ma_el_dual_second_heading }}}
                        </h2><!-- /.section-title -->

                        <div class="ma-el-section-description">
                            {{{ settings.ma_el_dual_heading_description }}}
                        </div><!-- /.section-description -->
                    </div><!-- /.sec-head-style -->
                </div><!-- /.sec-head-container -->

            <# } else{ #>

                <div id="ma-el-heading" class="ma-el-dual-heading">
                    <div class="ma-el-dual-heading-wrapper">
                        <# if ( settings.ma_el_dual_heading_icon_show == 'yes' ) { #>
                        <span class="ma-el-dual-heading-icon"><i class="{{ settings.ma_el_dual_heading_icon }}"></i></span>
                        <# } #>
                        <h1 class="ma-el-dual-heading-title">
                            <a href="{{{ settings.ma_el_dual_heading_title_link }}}">
                                <span class="first-heading">{{{ settings.ma_el_dual_first_heading }}}</span><span
                                    class="second-heading">{{{ settings.ma_el_dual_second_heading }}}</span>
                            </a>
                        </h1>
                        <# if ( settings.ma_el_dual_heading_description != "" ) { #>
                        <p class="ma-el-dual-heading-description">{{{ settings.ma_el_dual_heading_description }}}</p>
                        <# } #>
                    </div>
                </div>
            <# } #>

			<?php
		}

	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Dual_Heading() );