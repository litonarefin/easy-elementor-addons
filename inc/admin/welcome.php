<?php
/*
	 * Master Addons : Welcome Screen by Jewel Theme
	 */
$jltma_white_label_setting = jltma_get_options('jltma_white_label_settings');
?>

<div class="master_addons">
	<div class="wrappper about-wrap">

		<div class="intro_wrapper">

			<header class="header">
				<a class="ma_el_logo" href="https://wordpress.org/plugins/master-addons" target="_blank">
					<div class="wp-badge welcome__logo ma_logo"></div>
				</a>

				<h1 class="ma_title">
					<?php if (!empty($jltma_white_label_setting['jltma_wl_plugin_menu_label'])) {
						printf(__('%s <small>v %s</small>'), $jltma_white_label_setting['jltma_wl_plugin_menu_label'], JLTMA_PLUGIN_VERSION);
					} else {
						printf(__('%s <small>v %s</small>'), MELA, JLTMA_PLUGIN_VERSION);
					}
					?>
				</h1>

				<div class="about-text"></div>
			</header>

		</div>

		<?php require_once MELA_PLUGIN_PATH . '/inc/admin/welcome/navigation.php'; ?>

		<div class="master_addons_contents">
			<?php
			require MELA_PLUGIN_PATH . '/inc/admin/welcome/supports.php';
			require MELA_PLUGIN_PATH . '/inc/admin/welcome/addons.php';
			require MELA_PLUGIN_PATH . '/inc/admin/welcome/extensions.php';
			require MELA_PLUGIN_PATH . '/inc/admin/welcome/api-keys.php';
			require MELA_PLUGIN_PATH . '/inc/admin/welcome/version-control.php';
			require MELA_PLUGIN_PATH . '/inc/admin/welcome/changelogs.php';
			require MELA_PLUGIN_PATH . '/inc/admin/welcome/white-label.php';
			?>
		</div>

	</div>
</div>
