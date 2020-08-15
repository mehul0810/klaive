<?php
/**
 * Klaive | Admin Settings
 *
 * @since 1.0.0
 */
namespace Klaive\Includes;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Trait Helpers
 *
 * @since 1.0.0
 *
 * @package Klaive\Includes
 */
trait Helpers {

	/**
	 * This helper function is used to get API key.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public static function get_api_key() {
		return give_get_option( 'klaive_api_key', false );
	}

	/**
	 * This helper function will determine whether to show subscribe checkbox or not.
	 *
	 * @param int $form_id Donation Form ID.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public static function show_subscribe_checkbox( $form_id ) {

		$show_checkbox = give_is_setting_enabled( give_get_option( 'klaive_enable_globally', 'enabled' ) );
		$show_per_form = give_is_setting_enabled( give_get_meta( $form_id, 'klaive_enable_per_form', true ) );

		if ( $show_per_form && $form_id > 0 ) {
			$show_checkbox = $show_per_form;
		}

		return $show_checkbox;
	}

	/**
	 * This helper function will determine whether the subscribe checkbox is checked or not.
	 *
	 * @param int $form_id Donation Form ID.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public static function is_subscribe_checkbox_checked( $form_id ) {

		$is_checked    = give_is_setting_enabled( give_get_option( 'klaive_is_checkbox_checked_globally', 'enabled' ) );
		$show_per_form = give_is_setting_enabled( give_get_meta( $form_id, 'klaive_enable_per_form', true ) );

		if ( $show_per_form && $form_id > 0 ) {
			$is_checked = give_is_setting_enabled( give_get_meta( $form_id, 'klaive_is_checkbox_checked_per_form', true ) );
		}

		return $is_checked;
	}

	/**
	 * This helper function is used to get the text of the subscribe checkbox.
	 *
	 * @param int $form_id Donation Form ID.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public static function get_subscribe_checkbox_text( $form_id ) {

		$default_text  = __( 'Subscribe to our newsletter', 'klaive' );
		$checkbox_text = give_get_option( 'klaive_checkbox_text_globally', $default_text );
		$show_per_form = give_is_setting_enabled( give_get_meta( $form_id, 'klaive_enable_per_form', true ) );

		if ( $show_per_form && $form_id > 0 ) {
			$checkbox_text = give_get_meta( $form_id, 'klaive_checkbox_text_per_form', true );
		}

		return $checkbox_text;
	}

	/**
	 * This helper function is used to get API endpoint.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public static function get_api_endpoint() {
		return 'https://a.klaviyo.com';
	}

	/**
	 * This helper function is used to return all the lists.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array
	 */
	public static function get_all_lists() {

		$endpoint = self::get_api_endpoint() . '/api/v2/lists';
		$api_key  = self::get_api_key();

		$lists = wp_remote_retrieve_body(
			wp_safe_remote_get(
				$endpoint,
				[
					'body' => [
						'api_key' => $api_key,
					],
				]
			)
		);

		return json_decode( $lists );
	}

	/**
	 * This helper function is used to subscribe donor to Klaviyo list.
	 *
	 * @param string $list_id  List ID.
	 * @param array  $profiles Profiles array.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array|\WP_Error
	 */
	public static function subscribe_to_list( $list_id, $profiles ) {
		$endpoint = self::get_api_endpoint();
		$api_key  = self::get_api_key();
		$url      = "{$endpoint}/api/v2/list/{$list_id}/subscribe";

		$body = [
			'headers' => [
				'Content-Type' => 'application/json',
			],
			'body'    => wp_json_encode(
				[
					'api_key'  => $api_key,
					'profiles' => $profiles,
				]
			),
		];

		return wp_remote_post( $url, $body );
	}

	/**
	 * This helper function is used to get selected list ID.
	 *
	 * @param int $form_id Donation Form ID.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public static function get_list_id( $form_id ) {
		$list_id       = give_get_option( 'klaive_selected_list_globally' );
		$show_per_form = give_is_setting_enabled( give_get_meta( $form_id, 'klaive_enable_per_form', true ) );

		if ( $show_per_form && $form_id > 0 ) {
			$list_id = give_get_meta( $form_id, 'klaive_selected_list_per_form', true );
		}

		return $list_id;
	}

	/**
	 * This function is used to prepare list HTML.
	 *
	 * @param array  $field List of field arguments.
	 * @param string $value Selected Value.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public static function prepare_list_html( $field, $value ) {

		$id    = esc_attr( $field['id'] );
		$lists = self::get_all_lists();

		if ( is_array( $lists ) && count( $lists ) > 0 ) {
			?>
			<select class="klaive-select-list" name="<?php echo $id; ?>" id="<?php echo $id; ?>">
				<?php
				foreach ( $lists as $list ) {
					echo sprintf(
						'<option %3$s value="%1$s">%2$s</option>',
						$list->list_id,
						$list->list_name,
						( $list->list_id === $value ) ? 'selected="selected"' : ''
					);
				}
				?>
			</select>
			<?php
		}
		?>

		<button class="klaive-refresh-button button-secondary" data-action="klaive_refresh_lists">
			<?php echo esc_html__( 'Refresh Lists', 'klaive' ); ?>
		</button>
		<span class="klaive-spinner give-spinner spinner"></span>
		<?php
	}
}
