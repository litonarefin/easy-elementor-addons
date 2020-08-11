<div class="wp-tab-panel" id="ma_api_keys">


	<div class="master-addons-el-dashboard-header-wrapper">
		<div class="master-addons-el-dashboard-header-right">
			<button type="submit" class="master-addons-el-btn master-addons-el-js-element-save-setting">
				<?php _e('Save Settings', MELA_TD ); ?>
			</button>
		</div>
	</div>



	<div class="master_addons_feature">
		<form action="" method="POST" id="jltma-api-forms-settings" class="jltma-api-forms-settings"
				      name="jltma-api-forms-settings">

			<div class="api-settings-element">
				<h3><?php echo esc_html__('reCaptcha Settings', MELA_TD);?></h3>
				<div class="api-element-inner">
					<div class="form-group">
						<label for="recaptcha_site_key">
							<?php echo esc_html__('reCAPTCHA Site key', MELA_TD);?>
						</label>
						<input name="recaptcha_site_key" type="text" class="form-control" id="recaptcha_site_key">
					</div>
					<div class="form-group">
						<label for="recaptcha_secret_key">
							<?php echo esc_html__('reCAPTCHA Secret key', MELA_TD);?>
						</label>
						<input type="recaptcha_secret_key" class="form-control" id="recaptcha_secret_key">
					</div>

					<p>
						<?php echo sprintf( __( ' Go to your Google <a href="%1$s" target="_blank"> reCAPTCHA</a> > Account > Generate Keys (reCAPTCHA V2 > Invisible) and Copy and Paste here.', MELA_TD ),
								esc_url('https://www.google.com/recaptcha/about/')
							);
						?>
					</p>
				</div><!-- /.api-element-inner -->
			</div>

			<div class="api-settings-element">
				<h3><?php echo esc_html__('Facebook Settings', MELA_TD);?></h3>
				<div class="form-group">
					<label for="name-2">Username:</label>
					<input type="name" class="form-control" id="name-2">
				</div>
				<div class="form-group">
					<label for="api-2">API Key:</label>
					<input type="text" class="form-control" id="api-2">
				</div>
				<div class="form-group form-check">
					<label for="token-2">Access Tocken:</label>
					<input type="text" class="form-control" id="token-2">
				</div>

				<p>
					Go to the <a href="#">www.twitter.com/app/new</a> and lorem ispusm Lorem ipsum dolor sit amet, consectetur adipisicing elit.
				</p>
			</div><!-- /.api-settings-element -->

		</form>
	</div><!-- /.master_addons_feature -->
</div>