<div class="wp-tab-panel" id="ma_api_keys" style="display: none;">

	<div class="master-addons-el-dashboard-header-wrapper">
		<div class="master-addons-el-dashboard-header-right">
			<button type="submit" class="master-addons-el-btn master-addons-el-js-element-save-setting">
				<?php _e('Save Settings', MELA_TD ); ?>
			</button>
		</div>
	</div>

	<?php $jltma_api_options = get_option('jltma_api_save_settings'); ?>
	
	<form action="" method="POST" id="jltma-api-forms-settings" class="jltma-api-forms-settings" name="jltma-api-forms-settings">
		<div class="master_addons_feature">	

			<!-- Start of reCaptcha Settings -->
			<div class="api-settings-element">
				<h3><?php echo esc_html__('reCaptcha Settings', MELA_TD);?></h3>
				<div class="api-element-inner">
					<div class="api-forms">

						<div class="form-group">
							<label for="recaptcha_site_key">
								<?php echo esc_html__('reCAPTCHA Site key', MELA_TD);?>
							</label>
							<input name="recaptcha_site_key" type="text" class="form-control recaptcha_site_key" value="<?php echo isset($jltma_api_options['recaptcha_site_key'])?$jltma_api_options['recaptcha_site_key']:"" ;?>">
						</div>

						<div class="form-group">
							<label for="recaptcha_secret_key">
								<?php echo esc_html__('reCAPTCHA Secret key', MELA_TD);?>
							</label>
							<input type="text" name="recaptcha_secret_key" class="form-control recaptcha_secret_key" value="<?php echo isset($jltma_api_options['recaptcha_secret_key'])?$jltma_api_options['recaptcha_secret_key']:"";?>">
						</div>

						<p>
							<?php echo sprintf( __( 'Go to your Google <a href="%1$s" target="_blank"> reCAPTCHA</a> > Account > Generate Keys (reCAPTCHA V2 > Invisible) and Copy and Paste here.', MELA_TD ), esc_url('https://www.google.com/recaptcha/about/') );
							?>
						</p>
					</div>
				</div><!-- /.api-element-inner -->
			</div><!-- /.api-settings-element -->
			<!-- End of reCaptcha Settings -->



			<!-- Start of Twitter Settings -->
			<div class="api-settings-element">
				<h3><?php echo esc_html__('Twitter Settings', MELA_TD);?></h3>
				<div class="api-element-inner">
					<div class="api-forms">

						<div class="form-group">
							<label for="twitter_site_key">
								<?php echo esc_html__('Twitter Site key', MELA_TD);?>
							</label>
							<input name="twitter_site_key" type="text" class="form-control twitter_site_key" value="<?php echo isset($jltma_api_options['twitter_site_key'])?$jltma_api_options['twitter_site_key']:"" ;?>">
						</div>

						<div class="form-group">
							<label for="twitter_secret_key">
								<?php echo esc_html__('Twitter Secret key', MELA_TD);?>
							</label>
							<input type="text" name="twitter_secret_key" class="form-control twitter_secret_key" value="<?php echo isset($jltma_api_options['twitter_secret_key'])?$jltma_api_options['twitter_secret_key']:"";?>">
						</div>

						<p>
							<?php echo sprintf( __( 'Go to your Google <a href="%1$s" target="_blank"> Twitter</a> > Account > Generate Keys (Twitter V2 > Invisible) and Copy and Paste here.', MELA_TD ), esc_url('https://www.google.com/twitter/about/') );
							?>
						</p>
					</div>
				</div><!-- /.api-element-inner -->
			</div><!-- /.api-settings-element -->
			<!-- End of Twitter Settings -->




		</div><!-- /.master_addons_feature -->
	</form>
</div>