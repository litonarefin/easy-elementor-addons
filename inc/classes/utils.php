<?php
	/**
	 * Snippet Name: RSS Feed to dashboard
	 * Snippet URL: https://jeweltheme.com/category/master-addons/feed/
	 */

	add_action('wp_dashboard_setup', 'ma_el_dashboard_widgets');

	function ma_el_dashboard_widgets() {
		global $wp_meta_boxes;
		unset(
			$wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
		);

		// add a custom dashboard widget
		wp_add_dashboard_widget(
			'dashboard_custom_feed',
			'News from siteXY',
			'dashboard_custom_feed_output' );
	}
	function dashboard_custom_feed_output() {
		echo '<div class="rss-widget">';
		wp_widget_rss_output(array(
			'url' => 'https://jeweltheme.com/feed',
			'title' => 'Whats up at siteXY',
			'items' => 4,
			'show_summary' => 1,
			'show_author' => 0,
			'show_date' => 1
		));
		echo "</div>";
	}


