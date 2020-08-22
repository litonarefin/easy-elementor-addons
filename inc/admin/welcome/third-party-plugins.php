<?php
	namespace MasterAddons\Admin\Dashboard\Extensions;
	use MasterAddons\Master_Elementor_Addons;
    use MasterAddons\Inc\Helper\Master_Addons_Helper;
    use MasterAddons\Admin\Dashboard\Addons\ThirdPartyPlugins;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 9/5/19
	 */

	include_once MELA_PLUGIN_PATH . '/inc/admin/jltma-elements/ma-third-party-plugins.php';
	?>

	<h3><?php echo esc_html__('Third Party Plugins', MELA_TD);?></h3>

	<!-- Third Party Plugins -->
	<?php 
	foreach( Master_Elementor_Addons::$jltma_third_party_plugins as $key=>$jltma_plugins ) {
		// $is_pro = "";
		// print_r($jltma_plugins);
		?>

		<div class="master-addons-dashboard-checkbox col">
			<div class="master-addons-dashboard-checkbox-content">

				<div class="master-addons-features-ribbon">
					<?php
						$is_pro = "";
						if ( isset( $extension ) ) {
							if ( is_array( $extension ) ) {
								$is_pro = $extension[1];
								$extension = $extension[0];

								if( !ma_el_fs()->can_use_premium_code()) {
								echo '<span class="pro-ribbon">';
								echo ucwords( $is_pro );
								echo '</span>';
								}
							}
						}
					?>
				</div>

				<div class="master-addons-el-title">
					<div class="master-addons-el-title-content">
						<?php echo $jltma_elements['jltma-plugins']['plugin'][$key]['title']; ?>
					</div> <!-- master-addons-el-title-content -->
					<div class="ma-el-tooltip">
						<?php
						Master_Addons_Helper::jltma_admin_tooltip_info('Demo',$jltma_elements['jltma-plugins']['plugin'][$key]['demo_url'], 'eicon-device-desktop' );
						Master_Addons_Helper::jltma_admin_tooltip_info('Documentation',$jltma_elements['jltma-plugins']['plugin'][$key]['docs_url'], 'eicon-info-circle-o' );
						Master_Addons_Helper::jltma_admin_tooltip_info('Video Tutorial',$jltma_elements['jltma-plugins']['plugin'][$key]['tuts_url'], 'eicon-video-camera' );
						?>
					</div>
				</div> <!-- .master-addons-el-title -->


				<div class="master_addons_feature_switchbox">
					<label for="<?php echo esc_attr( $jltma_plugins ); ?>"
						class="switch switch-text switch-primary switch-pill <?php
						if( !ma_el_fs()->can_use_premium_code() && isset($is_pro) && $is_pro !="") { echo "ma-el-pro";} ?>">

						<?php if ( ma_el_fs()->can_use_premium_code() ) { ?>

							<input type="checkbox"
							id="<?php echo esc_attr( $jltma_plugins ); ?>"
							class="switch-input"
							name="<?php echo esc_attr( $jltma_plugins ); ?>"
							<?php checked( 1, $this->jltma_get_third_party_plugins_settings[$jltma_plugins], true ); ?>>

						<?php } else {

							if ( isset( $jltma_plugins ) ) {
								if ( is_array( $jltma_plugins ) ) {
									$is_pro = $jltma_plugins[1];
								}
							} ?>

							<input
							type="checkbox" id="<?php echo esc_attr( $jltma_plugins ); ?>"
							class="switch-input "
							name="<?php echo esc_attr( $jltma_plugins ); ?>"

							<?php
							if( !ma_el_fs()->can_use_premium_code() && $is_pro =="pro") {
								checked( 0,$this->jltma_get_third_party_plugins_settings[$jltma_plugins], false );
								echo "disabled";
							}else{
								checked( 1, $this->jltma_get_third_party_plugins_settings[$jltma_plugins], true );
							}  ?>/>
						<?php  }?>

						<span data-on="On" data-off="Off" class="switch-label"></span>
						<span class="switch-handle"></span>

					</label>
				</div>
			</div>
		</div>

	<?php } ?>