<div class="wp-tab-panel" id="addons" style="display: none;">
	<div class="master_addons_features">

		<h3 class="black sub-heading">
			<?php _e( 'Active/Deactivate elements for better Performance', MELA_TD ); ?>
		</h3>


		<div class="master-addons-el-dashboard-header-wrapper">
			<div class="master-addons-el-dashboard-header-right">
				<button type="submit" class="master-addons-el-btn master-addons-el-js-element-save-setting">
					<?php _e('Save Settings', MELA_TD ); ?>
				</button>
			</div>
		</div>


		<div class="master-addons-el-dashboard-wrapper">
			<form action="" method="POST" id="master-addons-el-settings" name="master-addons-el-settings">

				<?php wp_nonce_field( 'maad_el_settings_nonce_action' ); ?>


				<div class="master-addons-el-dashboard-tabs-wrapper">



					<div id="elements" class="master-addons-el-dashboard-header-left master-addons-dashboard-tab
					master_addons_features">
						<div class="master_addons_feature">

                            <h3><?php echo esc_html__('Master Addons', MELA_TD);?></h3>

							<?php foreach( Master_Elementor_Addons::$maad_el_default_widgets as $key=>$widget ) :
////                                print_r($widget);
//
//								if (!is_array($widget)) {
//
////							        echo $key ." => ". $widget ."\r\n" ;
//
//								} else {
////									echo $key ." => array( \r\n";
//
//									foreach ($widget as $key2 => $value2) {
////										echo "\t". $key2 ." => ". $value2 ."\r\n";
//										print_r($key2[1]);
////                                        echo $key2[0];
//									}
//
////									echo ")";
//								}
							?>

								<?php if ( isset( $widget ) ) : ?>

									<div class="master-addons-dashboard-checkbox col">

											<p class="master-addons-el-title">
												<?php
//													$li = ['ma-'];
//													$lit = ['-'];
//													$liton=  str_replace( $li, $lit, $widget );
//													$replace_sep = str_replace( "-", " ", $widget);
//													echo $replace_sep;
                                                    echo esc_html( ucwords( str_replace( "-", " ", $widget) ) );
//                                                echo $widget;
                                                ?>
											</p>

											<label for="<?php echo esc_attr( $widget ); ?>" class="switch switch-text
											 switch-primary switch-pill">
												<input type="checkbox" id="<?php echo esc_attr( $widget ); ?>" class="switch-input" name="<?php echo esc_attr( $widget ); ?>" <?php checked( 1, $this->maad_el_get_settings[$widget], true ); ?>>
												<span data-on="On" data-off="Off" class="switch-label"></span>
												<span class="switch-handle"></span>
											</label>

									</div>
								<?php endif; ?>
							<?php endforeach; ?>

                        </div>

                        <div class="master_addons_feature">


                            <h3><?php echo esc_html__('Form Elements', MELA_TD);?></h3>

							<?php foreach( Master_Elementor_Addons::$maad_el_default_form_widgets as $form_widgets ) : ?>

								<?php if ( isset( $form_widgets ) ) : ?>

									<div class="master-addons-dashboard-checkbox col">

											<p class="master-addons-el-title">
												<?php echo esc_html( ucwords( str_replace( "-", " ", $form_widgets) ) );?>
											</p>

											<label for="<?php echo esc_attr( $form_widgets ); ?>" class="switch switch-text
											 switch-primary switch-pill">

                                                <input type="checkbox" id="<?php echo esc_attr( $form_widgets ); ?>" class="switch-input" name="<?php echo esc_attr( $form_widgets ); ?>" <?php checked( 1, $this->maad_el_get_settings[$form_widgets], true ); ?>>

												<span data-on="On" data-off="Off" class="switch-label"></span>
												<span class="switch-handle"></span>
											</label>

									</div>
								<?php endif; ?>
							<?php endforeach; ?>




						</div>

					</div>
				</div> <!-- .master-addons-el-dashboard-tabs-wrapper-->


			</form>
		</div>
	</div>
</div>