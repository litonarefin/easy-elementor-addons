<?php
	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 9/5/19
	 */
	?>

	<div class="wp-tab-panel" id="extensions">

		<div class="master-addons-el-dashboard-header-wrapper">
			<div class="master-addons-el-dashboard-header-right">
				<button type="submit" class="master-addons-el-btn master-addons-el-js-element-save-setting">
					<?php _e('Save Settings', MELA_TD ); ?>
				</button>
			</div>
		</div>


		<div class="parent">


			<div class="left_column">
				<div class="left_block">

					<h3 class="black textcenter sub-heading">
						<?php _e( 'Master Addons Extensions', MELA_TD ); ?>
					</h3>




					<form action="" method="POST" id="master-addons-el-extensions-settings" class="master-addons-el-extensions-settings"
					      name="master-addons-el-extensions-settings">

						<?php wp_nonce_field( 'ma_el_extensions_settings_nonce_action' ); ?>


						<div class="master-addons-el-dashboard-tabs-wrapper">

							<div id="master-addons-elements" class="master-addons-el-dashboard-header-left master-addons-dashboard-tab master_addons_features">

								<div class="master_addons_feature">

									<?php foreach( Master_Elementor_Addons::$ma_el_extensions as $key=>$extension ) : ?>

										<div class="master-addons-dashboard-checkbox col">

											<p class="master-addons-el-title">

												<?php

//				                                if( ma_el_fs()->can_use_premium_code ()) {
													if ( isset( $extension ) ) {
														if ( is_array( $extension ) ) {
															echo '<span class="pro-ribbon">';
															$is_pro = $extension[1];
															$extension = $extension[0];
															echo ucwords( $is_pro );
															echo '</span>';
														}
														echo __('MA ', MELA_TD) . esc_html( ucwords( str_replace( "-",
																	" ",
																$extension )
														) );
													}

//				                                }
												?>
											</p>




											<label
												for="<?php echo esc_attr( $extension ); ?>"
												class="switch switch-text switch-primary switch-pill">

												<?php //if ( ma_el_fs()->can_use_premium_code() ) { ?>

												<?php //} else{ ?>

												<?php //}?>


													<input type="checkbox"
												       id="<?php echo esc_attr( $extension ); ?>"
												       class="switch-input"
												       name="<?php echo esc_attr( $extension ); ?>"
												<?php checked( 1, $this->maad_el_get_extension_settings[$extension], true ); ?>>
													<span data-on="On" data-off="Off" class="switch-label"></span>
													<span class="switch-handle"></span>
											</label>

										</div>

									<?php endforeach; ?>

								</div> <!--  .master_addons_extensions-->

							</div>
						</div> <!-- .master-addons-el-dashboard-tabs-wrapper-->
					</form>




				</div>
			</div>

			<div class="right_column">


			</div>
		</div>


	</div>
