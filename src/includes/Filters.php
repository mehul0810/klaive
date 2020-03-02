<?php
/**
 * Klaviyo for Give | Filters
 *
 * @since 1.0.0
 */
namespace KlaviyoForGive\Includes;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Filters
 *
 * @since 1.0.0
 *
 * @package KlaviyoForGive\Includes
 */
class Filters {

	/**
	 * Filters constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		add_filter( 'give_metabox_form_data_settings', [ $this, 'add_metabox_fields' ], 10, 2 );
	}

	/**
	 * Add Metabox Fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array
	 */
	public function add_metabox_fields( $settings, $post_id ) {

		$is_enabled_per_form = give_get_meta( $post_id, 'klaviyo_for_give_enable_per_form', true );

		$settings['klaviyo_for_give_per_form_settings'] = [
			'id'        => 'klaviyo_for_give_per_form_settings',
			'title'     => __( 'Klaviyo Settings', 'klaviyo-for-give' ),
			'icon-html' => '<span class="dashicons dashicons-email-alt"></span>',
			'fields'    => [
				[
					'name'    => __( 'Account Options', 'klaviyo-for-give' ),
					'id'      => 'klaviyo_for_give_enable_per_form',
					'type'    => 'radio_inline',
					'default' => 'disabled',
					'options' => [
						'disabled' => __( 'Global Options', 'klaviyo-for-give' ),
						'enabled'  => __( 'Customize', 'klaviyo-for-give' ),
					],
				],
				[
					'name'          => __( 'Opt-in Default', 'klaviyo-for-give' ),
					'id'            => 'klaviyo_for_give_is_checkbox_checked_per_form',
					'type'          => 'radio_inline',
					'default'       => 'enabled',
					'options'       => [
						'enabled'  => __( 'Checked', 'klaviyo-for-give' ),
						'disabled' => __( 'Unchecked', 'klaviyo-for-give' ),
					],
					'wrapper_class' => $is_enabled_per_form ? 'klaviyo-for-give-wrapped-fields' : 'klaviyo-for-give-wrapped-fields give-hidden',
				],
				[
					'name'          => __( 'Checkbox Text', 'klaviyo-for-give' ),
					'id'            => 'klaviyo_for_give_checkbox_text_per_form',
					'desc'          => __( 'This is the text shown next to the Sign Up Newsletter checkbox. This can also be customized per form.', 'klaviyo-for-give' ),
					'type'          => 'text',
					'size'          => 'regular',
					'default'       => __( 'Subscribe to our newsletter', 'klaviyo-for-give' ),
					'attributes'    => array(
						'placeholder' => __( 'Subscribe to our newsletter', 'klaviyo-for-give' ),
					),
					'wrapper_class' => $is_enabled_per_form ? 'klaviyo-for-give-wrapped-fields' : 'klaviyo-for-give-wrapped-fields give-hidden',
				],
			],
		];

		return $settings;
	}
}
