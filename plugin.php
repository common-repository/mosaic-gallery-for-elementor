<?php
namespace TWPElementorMosaicGallery;

use TWPElementorMosaicGallery\Widgets\Mosaic_Gallery;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		add_action( 'elementor/frontend/after_register_scripts', function() {
		wp_register_script( 'mosaic-gallery', plugins_url( '/assets/js/mosaic-gallery.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_script( 'elementor-jPages', plugins_url( '/assets/js/jPages.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_script( 'elementor-jquery.viewbox', plugins_url( '/assets/js/jquery.viewbox.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_script( 'elementor-trigger-mosaic-gallery', plugins_url( '/assets/js/trigger-mosaic-gallery.js', __FILE__ ), [ 'jquery' ], false, true );	
		wp_enqueue_style( 'elementor-animate', plugins_url( '/assets/css/animate.css', __FILE__ ));
		wp_enqueue_style( 'elementor-viewbox', plugins_url( '/assets/css/viewbox.css', __FILE__ ));
		wp_enqueue_style( 'elementor-mosaic-gallery-css', plugins_url( '/assets/css/mosaic-gallery.css', __FILE__ ));
		} );
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		require __DIR__ . '/widgets/mosaic-gallery.php';
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Mosaic_Gallery() );
	}
}

new Plugin();
