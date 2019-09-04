<div class="wp-tab-panel" id="ma-addons">
	<div class="master_addons_features">

		<div class="master-addons-el-dashboard-header-wrapper">
			<div class="master-addons-el-dashboard-header-right">
				<button type="submit" class="master-addons-el-btn master-addons-el-js-element-save-setting">
					<?php _e('Save Settings', MELA_TD ); ?>
				</button>
			</div>
		</div>


		<div class="master-addons-el-dashboard-wrapper">
			<form action="" method="POST" id="master-addons-el-settings" class="master-addons-el-settings"
                  name="master-addons-el-settings">

				<?php wp_nonce_field( 'maad_el_settings_nonce_action' ); ?>


				<div class="master-addons-el-dashboard-tabs-wrapper">


					<div id="master-addons-elements" class="master-addons-el-dashboard-header-left master-addons-dashboard-tab master_addons_features">

						<div class="master_addons_feature">

                            <h3><?php echo esc_html__('Master Addons', MELA_TD);?></h3>

							<?php foreach( array_slice(Master_Elementor_Addons::$maad_el_default_widgets, 0, 16) as
                                $key=>$widget ) : ?>

								<?php if ( isset( $widget ) ) : ?>

									<div class="master-addons-dashboard-checkbox col">

                                        <p class="master-addons-el-title">
                                            <?php echo esc_html( ucwords( str_replace( "-", " ", $widget) ) );?>
                                        </p>

                                        <label for="<?php echo esc_attr( $widget ); ?>" class="switch switch-text
                                         switch-primary switch-pill">
                                            <input type="checkbox" id="<?php echo esc_attr( $widget ); ?>" class="switch-input"
                                                   name="<?php echo esc_attr( $widget ); ?>" <?php checked( 1, $this->maad_el_get_settings[$widget], true ); ?>>
                                            <span data-on="On" data-off="Off" class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>

									</div>
								<?php endif; ?>
							<?php endforeach; ?>

                        </div> <!--  .master_addons_feature-->

                        <div class="master_addons_feature">

                            <h3><?php echo esc_html__('Form Addons', MELA_TD);?></h3>

                            <?php foreach( array_slice( Master_Elementor_Addons::$maad_el_default_widgets, 17, 6 ) as
                                $key=>$widget ) : ?>

                                <div class="master-addons-dashboard-checkbox col">

                                    <p class="master-addons-el-title">
                                        <?php
                //                            if( !ma_el_fs()->can_use_premium_code ()) {
                                                if ( isset( $widget ) ) {
                                                    if ( is_array( $widget ) ) {
                                                        echo '<span class="pro-ribbon">';
                                                        $is_pro = $widget[1];
                                                        $widget = $widget[0];
                                                        echo ucwords( $is_pro );
                                                        echo '</span>';
                                                    }
                                                    echo esc_html( ucwords( str_replace( "-", " ", $widget ) ) );
                                                }
                //                            }
                                        ?>
                                    </p>

                                    <label for="<?php echo esc_attr( $widget ); ?>" class="switch switch-text
											 switch-primary switch-pill">

                                        <?php if( ma_el_fs()->can_use_premium_code ()) {?>
                                            <input
                                                    type="checkbox"
                                                    id="<?php echo esc_attr( $widget ); ?>"
                                                    class="switch-input"
                                                    name="<?php echo esc_attr( $widget ); ?>"
                                                <?php checked( 1, $this->maad_el_get_settings[$widget], true ); ?>>

                                        <?php } else{


                                            if ( isset( $widget ) ) {
                                                if ( is_array( $widget ) ) {
                                                    echo '<span class="pro-ribbon">';
                                                    $widget = $widget[0];
                                                    $is_pro = $widget[1];
                                                    echo ucwords( $is_pro );
                                                    echo '</span>';
                                                }
                                            }



//	                                        $pro_link = array( "pro");

//	                                        print_r($widget);

//	                                            if ( isset( $widget ) ) {
//                                                    if (in_array($widget, $pro_link)) {
//                                                        echo "Liton";
//                                                    }else{
//                                                        echo "Arefin";
//                                                    }
//
//                                                }
//                                            echo $is_pro;
                                            ?>

                                            <input
                                                    type="checkbox" id="<?php echo esc_attr( $widget ); ?>"
                                                    class="switch-input"
                                                    name="<?php echo esc_attr( $widget ); ?>"
                                                <?php checked( 0, $this->maad_el_get_settings[$widget], true ); ?>
                                                <?php //echo (isset($is_pro))? "disabled" :"";?> >
                                        <?php }?>


                                        <span data-on="On" data-off="Off" class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>

                                </div>

	                        <?php endforeach; ?>

						</div> <!--  .master_addons_feature-->

					</div>
				</div> <!-- .master-addons-el-dashboard-tabs-wrapper-->


			</form>









        </div>
	</div>
</div>