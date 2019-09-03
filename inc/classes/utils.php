<?php
	/**
	 * Snippet Name: RSS Feed to dashboard
	 * Snippet URL: https://jeweltheme.com/category/master-addons/feed/
	 */

	add_action('wp_dashboard_setup', 'ma_el_dashboard_widgets');

	function ma_el_array_flatten($array) {
		if (!is_array($array)) {
			return false;
		}
		$result = array();
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$result = array_merge($result, array_values($value));
			} else {
				$result[$key] = $value;
			}
		}
		return $result;
	}

	function ma_el_dashboard_widgets() {
		global $wp_meta_boxes;
		unset(
			$wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
		);

		// add a custom dashboard widget
		wp_add_dashboard_widget(
			'master-addons-news-feed',
			'<img src="https://master-addons.com/wp-content/uploads/2019/06/icon-128x128.png" height="20" width="20">' .
			esc_html__
			('Master Addons News & Updates', MELA_TD),
			'ma_el_dashboard_news_feed' );
	}

	function ma_el_dashboard_news_feed() {
		echo '<div class="rss-widget">';
		wp_widget_rss_output(array(
			'url' => 'https://master-addons.com/blog/',
			'title' => 'Master Addons News & Updates',
			'items' => 5,
			'show_summary' => 1,
			'show_author' => 0,
			'show_date' => 1
		));
		echo "</div>";
	}


	function ma_el_hex2rgb_array( $hex ) {
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else { // strlen($hex) != 3
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
		return $rgb; // returns an array with the rgb values
	}


	//reference https://stackoverflow.com/questions/15202079/convert-hex-color-to-rgb-values-in-php
	function ma_el_hex2Rgb($hex, $alpha = false) {
		$hex      = str_replace('#', '', $hex);
		$length   = strlen($hex);
		$rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
		$rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
		$rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
		if ( $alpha ) {
			$rgb['a'] = $alpha;
		}
		return $rgb;
	}