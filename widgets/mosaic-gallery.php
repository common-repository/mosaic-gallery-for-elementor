<?php
namespace TWPElementorMosaicGallery\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Mosaic Gallery
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Mosaic_Gallery extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mosaic-gallery';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Mosaic Gallery', 'mosaic-gallery' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'mosaic-gallery' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'mosaic-gallery' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'elementor-mosaic-gallery' ),
			]
		);

		$this->add_control(
			'mosaic_gallery',
			[
				'label' => esc_html__( 'Add Images', 'elementor-mosaic-gallery' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		echo'<!-- navigation mosaicholder --> <div class="mosaicholder"></div>';
		echo'<ul id="mosaicContainer">';

		foreach ( $settings['mosaic_gallery'] as $image ) {
			echo '
				<li class="mosaicgallery-item">
					<a href="' . $image['url'] . '" class="mosaic-gallery-link">
						<img width="150" height="150" src="' . $image['url'] . '">
					</a>
				</li>
				';
		}

		echo'</ul>';
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<div class="mosaicholder"></div>
			<ul id="mosaicContainer">
				<# _.each( settings.mosaic_gallery, function( image ) { #>
				<li class="mosaicgallery-item">
					<a href="{{ image.url }}" class="mosaic-gallery-link">
						<img src="{{ image.url }}">
					</a>
				</li>
				<# }); #>
			</ul>
		<?php
	}
}
