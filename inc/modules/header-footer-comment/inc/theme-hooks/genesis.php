<?php 
namespace MasterHeaderFooter\Theme_Hooks;

defined( 'ABSPATH' ) || exit;

/**
 * Genesis theme compatibility.
 */
class Genesis {

	/**
	 * Instance of Elementor Frontend class.
	 *
	 * @var \Elementor\Frontend()
	 */
	private $elementor;

	private $header;
	private $footer;
	private $comment;

	/**
	 * Run all the Actions / Filters.
	 */
	function __construct($template_ids) {
		$this->header = $template_ids[0];
		$this->footer = $template_ids[1];
		$this->comment = $template_ids[2];

		if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {
			$this->elementor = \Elementor\Plugin::instance();
		}

		if($this->header != null){
			add_action( 'template_redirect', array( $this, 'remove_theme_header_markup' ), 10 );
			add_action( 'ocean_header', [$this, 'add_plugin_header_markup'] );
			add_action( 'genesis_header', array( $this, 'genesis_header_markup_open' ), 16 );
			add_action( 'genesis_header', array( $this, 'genesis_header_markup_close' ), 25 );		
		}

		if($this->footer != null){
			add_action( 'template_redirect', array( $this, 'remove_theme_footer_markup' ), 10 );
			add_action( 'genesis_footer', array( $this, 'genesis_footer_markup_open' ), 16 );
			add_action( 'genesis_footer', array( $this, 'genesis_footer_markup_close' ), 25 );
			add_action( 'ocean_footer', [$this, 'add_plugin_footer_markup'] );
		}

		if($this->comment != null){
			add_filter('comments_template', array($this, 'jltma_get_comment_form'));
		}

	}



	public function jltma_get_comment_form( $comment_template ){
        ob_start();
        return JLTMA_PLUGIN_PATH . '/inc/view/theme-support-comment.php';
		ob_get_clean();
	}


	// header actions
	public function remove_theme_header_markup() {
		for ( $priority = 0; $priority < 16; $priority ++ ) {
			remove_all_actions( 'genesis_header', $priority );
		}
	}
	/**
	 * Open markup for header.
	 */
	public function genesis_header_markup_open() {

		genesis_markup(
			array(
				'html5'   => '<header %s>',
				'xhtml'   => '<div id="header">',
				'context' => 'site-header',
			)
		);

		genesis_structural_wrap( 'header' );

	}
	/**
	 * Close MArkup for header.
	 */
	public function genesis_header_markup_close() {

		genesis_structural_wrap( 'header', 'close' );
		genesis_markup(
			array(
				'html5' => '</header>',
				'xhtml' => '</div>',
			)
		);

	}

    public function add_plugin_header_markup(){
		do_action('masteraddons/template/before_header');
		echo '<div class="jltma-template-content-markup jltma-template-content-header">';
			echo \Master_Header_Footer::render_elementor_content($this->header); 
		echo '</div>';
		do_action('masteraddons/template/after_header');
    }
 

	// footer actions
	public function remove_theme_footer_markup() {
		for ( $priority = 0; $priority < 16; $priority ++ ) {
			remove_all_actions( 'genesis_footer', $priority );
		}
	}
	/**
	 * Open markup for footer.
	 */
	public function genesis_footer_markup_open() {

		genesis_markup(
			array(
				'html5'   => '<footer %s>',
				'xhtml'   => '<div id="footer" class="footer">',
				'context' => 'site-footer',
			)
		);
		genesis_structural_wrap( 'footer', 'open' );

	}

	/**
	 * Close markup for footer.
	 */
	public function genesis_footer_markup_close() {

		genesis_structural_wrap( 'footer', 'close' );
		genesis_markup(
			array(
				'html5' => '</footer>',
				'xhtml' => '</div>',
			)
		);

	}
	public function add_plugin_footer_markup(){
		do_action('masteraddons/template/before_footer');
		echo '<div class="jltma-template-content-markup jltma-template-content-footer">';
			echo \Master_Header_Footer::render_elementor_content($this->footer); 
		echo '</div>';
		do_action('masteraddons/template/after_footer');
	}
 

}