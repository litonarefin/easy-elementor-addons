<?php
	/*
	 * Welcome Screen by Jewel Theme
	 */
?>

<div class="egb"> 
	<div class="wrap about-wrap">

		<div class="intro_wrapper">

			<header class="header">
				<h1 class="plugin_name">
					<?php printf( __( '%s <small>v %s</small>', MELA_TD ), MELA, MELA_VERSION ); ?>
				</h1>
				<div class="about-text">
					<?php printf( __( "Ultimate and Easy Gutenberg Blocks Page Builder for WordPress.", MELA_TD ),
                        MELA_VERSION ); ?>
				</div>
				<a href="https://wordpress.org/plugins/ultimate-blocks-for-gutenberg">
					<div class="wp-badge welcome__logo"></div>
				</a>
			</header>

			<div class="waveWrapper waveAnimation">
				<div class="waveWrapperInner bgTop">
					<div class="wave waveTop" style="background-image: url('<?php echo MELA_PLUGIN_URL. "/assets/images/wave-top.png";?>')"></div>
				</div>
				<div class="waveWrapperInner bgMiddle">
					<div class="wave waveMiddle" style="background-image: url('<?php echo MELA_PLUGIN_URL. "/assets/images/wave-mid.png";?>')"></div>
				</div>
				<div class="waveWrapperInner bgBottom">
					<div class="wave waveBottom" style="background-image: url('<?php echo MELA_PLUGIN_URL. "/assets/images/wave-bot.png";?>')"></div>
				</div>
			</div>

		</div>


			
			<!-- Start tabs -->
			<ul class="wp-tab-bar egb_navbar">
				<li class="wp-tab-active">
					<a href="#how-to">
						<?php _e( 'How to Use', MELA_TD ); ?>
					</a>
				</li>
				<li>
					<a href="#docs">
						<?php _e( 'Docs', MELA_TD ); ?>
					</a>
				</li>
				<li>
					<a href="#support">
						<?php _e( 'Support', MELA_TD ); ?>
					</a>
				</li>
				<li>
					<a href="#free-themes">
						<?php _e( 'Free Themes', MELA_TD ); ?>
					</a>
				</li>				
				<li>
					<a href="#changelogs">
						<?php _e( 'Changelogs', MELA_TD ); ?>
					</a>
				</li>
			</ul>
			<!-- End tabs -->

		

		<div class="egb_contents">


				<div class="wp-tab-panel" id="how-to">
					<h1 class="black textcenter main_heading">
						<?php _e( 'Welcome to Easy Blocks - Gutenberg Page Builder.', MELA_TD ); ?>
					</h1>				
					
					<h3 class="black textcenter sub-heading">
						<?php _e( 'The Ultimate Gutenberg Blocks Builder for WordPress!', 'EGB' ); ?>
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
								<h3><?php _e( 'Easy Block Demos:', MELA_TD ); ?></h3>
								<ul class="egb_demos">
									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/alert-notification/"
											target="_blank">
											<strong>
												<?php _e( 'Alert/Notification', MELA_TD ); ?>
											</strong>
										</a>
									</li>
									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/blockquote/"
											target="_blank">
											<strong>
												<?php _e( 'Blockquotes', MELA_TD ); ?>
											</strong>
											<span class="ribbon hot">
												<?php _e( 'Hot', MELA_TD ); ?>
											</span>
										</a>
									</li>
									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/call-to-action/"
											target="_blank">
											<strong>
												<?php _e( 'Call to Action', MELA_TD ); ?>
											</strong>
										</a>
									</li>
									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/cards/"
											target="_blank">
											<strong>
												<?php _e( 'Cards', MELA_TD ); ?>
											</strong>
										</a>
									</li>
									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/image-content/"
											target="_blank">
											<strong>
												<?php _e( 'Image & Content', MELA_TD ); ?>
											</strong>
										</a>
										<span class="ribbon new">
											<?php _e( 'New', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/testimonial/"
											target="_blank">
											<strong>
												<?php _e( 'Testimonials', MELA_TD ); ?>
											</strong>
										</a>
										<span class="ribbon trending">Trending</span>
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/title-subtitle/"
											target="_blank">
											<strong>
												<?php _e( 'Heading & Sub Heading', MELA_TD ); ?>
											</strong>
										</a>
										<span class="ribbon new">
											<?php _e( 'New', MELA_TD ); ?>
										</span>
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/testimonial-slider/"
											target="_blank">
											<strong>
												<?php _e( 'Testimonial Slider', MELA_TD ); ?>
											</strong>
										</a>
										<span class="ribbon trending">
											<?php _e( 'New', MELA_TD ); ?>
										</span>
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/click-to-tweet/"
											target="_blank">
											<strong>
												<?php _e( 'Click to Tweet', MELA_TD ); ?>
											</strong>
										</a>
										<span class="ribbon new">
											<?php _e( 'New', MELA_TD ); ?>
										</span>
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/hero-image/"
											target="_blank">
												<strong>
													<?php _e( 'Hero Image', MELA_TD ); ?>
												</strong>
												<span class="ribbon new">
													<?php _e( 'New', MELA_TD ); ?>
												</span>
										</a>
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/instagram-block/"
											target="_blank">
												<strong>
													<?php _e( 'Instagram', MELA_TD ); ?>
												</strong>
												<span class="ribbon hot">
													<?php _e( 'Hot', MELA_TD ); ?>
												</span>
										</a>
									</li>
									
									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/feature-grid/"
											target="_blank">
												<strong>
													<?php _e( 'Feature Grid', MELA_TD ); ?>
												</strong>
												<span class="ribbon new">
													<?php _e( 'New', MELA_TD ); ?>
												</span>
										</a>
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/feature-box/"
											target="_blank">
												<strong>
													<?php _e( 'Feature Box', MELA_TD ); ?>
												</strong>
												<span class="ribbon new">
													<?php _e( 'New', MELA_TD ); ?>
												</span>
										</a>
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/pricing-table/"
											target="_blank">
												<strong>
													<?php _e( 'Pricing Table', MELA_TD ); ?>
												</strong>
												<span class="ribbon new">
													<?php _e( 'New', MELA_TD ); ?>
												</span>
										</a>
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/social-share/"
											target="_blank">
												<strong>
													<?php _e( 'Social Share', MELA_TD ); ?>
												</strong>
												<span class="ribbon new">
													<?php _e( 'New', MELA_TD ); ?>
												</span>
										</a>
									</li>
									
									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/author-profile"
											target="_blank">										
												<strong>
													<?php _e( 'Author Box', MELA_TD ); ?>
												</strong>
												<span class="ribbon trending">
													<?php _e( 'Trending', MELA_TD ); ?>
												</span>
										</a>
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/counter-block/"
											target="_blank">										
												<strong>
													<?php _e( 'Animate Counter', MELA_TD ); ?>
												</strong>
												<span class="ribbon trending">
													<?php _e( 'Trending', MELA_TD ); ?>
												</span>
										</a>												
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/multiple-column-in-a-row/"
											target="_blank">										
												<strong>
													<?php _e( 'Row and Column', MELA_TD ); ?>
												</strong>
												<span class="ribbon new">
													<?php _e( 'New', MELA_TD ); ?>
												</span>
										</a>												
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/default-row-paragraph/"
											target="_blank">										
												<strong>
													<?php _e( 'Row and Column', MELA_TD ); ?>
												</strong>
												<span class="ribbon hot">
													<?php _e( 'Hot', MELA_TD ); ?>
												</span>
										</a>												
									</li>

									<li>
										<a 
											href="https://plugins.jeweltheme.com/easy-blocks/logo-slider/"
											target="_blank">										
												<strong>
													<?php _e( 'Logo Slider', MELA_TD ); ?>
												</strong>
												<span class="ribbon trending">
													<?php _e( 'New', MELA_TD ); ?>
												</span>
										</a>												
									</li>

									<li>

										<a 
										 	href="https://plugins.jeweltheme.com/easy-blocks/blog-post-grid-list/"
											target="_blank">
												<strong>
													<?php _e( 'Blog Post Grid/List', MELA_TD ); ?>
												</strong>
												<span class="ribbon trending">
													<?php _e( 'New', MELA_TD ); ?>
												</span>
										</a>
									</li>


									<li>
										<strong>
											<?php _e( 'Logo Slider', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>

									<li>
										<strong>
											<?php _e( 'Accordion', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<strong>
											<?php _e( 'Teams', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<strong>
											<?php _e( 'Team Slider', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<strong>
											<?php _e( 'Number Block', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>

									<li>
										<strong>
											<?php _e( 'GDPR Conscent', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<strong>
											<?php _e( 'Related Posts', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<strong>
											<?php _e( 'Facebook Like Block', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<strong>
											<?php _e( 'Social Share', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<strong>
											<?php _e( 'Google Maps(GMap)', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<strong>
											<?php _e( 'Maps Location', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									<li>
										<strong>
											<?php _e( 'Banner Ads', MELA_TD ); ?>
										</strong>
										<span class="ribbon coming">
											<?php _e( 'Upcoming', MELA_TD ); ?>
										</span>
									</li>
									
								</ul>
								
							</div>
						</div>

						<div class="right_column">
							<img class="tab-banner" src="<?php echo MELA_PLUGIN_URL .'/assets/images/banner-image.png';?>" alt="<?php echo UGB;?> Banner Image">
						</div>
					</div>



					<div class="egb_features">
						<h2>
							<?php //_e( 'Easy Blocks - Gutenberg Blocks Page Builder', MELA_TD ); ?>
							<?php echo UGB;?>
						</h3>
						<p class="textcenter">
							<?php _e( 'Listed Blocks are available not on Easy Blocks - Gutenberg Blocks Page Builder Plugin. Blocks are being added daily ...', MELA_TD ); ?>
						</p>
						<div class="egb_feature three-col">
							<div class="col">
								<div class="feature_content">
									<img src="<?php echo MELA_PLUGIN_URL .'/assets/images/feature/alert.svg';?>"/>
									<h3>
										<?php _e( 'Alert/Notification Block', MELA_TD ); ?>
									</h3>
									<p>
										<?php _e( 'Need to highlight anything special for your audience? Why not use Alert/ Notification block? There are different type of alert like - success, warning, danger, info, light and dark etc.', MELA_TD ); ?>
									</p>
								</div>
							</div>
							<div class="col">
								<div class="feature_content">
									<img src="<?php echo MELA_PLUGIN_URL .'/assets/images/feature/call-to-action.svg';?>" />
									<h3><?php _e( 'Call to Action Block', MELA_TD ); ?></h3>
									<p><?php _e( 'Attractive Highlighted Section for Customers. In the marketing section call to action (CTA) is a button which designed to provoke an immediate response. It helps to increase lead in your niche or strategy.', MELA_TD ); ?></p>
								</div>
							</div>
							<div class="col">
								<div class="feature_content">
									<img src="<?php echo MELA_PLUGIN_URL .'/assets/images/feature/cards.svg';?>" />
									<h3><?php _e( 'Cards Block', MELA_TD ); ?></h3>
									<p><?php _e( 'In the web world "card" used to height a special part of any webpage with image and content. By default, we have arranged the Card block, by keeping the image at the top and then content.', MELA_TD ); ?></p>
								</div>								
							</div>
						</div>

						
						<div class="egb_feature three-col">
							<div class="col">
								<div class="feature_content">
									<img src="<?php echo MELA_PLUGIN_URL .'/assets/images/feature/image.svg';?>"/>
									<h3><?php _e( 'Image & Content Block', MELA_TD ); ?></h3>
									<p><?php _e( 'Keeping both image and content in the same row is mandatory sometimes. There are two variations of alignment in this block. One is for the left image and another for right image.', MELA_TD ); ?></p>
								</div>
							</div>
							<div class="col">
								<div class="feature_content">
									<img src="<?php echo MELA_PLUGIN_URL .'/assets/images/feature/quote.svg';?>" />
									<h3><?php _e( 'Blockquote Block', MELA_TD ); ?></h3>
									<p><?php _e( 'Highlighting any Quote or sentence with a name can be done from this block. It has different color variation. You can select the color for the Quote icon or for the text too. LTR and RTL makes unique difference.', MELA_TD ); ?></p>
								</div>
							</div>
							<div class="col">
								<div class="feature_content">
									<img src="<?php echo MELA_PLUGIN_URL .'/assets/images/feature/testimonial.svg';?>" />
									<h3><?php _e( 'Testimonial Block', MELA_TD ); ?></h3>
									<p><?php _e( 'It\'s a single testimonial block. Use this block to arrange client or user feedback in web pages. We recommend using Photo, Name, Designation, and Content for a better look.', MELA_TD ); ?></p>
								</div>								
							</div>
						</div>
						
					</div>


				</div>

				<div class="wp-tab-panel" id="docs" style="display: none;">
					<div class="egb_features">
						<div class="egb_feature">
							<h2>
								<?php echo esc_html__('Documentation', MELA_TD);?>
							</h2>
							<p>
								<?php echo esc_html__('This is Documentation Section for Easy Blocks - Gutenberg Blocks Page Builder.', MELA_TD);?>
							</p>

							<div class="parent">

								<div class="left_column">
									<div class="left_block">
										<p>
										<?php _e( 'Easy Blocks plugin Developed and Maintained by Jewel Theme. 
												We Create different type of WordPress Theme in various niches. 
												We have Developed this plugin for those users who wants to Design their web pages perfectly. 
												Gutenberg a new editor which comes with some built-in blocks. 
												But default blocks are not enough to craft a landing page. 
												We are working on its update and arranging tons of new blocks for you. 
												Check the following upcoming blocks. You will get an update soon.', MELA_TD
                                        ); ?>

										</p>
										<br>

										<h4>
											<?php echo esc_html__('Installation:', MELA_TD);?>
										</h4>
										<div class='embed-container'>
											<iframe src='https://www.youtube.com/embed/mu-heAQgUOk' frameborder='0' allowfullscreen></iframe>
										</div>


										<h4>
											<?php echo esc_html__('Row and Columns Tutorial:', MELA_TD);?>
										</h4>
										<div class='embed-container'>
											<iframe src='https://www.youtube.com/embed/Ced4c_iFoDU' frameborder='0' allowfullscreen></iframe>
										</div>


										<h4>
											<?php echo esc_html__('Row and Columns Customizations Tutorial:', MELA_TD);?>
										</h4>
										<div class='embed-container'>
											<iframe src='https://www.youtube.com/embed/bBXv5cXc4D0' frameborder='0' allowfullscreen></iframe>
										</div>


										<h3>
											<?php _e( 'Frequently Asked Questions:', MELA_TD ); ?>
										</h3>
										<br>

										
										<div id="accordion">

											<h3>
												<?php echo esc_html__('Can I use "Easy Blocks - Gutenberg Blocks Page Builder" Plugin without Gutenberg Plugin ?', MELA_TD);?>
											</h3>
											<div>
												<p>
													<?php echo esc_html__('Yes, if you have WordPress 5.0+ version installed then you can use Easy Blocks - Gutenberg Blocks Page Builder Plugin without "Gutenberg" Plugin.', MELA_TD);?>
												</p>
											</div>

											<h3>
												<?php echo esc_html__('I\'m Using WordPress v5.0. Do I need to Install "Gutenberg" Plugin?', MELA_TD);?>
											</h3>
											<div>
												<p>
													<?php echo esc_html__('No, since Gutnberg is on core with WordPress v5.0. You don\'t need to Install "Gutenberg" Plugin.', MELA_TD);?>
												</p>
											</div>

											<h3>
												<?php echo esc_html__('How to Install this Plugin ?', MELA_TD);?>
											</h3>
											<div>
												<p>
													<div class='embed-container'>
														<iframe src='https://www.youtube.com/embed/mu-heAQgUOk' frameborder='0' allowfullscreen></iframe>
													</div>
													<br>
													<?php echo esc_html__('Installation Process has been discussed on "Installation" Section. Video Tutorial will help you about Installation Process.', MELA_TD);?>
												</p>
											</div>
											
											<h3>
												<?php echo esc_html__('How to Configure this Plugin ?', MELA_TD);?>
											</h3>
											<div>
												<p>
													<?php echo esc_html__('Basically, there\'s no Configuration required for using "Easy Blocks - Gutenberg Blocks Page Builder" Plugin.', MELA_TD);?>
												</p>
											</div>

											<h3>
												<?php echo esc_html__('How to add Easy Blocks?', MELA_TD);?>
											</h3>
											<div>
												<p>
													<?php echo esc_html__('Navigate to any post or page which you want to edit. Then click on the plus button. Scroll down or search for "Easy Block". Click on that option and you will see some blocks. Just add what block you like and edit the content.', MELA_TD);?>
												</p>
											</div>
											

											<h3>
												<?php echo esc_html__('"Easy Blocks - Gutenberg Blocks Page Builder Plugin" Installed but Not Working !', MELA_TD);?>
											</h3>
											<div>
												<p>
													<?php echo esc_html__('First, deactive Other "Gutenberg Blocks" plugin and try again. In most cases, it\'ll be conflicting issue. Try Activate/Deactivate "Easy Blocks - Gutenberg Blocks Page Builder" Plugin. If nothing works then post on our Support Form(Link Mentioned above).', MELA_TD);?>
												</p>
											</div>
											
											<h3>
												<?php echo esc_html__('How can I get faster Support?', MELA_TD);?>
											</h3>
											<div>
												<p>
													We've two ways to give Supports for "Easy Blocks - Gutenberg Blocks Page Builder" Plugin - <a href="https://wordpress.org/support/plugin/ultimate-blocks-for-gutenberg" target="_blank">Plugin Support Forum</a> or <a href="https://jeweltheme.com/support/forum/wordpress-plugins/easy-gutenberg-blocks" target="_blank">Our Website Support</a>. Since, this is a Free Plugin, Support reply may delay for answer but we're Dedicated on our Website <a href="https://jeweltheme.com/support/forum/wordpress-plugins/easy-gutenberg-blocks/" target="_blank">Support Forum</a>.
												</p>
											</div>
											
											<h3>
												<?php echo esc_html__('I need Custom Blocks, can you Customize or Create for me?', MELA_TD);?>
											</h3>
											<div>
												<p>
												We don't provide Customization Support for Free Products. But, If you need to Create one we do Offer Customization Service. 
<a href="https://jeweltheme.com/order-service/" target="_blank">Order Service</a>
												</p>
											</div>
										</div>


									</div>
								</div>

								<div class="right_column">
									<img class="tab-banner" src="<?php echo MELA_PLUGIN_URL .'/assets/images/docs.png';?>" alt="Easy Blocks - Gutenberg Blocks Page Builder Block Banner Image">
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="wp-tab-panel" id="support" style="display: none;">
					<div class="egb_features">
						<div class="egb_feature">
							<h2>
								<?php echo esc_html__('Need Help?', MELA_TD);?>
							</h3>

							<div class="parent">

								<div class="left_column">
									<div class="left_block">
										<p>
											<?php _e( 'Do you Stuck on something? Get help from the community on WordPress Support Forum or Facebook Community. In case of emergency, initiate a live chat at "Jewel Theme".', MELA_TD ); ?>
											We've Dedicated Support Forum for <strong>Easy Blocks - Gutenberg Blocks Page Builder</strong>. We're contributing for giving back to WordPress Community.
											As this is a Free WordPress Plugin, support maybe delayed because <strong>Jewel Theme</strong> provides Priority Support for Premium Customers.
										</p>

										<h4>
											<?php echo esc_html__('Get Support from your suitable Network:', MELA_TD);?>
										</h4>
										<ul>
											<li>
												<h4>
													<a href="https://www.facebook.com/groups/jeweltheme/" target="_blank">
														<?php echo esc_html__('Facebook Group', MELA_TD);?>
													</a>
												</h4>
											</li>
											<li>
												<h4>
													<a href="https://www.facebook.com/jwthemeltd/" target="_blank">
														<?php echo esc_html__('Facebook Fan Page', MELA_TD);?>
													</a>
												</h4>
											</li>
											<li>
												<h4>
													<a href="https://jeweltheme.com/support/forum/wordpress-plugins/easy-gutenberg-blocks" target="_blank">
														<?php echo esc_html__('Jewel Theme Support Forum', MELA_TD);?>
													</a>
												</h4>
											</li>
											<li>
												<h4>
													<a href="https://wordpress.org/support/plugin/ultimate-blocks-for-gutenberg" target="_blank">
														<?php echo esc_html__('WordPress Support Forum ( Easy Blocks )', MELA_TD);?>
													</a>
												</h4>
											</li>
											<li>
												<h4>
													<a href="https://www.youtube.com/channel/UCAPfTXvzbNebKsB322Iz6HQ" target="_blank">
														<?php echo esc_html__('Youtub Channel', MELA_TD);?>
													</a>
												</h4>
											</li>
										</ul>
									</div>
								</div>

								<div class="right_column">
									<img class="tab-banner" src="<?php echo MELA_PLUGIN_URL .'/assets/images/support.png';?>" alt="Easy Blocks - Gutenberg Blocks Page Builder Block Banner Image">
								</div>
							</div>
								
						</div>
					</div>
				</div>

				<div class="wp-tab-panel" id="free-themes" style="display: none;">
					<?php require( UGB_PLUGIN_DIR . '/inc/free-themes.php' );?>
				</div>

				

				<div class="wp-tab-panel" id="changelogs" style="display: none;">
					<div class="parent">
						<div class="left_column">
							<?php 
								require_once( UGB_PLUGIN_DIR . '/inc/readme-parser.php' );
								$li = new WordPress_Readme_Parser();
								$t = $li->parse_readme( UGB_PLUGIN_DIR . '/readme.txt' );
								echo '<pre>' . $t['sections']['changelog'] . '</pre>';					
							?>
						</div>
						<?php require( UGB_PLUGIN_DIR . '/inc/right-column.php' );?>
					</div>
				</div>

		</div>
	</div>
</div>


<script>
	jQuery(document).ready(function(){
		jQuery( "#accordion" ).accordion();
	});
	
</script>