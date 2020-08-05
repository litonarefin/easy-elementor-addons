<?php
namespace Elementor;

// Elementor Classes
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 05/08/2020
 */


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Master_Addons_Toggle_Content extends Widget_Base {

    public function get_name() {
        return 'ma-toggle-content';
    }

    public function get_title() {
        return esc_html__( 'MA Toggle Content', MELA_TD);
    }

    public function get_icon() {
        return 'ma-el-icon eicon-dual-button';
    }

    public function get_categories() {
        return [ 'master-addons' ];
    }

    public function get_style_depends(){
        return [
            'font-awesome-5-all',
            'font-awesome-4-shim'
        ];
    }

    public function get_keywords() {
        return [
            'content toggle',
            'toggle content',
            'content switcher',
            'switch content',
            'on/off content'
        ];
    }

    public function get_help_url(){
        return 'https://master-addons.com/demos/toggle-content/';
    }

    protected function _register_controls() {

        /**
         * -------------------------------------------
         * Tab Style MA Toggle Content
         * -------------------------------------------
         */
        $this->start_controls_section(
            'jltma_toggle_content_element_settings',
            [
                'label' => esc_html__( 'Content Settings', MELA_TD )
            ]
        );

        if ( ma_el_fs()->can_use_premium_code() ) {
            $this->add_control(
                'jltma_toggle_content_preset',
                [
                    'label'       	=> esc_html__( 'Style Preset', MELA_TD ),
                    'type' 			=> Controls_Manager::SELECT,
                    'default' 		=> 'two',
                    'label_block' 	=> false,
                    'options' 		=> [
                            'two'       => esc_html__( 'Horizontal Tabs', MELA_TD ),
                            'three'     => esc_html__( 'Vertical Tabs', MELA_TD ),
                            'four'      => esc_html__( 'Left Active Border', MELA_TD ),
                            'five'      => esc_html__( 'Tabular Content', MELA_TD ),
                    ]
                ]
            );
        } else{
            $this->add_control(
                'jltma_toggle_content_preset',
                [
                    'label'       	=> esc_html__( 'Style Preset', MELA_TD ),
                    'type' 			=> Controls_Manager::SELECT,
                    'default' 		=> 'two',
                    'label_block' 	=> false,
                    'options' 		=> [
                            'two'       => esc_html__( 'Horizontal Tabs', MELA_TD ),
                            'three'     => esc_html__( 'Vertical Tabs', MELA_TD ),
                            'four'      => esc_html__( 'Left Active Border', MELA_TD ),
                            'ma_tabular_pro'      => esc_html__( 'Tabular Content (Pro)', MELA_TD ),
                    ],
                ]
            );
        }

        $repeater = new Repeater();

        $repeater->start_controls_tabs( 'jltma_toggle_contents_repeater' );

        $repeater->start_controls_tab( 'jltma_toggle_content', [ 'label' => esc_html__( 'Content', MELA_TD ) ] );

        $repeater->add_control(
            'jltma_toggle_content_text',
            [
                'default'	=> '',
                'type'		=> Controls_Manager::TEXT,
                'dynamic'	=> [ 'active' => true ],
                'label' 	=> esc_html__( 'Label', MELA_TD ),
                'separator' => 'none',
            ]
        );


        $this->add_control(
            'jltma_toggle_content_icon',
            [
                'label'					=> esc_html__( 'Icon', MELA_TD ),
                'type'					=> Controls_Manager::ICONS,
                'fa4compatibility'		=> 'jltma_toggle_content_fa4_icon',
                'label_block' 	        => false,
            ]
        );

        $repeater->add_control(
            'jltma_toggle_content_icon_align',
            [
                'label' 	            => esc_html__( 'Icon Position', MELA_TD ),
                'label_block'           => false,
                'type' 		            => Controls_Manager::SELECT,
                'default' 	            => 'left',
                'options' 	            => [
                    'left' 		=> esc_html__( 'Before', MELA_TD ),
                    'right' 	=> esc_html__( 'After', MELA_TD ),
                ],
                'condition' => [
                    'jltma_toggle_content_fa4_icon!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'jltma_toggle_content_icon_align',
            [
                'label' 	            => esc_html__( 'Icon Spacing', MELA_TD ),
                'type' 		            => Controls_Manager::SLIDER,
                'range' 	            => [
                    'px' 	=> [
                        'max' => 50,
                    ],
                ],
                'condition'             => [
                    'jltma_toggle_content_fa4_icon!' => '',
                ],
                'selectors'             => [
                    // '{{WRAPPER}} {{CURRENT_ITEM}} .ee-icon--right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}} {{CURRENT_ITEM}} .ee-icon--left' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'jltma_toggle_content_type',
            [
                'label'		            => esc_html__( 'Type', MELA_TD ),
                'type' 		            => Controls_Manager::SELECT,
                'default' 	            => 'content',
                'options' 	            => [
                    'content' 		    => esc_html__( 'Content', MELA_TD ),
                    'template' 	        => esc_html__( 'Template', MELA_TD ),
                ],
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' 	            => esc_html__( 'Content', MELA_TD ),
                'type' 		            => Controls_Manager::WYSIWYG,
                'dynamic'	            => [ 'active' => true ],
                'default' 	            => esc_html__( 'I am the content ready to be toggled', MELA_TD ),
                'condition'	            => [
                    'content_type'      => 'content',
                ],
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
                'raw'             => sprintf( esc_html__( '%1$s Live Demo %2$s', MELA_TD ), '<a href="https://master-addons.com/demos/tabs/" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_2',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Documentation %2$s', MELA_TD ), '<a href="https://master-addons.com/docs/addons/tabs-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_3',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Watch Video Tutorial %2$s', MELA_TD ), '<a href="https://www.youtube.com/watch?v=lsqGmIrdahw" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );
        $this->end_controls_section();



        if ( ma_el_fs()->is_not_paying() ) {

            $this->start_controls_section(
                'ma_el_section_pro_style_section',
                [
                    'label' => esc_html__( 'Upgrade to Pro Nested Tabs', MELA_TD ),
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
                    'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
                ]
            );

            $this->end_controls_section();
        }


    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $column_order = ( isset( $settings['ma_el_tabs_left_cols'] ) ) ? 'row d-flex' : '';
        $this->add_render_attribute(
            'ma_el_tab_wrapper',
            [
                'id'     => "ma-el-advance-tabs-{$this->get_id()}",
                'class'	 => [ 'ma-el-advance-tab',
                                $settings['ma_el_tabs_preset'],
                                $column_order
                            ],
                'data-tab-effect' => $settings['ma_el_tabs_effect']
            ]
        );

        if(isset( $settings['ma_el_tabs_left_cols'] )){
            $ma_el_tabs_left_cols = explode( '-',  $settings['ma_el_tabs_left_cols'] );
        }
        $column_order = isset( $settings['ma_el_tabs_content_style'] )?$settings['ma_el_tabs_content_style']:"";
    ?>


            <div <?php echo $this->get_render_attribute_string('ma_el_tab_wrapper'); ?> data-tabs>

                <?php if(isset( $settings['ma_el_tabs_preset']) && $settings['ma_el_tabs_preset'] == "five"){ ?>
                    <div class="col-md-<?php echo esc_attr($ma_el_tabs_left_cols[0]);?> <?php if($column_order=="float-left") {
                            echo "order-1";
                        }else{
                            echo "order-2";
                        } ?>">
                <?php } ?>

                        <ul class="ma-el-advance-tab-nav">
                            <?php foreach( $settings['ma_el_tabs'] as $key=>$tab ) : ?>
                                <li class="<?php echo esc_attr( $tab['ma_el_tab_show_as_default'] ); ?>" data-tab data-tab-id="jltma-tab-<?php echo $this->get_id() . $key;?>">
                                    <?php if( $settings['ma_el_tabs_icon_show'] === 'yes' ) :
                                        if( $tab['ma_el_tabs_icon_type'] === 'icon' ) : ?>
                                            <i class="<?php echo esc_attr( $tab['ma_el_tab_title_icon'] ); ?>"></i>
                                        <?php elseif( $tab['ma_el_tabs_icon_type'] === 'image' ) : ?>
                                            <img src="<?php echo esc_attr( $tab['ma_el_tab_title_image']['url'] );
                                            ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <span class="ma-el-tab-title"><?php echo $tab['ma_el_tab_title']; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    <?php if($settings['ma_el_tabs_preset'] == "five"){ ?>
                        </div>

                    <div class="col-md-<?php echo esc_attr($ma_el_tabs_left_cols[1]);?> <?php if($column_order=="float-left") {
                            echo "order-2";
                        }else{
                            echo "order-1";
                        } ?>">
                    <?php } ?>

                        <div class="tab-content">
                            <?php foreach( $settings['ma_el_tabs'] as $key=>$tab ) : $ma_el_find_default_tab[] = $tab['ma_el_tab_show_as_default'];?>
                                <div id="jltma-tab-<?php echo $this->get_id() . $key;?>" class="ma-el-advance-tab-content tab-pane <?php echo esc_attr( $tab['ma_el_tab_show_as_default']
                                ); ?>">
                                    <?php
                                        // Nested Accordion Available for Premium Version
                                        if ( ma_el_fs()->can_use_premium_code() ) {

                                            if ( $tab['ma_tabs_content_type'] == 'content' ) {

                                                echo do_shortcode( $tab['ma_el_tab_content'] );

                                            } else if ( $tab['ma_tabs_content_type'] == 'section' && ! empty( $tab['saved_section'] ) ) {

                                                echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $tab['saved_section'] );

                                            } else if ( $tab['ma_tabs_content_type'] == 'template' && ! empty( $tab['templates'] ) ) {

                                                echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $tab['templates'] );

                                            } else if ( $tab['ma_tabs_content_type'] == 'widget' && ! empty( $tab['saved_widget'] ) ) {

                                                echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $tab['saved_widget'] );

                                            }

                                            // Free Version Code
                                        } else{

                                                echo do_shortcode( $tab['ma_el_tab_content'] );
                                        } ?>
                                    </div><!-- ma-el-advance-tab-content -->
                                <?php endforeach; ?>
                            </div> <!-- tab-content -->


                        <?php if($settings['ma_el_tabs_preset'] == "five"){ ?>
                            </div> <!-- col-md-5 -->
                        <?php } ?>

            </div>
        <?php
    }



    public function get_page_template_options( $type = '' ) {

        $page_templates = Master_Addons_Helper::ma_get_page_templates( $type );

        $options[-1]   = esc_html__( 'Select', MELA_TD );

        if ( count( $page_templates ) ) {
            foreach ( $page_templates as $id => $name ) {
                $options[ $id ] = $name;
            }
        } else {
            $options['no_template'] = esc_html__( 'No saved templates found!', MELA_TD );
        }

        return $options;
    }


}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Toggle_Contenttoggle-content);