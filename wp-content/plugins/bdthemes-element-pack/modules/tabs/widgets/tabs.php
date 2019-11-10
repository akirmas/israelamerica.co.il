<?php
namespace ElementPack\Modules\Tabs\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use ElementPack\Modules\QueryControl\Module as QueryControlModule;
use ElementPack\Element_Pack_Loader;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Tabs extends Widget_Base {

	public function get_name() {
		return 'bdt-tabs';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Tabs', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-tabs';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'tabs', 'toggle', 'accordion' ];
	}

	public function is_reload_preview_required() {
		return false;
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Tabs', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'tab_layout',
			[
				'label'   => esc_html__( 'Layout', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Top (Default)', 'bdthemes-element-pack' ),
					'bottom'  => esc_html__( 'Bottom', 'bdthemes-element-pack' ),
					'left'    => esc_html__( 'Left', 'bdthemes-element-pack' ),
					'right'   => esc_html__( 'Right', 'bdthemes-element-pack' ),
				],
			]
		);

		$this->add_control(
			'tabs',
			[
				'label'   => __( 'Tab Items', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   => __( 'Tab #1', 'bdthemes-element-pack' ),
						'tab_content' => __( 'I am tab #1 content. Click edit button to change this text. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.', 'bdthemes-element-pack' ),
					],
					[
						'tab_title'   => __( 'Tab #2', 'bdthemes-element-pack' ),
						'tab_content' => __( 'I am tab #2 content. Click edit button to change this text. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman.', 'bdthemes-element-pack' ),
					],
					[
						'tab_title'   => __( 'Tab #3', 'bdthemes-element-pack' ),
						'tab_content' => __( 'I am tab #3 content. Click edit button to change this text. Drops of rain could be heard hitting the pane, which made him feel quite sad. How about if I sleep a little bit longer and forget all this nonsense.', 'bdthemes-element-pack' ),
					],
				],
				'fields' => [
					[
						'name'        => 'tab_title',
						'label'       => __( 'Title', 'bdthemes-element-pack' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => __( 'Tab Title' , 'bdthemes-element-pack' ),
						'label_block' => true,
					],
					[
						'name'        => 'tab_sub_title',
						'label'       => __( 'Sub Title', 'bdthemes-element-pack' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'label_block' => true,
					],
					[
						'name'        => 'tab_icon',
						'label'       => __( 'Icon', 'bdthemes-element-pack' ),
						'type'        => Controls_Manager::ICON,
						'label_block' => true,
					],
					[
						'name'    => 'source',
						'label'   => esc_html__( 'Select Source', 'bdthemes-element-pack' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 'custom',
						'options' => [
							'custom'    => esc_html__( 'Custom', 'bdthemes-element-pack' ),
							"elementor" => esc_html__( 'Elementor Template', 'bdthemes-element-pack' ),
							'anywhere'  => esc_html__( 'AE Template', 'bdthemes-element-pack' ),
						],
					],
					[
						'name'       => 'tab_content',
						'type'       => Controls_Manager::WYSIWYG,
						'dynamic'    => [ 'active' => true ],
						'default'    => __( 'Tab Content', 'bdthemes-element-pack' ),
						'condition'  => ['source' => 'custom'],
					],
					[
						'name'        => 'template_id',
						'label'       => __( 'Enter Template ID', 'bdthemes-element-pack' ),
						'description' => __( 'Go to your template > Edit template > look at here: http://prntscr.com/md5qvr for template ID.', 'bdthemes-element-pack' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
						'condition'   => ['source' => "elementor"],
					],
					[
						'name'        => 'anywhere_id',
						'label'       => esc_html__( 'Enter Template ID', 'bdthemes-element-pack' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => 'true',
						'condition'   => ['source' => 'anywhere'],
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'align',
			[
				'label'   => __( 'Alignment', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					''    => [
						'title' => __( 'Left', 'bdthemes-element-pack' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bdthemes-element-pack' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bdthemes-element-pack' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'bdthemes-element-pack' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'condition' => [
					'tab_layout' => ['default', 'bottom']
				],
			]
		);

		$this->add_responsive_control(
			'item_spacing',
			[
				'label' => __( 'Tab Spacing', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-tab .bdt-tabs-item'                                                                 => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-tab'                                                                                => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-tab.bdt-tab-left .bdt-tabs-item, {{WRAPPER}} .bdt-tab.bdt-tab-right .bdt-tabs-item' => 'padding-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-tab.bdt-tab-left, {{WRAPPER}} .bdt-tab.bdt-tab-right'                               => 'margin-top: -{{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'content_spacing',
			[
				'label' => __( 'Content Spacing', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-tabs .bdt-tab'        => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-tabs .bdt-tab-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-tabs .bdt-tab-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-tabs .bdt-tab-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_additional',
			[
				'label' => __( 'Additional', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'active_item',
			[
				'label' => __( 'Active Item No', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 1,
				'max'   => 20,
			]
		);

		$this->add_control(
			'tab_transition',
			[
				'label'   => esc_html__( 'Transition', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => element_pack_transition_options(),
				'default' => '',
			]
		);

		$this->add_control(
			'duration',
			[
				'label' => __( 'Animation Duration', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1,
						'max'  => 501,
						'step' => 50,
					],
				],
				'default' => [
					'size' => 200,
				],
			]
		);

		$this->add_control(
			'media',
			[
				'label'       => __( 'Turn On Horizontal mode', 'bdthemes-element-pack' ),
				'description' => __( 'It means that when switch to the horizontal tabs mode from vertical mode', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => [
					'960' => [
						'title' => __( 'On Tablet', 'bdthemes-element-pack' ),
						'icon'  => 'fa fa-tablet',
					],
					'768' => [
						'title' => __( 'On Mobile', 'bdthemes-element-pack' ),
						'icon'  => 'fa fa-mobile',
					],
				],
				'condition' => [
					'tab_layout' => ['left', 'right']
				],
			]
		);

		// $this->add_control(
		// 	'advanced_scroll',
		// 	[
		// 		'label'   => esc_html__( 'Open Tab From URL ID', 'bdthemes-element-pack' ),
		// 		'type'    => Controls_Manager::SWITCHER,
		// 		'default' => 'yes',
		// 	]
		// );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => __( 'Tab', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'title_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .bdt-tab .bdt-tabs-item-title',
				'separator' => 'after',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-tab .bdt-tabs-item-title' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'title_shadow',
				'selector' => '{{WRAPPER}} .bdt-tab .bdt-tabs-item .bdt-tabs-item-title',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-tab .bdt-tabs-item-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'title_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-tab .bdt-tabs-item .bdt-tabs-item-title',
			]
		);

		$this->add_control(
			'title_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-tab .bdt-tabs-item .bdt-tabs-item-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .bdt-tab .bdt-tabs-item-title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'active_style_color',
			[
				'label'     => __( 'Style Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'active_title_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title',
				'separator' => 'after',
			]
		);

		$this->add_control(
			'active_title_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'active_title_shadow',
				'selector' => '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'active_title_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title',
			]
		);

		$this->add_control(
			'active_title_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_title',
			[
				'label' => __( 'Sub Title', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_sub_title_style' );

		$this->start_controls_tab(
			'tab_sub_title_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
			]
		);


		$this->add_control(
			'sub_title_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-tab .bdt-tab-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_title_spacing',
			[
				'label'     => __( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-tab .bdt-tab-sub-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .bdt-tab .bdt-tab-sub-title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sub_title_active',
			[
				'label' => __( 'Active', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'active_sub_title_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-tab .bdt-tabs-item .bdt-active .bdt-tab-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'active_sub_title_typography',
				'selector' => '{{WRAPPER}} .bdt-tab .bdt-tabs-item .bdt-active .bdt-tab-sub-title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_content',
			[
				'label' => __( 'Content', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'content_background_color',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content',
				'separator' => 'after',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'content_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content',
			]
		);

		$this->add_control(
			'content_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'   => __( 'Alignment', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Start', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'End', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => is_rtl() ? 'right' : 'left',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-tabs .bdt-tabs-item-title .fa:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-tabs .bdt-tabs-item-title .bdt-button-icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-tabs .bdt-tabs-item-title .bdt-button-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_active',
			[
				'label' => __( 'Active', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-tabs .bdt-tabs-item.bdt-active .bdt-tabs-item-title .fa:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id       = $this->get_id();

		$this->add_render_attribute(
			[
				'tab-settings' => [
					'class' => [
						'bdt-tab',
						( '' !== $settings['tab_layout'] ) ? 'bdt-tab-' . $settings['tab_layout'] : '',
						('' != $settings['align'] and 'left' != $settings['tab_layout'] and 'right' != $settings['tab_layout']) ? ('justify' != $settings['align']) ? 'bdt-flex-' . $settings['align'] : 'bdt-child-width-expand' : ''
					],
					'bdt-tab' => [
						wp_json_encode(array_filter([
							"connect"   => "#bdt-tab-content-" .  esc_attr($id),
							"animation" => ($settings["tab_transition"]) ? "bdt-animation-". $settings["tab_transition"] : "",
							"duration"  => ($settings["duration"]) ? $settings["duration"]["size"] : "",
							"media"     => ($settings["media"]) ? $settings["media"] : "",
						]))
					]
				]
			]
		);

		$id_int = substr( $this->get_id_int(), 0, 3 );

		?>
		<div id="bdt-tabs-<?php echo esc_attr($id); ?>" class="bdt-tabs">
			<?php
			if ( 'left' == $settings['tab_layout'] or 'right' == $settings['tab_layout'] ) {
				echo '<div class="bdt-grid-collapse"  bdt-grid>';

				$this->add_render_attribute(
					[
						'switcher-width' => [
							'class' => [
								'bdt-switcher-wrapper',
								'bdt-width-expand@m'
							]
						]
					]
				);

				$this->add_render_attribute(
					[
						'tabs-width' => [
							'class' => [
								'bdt-tab-wrapper',
								'bdt-width-auto@m',
								( 'right' == $settings['tab_layout'] ) ? ' bdt-flex-last@m' : ''
							]
						]
					]
				);
			}
			?>

			<?php if ( 'bottom' == $settings['tab_layout'] ) : ?>			
				<div <?php echo ( $this->get_render_attribute_string( 'switcher-width' ) ); ?>>
					<div id="bdt-tab-content-<?php echo esc_attr($id); ?>" class="bdt-switcher bdt-switcher-item-content">
						<?php foreach ( $settings['tabs'] as $index => $item ) : ?>
							<div>
								<div>
									<?php 
						            	if ( 'custom' == $item['source'] and !empty( $item['tab_content'] ) ) {
						            		echo wp_kses_post( $item['tab_content'] );
						            	} elseif ("elementor" == $item['source'] and !empty( $item['template_id'] )) {
						            		echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display( $item['template_id'] );
						            	} elseif ('anywhere' == $item['source'] and !empty( $item['anywhere_id'] )) {
						            		echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display( $item['anywhere_id'] );
						            	}
						            ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<div <?php echo ( $this->get_render_attribute_string( 'tabs-width' ) ); ?>>
				<div <?php echo ( $this->get_render_attribute_string( 'tab-settings' ) ); ?>>
					<?php foreach ( $settings['tabs'] as $index => $item ) :
						
						$tab_count = $index + 1;
						$tab_id    = ($item['tab_title']) ? element_pack_string_id($item['tab_title']) : $id . $tab_count;
						$tab_id    = 'bdt-tab-'. $tab_id;

						$this->add_render_attribute( 'tabs-item', 'class', 'bdt-tabs-item', true );
						if (empty($item['tab_title'])) {
							$this->add_render_attribute( 'tabs-item', 'class', 'bdt-has-no-title' );
						}
						if ($tab_count === $settings['active_item']) {
							$this->add_render_attribute( 'tabs-item', 'class', 'bdt-active' );
						}						

						?>
						<div <?php echo ( $this->get_render_attribute_string( 'tabs-item' ) ); ?>>
							<a class="bdt-tabs-item-title" href="#" id="<?php echo $tab_id; ?>">
								<div class="bdt-tab-text-wrapper bdt-flex-column">

									<div class="bdt-tab-title-icon-wrapper">
										<?php if ('' != $item['tab_icon'] and 'left' == $settings['icon_align']) : ?>
											<span class="bdt-button-icon-align-<?php echo esc_html($settings['icon_align']); ?>">
												<i class="<?php echo esc_attr($item['tab_icon']); ?>"></i>
											</span>
										<?php endif; ?>

										<?php if ($item['tab_title']) : ?>
											<span class="bdt-tab-text"><?php echo $item['tab_title']; ?></span>
										<?php endif; ?>

										<?php if ('' != $item['tab_icon'] and 'right' == $settings['icon_align']) : ?>
											<span class="bdt-button-icon-align-<?php echo esc_html($settings['icon_align']); ?>">
												<i class="<?php echo esc_attr($item['tab_icon']); ?>"></i>
											</span>
										<?php endif; ?>
									</div>

									<?php if ($item['tab_sub_title'] and $item['tab_title']) : ?>
										<span class="bdt-tab-sub-title bdt-text-small"><?php echo $item['tab_sub_title']; ?></span>
									<?php endif; ?>

								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<?php if ( 'bottom' != $settings['tab_layout'] ) : ?>
				<div <?php echo ( $this->get_render_attribute_string( 'switcher-width' ) ); ?>>
					<div id="bdt-tab-content-<?php echo esc_attr($id); ?>" class="bdt-switcher bdt-switcher-item-content">
						<?php foreach ( $settings['tabs'] as $index => $item ) : ?>
							<div>
								<div>
									<?php 
						            	if ( 'custom' == $item['source'] and !empty( $item['tab_content'] ) ) {
						            		echo wp_kses_post( $item['tab_content'] );
						            	} elseif ("elementor" == $item['source'] and !empty( $item['template_id'] )) {
						            		echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display( $item['template_id'] );
						            	} elseif ('anywhere' == $item['source'] and !empty( $item['anywhere_id'] )) {
						            		echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display( $item['anywhere_id'] );
						            	}
						            ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php
			if ( 'left' == $settings['tab_layout'] or 'right' == $settings['tab_layout'] ) {
				echo "</div>";
			}
			?>
		</div>

		<?php
	}
}