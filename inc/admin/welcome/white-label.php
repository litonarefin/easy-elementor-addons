<div class="wp-tab-panel" id="jltma_white_label" style="display: none;">

    <div class="master-addons-el-dashboard-header-wrapper">
        <div class="master-addons-el-dashboard-header-right">
            <button type="submit" class="master-addons-el-btn master-addons-el-js-element-save-setting">
                <?php _e('Save Settings', MELA_TD); ?>
            </button>
        </div>
    </div>

    <?php $jltma_white_label_options = get_option('jltma_white_label_settings'); ?>

    <form action="" method="POST" id="jltma-white-label-settings" class="jltma-white-label-settings" name="jltma-white-label-settings">
        <?php wp_nonce_field('jltma_white_label_settings_nonce_action'); ?>

        <div class="master_addons_feature jltma-center-align">

            <!-- Start of White Label Settings -->
            <div class="api-settings-element">
                <h3><?php echo esc_html__('White Label Settings', MELA_TD); ?></h3>
                <div class="api-element-inner">
                    <div class="api-forms">

                        <div class="form-group">
                            <label for="jltma_wl_plugin_name">
                                <?php echo esc_html__('Plugin Name', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_name" type="text" class="form-control jltma_wl_plugin_name" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_name']) ? $jltma_white_label_options['jltma_wl_plugin_name'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_desc">
                                <?php echo esc_html__('Plugin Description', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_desc" type="text" class="form-control jltma_wl_plugin_desc" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_desc']) ? $jltma_white_label_options['jltma_wl_plugin_desc'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_author_name">
                                <?php echo esc_html__('Developer/Agency Name', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_author_name" type="text" class="form-control jltma_wl_plugin_author_name" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_author_name']) ? $jltma_white_label_options['jltma_wl_plugin_author_name'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_url">
                                <?php echo esc_html__('Developer/Agency Name', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_url" type="text" class="form-control jltma_wl_plugin_url" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_url']) ? $jltma_white_label_options['jltma_wl_plugin_url'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_logo">
                                <?php echo esc_html__('Master Addons Icon/Logo', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_logo" type="text" class="form-control jltma_wl_plugin_logo" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_logo']) ? $jltma_white_label_options['jltma_wl_plugin_logo'] : ""; ?>">
                        </div>


                        <div class="form-group">
                            <label for="jltma_wl_plugin_row_links">
                                <?php echo esc_html__('Hide Plugin Row Meta Links', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_row_links" type="text" class="form-control jltma_wl_plugin_row_links" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_row_links']) ? $jltma_white_label_options['jltma_wl_plugin_row_links'] : ""; ?>">
                        </div>

                    </div>
                </div><!-- /.api-element-inner -->
            </div><!-- /.api-settings-element -->
            <!-- End of White Label Settings -->


            <!-- Start of White Label Admin Settings -->
            <div class="api-settings-element">
                <h3><?php echo esc_html__('Admin Settings', MELA_TD); ?></h3>
                <div class="api-element-inner">
                    <div class="api-forms">

                        <div class="form-group">
                            <label for="jltma_wl_plugin_tab_welcome">
                                <?php echo esc_html__('Hide Welcome Tab', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_tab_welcome" type="checkbox" class="form-control jltma_wl_plugin_tab_welcome" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_tab_welcome']) ? $jltma_white_label_options['jltma_wl_plugin_name'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_tab_addons">
                                <?php echo esc_html__('Hide Addons Tab', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_tab_addons" type="checkbox" class="form-control jltma_wl_plugin_tab_addons" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_tab_addons']) ? $jltma_white_label_options['jltma_wl_plugin_name'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_tab_extensions">
                                <?php echo esc_html__('Hide Welcome Tab', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_tab_extensions" type="checkbox" class="form-control jltma_wl_plugin_tab_extensions" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_tab_extensions']) ? $jltma_white_label_options['jltma_wl_plugin_name'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_tab_api">
                                <?php echo esc_html__('Hide Welcome Tab', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_tab_api" type="checkbox" class="form-control jltma_wl_plugin_tab_api" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_tab_api']) ? $jltma_white_label_options['jltma_wl_plugin_name'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_tab_white_label">
                                <?php echo esc_html__('Hide White Label Tab', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_tab_white_label" type="checkbox" class="form-control jltma_wl_plugin_tab_white_label" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_tab_white_label']) ? $jltma_white_label_options['jltma_wl_plugin_name'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_tab_version">
                                <?php echo esc_html__('Hide Version Tab', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_tab_version" type="checkbox" class="form-control jltma_wl_plugin_tab_version" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_tab_version']) ? $jltma_white_label_options['jltma_wl_plugin_name'] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label for="jltma_wl_plugin_tab_changelogs">
                                <?php echo esc_html__('Hide Changelogs Tab', MELA_TD); ?>
                            </label>
                            <input name="jltma_wl_plugin_tab_changelogs" type="checkbox" class="form-control jltma_wl_plugin_tab_changelogs" value="<?php echo isset($jltma_white_label_options['jltma_wl_plugin_tab_changelogs']) ? $jltma_white_label_options['jltma_wl_plugin_name'] : ""; ?>">
                        </div>

                        <p class="border border-danger p-2">
                            <strong><?php _e('NOTE: ', MELA_TD); ?></strong>
                            <?php echo __('You will need to reactivate Master Addons PRO for Elementor plugin to be able to reset White Labeling Tab Options.', MELA_TD); ?>
                        </p>

                    </div>
                </div><!-- /.api-element-inner -->
            </div><!-- /.api-settings-element -->
            <!-- End of White Label Admin Settings -->


        </div><!-- /.master_addons_feature -->
    </form>
</div>
