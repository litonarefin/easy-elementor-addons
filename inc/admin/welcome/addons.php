<div class="wp-tab-panel" id="addons" style="display: none;">

	<div class="master-addons-el-dashboard-wrapper">
		<form action="" method="POST" id="master-addons-el-settings" name="master-addons-el-settings">

			<?php wp_nonce_field( 'maad_el_settings_nonce_action' ); ?>


			<div class="master-addons-el-dashboard-tabs-wrapper">
				<!--                    <ul class="master-addons-dashboard-tabs">-->
				<!--                        <li><a href="#general" class="active"><img src="--><?php //echo plugins_url( '/', __FILE__ ).'assets/img/settings-icon.png'; ?><!--"><span>General</span></a></li>-->
				<!--                        <li><a href="#elements"><img src="--><?php //echo plugins_url( '/', __FILE__ ).'assets/img/elements-icon.png'; ?><!--"><span>Elements</span></a></li>-->
				<!--                        <li><a href="#apikeys"><img src="--><?php //echo plugins_url( '/', __FILE__ ).'assets/img/api-keys.svg'; ?><!--"><span>API Keys</span></a></li>-->
				<!--                    </ul>-->


				<div id="elements" class="master-addons-dashboard-tab">
					<div class="master-addons-row">
						<div class="master-addons-full-width">
							<div class="master-addons-elements-dashboard-title">
								<!--                                    <img src="--><?php //echo plugins_url( '/', __FILE__ ).'assets/img/elements-dashboard.svg'; ?><!--">-->
								<h4 class="master-addons-dashboard-section-title">Deactivate elements for better
									performance</h4>
								<p class="master-addons-dashboard-section-title-p-tag">You can deactivate those
									elements
									that
									you do not intend to use to avoid loading scripts and files related to those elements.</p>
							</div>
							<div class="master-addons-dashboard-checkbox-container">

								<?php foreach( Master_Elementor_Addons::$maad_el_default_widgets as $widget ) : ?>
									<?php if ( isset( $widget ) ) : ?>
										<div class="master-addons-dashboard-checkbox">
											<div class="master-addons-dashboard-checkbox-text">
												<p class="master-addons-el-title"><?php echo esc_html( ucwords(
														str_replace( "-", " ", $widget ) ) ); ?></p>
											</div>
											<div class="master-addons-dashboard-checkbox-label">
												<input type="checkbox" id="<?php echo esc_attr( $widget ); ?>" name="<?php echo esc_attr( $widget ); ?>" <?php checked( 1, $this->maad_el_get_settings[$widget], true ); ?> >
												<label for="<?php echo esc_attr( $widget ); ?>"></label>
											</div>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>

							</div>
							<!--./checkbox-container-->
						</div>

					</div>
				</div>


			</div> <!-- .master-addons-el-dashboard-tabs-wrapper-->


		</form>
	</div>
</div>