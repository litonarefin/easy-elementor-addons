<?php
	namespace Elementor;
	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 6/26/19
	 */

	use Elementor\Widget_Base;

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Infobox extends Widget_Base {

		public function get_name() {
			return 'ma-el-infobox';
		}
		public function get_title() {
			return esc_html__( 'MA Info Box', MELA_TD );
		}
		public function get_icon() {
			return 'ma-el-icon eicon-info-box';
		}
		public function get_categories() {
			return [ 'master-addons' ];
		}
		protected function _register_controls() {

			/*
			* Master Addons: Infobox Image
			*/
			$this->start_controls_section(
				'ma_el_section_infobox_content',
				[
					'label' => esc_html__( 'Content', MELA_TD )
				]
			);

			$this->add_control(
				'ma_el_infobox_img_or_icon',
				[
					'label' => esc_html__( 'Image or Icon', MELA_TD ),
					'type' => Controls_Manager::CHOOSE,
					'label_block' => true,
					'options' => [
						'none' => [
							'title' => esc_html__( 'None', MELA_TD ),
							'icon' => 'fa fa-ban',
						],
						'icon' => [
							'title' => esc_html__( 'Icon', MELA_TD ),
							'icon' => 'fa fa-info-circle',
						],
						'img' => [
							'title' => esc_html__( 'Image', MELA_TD ),
							'icon' => 'fa fa-picture-o',
						]
					],
					'default' => 'icon',
				]
			);



			$this->add_control(
				'ma_el_infobox_image',
				[
					'label' => esc_html__( 'Image', MELA_TD ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'ma_el_infobox_img_or_icon' => 'img'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail',
					'default' => 'full',
					'condition' => [
						'ma_el_infobox_img_or_icon' => 'img'
					]
				]
			);

			$this->add_control(
				'ma_el_infobox_icon',
				[
					'label' => esc_html__( 'Icon', MELA_TD ),
					'type' => Controls_Manager::ICON,
					'default' => 'fa fa-tag',
					'condition' => [
						'ma_el_infobox_img_or_icon' => 'icon'
					]
				]
			);


			$this->add_control(
				'ma_el_infobox_title',
				[
					'label' => esc_html__( 'Title', MELA_TD ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'Infobox Title', MELA_TD ),
				]
			);

			$this->add_control(
				'ma_el_infobox_title_link',
				[
					'label' => __( 'Title URL', MELA_TD ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', MELA_TD ),
					'label_block' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
					],
				]
			);

			$this->add_control(
				'ma_el_infobox_description',
				[
					'label' => esc_html__( 'Description', MELA_TD ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Basic description about the Infobox', MELA_TD ),
				]
			);

			$this->end_controls_section();


			/*
			* Infobox Styling Section
			*/
			$this->start_controls_section(
				'ma_el_section_infobox_styles_preset',
				[
					'label' => esc_html__( 'General Styles', MELA_TD ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);
			$this->add_control(
				'ma_el_infobox_preset',
				[
					'label' => esc_html__( 'Style Preset', MELA_TD ),
					'type' => Controls_Manager::SELECT,
					'default' => 'one',
					'options' => [
						'one' => esc_html__( 'Style 1', MELA_TD ),
						'two' => esc_html__( 'Style 2', MELA_TD ),
						'three' => esc_html__( 'Style 3', MELA_TD ),
						'four' => esc_html__( 'Style 4', MELA_TD ),
						'five' => esc_html__( 'Style 5', MELA_TD ),
						'six' => esc_html__( 'Style 6', MELA_TD ),
						'seven' => esc_html__( 'Style 7', MELA_TD ),
						'eight' => esc_html__( 'Style 8', MELA_TD ),
						'nine' => esc_html__( 'Style 9', MELA_TD ),
						'ten' => esc_html__( 'Style 10', MELA_TD ),
						'eleven' => esc_html__( 'Style 11', MELA_TD ),
						'twelve' => esc_html__( 'Style 12', MELA_TD ),
					],
				]
			);

			$this->add_control(
				'ma_el_infobox_color_scheme',
				[
					'label' => __('Icon Color Scheme', MELA_TD),
					'type' => Controls_Manager::COLOR,
					'default' => '#704aff',
					'selectors' => [
						'{{WRAPPER}} .ma-el-infobox.one .ma-el-infobox-icon::before' => 'background: {{VALUE}};',
						'{{WRAPPER}} .ma-el-infobox.one .ma-el-infobox-icon i, 
						{{WRAPPER}} .ma-el-infobox.two .ma-el-infobox-item:hover .ma-el-infobox-icon i, 
						{{WRAPPER}} .ma-el-infobox.three .ma-el-infobox-item .ma-el-infobox-icon i, 
						{{WRAPPER}} .ma-el-infobox.four .ma-el-infobox-item:hover .ma-el-infobox-icon i, 
						{{WRAPPER}} .ma-el-infobox.five .ma-el-infobox-item:hover .ma-el-infobox-icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ma-el-infobox.one .ma-el-infobox-item:hover .ma-el-infobox-icon i' => 'color: #FFF',
						'{{WRAPPER}} .ma-el-infobox.two .ma-el-infobox-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .ma-el-infobox.two .ma-el-infobox-item:hover .ma-el-infobox-icon, 
						{{WRAPPER}} .ma-el-infobox.four .ma-el-infobox-item:hover .ma-el-infobox-icon, 
						{{WRAPPER}} .ma-el-infobox.five .ma-el-infobox-item:hover .ma-el-infobox-icon' => 'background: #FFF; border: 1px solid {{VALUE}};',

						'{{WRAPPER}} .ma-el-infobox.three .ma-el-infobox-item:hover .ma-el-infobox-icon i' => 'color: #FFF',
						/*new added line */

						'{{WRAPPER}} .ma-el-infobox.four .ma-el-infobox-icon, {{WRAPPER}} .ma-el-infobox.five .ma-el-infobox-icon' =>
							'background: {{VALUE}};',
						'{{WRAPPER}} .ma-el-infobox.five .ma-el-infobox-item' => 'border-bottom: 3px solid {{VALUE}};',

					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'background',
					'label' => __( 'Background', MELA_TD ),
					'types' => [ 'classic', 'gradient' ],
					'separator' => 'before',
					'selector' => '{{WRAPPER}} .ma-el-infobox .ma-el-infobox-item',
					'default' => '#FFFFFF',
				]
			);


			$this->end_controls_section();

			// Title , Description Font Color and Typography

			$this->start_controls_section(
				'section_infobox_title',
				[
					'label' => __('Title', MELA_TD),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'ma_el_title_color',
				[
					'label' => __('Color', MELA_TD),
					'type' => Controls_Manager::COLOR,
					'default' => '#132c47',
					'selectors' => [
						'{{WRAPPER}} .ma-el-infobox-content-title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'infobox_title_typography',
					'selector' => '{{WRAPPER}} .ma-el-infobox-content-title',
				]
			);

			$this->end_controls_section();


			$this->start_controls_section(
				'section_infobox_description',
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
					'default' => '#797c80',
					'selectors' => [
						'{{WRAPPER}} .ma-el-infobox-content-description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'ma_el_description_typography',
					'selector' => '{{WRAPPER}} .ma-el-infobox-content-description',
				]
			);

			$this->end_controls_section();

		}
		protected function render() {
			$settings = $this->get_settings_for_display();

			$infobox_image = $this->get_settings_for_display( 'ma_el_infobox_image' );
			$infobox_image_url = Group_Control_Image_Size::get_attachment_image_src( $infobox_image['id'], 'thumbnail', $settings );

			if ( empty( $infobox_image_url ) ) {
				$infobox_image_url = $infobox_image['url'];
			}  else {
				$infobox_image_url = $infobox_image_url;
			}

			?>

            <div id="ma-el-infobox-<?php echo esc_attr($this->get_id()); ?>" class="ma-el-infobox <?php echo esc_attr
			($settings['ma_el_infobox_preset']); ?>">
                <div class="ma-el-infobox-item">

					<?php if( $settings['ma_el_infobox_img_or_icon'] != 'none' ) : ?>
                        <div class="ma-el-infobox-icon">
                            <div class="inner-content">

								<?php if( 'icon' == $settings['ma_el_infobox_img_or_icon'] ) : ?>
                                    <i class="<?php echo esc_attr( $settings['ma_el_infobox_icon'] ); ?>"></i>
								<?php endif; ?>

								<?php if( 'img' == $settings['ma_el_infobox_img_or_icon'] ) : ?>
                                    <img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
								<?php endif; ?>

								<?php if($settings['ma_el_infobox_preset']=="ten"){ ?>
                                    <h3 class="ma-el-infobox-content-title"><?php echo $settings['ma_el_infobox_title']; ?></h3>
								<?php }?>
                            </div><!-- /.inner-content -->
                        </div>
					<?php endif; ?>

                    <div class="ma-el-infobox-content">
                        <div class="inner-content">
							<?php if($settings['ma_el_infobox_preset']!=="ten"){ ?>
                                <h3 class="ma-el-infobox-content-title"><?php echo $settings['ma_el_infobox_title']; ?></h3>
							<?php }?>
                            <p class="ma-el-infobox-content-description">
								<?php echo $settings['ma_el_infobox_description']; ?>
                            </p>
                        </div><!-- /.inner-content -->
                    </div>
                </div>
            </div>

			<?php
		}

		protected function _content_template() { ?>

            <div id="ma-el-infobox" class="ma-el-infobox {{ settings.ma_el_infobox_preset }}">
                <div class="ma-el-infobox-item">

                    <# if( settings.ma_el_infobox_img_or_icon != 'none') { #>
                    <div class="ma-el-infobox-icon">

                        <# if( 'icon' == settings.ma_el_infobox_img_or_icon ) { #>
                        <i class="{{{ settings.ma_el_infobox_icon }}}"></i>
                        <# } #>

                        <# if( 'img' == settings.ma_el_infobox_img_or_icon ) { #>
                        <img src="{{{ settings.ma_el_infobox_image.url }}}" alt="Icon Image">
                        <# } #>

                        <# if( 'ten' == settings.ma_el_infobox_preset ) { #>
                            <h3 class="ma-el-infobox-content-title">{{{ settings.ma_el_infobox_title }}}</h3>
                        <# } #>


                    </div>
                    <# } #>

                    <div class="ma-el-infobox-content">
                        <# if( 'ten' !== settings.ma_el_infobox_preset ) { #>
                            <h3 class="ma-el-infobox-content-title">{{{ settings.ma_el_infobox_title }}}</h3>
                        <# } #>
                        <p class="ma-el-infobox-content-description">{{{ settings.ma_el_infobox_description }}}
                        </p>
                    </div>
                </div>
            </div>
			<?php
		}
	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Infobox() );