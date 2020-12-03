<?php
/**
 * White Label Markup
 *
 * @package Astra Pro
 */

if ( ! class_exists( 'Astra_Ext_White_Label_Markup' ) ) {

	/**
	 * White Label Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Astra_Ext_White_Label_Markup {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var array instance
		 */
		public static $branding;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
			self::$branding = self::get_white_labels();

			add_filter( 'astra_theme_author', array( $this, 'theme_author_callback' ) );
			if ( is_admin() ) {
				add_filter( 'all_plugins', array( $this, 'plugins_page' ) );
				add_filter( 'wp_prepare_themes_for_js', array( $this, 'themes_page' ) );
				add_filter( 'all_themes', array( $this, 'network_themes_page' ) );
				add_filter( 'update_right_now_text', array( $this, 'admin_dashboard_page' ) );
				add_filter( 'gettext', array( $this, 'theme_gettext' ) );
				add_filter( 'gettext', array( $this, 'plugin_gettext' ) );
				add_action( 'customize_render_section', array( $this, 'theme_customizer' ) );

				// Change menu page title.
				add_filter( 'astra_menu_page_title', array( $this, 'menu_page_title' ), 10, 1 );
				add_filter( 'astra_theme_name', array( $this, 'menu_page_title' ), 10, 1 );
				add_filter( 'astra_addon_name', array( $this, 'addon_page_name' ), 10, 1 );
				add_filter( 'astra_addon_list_tagline', array( $this, 'addon_addon_list_tagline' ), 10, 1 );

				// Theme welcome Page right sections filter.
				add_filter( 'astra_support_link', array( $this, 'agency_author_link' ), 10, 1 );
				add_filter( 'astra_community_group_link', array( $this, 'agency_author_link' ), 10, 1 );
				add_filter( 'astra_knowledge_base_documentation_link', array( $this, 'agency_author_link' ), 10, 1 );
				add_filter( 'astra_starter_sites_documentation_link', array( $this, 'agency_author_link' ), 10, 1 );

				// Astra Addon List filter.
				add_filter( 'astra_addon_list', array( $this, 'astra_addon_list' ) );

				add_filter( 'astra_site_url', array( $this, 'astra_theme_site_url' ), 10, 1 );
				add_action( 'astra_welcome_page_header_title', array( $this, 'welcome_page_header_site_title' ) );
				add_filter( 'astra_page_top_icon', array( $this, 'astra_welcome_page_icon' ), 10, 1 );

				// Add menu item.
				if ( self::show_branding() ) {
					add_filter( 'astra_menu_options', array( $this, 'menu_options' ), 10, 1 );
					add_action( 'astra_menu_white_label_action', array( $this, 'settings_page' ) );
				} else {
					add_action( 'init', array( $this, 'white_label_hide_settings' ) );
					add_filter( 'astra_welcome_wrapper_class', array( $this, 'welcome_wrapper_class' ), 10, 1 );

					// Remove Action Heading if white label is enabled.
					add_filter( 'astra_advanced_hooks_list_action_column_headings', array( $this, 'remove_white_label_action' ), 10, 1 );

					// Remove Action Description.
					add_filter( 'astra_custom_layouts_hooks', array( $this, 'remove_description_custom_layouts' ), 10, 1 );

					// Rename custom layout post url slug.
					add_filter( 'astra_advanced_hooks_rewrite_slug', array( $this, 'change_custom_hook_url_slug' ), 20, 2 );

					// Hide Themes section in the customizer as the theme name cannot be edited in it.
					add_action( 'customize_register', array( $this, 'remove_themes_section' ), 30 );
				}

				// White label save action.
				add_action( 'astra_admin_settings_save', array( $this, 'settings_save' ) );

				// Add menu item.
				add_filter( 'astra_addon_licence_url', array( $this, 'addon_licence_url' ), 10, 1 );

			}

			// White Label graupi updates screen.
			add_filter( 'bsf_product_name_astra-addon', array( $this, 'astra_pro_whitelabel_name' ) );
			add_filter( 'bsf_product_description_astra-addon', array( $this, 'astra_pro_whitelabel_description' ) );
			add_filter( 'bsf_product_author_astra-addon', array( $this, 'astra_pro_whitelabel_author' ) );
			add_filter( 'bsf_product_changelog_astra-addon', '__return_empty_string' );
			add_filter( 'bsf_product_homepage_astra-addon', array( $this, 'astra_pro_whitelabel_author_url' ) );
		}


		/**
		 * Provide White Label array().
		 *
		 * @return array()
		 * @since 1.0
		 */
		static public function get_white_labels() {

			$branding_default = apply_filters(
				'astra_addon_branding_options',
				array(
					'astra-agency' => array(
						'author'        => '',
						'author_url'    => '',
						'licence'       => '',
						'hide_branding' => false,
					),
					'astra'        => array(
						'name'        => '',
						'description' => '',
						'screenshot'  => '',
					),
					'astra-pro'    => array(
						'name'        => '',
						'description' => '',
					),
				)
			);

			$branding = Astra_Admin_Helper::get_admin_settings_option( '_astra_ext_white_label', true );
			$branding = wp_parse_args( $branding, $branding_default );

			return apply_filters( 'astra_addon_get_white_labels', $branding );
		}

		/**
		 * Get individual whitelabel setting.
		 *
		 * @param String $product Product Slug for which whitelabel value is to be received.
		 * @param String $key whitelabel key to be received from the database.
		 * @param mixed  $default default value to be retturned if the whitelabel value is not aset by user.
		 *
		 * @return mixed.
		 */
		public static function get_whitelabel_string( $product, $key, $default = false ) {
			$whitelabel_settings = self::get_white_labels();

			if ( isset( $whitelabel_settings[ $product ][ $key ] ) ) {
				return $whitelabel_settings[ $product ][ $key ];
			}

			return $default;
		}

		/**
		 * Show white label tab.
		 *
		 * @since 1.0
		 * @return bool true | false
		 */
		public static function show_branding() {

			if ( ! isset( self::$branding['astra-agency']['hide_branding'] ) ) {
				return true;
			}

			if ( self::$branding['astra-agency']['hide_branding'] ) {
				return false;
			}

			if ( defined( 'WP_ASTRA_WHITE_LABEL' ) && WP_ASTRA_WHITE_LABEL ) {
				return false;
			}

			return true;
		}

		/**
		 * Get white label setting.
		 *
		 * @since 1.0
		 * @param array $option option name.
		 * @param array $sub_option sub option name.
		 * @return array()
		 */
		static public function get_white_label( $option = '', $sub_option = '' ) {

			$settings = self::get_white_labels();

			if ( isset( $settings[ $option ] ) ) {
				if ( isset( $settings[ $option ][ $sub_option ] ) ) {
					return $settings[ $option ][ $sub_option ];
				}
			}

			return '';

		}

		/**
		 * White labels the plugins page.
		 *
		 * @param array $plugins Plugins Array.
		 * @return array
		 */
		function plugins_page( $plugins ) {

			$branding = self::$branding;
			$key      = plugin_basename( ASTRA_EXT_DIR . 'astra-addon.php' );

			if ( isset( $plugins[ $key ] ) && '' != $branding['astra-pro']['name'] ) {
				$plugins[ $key ]['Name']        = $branding['astra-pro']['name'];
				$plugins[ $key ]['Description'] = $branding['astra-pro']['description'];
			}

			$author     = $branding['astra-agency']['author'];
			$author_uri = $branding['astra-agency']['author_url'];

			if ( ! empty( $author ) ) {
				$plugins[ $key ]['Author']     = $author;
				$plugins[ $key ]['AuthorName'] = $author;
			}

			if ( ! empty( $author_uri ) ) {
				$plugins[ $key ]['AuthorURI'] = $author_uri;
				$plugins[ $key ]['PluginURI'] = $author_uri;
			}

			return $plugins;
		}

		/**
		 * White labels the theme on the themes page.
		 *
		 * @param array $themes Themes Array.
		 * @return array
		 */
		function themes_page( $themes ) {

			$astra_key = 'astra';

			if ( isset( $themes[ $astra_key ] ) ) {

				$theme_data = self::$branding;

				if ( ! empty( $theme_data['astra']['name'] ) ) {

					$themes[ $astra_key ]['name'] = $theme_data['astra']['name'];

					foreach ( $themes as $key => $theme ) {
						if ( isset( $theme['parent'] ) && 'Astra' == $theme['parent'] ) {
							$themes[ $key ]['parent'] = $theme_data['astra']['name'];
						}
					}
				}
				if ( ! empty( $theme_data['astra']['description'] ) ) {
					$themes[ $astra_key ]['description'] = $theme_data['astra']['description'];
				}
				if ( ! empty( $theme_data['astra-agency']['author'] ) ) {
					$author_url                           = empty( $theme_data['astra-agency']['author_url'] ) ? '#' : $theme_data['astra-agency']['author_url'];
					$themes[ $astra_key ]['author']       = $theme_data['astra-agency']['author'];
					$themes[ $astra_key ]['authorAndUri'] = '<a href="' . esc_url( $author_url ) . '">' . $theme_data['astra-agency']['author'] . '</a>';
				}
				if ( ! empty( $theme_data['astra']['screenshot'] ) ) {
					$themes[ $astra_key ]['screenshot'] = array( $theme_data['astra']['screenshot'] );
				}
			}

			return $themes;
		}

		/**
		 * White labels the theme on the network admin themes page.
		 *
		 * @param array $themes Themes Array.
		 * @return array
		 */
		function network_themes_page( $themes ) {

			$astra_key = 'astra';

			if ( isset( $themes[ $astra_key ] ) && is_network_admin() ) {

				$theme_data         = self::$branding;
				$network_theme_data = array();

				if ( ! empty( $theme_data['astra']['name'] ) ) {

					$network_theme_data['Name'] = $theme_data['astra']['name'];

					foreach ( $themes as $theme_key => $theme ) {
						if ( isset( $theme['parent'] ) && 'Astra' == $theme['parent'] ) {
							$themes[ $theme_key ]['parent'] = $theme_data['astra']['name'];
						}
					}
				}
				if ( ! empty( $theme_data['astra']['description'] ) ) {
					$network_theme_data['Description'] = $theme_data['astra']['description'];
				}
				if ( ! empty( $theme_data['astra-agency']['author'] ) ) {
					$author_url                      = empty( $theme_data['astra-agency']['author_url'] ) ? '#' : $theme_data['astra-agency']['author_url'];
					$network_theme_data['Author']    = $theme_data['astra-agency']['author'];
					$network_theme_data['AuthorURI'] = $author_url;
					$network_theme_data['ThemeURI']  = $author_url;
				}

				if ( count( $network_theme_data ) > 0 ) {
					$reflection_object = new ReflectionObject( $themes[ $astra_key ] );
					$headers           = $reflection_object->getProperty( 'headers' );
					$headers->setAccessible( true );

					$headers_sanitized = $reflection_object->getProperty( 'headers_sanitized' );
					$headers_sanitized->setAccessible( true );

					// Set white labeled theme data.
					$headers->setValue( $themes[ $astra_key ], $network_theme_data );
					$headers_sanitized->setValue( $themes[ $astra_key ], $network_theme_data );

					// Reset back to private.
					$headers->setAccessible( false );
					$headers_sanitized->setAccessible( false );
				}
			}

			return $themes;
		}

		/**
		 * White labels the theme on the dashboard 'At a Glance' metabox
		 *
		 * @param mixed $content Content.
		 * @return array
		 */
		function admin_dashboard_page( $content ) {

			$theme_data = self::$branding;

			if ( is_admin() && 'Astra' == wp_get_theme() && ! empty( $theme_data['astra']['name'] ) ) {
				return sprintf( $content, get_bloginfo( 'version', 'display' ), '<a href="themes.php">' . $theme_data['astra']['name'] . '</a>' );
			}

			return $content;
		}

		/**
		 * White labels the theme using the gettext filter
		 * to cover areas that we can't access like the Customizer.
		 *
		 * @param string $text Text.
		 * @return string
		 */
		function theme_gettext( $text ) {

			if ( is_admin() && 'Astra' == $text ) {

				$theme_data = self::$branding;

				if ( ! empty( $theme_data['astra']['name'] ) ) {
					$text = $theme_data['astra']['name'];
				}
			}

			return $text;
		}

		/**
		 * White labels the plugin using the gettext filter
		 * to cover areas that we can't access.
		 *
		 * @param string $text Text.
		 * @return string
		 */
		function plugin_gettext( $text ) {

			if ( is_admin() && 'Astra Pro' == $text ) {

				$plugin_data = self::$branding;

				if ( ! empty( $plugin_data['astra-pro']['name'] ) ) {
					$text = $plugin_data['astra-pro']['name'];
				}
			}

			return $text;
		}

		/**
		 * White labels the builder theme using the `customize_render_section` hook
		 * to cover areas that we can't access like the Customizer.
		 *
		 * @param object $instance  Astra Object.
		 * @return string           Only return if theme branding has been filled up.
		 */
		function theme_customizer( $instance ) {

			if ( 'Astra' == $instance->title ) {

				$theme_data = self::$branding;

				if ( isset( $theme_data['astra']['name'] ) && ! empty( $theme_data['astra']['name'] ) ) {
					$instance->title = $theme_data['astra']['name'];
					return $instance->title;
				}
			}
		}

		/**
		 * Allow to remove the theme switch in the customizer as the theme name cannot be edited
		 *
		 * @since 1.6.12
		 * @param  object $wp_customize customizer object.
		 */
		public static function remove_themes_section( $wp_customize ) {
			$wp_customize->remove_panel( 'themes' );
		}

		/**
		 * Filter to update Theme Author Link
		 *
		 * @param  array $args Theme Author Detail Array.
		 * @return array
		 */
		function theme_author_callback( $args ) {

			$branding = self::$branding;

			if ( '' != $branding['astra']['name'] ) {
				$args['theme_name'] = $branding['astra']['name'];
			}

			if ( '' != $branding['astra-agency']['author_url'] ) {
				$args['theme_author_url'] = $branding['astra-agency']['author_url'];
			}
			return $args;
		}

		/**
		 * Menu Page Title
		 *
		 * @param string $title Page Title.
		 * @return string
		 */
		function menu_page_title( $title ) {

			$branding = self::$branding;

			if ( '' != $branding['astra']['name'] ) {
				$title = $branding['astra']['name'];
			}

			return $title;
		}

		/**
		 * Astra Pro plugin Title
		 *
		 * @param string $title Page Title.
		 * @return string
		 */
		function addon_page_name( $title ) {

			$plugin_data = self::$branding;

			if ( '' != $plugin_data['astra-pro']['name'] ) {
				$title = $plugin_data['astra-pro']['name'];
			}

			return $title;
		}

		/**
		 * Astra Agency Author Url
		 *
		 * @since 1.2.2
		 * @param string $url Astra Agency Author Url.
		 * @return string $url Updated Agency Author Url.
		 */
		function agency_author_link( $url ) {

			$branding = self::$branding;
			if ( '' != $branding['astra-agency']['author_url'] ) {
				$url = $branding['astra-agency']['author_url'];
			}
			return $url;
		}

		/**
		 * Astra Pro Welcome Page tagline
		 *
		 * @param string $title Page Title.
		 * @return string
		 */
		function addon_addon_list_tagline( $title ) {

			$plugin_data = self::$branding;

			if ( '' != $plugin_data['astra-pro']['name'] ) {
				/* translators: %s: white label pro name */
				$title = sprintf( __( 'Available %s Modules:', 'astra-addon' ), $plugin_data['astra-pro']['name'] );
			} else {
				$title = __( 'Available Astra Pro Modules:', 'astra-addon' );
			}

			return $title;
		}

		/**
		 * Menu Options
		 *
		 * @param string $actions Actions.
		 * @return array
		 */
		function menu_options( $actions ) {

			$branding = self::$branding;
			$show     = true;

			if ( isset( $branding['astra-agency']['hide_branding'] ) && $branding['astra-agency']['hide_branding'] ) {
				$show = false;
			}

			$actions['white-label'] = array(
				'label' => __( 'White Label', 'astra-addon' ),
				'show'  => $show,
			);
			return $actions;
		}

		/**
		 * Setting Page
		 */
		function settings_page() {

			require_once ASTRA_EXT_DIR . 'includes/view-white-label.php';
		}

		/**
		 * Save Settings
		 */
		function settings_save() {

			if ( isset( $_POST['ast-white-label-nonce'] ) && wp_verify_nonce( $_POST['ast-white-label-nonce'], 'white-label' ) ) {

				$url             = $_SERVER['REQUEST_URI'];
				$stored_settings = self::get_white_labels();
				$input_settings  = array();
				$new_settings    = array();

				if ( isset( $_POST['ast_white_label'] ) ) {

					$input_settings = $_POST['ast_white_label'];

					// Loop through the input and sanitize each of the values.
					foreach ( $input_settings as $key => $val ) {

						if ( is_array( $val ) ) {
							foreach ( $val as $k => $v ) {
								$new_settings[ $key ][ $k ] = ( isset( $val[ $k ] ) ) ? sanitize_text_field( stripslashes( $v ) ) : '';
							}
						} else {
							$new_settings[ $key ] = ( isset( $input_settings[ $key ] ) ) ? sanitize_text_field( stripslashes( $val ) ) : '';
						}
					}
				}

				$new_settings = wp_parse_args( $new_settings, $stored_settings );

				if ( ! isset( $new_settings['astra-agency']['hide_branding'] ) ) {
					$new_settings['astra-agency']['hide_branding'] = false;
				} else {
					$url = str_replace( 'white-label', 'general', $url );
				}

				Astra_Admin_Helper::update_admin_settings_option( '_astra_ext_white_label', $new_settings, true );

				$query = array(
					'message' => 'saved',
				);

				$redirect_to = add_query_arg( $query, $url );

				// Flush rewrite rules on publish action of custom layout.
				flush_rewrite_rules();

				wp_redirect( $redirect_to );
				exit;
			}
		}

		/**
		 * Licence Url
		 *
		 * @param string $purchase_url Actions.
		 * @return string
		 */
		function addon_licence_url( $purchase_url ) {

			$branding = self::$branding;

			if ( isset( $branding['astra-agency']['licence'] ) && '' !== $branding['astra-agency']['licence'] ) {

				$purchase_url = $branding['astra-agency']['licence'];
			}

			return $purchase_url;
		}

		/**
		 * Remove Sidebar from Astra Welcome Page for white label
		 *
		 * @since 1.2.2
		 */
		function white_label_hide_settings() {
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_starter_sites_section', 10 );
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_knowledge_base_scetion', 11 );
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_community_scetion', 12 );
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_five_star_scetion', 13 );
			remove_action( 'astra_welcome_page_right_sidebar_content', 'Astra_Admin_Settings::astra_welcome_page_cloudways_scetion', 14 );

			// Remove Beta Updates if white label is enabled.
			$theme_ext_class = Astra_Theme_Extension::get_instance();
			remove_action( 'astra_welcome_page_right_sidebar_content', array( $theme_ext_class, 'astra_beta_updates_form' ), 50 );
		}

		/**
		 * Add class to welcome wrapper
		 *
		 * @since 1.2.1
		 * @param array $classes astra welcome page classes.
		 * @return array $classes updated astra welcome page classes.
		 */
		function welcome_wrapper_class( $classes ) {

				$classes[] = 'ast-hide-white-label';

			return $classes;
		}

		/**
		 * Astra Theme Url
		 *
		 * @param string $url Author Url if given.
		 * @return string
		 */
		function astra_theme_site_url( $url ) {

			$branding = self::$branding;
			if ( '' != $branding['astra-agency']['author_url'] ) {
				$url = $branding['astra-agency']['author_url'];
			}
			return $url;
		}

		/**
		 * Astra Welcome Page Icon
		 *
		 * @since 1.2.1
		 * @param string $icon Theme Welcome icon.
		 * @return string $icon Updated Theme Welcome icon.
		 */
		function astra_welcome_page_icon( $icon ) {

			$branding = self::$branding;
			if ( '' != $branding['astra']['name'] ) {
				$icon = false;
			}
			return $icon;
		}

		/**
		 * Astra Welcome Page Site Title
		 *
		 * @since 1.2.1
		 */
		function welcome_page_header_site_title() {

			$branding = self::$branding;
			if ( '' != $branding['astra']['name'] ) {
				echo '<span>' . $branding['astra']['name'] . '</span>';
			}
		}

		/**
		 * Modify Astra Addon List
		 *
		 * @since 1.2.1
		 * @param array $addons Astra addon list.
		 * @return array $addons Updated Astra addon list.
		 */
		function astra_addon_list( $addons = array() ) {

			foreach ( $addons as $addon_slug => $value ) {

				$branding = self::$branding;
				// Remove each addon link to the respective documentation if pro is white labled.
				if ( '' != $branding['astra-pro']['name'] ) {
					$addons[ $addon_slug ]['title_url'] = '';
				}
			}

			return $addons;
		}

		/**
		 * Get Astra Pro whitelabelled name.
		 *
		 * @since 1.6.10
		 * @param String $name Original Product name from Graupi.
		 *
		 * @return String Astra Pro's whitelabelled name.
		 */
		public function astra_pro_whitelabel_name( $name ) {
			return self::get_whitelabel_string( 'astra-pro', 'name', $name );
		}

		/**
		 * Get Astra Pro whitelabelled description.
		 *
		 * @since 1.6.10
		 * @param String $description Original Product descriptionn from Graupi.
		 *
		 * @return String Astra Pro's whitelabelled description.
		 */
		public function astra_pro_whitelabel_description( $description ) {
			return self::get_whitelabel_string( 'astra-pro', 'description', $description );
		}

		/**
		 * Get Astra Pro whitelabelled author.
		 *
		 * @since 1.6.10
		 * @param String $author Original Product author from Graupi.
		 *
		 * @return String Astra Pro's whitelabelled author.
		 */
		public function astra_pro_whitelabel_author( $author ) {
			return self::get_whitelabel_string( 'astra-agency', 'author', $author );
		}

		/**
		 * Get Astra Pro whitelabelled author URL.
		 *
		 * @since 1.6.10
		 * @param String $author_url Original Product author URL from Graupi.
		 *
		 * @return String Astra Pro's whitelabelled author URL.
		 */
		public function astra_pro_whitelabel_author_url( $author_url ) {
			return self::get_whitelabel_string( 'astra-agency', 'author_url', $author_url );
		}

		/**
		 * Remove White Label Actions.
		 *
		 * @param array $columns Custom layout actions.
		 * @return array $columns Custom layout actions.
		 */
		function remove_white_label_action( $columns ) {
			unset( $columns['advanced_hook_action'] );
			return $columns;
		}

		/**
		 * Remove custom layouts description.
		 *
		 * @param array $hooks Custom layout data.
		 * @return array $hooks Custom layout data.
		 */
		function remove_description_custom_layouts( $hooks = array() ) {

			if ( $hooks ) {
				foreach ( $hooks as $key => $hook_group ) {
					if ( array_key_exists( 'hooks', $hook_group ) ) {
						foreach ( $hook_group['hooks'] as $hook_group_key => $hook ) {
							if ( array_key_exists( 'description', $hook ) ) {
								unset( $hooks[ $key ]['hooks'][ $hook_group_key ]['description'] );
							}
						}
					}
				}
			}
			return $hooks;
		}

		/**
		 * Rewrite custom layouts slug.
		 *
		 * @param array $slug Custom layout slug.
		 * @return array $slug Custom layout slug.
		 */
		function change_custom_hook_url_slug( $slug ) {

			// Get white label theme name.
			$branding   = self::$branding;
			$theme_name = strtolower( $branding['astra-pro']['name'] );
			$theme_name = str_replace( ' ', '-', $theme_name );

			// Change the astra-advanced-hooks post slug for white label.
			$slug = $theme_name . '-advanced-hook';

			return $slug;
		}

	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Astra_Ext_White_Label_Markup::get_instance();
