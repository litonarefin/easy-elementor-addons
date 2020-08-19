<?php
namespace MasterAddons\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class JLTMA_Featured_Colors extends Tag {

	public function get_name() {
		return 'jltma-featured-colors';
	}

	public function get_title() {
		return esc_html__( 'Featured Colors', MELA_TD );
	}

	public function get_group() {
		return 'colors';
	}

	public function get_categories() {
		return [
			TagsModule::COLOR_CATEGORY
		];
    }

    public function get_colors() {

		$items = [
            '' => [
				'label' => esc_html__( 'Select...', MELA_TD ),
			]
        ];

		for( $i = 1; $i <= 8 ; ++$i ) {
			$items[$i] = [
				'label' =>  sprintf( esc_html__( 'Color %s', MELA_TD ), $i ),
				'color'	=> get_option( 'site_featured_color_' . $i, '#6a14d1' )
			];
		}

        return $items;
    }

	public function is_settings_required() {
		return true;
	}

	protected function _register_controls() {
		$this->add_control(
			'key',
			[
				'label'   => esc_html__( 'Colors', MELA_TD ),
				'type'    => 'jltma-featured-color',
				'options' => $this->get_colors(),
				'default' => ''
            ]
        );
	}

	protected function get_color() {
		if( $key = $this->get_settings( 'key' ) ){
			return "var( --jltma-featured-color-{$key} )";
		}

		return '';
	}

	public function get_value( array $options = [] ) {
		return $this->get_color();
	}

	public function render() {
		echo $this->get_color();
	}

}
