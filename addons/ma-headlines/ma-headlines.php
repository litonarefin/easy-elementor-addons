<?php
	namespace Elementor;
	use Elementor\Widget_Base;

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Headlines extends Widget_Base {

		public function get_name() {
			return 'ma-headlines';
		}

		public function get_title() {
			return esc_html__( 'MA Animated Headlines', MELA_TD );
		}

		public function get_icon() {
			return 'ma-el-icon eicon-type-tool';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

			/**
			 * Master Headlines Content Section
			 */
			$this->start_controls_section(
				'ma_el_headlines_content',
				[
					'label' => esc_html__( 'Content', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_headlines_first_heading',
				[
					'label' => esc_html__( 'First Heading', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'First', MELA_TD ),
				]
			);

			$repeater = new Repeater();


			$repeater->add_control(
				'ma_el_headlines_second_heading',
				[
					'label'                 => __( 'More Titles', MELA_TD ),
					'type'                  => Controls_Manager::TEXT,
					'default'               => __( 'Minimal Template', MELA_TD ),
					'dynamic'               => [
						'active'   => true,
					],
				]
			);



			$this->add_control(
				'tabs',
				[
					'type'                  => Controls_Manager::REPEATER,
					'default'               => [
						[ 'ma_el_headlines_second_heading' => esc_html__( 'Minimal Design', MELA_TD ) ],
						[ 'ma_el_headlines_second_heading' => esc_html__( 'Unique Design', MELA_TD ) ],
						[ 'ma_el_headlines_second_heading' => esc_html__( 'Portfolio Template', MELA_TD ) ],
						[ 'ma_el_headlines_second_heading' => esc_html__( 'Modern Design', MELA_TD ) ],
						[ 'ma_el_headlines_second_heading' => esc_html__( 'HTML5 Template', MELA_TD ) ],
					],
					'fields'                => array_values( $repeater->get_controls() ),
					'title_field'           => '{{ma_el_headlines_second_heading}}',
				]
			);


			$this->end_controls_section();



			/*
				* Master Headlines First Part Styling Section
				*/
			$this->start_controls_section(
				'ma_el_headlines_first_heading_styles',
				[
					'label' => esc_html__( 'First Heading', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'ma_el_headlines_first_text_color',
				[
					'label'		=> esc_html__( 'Text Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#ffffff',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title .first-heading'
						=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'ma_el_headlines_first_bg_color',
				[
					'label' => __( 'Background', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#704aff',
					'selectors' => [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title .first-heading'
						=> 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'ma_el_headlines_first_heading_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title .first-heading',
				]
			);

			$this->end_controls_section();

			/*
			* Master Headlines Second Part Styling Section
			*/
			$this->start_controls_section(
				'ma_el_headlines_second_heading_styles',
				[
					'label' => esc_html__( 'Second Heading', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'ma_el_headlines_second_text_color',
				[
					'label'		=> esc_html__( 'Text Color', MELA_TD ),
					'type'		=> Controls_Manager::COLOR,
					'default' => '#132C47',
					'selectors'	=> [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title .second-heading' =>
							'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'ma_el_headlines_second_bg_color',
				[
					'label' => __( 'Background', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title .second-heading' =>
							'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'ma_el_headlines_second_heading_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title .second-heading',
				]
			);


			$this->end_controls_section();


		}

		protected function render() {
			$settings = $this->get_settings_for_display();
			?>

                <div id="ma-el-heading-<?php echo esc_attr($this->get_id()); ?>" class="ma-el-dual-heading">
                    <div class="ma-el-dual-heading-wrapper">

                        <h1 class="ma-el-dual-heading-title cd-headline rotate-1 main-title">
                            <span class="first-heading">
                                <?php echo esc_html( $settings['ma_el_headlines_first_heading'] ); ?>
                            </span>
                            <span class="cd-words-wrapper">
                                <?php foreach( $settings['tabs'] as $index => $tab ) { ?>
                                    <b class="second-heading <?php echo ($index==0) ? "is-visible": "";?>">
                                        <?php echo $tab['ma_el_headlines_second_heading']; ?>
                                    </b>
                                <?php } ?>
                            </span>
                        </h1>

                    </div>
                </div>

			<?php
		}


		protected function _content_template() { ?>

			<div id="ma-el-heading" class="ma-el-dual-heading">
				<div class="ma-el-dual-heading-wrapper">

                    <h1 class="ma-el-dual-heading-title cd-headline rotate-1 main-title">
                        <span class="first-heading">{{{ settings.ma_el_headlines_first_heading }}}</span>
                        <# _.each( settings.ma_el_exclusive_tabs, function( tab, index ) { #>
                            <span class="second-heading">{{{ settings.ma_el_headlines_second_heading }}}</span>
                        <# }); #>
					</h1>

				</div>
			</div>

        <?php }

	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Headlines() );