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
			 * Dual Heading Content Section
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
//			$this->add_control(
//				'ma_el_dual_second_heading',
//				[
//					'label' => esc_html__( 'Second Heading', MELA_TD ),
//					'type' => Controls_Manager::TEXT,
//					'label_block' => true,
//					'default' => esc_html__( 'Second', MELA_TD ),
//				]
//			);


			$repeater = new Repeater();


			$repeater->add_control(
				'ma_el_dual_second_heading',
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
						[ 'ma_el_dual_second_heading' => esc_html__( 'Minimal Design', MELA_TD ) ],
						[ 'ma_el_dual_second_heading' => esc_html__( 'Unique Design', MELA_TD ) ],
						[ 'ma_el_dual_second_heading' => esc_html__( 'Portfolio Template', MELA_TD ) ],
						[ 'ma_el_dual_second_heading' => esc_html__( 'Modern Design', MELA_TD ) ],
						[ 'ma_el_dual_second_heading' => esc_html__( 'HTML5 Template', MELA_TD ) ],
					],
					'fields'                => array_values( $repeater->get_controls() ),
					'title_field'           => '{{ma_el_dual_second_heading}}',
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
					'default'     => __( 'Add your sub heading here.', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_dual_heading_icon_show',
				[
					'label' => esc_html__( 'Enable Icon', MELA_TD ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'return_value' => 'yes',
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
			* Dual Heading Styling Section
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
				* Dual Heading First Part Styling Section
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
					'selector' => '{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title a .first-heading',
				]
			);

			$this->end_controls_section();

			/*
			* Dual Heading Second Part Styling Section
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
					'selector' => '{{WRAPPER}} .ma-el-dual-heading .ma-el-dual-heading-wrapper .ma-el-dual-heading-title a .second-heading',
				]
			);


			$this->end_controls_section();

			/*
				* Dual Heading description Styling Section
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

			foreach( $settings['tabs'] as $index => $tab ) {

//
//				$tab_count = $index+1;
//				$tab_title_setting_key = $this->get_repeater_setting_key('ma_el_dual_second_heading', 'tabs', $index);
////				$tab_content_setting_key = $this->get_repeater_setting_key('accordion_content', 'tabs', $index);
//
//				$tab_title_class 	= ['ma-accordion-tab-title'];
//				$tab_content_class 	= ['ma-accordion-tab-content'];
//
//				if ( $tab['accordion_tab_default_active'] == 'yes' ) {
//					$tab_title_class[] 		= 'ma-accordion-tab-active-default';
//					$tab_content_class[] 	= 'ma-accordion-tab-active-default';
//				}
?>

				<h1 class="cd-headline rotate-1 main-title">
					<span>Mama - The Best</span>
						<span class="cd-words-wrapper">
				        <b class="is-visible">Minimal Template</b>
				        <b><?php echo $tab['tab_title']; ?></b>
				    </span>
				</h1>
<?php


			}

			?>

			<div id="ma-el-heading-<?php echo esc_attr($this->get_id()); ?>" class="ma-el-dual-heading">
				<div class="ma-el-dual-heading-wrapper">
					<?php if ( $settings['ma_el_dual_heading_icon_show'] == 'yes' ) : ?>
						<span class="ma-el-dual-heading-icon"><i class="<?php echo esc_attr( $settings['ma_el_dual_heading_icon'] ); ?>"></i></span>
					<?php endif; ?>
					<h1 class="ma-el-dual-heading-title">
						<a href="<?php echo esc_url( $settings['ma_el_dual_heading_title_link']['url'] ); ?>">
							<span class="first-heading"><?php echo esc_html( $settings['ma_el_dual_first_heading'] );
								?></span><span class="second-heading"><?php //echo esc_html(
									// $settings['ma_el_dual_second_heading'] ); ?></span>
						</a>
					</h1>
					<?php if ( $settings['ma_el_dual_heading_description'] != "" ) : ?>
						<p class="ma-el-dual-heading-description"><?php echo esc_html( $settings['ma_el_dual_heading_description'] ); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php
		}

		protected function _content_template() {
			?>
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
			<?php
		}


	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Headlines() );