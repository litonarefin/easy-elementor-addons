<?php
	namespace Elementor;

	// Elementor Classes
    use Elementor\Widget_Base;
    use Elementor\Group_Control_Typography;
    use Elementor\Scheme_Color;
    use Elementor\Scheme_Typography;    
	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 02/05/2020
	 */

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Twitter_Slider extends Widget_Base {

		public function get_name() {
			return 'ma-el-twitter-slider';
		}

		public function get_title() {
			return esc_html__( 'Twitter Slider', MELA_TD );
		}

		public function get_icon() {
			return 'ma-el-icon eicon-twitter-feed';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

			/**
			 * Master Addons: Domain Checker
			 */
			$this->start_controls_section(
				'ma_el_domain_checker_content',
				[
					'label' => esc_html__( 'General', MELA_TD ),
				]
			);

            
            $this->add_control(
                'button_text',
                array(
                    'label'       => __( 'Text', MELA_TD ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => 'Search',
                    'label_block' => true
                )
            );

            $this->add_control(
                'palceholder_text',
                array(
                    'label'       => __( 'Input Placeholder', MELA_TD ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => 'Enter Your Domain Here',
                    'label_block' => true
                )
            );
                        
            $this->end_controls_section();
            

        /*  button_style_section
        /*-------------------------------------*/

        $this->start_controls_section(
            'button_style_section',
            array(
                'label'     => __('Button', MELA_TD ),
                'tab'       => Controls_Manager::TAB_STYLE
            )
        );

        $this->start_controls_tabs( 'button_background_tab' );

        $this->start_controls_tab(
            'button_bg_normal',
            array(
                'label' => __( 'Normal' , MELA_TD )
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'button_background',
                'label' => __( 'Background', MELA_TD ),
                'types' => array( 'classic', 'gradient' ),
                'selector' => '{{WRAPPER}} .ma-el-button',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'      => 'button_box_shadow',
                'selector'  => '{{WRAPPER}} .ma-el-button'
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_bg_hover',
            array(
                'label' => __( 'Hover' , MELA_TD )
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'hover_button_background',
                'label' => __( 'Background', MELA_TD ),
                'types' => array( 'classic', 'gradient' ),
                'selector' => '{{WRAPPER}} .ma-el-button .ma-el-overlay::after',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'      => 'hover_button_box_shadow',
                'selector'  => '{{WRAPPER}} .ma-el-button:hover'
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_text_heading',
            array(
                'label'     => __( 'Button Text', MELA_TD ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            )
        );

        $this->start_controls_tabs( 'button_text_style' );

        $this->start_controls_tab(
            'button_text_normal',
            array(
                'label' => __( 'Normal' , MELA_TD )
            )
        );

        $this->add_control(
            'btn_text_color',
            array(
                'label' => __( 'Color', MELA_TD ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ma-el-button span' => 'color: {{VALUE}};',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name' => 'btn_text_shadow',
                'label' => __( 'Text Shadow', MELA_TD ),
                'selector' => '{{WRAPPER}} .ma-el-button',
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'button_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ma-el-button span'
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_text_hover',
            array(
                'label' => __( 'Hover' , MELA_TD )
            )
        );

        $this->add_control(
            'hover_btn_text_color',
            array(
                'label' => __( 'Color', MELA_TD ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ma-el-button:hover .ma-el-button span' => 'color: {{VALUE}};',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name' => 'hover_btn_text_shadow',
                'label' => __( 'Text Shadow', MELA_TD ),
                'selector' => '{{WRAPPER}} .ma-el-button:hover',
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'hover_button_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ma-el-button span'
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'button_padding',
            array(
                'label'      => __( 'Padding', MELA_TD ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .ma-el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->end_controls_section();


        /*  loader_style_section
        /*-------------------------------------*/

        $this->start_controls_section(
            'loader_style_section',
            array(
                'label'     => __('Loader', MELA_TD ),
                'tab'       => Controls_Manager::TAB_STYLE
            )
        );

        $this->add_control(
            'loader_color',
            array(
                'label' => __( 'Color', MELA_TD ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ma-el-button path, .ma-el-button rect' => 'fill: {{VALUE}};',
                )
            )
        );

        $this->add_control(
            'loader_size',
            array(
                'label'       => __( 'Size', MELA_TD ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '24',
                'min'         => 16,
                'step'        => 1
            )
        );

        $this->end_controls_section();

		}

		protected function render() {
                $settings = $this->get_settings_for_display();
                ob_start();
                ?>
                <div class="ma-el-domain-checker">
                    <div class="ma-el-input-group">
                        <form method="post">
                            <input type="text" placeholder="<?php echo esc_attr( $settings['palceholder_text'] ); ?>" class="form-control" autocomplete="off">
                            <button type="submit" class="ma-el-button ma-el-black ma-el-btn-loader">
                                <span><?php echo $settings['button_text']; ?></span>
                            </button>
                        </form>
                    </div>
                    <div class="ma-el-results"></div>
                </div>

                <script>
                ;(function($){
                    $(function(){
                        $('.ma-el-domain-checker').on('submit', function(event) {
                            event.preventDefault();
                            var $this  = $(this);
                            var domain = $('.form-control', $this).val();
                            $.ajax({
                                type      :'POST',
                                dataType  : 'json',
                                url       : '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                                data      :{
                                    action: 'jltma_domain_checker',
                                    domain: domain,
                                    nonce : '<?php echo wp_create_nonce( 'ma-el-domain-checker' ); ?>'
                                },
                                beforeSend:function(){
                                    // Add progress status class to button
                                    $('.ma-el-button' , $this).addClass( 'ma-el-svg-progress' ).prop('disabled', true);
                                }
                            }).then(function( response ) {
                                $('.ma-el-button' , $this).removeClass( 'ma-el-svg-progress' ).prop('disabled', false);
                                if( response.success ) {
                                    $( '.ma-el-results', $this ).addClass( "ma-el-success" ).removeClass( "ma-el-error" ).html( response.data );
                                } else {
                                    $( '.ma-el-results', $this ).addClass( "ma-el-error" ).removeClass( "ma-el-success" ).html( response.data );
                                }
                            });
                        });
                    });
                })( jQuery );
                </script>
            <?php
            echo ob_get_clean();

		}



	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Twitter_Slider() );