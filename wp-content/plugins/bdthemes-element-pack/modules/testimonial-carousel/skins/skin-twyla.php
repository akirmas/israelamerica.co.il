<?php
namespace ElementPack\Modules\TestimonialCarousel\Skins;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Twyla extends Elementor_Skin_Base {
	public function get_id() {
		return 'bdt-twyla';
	}

	public function get_title() {
		return __( 'Twyla', 'bdthemes-element-pack' );
	}

	public function render() {
		$settings = $this->parent->get_settings();
		global $post;

		$wp_query = $this->parent->render_query();

		if( $wp_query->have_posts() ) : ?>

			<?php $this->parent->render_header('twyla'); ?>

				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			  		<div class="swiper-slide bdt-testimonial-carousel-item">
				  		<div class="bdt-testimonial-carousel-item-wrapper bdt-text-center">
					  		<div class="testimonial-item-header">
					  			<?php $this->parent->render_image( $post->ID ); ?>
				            </div>

			            	<?php
			            	$this->parent->render_excerpt();
			            	$this->parent->render_title( $post->ID );
							$this->parent->render_address( $post->ID );

	                        if (( $settings['show_rating'] ) && ( $settings['show_text'] )) : ?>
		                    	<div class="bdt-testimonial-carousel-rating bdt-display-inline-block">
								    <?php $this->parent->render_rating( $post->ID ); ?>
				                </div>
	                        <?php endif; ?>

		                </div>
	                </div>
				<?php endwhile; wp_reset_postdata(); ?>					

		 	<?php $this->parent->render_footer();
		 	
		endif;
	}
}

