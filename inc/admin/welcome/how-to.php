

<div class="wp-tab-panel" id="how-to">
	<h1 class="black textcenter main_heading">
		<?php _e( 'Welcome to Easy Blocks - Gutenberg Page Builder.', MELA_TD ); ?>
	</h1>

	<h3 class="black textcenter sub-heading">
		<?php _e( 'The Ultimate Gutenberg Blocks Builder for WordPress!', MELA_TD ); ?>
	</h3>

	<div class="parent">

		<div class="left_column">
			<div class="left_block">
				<p>
					<?php _e( 'Gutenberg provides some basic block like Paragraph, Heading, Image, Gallery, List, Cover, File. These all are the default block. 
											But building more blocks give you full control to design your web pages. 
											Visually you can see everything, what you are doing now. 
											Within this Easy Blocks - Gutenberg Blocks Page Builder plugin, we have packed most necessary blocks. 
											We are working on its Development every day and trying to cover all blocks so that you don\'t need to worry on webpage designing.', MELA_TD ); ?>

				</p>
				<br>

                <h3><?php _e( 'Master Addons Demos:', MELA_TD ); ?></h3>

                <?php require MELA_PLUGIN_PATH . '/inc/admin/welcome/demos.php'; ?>

			</div>
		</div>

		<div class="right_column">
			<img class="tab-banner" src="<?php echo MELA_PLUGIN_URL .'/assets/images/banner-image.png';?>" alt="<?php echo MELA;?> Banner Image">
		</div>
	</div>


	<?php require MELA_PLUGIN_PATH . '/inc/admin/welcome/how-to-features.php'; ?>


</div>