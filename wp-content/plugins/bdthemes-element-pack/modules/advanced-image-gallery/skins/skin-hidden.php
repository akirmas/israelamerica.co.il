<?php
namespace ElementPack\Modules\AdvancedImageGallery\Skins;

use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Hidden extends Elementor_Skin_Base {
	public function get_id() {
		return 'bdt-hidden';
	}

	public function get_title() {
		return __( 'Hidden', 'bdthemes-element-pack' );
	}

	public function render_loop_item($settings) {

		$this->parent->add_render_attribute('advanced-image-gallery-item', 'class', ['bdt-gallery-item', 'bdt-transition-toggle']);

		$this->parent->add_render_attribute('advanced-image-gallery-inner', 'class', 'bdt-advanced-image-gallery-inner');
		
		if ($settings['tilt_show']) {
			$this->parent->add_render_attribute('advanced-image-gallery-inner', 'data-tilt', '');
		}

		foreach ( $settings['avd_gallery_images'] as $index => $item ) : ?>
			
			<?php $this->parent->link_only($item); ?>

		<?php endforeach;
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$id       = $this->parent->get_id();

		if ( empty( $settings['avd_gallery_images'] ) ) {
			return;
		}

		$this->parent->render_header($settings, $id, $skin = 'carousel');
		$this->render_loop_item($settings);
		$this->parent->render_footer();
	}
}

