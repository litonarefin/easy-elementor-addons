<?php
	/*
	 * Master Addons : Welcome Screen by Jewel Theme
	 */
?>

<div class="master_addons">
	<div class="wrappper about-wrap">

        <a href="https://wordpress.org/plugins/master-addons">
            <div class="wp-badge welcome__logo">
				<?php printf( __( '<small>v %s</small>', MELA_TD ), MELA_VERSION ); ?>
            </div>
        </a>

        <?php require_once MELA_PLUGIN_PATH . '/inc/admin/welcome/navigation.php';?>


		<div class="master_addons_contents">

			<?php
                require MELA_PLUGIN_PATH . '/inc/admin/welcome/how-to.php';
			    require MELA_PLUGIN_PATH . '/inc/admin/welcome/addons.php';
			    require MELA_PLUGIN_PATH . '/inc/admin/welcome/docs.php';
			    require MELA_PLUGIN_PATH . '/inc/admin/welcome/supports.php';
			    require MELA_PLUGIN_PATH . '/inc/admin/welcome/free-themes.php';
			    require MELA_PLUGIN_PATH . '/inc/admin/welcome/changelogs.php';
			?>

		</div>

	</div>
</div>


<script>
	jQuery(document).ready(function(){
		jQuery( "#accordion" ).accordion();
	});
</script>