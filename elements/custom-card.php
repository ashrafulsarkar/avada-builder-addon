<?php
/**
 * Add an element to fusion-builder.
 *
 * @package fusion-builder
 * @since 1.0
 */

if ( fusion_is_element_enabled( 'custom_card' ) ) {

	if ( ! class_exists( 'CustomCard' ) && class_exists( 'Fusion_Element' ) ) {
		/**
		 * Shortcode class.
		 *
		 * @since 1.0
		 */
		class CustomCard extends Fusion_Element {

			/**
			 * An array of the shortcode arguments.
			 *
			 * @access protected
			 * @since 1.0
			 * @var array
			 */
			protected $args;

			/**
			 * Constructor.
			 *
			 * @access public
			 * @since 1.0
			 */
			public function __construct() {
				parent::__construct();
				add_filter( 'fusion_attr_custom_card-wrapper', [ $this, 'attr' ] );
				add_shortcode( 'custom_card', [ $this, 'render' ] );
			}

			/**
			 * Gets the default values.
			 *
			 * @static
			 * @access public
			 * @since 2.0.0
			 * @return array
			 */
			public static function get_element_defaults() {
				$fusion_settings = fusion_get_fusion_settings();

				return [
					'background' => $fusion_settings->get( 'custom_card_background' ),
				];
			}

			/**
			 * Maps settings to param variables.
			 *
			 * @static
			 * @access public
			 * @since 2.0.0
			 * @return array
			 */
			public static function settings_to_params() {
				return [
					'custom_card_background' => 'background',
				];
			}

			/**
			 * Used to set any other variables for use on front-end editor template.
			 *
			 * @static
			 * @access public
			 * @since 2.0.0
			 * @return array
			 */
			public static function get_element_extras() {
				return [];
			}

			/**
			 * Maps settings to extra variables.
			 *
			 * @static
			 * @access public
			 * @since 2.0.0
			 * @return array
			 */
			public static function settings_to_extras() {
				return [];
			}

			/**
			 * Render the shortcode
			 *
			 * @access public
			 * @since 1.0
			 * @param  array  $args    Shortcode parameters.
			 * @param  string $content Content between shortcode.
			 * @return string          HTML output.
			 */
			public function render( $args, $content = '' ) {


				$defaults   = FusionBuilder::set_shortcode_defaults( self::get_element_defaults(), $args, 'custom_card' );
				$this->args = $defaults;

				$html  = '<div class="custom_card">';
				$html .= '<div '. FusionBuilder::attributes( 'custom_card-wrapper' ) .'>';
				$html .= '<div class="custom_card_image"><img src="'.$args[ 'image' ].'"></div>';
				$html .= '<div class="custom_card_content">';
				$html .= '<h4>'.$args[ 'title' ].'</h4>';
				$html .= '<a href="'.$args[ 'button_link' ].'">'.$args[ 'button_text' ].'</a>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '<div class="custom_card_bottom">';
				$html .= '</div>';
				$html .= '</div>';

				return $html;

			}

			/**
			 * Builds the attributes array.
			 *
			 * @access public
			 * @since 1.0
			 * @return array
			 */
			public function attr() {
				$attr = [
					'class' => 'custom_card_top',
					'style' => 'background-color:' . $this->args['background'],
				];

				return $attr;
			}

			/**
			 * Adds settings to element options panel.
			 *
			 * @access public
			 * @since 1.1.6
			 * @return array $sections Blog settings.
			 */
			public function add_options() {
				return [
					'custom_card_shortcode_section' => [
						'label'       => esc_attr__( 'Custom Card', 'hello-world' ),
						'description' => '',
						'id'          => 'custom_card_shortcode_section',
						'default'     => '',
						'icon'        => 'fusiona-check',
						'type'        => 'accordion',
						'fields'      => [
							'custom_card_background' => [
								'label'       => esc_attr__( 'Custom Card Background Color', 'hello-world' ),
								'id'          => 'custom_card_background',
								'default'     => '#0179C1',
								'type'        => 'color-alpha',
								'transport'   => 'postMessage',
							],
						],
					],
				];
			}

			/**
			 * Sets the necessary scripts.
			 *
			 * @access public
			 * @since 1.1
			 * @return void
			 */
			public function add_scripts() {

				/* For example.
				Fusion_Dynamic_JS::enqueue_script(
					'fusion-date-picker',
					FUSION_BUILDER_PLUGIN_URL . 'assets/js/library/flatpickr.js',
					FUSION_BUILDER_PLUGIN_URL . 'assets/js/library/flatpickr.js',
					[ 'jquery' ],
					'1',
					true
				);
				*/
			}

			/**
			 * Load element base CSS.
			 *
			 * @access public
			 * @since 3.0
			 * @return void
			 */
			public function add_css_files() {
				FusionBuilder()->add_element_css( SAMPLE_ADDON_PLUGIN_DIR . 'css/style.css' );
			}
		}
	}

	new CustomCard();
}

/**
 * Map shortcode to Fusion Builder
 *
 * @since 1.0
 */
function custom_card_map() {

	$fusion_settings = fusion_get_fusion_settings();

	fusion_builder_map(
		fusion_builder_frontend_data(

			// Class reference.
			'CustomCard',
			[
				'name'                     => esc_attr__( 'Custom Card', 'hello-world' ),
				'shortcode'                => 'custom_card',
				'icon'                     => 'fusiona-check',

				// View used on front-end.
				'front_end_custom_settings_view_js' => SAMPLE_ADDON_PLUGIN_URL . 'elements/front-end/custom-card.js',

				// // Template that is used on front-end.
				'front-end'                         => SAMPLE_ADDON_PLUGIN_DIR . '/elements/front-end/custom-card.php',

				'allow_generator'          => false,

				// Allows inline editor.
				'inline_editor'            => true,
				'inline_editor_shortcodes' => true,

				'params'                   => [
					[
						'type'        => 'upload',
						'heading'     => esc_attr__( 'Image', 'fusion-builder' ),
						'param_name'  => 'image',
						'value'       => '',
						'description' => esc_attr__( 'Upload an image for the card.', 'fusion-builder' ),
					],
					[
						'type'        => 'textfield',
						'heading'     => esc_attr__( 'Title', 'fusion-builder' ),
						'param_name'  => 'title',
						'value'       => '',
						'description' => esc_attr__( 'Enter the title for the card.', 'fusion-builder' ),
					],
					[
						'type'        => 'link_selector',
						'heading'     => esc_attr__( 'Button Link', 'fusion-builder' ),
						'param_name'  => 'button_link',
						'value'       => '',
						'description' => esc_attr__( 'Enter the URL for the button link.', 'fusion-builder' ),
					],
					[
						'type'        => 'textfield',
						'heading'     => esc_attr__( 'Button Text', 'fusion-builder' ),
						'param_name'  => 'button_text',
						'value'       => 'Learn more',
						'description' => esc_attr__( 'Enter the text for the button.', 'fusion-builder' ),
					],
					[
						'type'        => 'colorpickeralpha',
						'heading'     => esc_attr__( 'Background Color', 'fusion-builder' ),
						'param_name'  => 'background',
						'value'       => '',
						'description' => esc_attr__( 'Choose a background color for the card.', 'fusion-builder' ),
						'default'     => $fusion_settings->get( 'custom_card_background' ) ? $fusion_settings->get( 'custom_card_background' ) : '#0179C1',
					],
				],
			]
		)
	);
}
add_action( 'fusion_builder_before_init', 'custom_card_map' );
