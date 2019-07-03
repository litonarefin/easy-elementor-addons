<?php
	namespace Elementor;
	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 6/26/19
	 */

	use Elementor\Widget_Base;
	use Elementor\Controls_Manager;
	use Elementor\Group_Control_Background;
	use Elementor\Group_Control_Border;
	use Elementor\Scheme_Color;
	use Elementor\Group_Control_Typography;
	use Elementor\Scheme_Typography;
	use Elementor\Modules\DynamicTags\Module as TagsModule;


	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Flip_Box extends Widget_Base {

		public function get_name() {
			return 'ma-flipbox';
		}

		public function get_title() {
			return esc_html__( 'MA Flipbox', MELA_TD);
		}

		public function get_icon() {
			return 'ma-el-icon eicon-flip-box';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

			$this->start_controls_section(
				'section_front_box',
				[
					'label' => __( 'Front Box', MELA_TD )
				]
			);

			$this->add_control(
				'front_icon',
				[
					'label' => __( 'Icon', MELA_TD ),
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-wordpress',
				]
			);

			$this->add_control(
				'front_icon_view',
				[
					'label' => __( 'View', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'default' => __( 'Default', MELA_TD ),
						'stacked' => __( 'Stacked', MELA_TD ),
						'framed' => __( 'Framed', MELA_TD ),
					],
					'default' => 'default',

				]
			);

			$this->add_control(
				'front_icon_shape',
				[
					'label' => __( 'Shape', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'circle' => __( 'Circle', MELA_TD ),
						'square' => __( 'Square', MELA_TD ),
					],
					'default' => 'circle',
					'condition' => [
						'front_icon_view!' => 'default',
					],

				]
			);

			$this->add_control(
				'front_title',
				[
					'label' => __( 'Title', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter text', MELA_TD ),
					'default' => __( 'Text Title', MELA_TD ),
				]
			);

			$this->add_control(
				'front_title_html_tag',
				[
					'label' => __( 'HTML Tag', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h1' => __( 'H1', MELA_TD ),
						'h2' => __( 'H2', MELA_TD ),
						'h3' => __( 'H3', MELA_TD ),
						'h4' => __( 'H4', MELA_TD ),
						'h5' => __( 'H5', MELA_TD ),
						'h6' => __( 'H6', MELA_TD )
					],
					'default' => 'h3',
				]
			);

			$this->add_control(
				'front-text',
				[
					'label' => __( 'Text', MELA_TD ),
					'type' => Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter text', MELA_TD ),
					'default' => __( 'Add some nice text here.', MELA_TD ),
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_back_box',
				[
					'label' => __( 'Back Box', MELA_TD )
				]
			);

			$this->add_control(
				'back_icon',
				[
					'label' => __( 'Icon', MELA_TD ),
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-wordpress',
				]
			);

			$this->add_control(
				'back_icon_view',
				[
					'label' => __( 'View', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'default' => __( 'Default', MELA_TD ),
						'stacked' => __( 'Stacked', MELA_TD ),
						'framed' => __( 'Framed', MELA_TD ),
					],
					'default' => 'default',

				]
			);

			$this->add_control(
				'back_icon_shape',
				[
					'label' => __( 'Shape', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'circle' => __( 'Circle', MELA_TD ),
						'square' => __( 'Square', MELA_TD ),
					],
					'default' => 'circle',
					'condition' => [
						'back_icon_view!' => 'default',
					],

				]
			);

			$this->add_control(
				'back_title',
				[
					'label' => __( 'Title', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter text', MELA_TD ),
					'default' => __( 'Text Title', MELA_TD ),
				]
			);

			$this->add_control(
				'back_title_html_tag',
				[
					'label' => __( 'HTML Tag', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h1' => __( 'H1', MELA_TD ),
						'h2' => __( 'H2', MELA_TD ),
						'h3' => __( 'H3', MELA_TD ),
						'h4' => __( 'H4', MELA_TD ),
						'h5' => __( 'H5', MELA_TD ),
						'h6' => __( 'H6', MELA_TD )
					],
					'default' => 'h3',
				]
			);

			$this->add_control(
				'back_text',
				[
					'label' => __( 'Text', MELA_TD ),
					'type' => Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter text', MELA_TD ),
					'default' => __( 'Add some nice text here.', MELA_TD ),
				]
			);

			$this->end_controls_section();


			$this->start_controls_section(
				'section-action-button',
				[
					'label' => __( 'Action Button', MELA_TD ),
				]
			);

			$this->add_control(
				'action_text',
				[
					'label' => __( 'Button Text', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Buy', MELA_TD ),
					'default' => __( 'Buy Now', MELA_TD ),
				]
			);

			$this->add_control(
				'link',
				[
					'label' => __( 'Link to', MELA_TD ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'http://your-link.com', MELA_TD ),
					'separator' => 'before',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section-general-style',
				[
					'label' => __( 'General', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'animation_style',
				[
					'label' => __( 'Animation Style', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'horizontal'                            => esc_html__( 'Flip Horizontal', MELA_TD ),
						'vertical'                              => esc_html__( 'Flip Vertical', MELA_TD ),
						'fade'                                  => esc_html__( 'Fade',MELA_TD),
						'flipcard flipcard-rotate-top-down'     => esc_html__( 'Cube - Top Down', MELA_TD ),
						'flipcard flipcard-rotate-down-top'     => esc_html__( 'Cube - Down Top', MELA_TD ),
						'flipcard flipcard-rotate-left-right'   => esc_html__( 'Cube - Left Right', MELA_TD ),
						'flipcard flipcard-rotate-right-left'   => esc_html__( 'Cube - Right Left', MELA_TD ),
						'flip box'                              => esc_html__( 'Flip Box',MELA_TD),
						'flip box fade'                         => esc_html__( 'Flip Box Fade',MELA_TD),
						'flip box fade up'                      => esc_html__( 'Fade Up',MELA_TD),
						'flip box fade hideback'                => esc_html__( 'Fade Hideback',MELA_TD),
						'flip box fade up hideback'             => esc_html__( 'Fade Up Hideback',MELA_TD),
						'nananana'                              => esc_html__( 'Nananana',MELA_TD),
						'rollover'                              => esc_html__( 'Rollover',MELA_TD),

						'left-to-right'                         => esc_html__( 'Left to Right', MELA_TD ), // New Styles
						'right-to-left'                         => esc_html__( 'Right to Left', MELA_TD ),
						'top-to-bottom'                         => esc_html__( 'Top to Bottom', MELA_TD ),
						'bottom-to-top'                         => esc_html__( 'Bottom to Top', MELA_TD ),
						'top-to-bottom-angle'                   => esc_html__( 'Diagonal (Top to Bottom)', MELA_TD ),
						'bottom-to-top-angle'                   => esc_html__( 'Diagonal (Bottom to Top)', MELA_TD ),
						'fade-in-out'                           => esc_html__( 'Fade In Out', MELA_TD ),


					],
					'default' => 'vertical',
					'prefix_class' => 'ma-el-fb-animate-'
				]
			);


			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'flip_box_border',
					'label' => __( 'Box Border', MELA_TD ),
					'selector' => '{{WRAPPER}} .ma-el-flip-box-inner > div',
				]
			);



			$this->add_control(
				'box_border_radius',
				[
					'label' => __( 'Border Radius', MELA_TD ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ma-el-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'box_height',
				[
					'type' => Controls_Manager::TEXT,
					'label' => __( 'Box Height', MELA_TD ),
					'placeholder' => __( '250', MELA_TD ),
					'default' => __( '250', MELA_TD ),
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-inner' => 'height: {{VALUE}}px;',
						'{{WRAPPER}}.ma-el-fb-animate-flipcard .ma-el-flip-box-front' => 'transform-origin: center center calc(-{{VALUE}}px/2);-webkit-transform-origin:center center calc(-{{VALUE}}px/2);',
						'{{WRAPPER}}.ma-el-fb-animate-flipcard .ma-el-flip-box-back' => 'transform-origin: center center calc(-{{VALUE }}px/2);-webkit-transform-origin:center center calc(-{{VALUE}}px/2);'
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section-front-box-style',
				[
					'label' => __( 'Front Box', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'front_box_background',
					'label' => __( 'Front Box Background', MELA_TD ),
					'types' => [ 'classic','gradient' ],
					'selector' => '{{WRAPPER}} .ma-el-flip-box-front',
				]
			);


			$this->add_control(
				'front_box_title_color',
				[
					'label' => __( 'Title', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .front-icon-title' => 'color: {{VALUE}};',
					],
					'condition' => [
						'front_title!' => ''
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'front_box_title_typography',
					'label' => __( 'Title Typography', MELA_TD ),
					'scheme' => Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .front-icon-title',
				]
			);

			$this->add_control(
				'front_box_text_color',
				[
					'label' => __( 'Description Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-front p' => 'color: {{VALUE}};',
					],

				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'front_box_text_typography',
					'label' => __( 'Description Typography', MELA_TD ),
					'scheme' => Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .ma-el-flip-box-front p',
				]
			);


			/**
			 *  Front Box icons styles
			 **/
			$this->add_control(
				'front_box_icon_color',
				[
					'label' => __( 'Icon Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-front .icon-wrapper i' => 'color: {{VALUE}};',
					],
					'condition' => [
						'front_icon!' => ''
					],
				]
			);

			$this->add_control(
				'front_box_icon_fill_color',
				[
					'label' => __( 'Icon Fill Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#92BE43',
					'selectors' => [
						'{{WRAPPER}} .ma-el-fb-icon-view-stacked' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'front_icon_view' => 'stacked'
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'front_box_icon_border',
					'label' => __( 'Box Border', MELA_TD ),
					'placeholder' => '1px',
					'default' => '1px',
					'selector' => '{{WRAPPER}} .ma-el-flip-box-front .ma-el-fb-icon-view-framed, {{WRAPPER}} .ma-el-flip-box-front .ma-el-fb-icon-view-stacked',
					'label_block' => true,
					'condition' => [
						'front_icon_view!' => 'default'
					],
				]
			);

			$this->add_control(
				'front_icon_size',
				[
					'label' => __( 'Icon Size', MELA_TD ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 6,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-front .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'front_icon_padding',
				[
					'label' => __( 'Icon Padding', MELA_TD ),
					'type' => Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-front .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
					],
					'default' => [
						'size' => 1.5,
						'unit' => 'em',
					],
					'range' => [
						'em' => [
							'min' => 0,
						],
					],
					'condition' => [
						'front_icon_view!' => 'default',
					],
				]
			);





			$this->end_controls_section();



			$this->start_controls_section(
				'section-back-box-style',
				[
					'label' => __( 'Back Box', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);


			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'back_box_background',
					'label' => __( 'Back Box Background', MELA_TD ),
					'types' => [ 'classic','gradient' ],
					'selector' => '{{WRAPPER}} .ma-el-flip-box-back',
				]
			);

			$this->add_control(
				'back_box_title_color',
				[
					'label' => __( 'Title', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .back-icon-title' => 'color: {{VALUE}};',
					],

				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'back_box_title_typography',
					'label' => __( 'Title Typography', MELA_TD ),
					'scheme' => Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .back-icon-title',
				]
			);

			$this->add_control(
				'back_box_text_color',
				[
					'label' => __( 'Description Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-back p' => 'color: {{VALUE}};',
					],

				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'back_box_text_typography',
					'label' => __( 'Description Typography', MELA_TD ),
					'scheme' => Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .ma-el-flip-box-back p',
				]
			);


			/**
			 *  Back Box icons styles
			 **/
			$this->add_control(
				'back_box_icon_color',
				[
					'label' => __( 'Icon Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#FFF',
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-back .icon-wrapper i' => 'color: {{VALUE}};',
					],
					'condition' => [
						'back_icon!' => ''
					],
				]
			);

			$this->add_control(
				'back_box_icon_fill_color',
				[
					'label' => __( 'Icon Fill Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#92BE43',
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-back .ma-el-fb-icon-view-stacked' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'front_icon_view' => 'stacked'
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'back_box_icon_border',
					'label' => __( 'Box Border', MELA_TD ),
					'placeholder' => '1px',
					'default' => '1px',
					'selector' => '{{WRAPPER}} .ma-el-flip-box-back .ma-el-fb-icon-view-framed, {{WRAPPER}} .ma-el-flip-box-back .ma-el-fb-icon-view-stacked',
					'label_block' => true,
					'condition' => [
						'back_icon_view!' => 'default'
					],
				]
			);

			$this->add_control(
				'back_icon_size',
				[
					'label' => __( 'Icon Size', MELA_TD ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 6,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-back .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'back_icon_padding',
				[
					'label' => __( 'Icon Padding', MELA_TD ),
					'type' => Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .ma-el-flip-box-back .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
					],
					'default' => [
						'size' => 1.5,
						'unit' => 'em',
					],
					'range' => [
						'em' => [
							'min' => 0,
						],
					],
					'condition' => [
						'back_icon_view!' => 'default',
					],
				]
			);



			$this->end_controls_section();

			$this->start_controls_section(
				'section-action-button-style',
				[
					'label' => __( 'Action Button', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'button_text_color',
				[
					'label' => __( 'Text Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .ma-el-fb-button' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'label' => __( 'Typography', MELA_TD ),
					'scheme' => Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .ma-el-fb-button',
				]
			);

			$this->add_control(
				'background_color',
				[
					'label' => __( 'Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_4,
					],
					'default' => '#93C64F',
					'selectors' => [
						'{{WRAPPER}} .ma-el-fb-button' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'border',
					'label' => __( 'Border', MELA_TD ),
					'placeholder' => '1px',
					'default' => '1px',
					'selector' => '{{WRAPPER}} .ma-el-fb-button',
				]
			);

			$this->add_control(
				'border_radius',
				[
					'label' => __( 'Border Radius', MELA_TD ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-el-fb-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'text_padding',
				[
					'label' => __( 'Text Padding', MELA_TD ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ma-el-fb-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


			$this->end_controls_section();





		}

		protected function render( ) {
			$settings = $this->get_settings_for_display();

			$this->add_render_attribute('front-icon-wrapper','class','icon-wrapper');
			$this->add_render_attribute('front-icon-wrapper','class','ma-el-fb-icon-view-'.$settings['front_icon_view']);
			$this->add_render_attribute('front-icon-wrapper','class','ma-el-fb-icon-shape-'.$settings['front_icon_shape']);
			$this->add_render_attribute('front-icon-title','class','front-icon-title');
			$this->add_render_attribute('front-icon','class',$settings['front_icon']);


			$this->add_render_attribute('back-icon-wrapper','class','icon-wrapper');
			$this->add_render_attribute('back-icon-wrapper','class','ma-el-fb-icon-view-'.$settings['back_icon_view']);
			$this->add_render_attribute('back-icon-wrapper','class','ma-el-fb-icon-shape-'.$settings['back_icon_shape']);
			$this->add_render_attribute('back-icon-title','class','back-icon-title');
			$this->add_render_attribute('back-icon','class',$settings['back_icon']);

			$this->add_render_attribute( 'button', 'class', 'ma-el-fb-button' );
			if ( ! empty( $settings['link']['url'] ) ) {
				$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );

				if ( ! empty( $settings['link']['is_external'] ) ) {
					$this->add_render_attribute( 'button', 'target', '_blank' );
				}
			}

			?>
			<div class="ma-el-flip-box-wrapper">
				<div class="ma-el-flip-box-inner">

					<div class="ma-el-flip-box-front">
						<div class="flipbox-content">
							<?php if(!empty($settings['front_icon'])){ ?>
								<div <?php echo $this->get_render_attribute_string( 'front-icon-wrapper' ); ?>>
									<i <?php echo $this->get_render_attribute_string( 'front-icon' ); ?>></i>
								</div>
							<?php } ?>

							<?php if(!empty($settings['front_title'])){ ?>
							<<?php echo $settings['front_title_html_tag']; ?> <?php echo $this->get_render_attribute_string( 'front-icon-title' ); ?> >
							<?php echo $settings['front_title']; ?>
						</<?php echo $settings['front_title_html_tag']; ?>>
						<?php } ?>

						<?php if(!empty($settings['front-text'])){ ?>
							<p>
								<?php echo $settings['front-text']; ?>
							</p>
						<?php } ?>
					</div>
				</div>

				<div class="ma-el-flip-box-back">
					<div class="flipbox-content">
						<?php if(!empty($settings['back_icon'])){ ?>
							<div <?php echo $this->get_render_attribute_string( 'back-icon-wrapper' ); ?>>
								<i <?php echo $this->get_render_attribute_string( 'back-icon' ); ?>></i>
							</div>
						<?php } ?>

						<?php if(!empty($settings['back_title'])){ ?>
						<<?php echo $settings['back_title_html_tag']; ?> <?php echo $this->get_render_attribute_string( 'back-icon-title' ); ?> >
						<?php echo $settings['back_title']; ?>
					</<?php echo $settings['back_title_html_tag']; ?>>
					<?php } ?>

					<?php if(!empty($settings['back_text'])){ ?>
						<p>
							<?php echo $settings['back_text']; ?>
						</p>
					<?php } ?>

					<?php if(!empty($settings['action_text'])){ ?>
						<div class="ma-el-fb-button-wrapper">
							<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
								<span class="elementor-button-text"><?php echo $settings['action_text']; ?></span>
							</a>
						</div>
					<?php  }  ?>
				</div>
			</div>

			</div>
			</div>
			<?php
		}

		protected function _content_template() {}

	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Flip_Box() );