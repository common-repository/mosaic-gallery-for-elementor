<?php
/*
Plugin Name: Mosaic Gallery for Elementor
Description: Mosaic Gallery Addon for Elementor plugin.
Plugin URI:  https://themeofwp.com/downloads/mosaic-gallery-add-on-for-elementor-page-builder/
Version:     1.0.3
Tested up to: 5.9
Author:      themeofwpcom
Author URI:  https://themeofwp.com/
Text Domain: elementor-mosaic-gallery
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
Support    : https://themeofwp.com/support/
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Load Mosaic Gallery
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
	function mosaic_gallery_load() {
		// Load localization file
		load_plugin_textdomain( 'mosaic-gallery' );

		// Notice if the Elementor is not active
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', 'mosaic_gallery_fail_load' );
			return;
		}

		// Check required version
		$elementor_version_required = '1.8.0';
		if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
			add_action( 'admin_notices', 'mosaic_gallery_fail_load_out_of_date' );
			return;
		}

		// Require the main plugin file
		require( __DIR__ . '/plugin.php' );
	}
	add_action( 'plugins_loaded', 'mosaic_gallery_load' );

/**
* Add plugin pro link to plugins page
 */
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'mosaic_gallery_pro_link' );

	function mosaic_gallery_pro_link( $links ) {
	   $links[] = '<a href="https://themeofwp.com/plugins/elementor/docs/mosaic-gallery-for-elementor/" target="_blank">Documentation</a>';
	   $links[] = '<a href="https://themeofwp.com/help-videos/" target="_blank">Video Tutorials</a>';
	   $links[] = '<a href="https://themeofwp.com/downloads/mosaic-gallery-add-on-for-elementor-page-builder/" target="_blank" style="font-weight:bold; color: #39b54a">Go Pro</a>';
	   return $links;
	}


	function mosaic_gallery_fail_load_out_of_date() {
		if ( ! current_user_can( 'update_plugins' ) ) {
			return;
		}

		$file_path = 'elementor/elementor.php';

		$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
		$message = '<p>' . esc_html__( 'Elementor Mosaic Gallery is not working because you are using an old version of Elementor.', 'mosaic-gallery' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, esc_html__( 'Update Elementor Now', 'mosaic-gallery' ) ) . '</p>';

		echo '<div class="error">' . $message . '</div>';
	}

	function mosaic_gallery_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'mosaic-gallery',
			[
				'title' => esc_html__( 'Mosaic Gallery', 'mosaic-gallery' ),
				'icon' => 'fa fa-plug',
			]
		);
	}
	add_action( 'elementor/elements/categories_registered', 'mosaic_gallery_widget_categories' );