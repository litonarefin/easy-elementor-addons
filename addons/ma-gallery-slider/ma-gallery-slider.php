<?php
namespace Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;


/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/27/19
 */

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class JLTMA_Gallery_Slider extends Widget_Base {

	//use ElementsCommonFunctions;
	public function get_name() {
		return 'jltma-gallery-slider';
	}
	public function get_title() {
		return esc_html__( 'MA Gallery Slider', MELA_TD );
	}
	public function get_icon() {
		return 'ma-el-icon eicon-slider-push';
	}
	public function get_categories() {
		return [ 'master-addons' ];
	}

	public function get_script_depends() {
		return [
			'jquery-slick',
			'master-addons-waypoints',
			'master-addons-scripts'
		];
	}

	public function get_keywords() {
		return [ 
			'gallery', 
			'image carousel', 
			'image slider', 
			'carousel gallery', 
			'left gallery slider',
			'right gallery slider',
			'slider gallery'
		];
	}


	public function get_help_url() {
		return 'https://master-addons.com/demos/gallery-slider/';
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'jltma_gallery_slider_section_start',
			[
				'label' => esc_html__( 'Gallery', MELA_TD )
			]
		);

			$this->add_control(
				'jltma_gallery_slider',
				[
					'label' 	=> esc_html__( 'Add Images', MELA_TD ),
					'type' 		=> Controls_Manager::GALLERY,
					'dynamic'	=> [ 'active' => true ],
				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'jltma_gallery_slider_section_thumbnails',
			[
				'label' => esc_html__( 'Thumbnails', MELA_TD ),
			]
		);	


			$this->add_control(
				'jltma_gallery_slider_show_thumbnails',
				[
					'type' 		=> Controls_Manager::SWITCHER,
					'label' 	=> esc_html__( 'Thumbnails', MELA_TD ),
					'default' 	=> 'yes',
					'label_off' => esc_html__( 'Hide', MELA_TD ),
					'label_on' 	=> esc_html__( 'Show', MELA_TD ),
					'frontend_available' => true,
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 		=> 'jltma_gallery_slider_thumbnail',
					'label'		=> esc_html__( 'Thumbnails Size', MELA_TD ),
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'columns',
				[
					'label' 	=> esc_html__( 'Columns', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> '2',
					'tablet_default' 	=> '4',
					'mobile_default' 	=> '4',
					'options' 			=> [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
					],
					'prefix_class'	=> 'ee-grid-columns%s-',
					'frontend_available' => true,
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_gallery_rand',
				[
					'label' 	=> esc_html__( 'Ordering', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'' 		=> esc_html__( 'Default', MELA_TD ),
						'rand' 	=> esc_html__( 'Random', MELA_TD ),
					],
					'default' 	=> '',
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_thumbnails_caption_type',
				[
					'label' 	=> esc_html__( 'Caption', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> '',
					'options' 	=> [
						'' 				=> esc_html__( 'None', MELA_TD ),
						'title' 		=> esc_html__( 'Title', MELA_TD ),
						'caption' 		=> esc_html__( 'Caption', MELA_TD ),
						'description' 	=> esc_html__( 'Description', MELA_TD ),
					],
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_view',
				[
					'label' 	=> esc_html__( 'View', MELA_TD ),
					'type' 		=> Controls_Manager::HIDDEN,
					'default' 	=> 'traditional',
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);	
		
		$this->end_controls_section();


        /**
         * Content Tab: Previews
         */


		$this->start_controls_section(
			'jltma_gallery_slider_section_preview',
			[
				'label' => esc_html__( 'Preview', MELA_TD ),
			]
		);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 		=> 'jltma_gallery_slider_preview',
					'label'		=> esc_html__( 'Preview Size', MELA_TD ),
					'default'	=> 'full',
				]
			);

			$this->add_control(
				'jltma_gallery_slider_link_to',
				[
					'label' 	=> esc_html__( 'Link to', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'none',
					'options' 	=> [
						'none' 		=> esc_html__( 'None', MELA_TD ),
						'file' 		=> esc_html__( 'Media File', MELA_TD ),
						'custom' 	=> esc_html__( 'Custom URL', MELA_TD ),
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_link',
				[
					'label' 		=> 'Link to',
					'type' 			=> Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'http://your-link.com', MELA_TD ),
					'condition' 	=> [
						'jltma_gallery_slider_link_to' 	=> 'custom',
					],
					'show_label' 	=> false,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_open_lightbox',
				[
					'label' 	=> esc_html__( 'Lightbox', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'default',
					'options' 	=> [
						'default' 	=> esc_html__( 'Default', MELA_TD ),
						'yes' 		=> esc_html__( 'Yes', MELA_TD ),
						'no' 		=> esc_html__( 'No', MELA_TD ),
					],
					'condition' => [
						'jltma_gallery_slider_link_to' => 'file',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_preview_stretch',
				[
					'label' 	=> esc_html__( 'Image Stretch', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'yes',
					'options' 	=> [
						'no' 	=> esc_html__( 'No', MELA_TD ),
						'yes' 	=> esc_html__( 'Yes', MELA_TD ),
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_caption_type',
				[
					'label' 	=> esc_html__( 'Caption', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'caption',
					'options' 	=> [
						'' 				=> esc_html__( 'None', MELA_TD ),
						'title' 		=> esc_html__( 'Title', MELA_TD ),
						'caption' 		=> esc_html__( 'Caption', MELA_TD ),
						'description' 	=> esc_html__( 'Description', MELA_TD ),
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_show_arrows',
				[
					'type' 		=> Controls_Manager::SWITCHER,
					'label' 	=> esc_html__( 'Arrows', MELA_TD ),
					'default' 	=> '',
					'label_off' => esc_html__( 'Hide', MELA_TD ),
					'label_on' 	=> esc_html__( 'Show', MELA_TD ),
					'frontend_available' => true,
					'prefix_class' 	=> 'elementor-arrows-',
					'render_type' 	=> 'template',
				]
			);

			$this->add_control(
				'jltma_gallery_slider_autoplay',
				[
					'label' 	=> esc_html__( 'Autoplay', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'yes',
					'options' 	=> [
						'yes' 	=> esc_html__( 'Yes', MELA_TD ),
						'no' 	=> esc_html__( 'No', MELA_TD ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_autoplay_speed',
				[
					'label' 	=> esc_html__( 'Autoplay Speed', MELA_TD ),
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> 5000,
					'frontend_available' => true,
					'condition'	=> [
						'jltma_gallery_slider_autoplay' => 'yes',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_pause_on_hover',
				[
					'label' 	=> esc_html__( 'Pause on Hover', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'yes',
					'options' 	=> [
						'yes' 	=> esc_html__( 'Yes', MELA_TD ),
						'no' 	=> esc_html__( 'No', MELA_TD ),
					],
					'frontend_available' => true,
					'condition'	=> [
						'jltma_gallery_slider_autoplay' => 'yes',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_infinite',
				[
					'label' 	=> esc_html__( 'Infinite Loop', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'yes',
					'options' 	=> [
						'yes' 	=> esc_html__( 'Yes', MELA_TD ),
						'no' 	=> esc_html__( 'No', MELA_TD ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_adaptive_height',
				[
					'label' 	=> esc_html__( 'Adaptive Height', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'yes',
					'options' 	=> [
						'yes' 	=> esc_html__( 'Yes', MELA_TD ),
						'no' 	=> esc_html__( 'No', MELA_TD ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_effect',
				[
					'label' 	=> esc_html__( 'Effect', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'slide',
					'options' 	=> [
						'slide' 	=> esc_html__( 'Slide', MELA_TD ),
						'fade' 		=> esc_html__( 'Fade', MELA_TD ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_speed',
				[
					'label' 	=> esc_html__( 'Animation Speed', MELA_TD ),
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> 500,
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_direction',
				[
					'label' 	=> esc_html__( 'Direction', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'ltr',
					'options' 	=> [
						'ltr' 	=> esc_html__( 'Left', MELA_TD ),
						'rtl' 	=> esc_html__( 'Right', MELA_TD ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();











        /**
         * Content Tab: Docs Links
         */
        $this->start_controls_section(
            'jltma_section_help_docs',
            [
                'label' => esc_html__( 'Help Docs', MELA_TD ),
            ]
        );


        $this->add_control(
            'help_doc_1',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Live Demo %2$s', MELA_TD ), '<a href="https://master-addons.com/demos/gallery-slider/" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_2',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Documentation %2$s', MELA_TD ), '<a href="https://master-addons.com/docs/addons/gallery-slider-for-elementor/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_3',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Watch Video Tutorial %2$s', MELA_TD ), '<a href="https://www.youtube.com/watch?v=9amvO6p9kpM" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );
        $this->end_controls_section();




        //Upgrade to Pro
		if ( ma_el_fs()->is_not_paying() ) {

			$this->start_controls_section(
				'jltma_section_pro_style_section',
				[
					'label' => esc_html__( 'Upgrade to Pro Version for More Features', MELA_TD ),
				]
			);

			$this->add_control(
				'jltma_control_get_pro_style_tab',
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

	}


	protected function render() {

		$settings  = $this->get_settings_for_display();



	}


}

Plugin::instance()->widgets_manager->register_widget_type( new JLTMA_Gallery_Slider() );
