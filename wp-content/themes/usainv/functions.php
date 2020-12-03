<?php

if ( ! function_exists( 'usainv_setup' ) ) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function usainv_setup() {
        load_theme_textdomain('usainv', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1568, 9999);


        add_image_size( 'cropped-thumbnail', 320, 180, array( 'right', 'top') );

        register_nav_menus(
            array(
                'menu-1' => __('Primary', 'usainv'),
                'footer' => __('Footer Menu', 'usainv'),
                'social' => __('Social Links Menu', 'usainv'),
            )
        );

        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        add_theme_support(
            'custom-logo',
            array(
                'height' => 190,
                'width' => 190,
                'flex-width' => false,
                'flex-height' => false,
            )
        );

        add_theme_support('customize-selective-refresh-widgets');

        add_theme_support('wp-block-styles');

        add_theme_support('align-wide');
        
        add_theme_support('responsive-embeds');
    }
}
add_action( 'after_setup_theme', 'usainv_setup' );

/**
 * Register widget area.
 */
function usainv_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'usainv' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'usainv' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'usainv_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function usainv_scripts() {
	wp_enqueue_style( 'usainv-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'usainv_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function usainv_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'usainv_skip_link_focus_fix' );

/**
 * Page Slug Body Class
 *
 * @param $classes
 * @return array
 */
function usainv_add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'usainv_add_slug_body_class' );

/**
 * Admin styles.
 */
function usainv_admin_styles() {
    ?>
    <style>
        div.wpsm_ac_h_i { display: none !important; }
    </style>
    <?php
}
add_action( 'admin_head', 'usainv_admin_styles', 1000 );

/**
 *
 */
function usainv_add_custom_fields_to_short_description( $short_description ) {
    ob_start();

    $post_id = get_the_ID();

    $field_group_key = 'group_5c3da610bbe2c';

    $fields = acf_get_fields( $field_group_key );
    /*echo '<form id="category_filter">';
    foreach ($fields as $field => $data){
        echo '<div class="category_wrapper">';
        echo '<p class="field_label">'.$data['label'].'</p>';
        echo '<select id="ms_'.$data['name'].'" multiple>';

        foreach ($data['choices'] as $key => $value ){
            echo '<option value="'.$value.'">'.$key.'</option>';
        }
        echo '</select>';
        echo '</div>';
    }
    echo '</form>';*/



    ?>

    <table class="table table-bordered">
        <tbody>
        <?php foreach ( $fields as $field => $data ): ?>
            <?php if ( $value = get_field( $data['name'], $post_id ) ): ?>
                <tr>
                    <th scope="row"><?php echo $data['label']; ?></th>
                    <td><?php echo $value; ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php

    $custom_fields = ob_get_clean();

    $short_description .= $custom_fields;

    return $short_description;
}
add_filter( 'woocommerce_short_description', 'usainv_add_custom_fields_to_short_description' );



function usainv_adjust_image_sizes() {

}
add_action( 'after_setup_theme', 'usainv_adjust_image_sizes' );
