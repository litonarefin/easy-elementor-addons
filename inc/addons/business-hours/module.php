<?php
namespace MasterAddons\Addons\BusinessHours;

use MasterAddons\Inc\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'master-business-hours';
	}

	public function get_widgets() {
		return [
			'Business_Hours',
		];
	}
}
