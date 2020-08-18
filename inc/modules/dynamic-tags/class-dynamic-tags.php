<?php
namespace MasterAddons\Inc\DisplayTags;
use Elementor\Plugin;


class JLTMA_Dynamic_Tags {
	private $docs_types = [];
	private static $_instance = null;

	public function __construct() {
		if( ! defined( 'ELEMENTOR_PRO_VERSION' ) ){
			add_action( 'elementor/dynamic_tags/register_tags', [ $this, 'register_tag' ] );
		}
	}

	/**
	 * @param \Elementor\Core\DynamicTags\Manager $dynamic_tags
	 */
	public function register_tag( $dynamic_tags ) {

        $tags = array(
            // 'aux-archive-description' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCarchive-description.php',
			// 	'class' => 'DynamicTags\Archive_Description',
			// 	'group' => 'archive',
			// 	'title' => 'Archive',
			// ),
            // 'aux-archive-meta' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCarchive-meta.php',
			// 	'class' => 'DynamicTags\Archive_Meta',
			// 	'group' => 'archive',
			// 	'title' => 'Archive',
			// ),
            // 'aux-archive-title' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCarchive-title.php',
			// 	'class' => 'DynamicTags\Archive_Title',
			// 	'group' => 'archive',
			// 	'title' => 'Archive',
			// ),
            // 'aux-archive-url' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCarchive-url.php',
			// 	'class' => 'DynamicTags\Archive_URL',
			// 	'group' => 'archive',
			// 	'title' => 'Archive',
			// ),
            // 'aux-author-info' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCauthor-info.php',
			// 	'class' => 'DynamicTags\Author_Info',
			// 	'group' => 'author',
			// 	'title' => 'Author',
			// ),
            // 'aux-author-meta' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCauthor-meta.php',
			// 	'class' => 'DynamicTags\Author_Meta',
			// 	'group' => 'author',
			// 	'title' => 'Author',
			// ),
            // 'aux-author-name' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCauthor-name.php',
			// 	'class' => 'DynamicTags\Author_Name',
			// 	'group' => 'author',
			// 	'title' => 'Author',
			// ),
            // 'aux-author-profile-picture' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCauthor-profile-picture.php',
			// 	'class' => 'DynamicTags\Author_Profile_Picture',
			// 	'group' => 'author',
			// 	'title' => 'Author',
			// ),
            // 'aux-author-url' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCauthor-url.php',
			// 	'class' => 'DynamicTags\Author_URL',
			// 	'group' => 'author',
			// 	'title' => 'Author',
			// ),
            // 'aux-comments-number' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCcomments-number.php',
			// 	'class' => 'DynamicTags\Comments_Number',
			// 	'group' => 'comments',
			// 	'title' => 'Comments',
			// ),
            // 'aux-comments-url' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCcomments-url.php',
			// 	'class' => 'DynamicTags\Comments_URL',
			// 	'group' => 'comments',
			// 	'title' => 'Comments',
			// ),
            // 'aux-contact-url' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCcontact-url.php',
			// 	'class' => 'DynamicTags\Contact_URL',
			// 	'group' => 'action',
			// 	'title' => 'Action',
			// ),
            // 'aux-current-date-time' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCcurrent-date-time.php',
			// 	'class' => 'DynamicTags\Current_Date_Time',
			// 	'group' => 'site',
			// 	'title' => 'Site',
			// ),
            // 'aux-featured-image-data' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCfeatured-image-data.php',
			// 	'class' => 'DynamicTags\Featured_Image_Data',
			// 	'group' => 'media',
			// 	'title' => 'Media',
			// ),
            // 'aux-page-title' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpage-title.php',
			// 	'class' => 'DynamicTags\Page_Title',
			// 	'group' => 'site',
			// 	'title' => 'Site',
			// ),
            'aux-post-custom-field' => array(
                'file'  => JLTMA_DYNAMIC_TAGS_PATH_INC . 'post-custom-field.php',
				'class' => 'DynamicTags\Post_Custom_Field',
				'group' => 'post',
				'title' => 'Post',
			),
			'aux-featured-colors' => array(
                'file'  => JLTMA_DYNAMIC_TAGS_PATH_INC . 'featured-colors.php',
				'class' => 'DynamicTags\Auxin_Featured_Colors',
				'group' => 'colors',
				'title' => 'Colors',
			),
			// 'aux-pages-url' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INC . 'pages-url.php',
			// 	'class' => 'DynamicTags\Auxin_Pages_Url',
			// 	'group' => 'URL',
			// 	'title' => 'URL',
			// ),
			// 'aux-cats-url' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCtaxonomies-url.php',
			// 	'class' => 'DynamicTags\Auxin_Taxonomies_Url',
			// 	'group' => 'URL',
			// 	'title' => 'URL',
			// ),
   //          'aux-post-date' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpost-date.php',
			// 	'class' => 'DynamicTags\Post_Date',
			// 	'group' => 'post',
			// 	'title' => 'Post',
			// ),
   //          'aux-post-excerpt' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpost-excerpt.php',
			// 	'class' => 'DynamicTags\Post_Excerpt',
			// 	'group' => 'post',
			// 	'title' => 'Post',
			// ),
   //          'aux-post-featured-image' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpost-featured-image.php',
			// 	'class' => 'DynamicTags\Post_Featured_Image',
			// 	'group' => 'post',
			// 	'title' => 'Post',
			// ),
   //          'aux-post-gallery' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpost-gallery.php',
			// 	'class' => 'DynamicTags\Post_Gallery',
			// 	'group' => 'post',
			// 	'title' => 'Post',
			// ),
   //          'aux-post-id' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpost-id.php',
			// 	'class' => 'DynamicTags\Post_ID',
			// 	'group' => 'post',
			// 	'title' => 'Post',
			// ),
   //          'aux-post-terms' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpost-terms.php',
			// 	'class' => 'DynamicTags\Post_Terms',
			// 	'group' => 'post',
			// 	'title' => 'Post',
			// ),
   //          'aux-post-time' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpost-time.php',
			// 	'class' => 'DynamicTags\Post_Time',
			// 	'group' => 'post',
			// 	'title' => 'Post',
			// ),
   //          'aux-post-title' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpost-title.php',
			// 	'class' => 'DynamicTags\Post_Title',
			// 	'group' => 'post',
			// 	'title' => 'Post',
			// ),
   //          'aux-post-url' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCpost-url.php',
			// 	'class' => 'DynamicTags\Post_URL',
			// 	'group' => 'post',
			// 	'title' => 'Post',
			// ),
   //          'aux-request-parameter' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCrequest-parameter.php',
			// 	'class' => 'DynamicTags\Request_Parameter',
			// 	'group' => 'site',
			// 	'title' => 'Site',
			// ),
   //          'aux-shortcode' => array(
   //              'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCshortcode.php',
			// 	'class' => 'DynamicTags\Shortcode',
			// 	'group' => 'site',
			// 	'title' => 'Site',
			// ),
            // 'aux-site-logo' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCsite-logo.php',
			// 	'class' => 'DynamicTags\Site_Logo',
			// 	'group' => 'site',
			// 	'title' => 'Site',
			// ),
            // 'aux-site-tagline' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCsite-tagline.php',
			// 	'class' => 'DynamicTags\Site_Tagline',
			// 	'group' => 'site',
			// 	'title' => 'Site',
			// ),
            // 'aux-site-title' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCsite-title.php',
			// 	'class' => 'DynamicTags\Site_Title',
			// 	'group' => 'site',
			// 	'title' => 'Site',
			// ),
            // 'aux-site-url' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCsite-url.php',
			// 	'class' => 'DynamicTags\Site_URL',
			// 	'group' => 'site',
			// 	'title' => 'Site',
			// ),
            // 'aux-user-info' => array(
            //     'file'  => JLTMA_DYNAMIC_TAGS_PATH_INCuser-info.php',
			// 	'class' => 'DynamicTags\User_Info',
			// 	'group' => 'site',
			// 	'title' => 'Site',
			// )
        );

        foreach ( $tags as $tags_type => $tags_info ) {
            if( ! empty( $tags_info['file'] ) && ! empty( $tags_info['class'] ) ){
				// In our Dynamic Tag we use a group named request-variables so we need
				// To register that group as well before the tag
				\Elementor\Plugin::$instance->dynamic_tags->register_group( $tags_info['group'] , [
					'title' => $tags_info['title']
				] );

                include_once( $tags_info['file'] );

                print_r(include_once( $tags_info['file'] ));

                if( class_exists( $tags_info['class'] ) ){
                    $class_name = $tags_info['class'];
                } elseif( class_exists( __NAMESPACE__ . '\\' . $tags_info['class'] ) ){
                    $class_name = __NAMESPACE__ . '\\' . $tags_info['class'];
                }
				$dynamic_tags->register_tag( $class_name );
            }
        }
	}


    public static function get_instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}

JLTMA_Dynamic_Tags::get_instance();