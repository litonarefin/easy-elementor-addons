<?php

namespace MasterAddons\Admin\Dashboard\Addons;

use MasterAddons\Master_Elementor_Addons;
use MasterAddons\Admin\Dashboard\Addons\Elements;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

include_once MELA_PLUGIN_PATH . '/inc/admin/jltma-elements/ma-elements.php';
?>


<div class="master_addons_feature">

	<div class="master-addons-dashboard-filter">
		<div class="filter-left">
			<h3><?php echo esc_html__('Master Addons Elements', MELA_TD); ?></h3>
			<p>
				<?php echo esc_html__('Enable/Disable all Elements once. Please make sure to click "Save Changes" button'); ?>
			</p>
		</div>

		<div class="filter-right">
			<button class="addons-enable-all">
				<?php echo esc_html__('Enable All', MELA_TD); ?>
			</button>
			<button class="addons-disable-all">
				<?php echo esc_html__('Disable All', MELA_TD); ?>
			</button>
		</div>
	</div><!-- /.master-addons-dashboard-filter -->

	<h3><?php echo esc_html__('Content Elements', MELA_TD); ?></h3>

	<?php
	foreach ($jltma_elements['jltma-addons']['elements'] as $key => $value) {
		print_r($value);
	}

	// print_r(MELA_PLUGIN_PATH . '/inc/admin/jltma-elements/ma-elements.php');
	// print_r($jltma_elements);

	foreach ($jltma_elements['jltma-addons']['elements'] as $key => $widget) : ?>

		<div class="master-addons-dashboard-checkbox col">
			<div class="master-addons-dashboard-checkbox-content">

				<div class="master-addons-features-ribbon">
					<?php
					// $is_pro = "";
					// if (isset($widget)) {
					// 	if (is_array($widget)) {
					// 		$is_pro = $widget[1];
					// 		$widget = $widget[0];

					// 		if (!ma_el_fs()->can_use_premium_code()) {
					// 			echo '<span class="pro-ribbon">';
					// 			echo ucwords($is_pro);
					// 			echo '</span>';
					// 		}
					// 	}
					// }

					if (isset($widget['is_pro']) && $widget['is_pro']) {
						echo '<span class="pro-ribbon">Pro</span>';
						// echo 'Pro';
						// echo '</span>';
					}

					?>
				</div>

				<div class="master-addons-el-title">
					<div class="master-addons-el-title-content">
						<?php echo $widget['title']; ?>
					</div> <!-- master-addons-el-title-content -->

					<div class="ma-el-tooltip">
						<?php
						Master_Addons_Helper::jltma_admin_tooltip_info('Demo', $widget['demo_url'], 'eicon-device-desktop');
						Master_Addons_Helper::jltma_admin_tooltip_info('Documentation', $widget['docs_url'], 'eicon-info-circle-o');
						Master_Addons_Helper::jltma_admin_tooltip_info('Video Tutorial', $widget['tuts_url'], 'eicon-video-camera');
						?>
					</div>
				</div> <!-- .master-addons-el-title -->

				<?php
				// if (isset($widget)) {
				// 	if (is_array($widget)) {
				// 		$is_pro = $widget[1];
				// 	}
				// }
				?>

				<div class="master_addons_feature_switchbox">
					<label for="<?php echo esc_attr($widget['key']); ?>" class="switch switch-text switch-primary switch-pill
					<?php if (!ma_el_fs()->can_use_premium_code() && isset($widget['is_pro']) && $widget['is_pro']) {
						echo "ma-el-pro";
					} ?>">

						<?php if (ma_el_fs()->can_use_premium_code()) { ?>

							<input type="checkbox" id="<?php echo esc_attr($widget['key']); ?>" class="switch-input" name="<?php echo esc_attr($widget['key']); ?>" <?php checked(1, $this->maad_el_get_settings[$widget['key']], true); ?>>

						<?php } else { ?>

							<input type="checkbox" id="<?php echo esc_attr($widget['key']); ?>" class="switch-input " name="<?php echo esc_attr($widget['key']); ?>" <?php
																																										if (!ma_el_fs()->can_use_premium_code() && isset($widget['is_pro']) && $widget['is_pro']) {
																																											checked(0, $this->maad_el_get_settings[$widget['key']], false);
																																											echo "disabled";
																																										} else {
																																											checked(1, $this->maad_el_get_settings[$widget['key']], true);
																																										}  ?> />

						<?php } ?>

						<span data-on="On" data-off="Off" class="switch-label"></span>
						<span class="switch-handle"></span>
					</label>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

</div> <!--  .master_addons_feature-->
