<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-version" style="display: none;">
	<div class="jltma-master-addons-features">


		<div class="jltma-tab-dashboard-header-wrapper">

			<div class="jltma-response-wrap"></div>

			<div class="jltma-version-top-wrapper">
				<h2 class="jltma-roll-back mb-0">
					<?php echo __('Rollback to Previous Version', MELA_TD); ?>
				</h2>
				<p class="jltma-roll-back-span"><?php echo sprintf(__('Experiencing an issue with Master Addons for Elementor version <strong>%s</strong>? Rollback to a previous version before the issue appeared.', MELA_TD), MELA_VERSION); ?></p>
			</div>


			<div class="jltma-version-wrapper is-flex mt-2">
				<div class="jltma-version-left p-3">
					<h4 class="m-0"><?php echo __('Rollback Version', MELA_TD); ?></h4>
				</div>
				<div class="jltma-version-right p-3">
					<?php echo  sprintf('<a href="%1$s" class="jltma-button inline-block jltma-rollback-button elementor-button-spinner">%2$s</a>', wp_nonce_url(admin_url('admin-post.php?action=master_addons_rollback'), 'master_addons_rollback'), __('Rollback to Version ' . JLTMA_STABLE_VERSION, MELA_TD)); ?>
					<p class="jltma-roll-desc text-danger mb-0">
						<?php echo __('Warning: Please backup your database before making the rollback.', MELA_TD); ?>
					</p>
				</div>
			</div>

		</div>
	</div>
</div>