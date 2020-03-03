<?php
/**
 * Klaviyo for Give | Actions
 *
 * @since 1.0.0
 */
namespace KlaviyoForGive\Includes;

use KlaviyoForGive\Includes\Helpers;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Actions
 *
 * @since 1.0.0
 *
 * @package KlaviyoForGive\Includes
 */
class Actions {

	/**
	 * Actions constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'give_donation_form_before_submit', array( $this, 'register_subscribe_newsletter_field' ), 100, 1 );
		add_action( 'give_insert_payment', array( $this, 'subscribe_to_klaviyo' ), 10, 2 );
	}

	/**
	 * This function is used to register subscribe newsletter field on donation form.
	 *
	 * @param int $form_id Donation Form ID.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_subscribe_newsletter_field( $form_id ) {

	    // Bailout, if we don't need to show the subscribe checkbox.
		if ( ! Helpers::show_subscribe_checkbox( $form_id ) ) {
			return;
		}

		$label      = Helpers::get_subscribe_checkbox_text( $form_id );
		$is_checked = Helpers::is_subscribe_checkbox_checked( $form_id );

		ob_start();
		?>
		<fieldset id="klaviyo-for-give-<?php echo $form_id; ?>" class="klaviyo-for-give-fieldset">
			<p>
				<input name="klaviyo_for_give_subscribe"
				       id="klaviyo-for-give-<?php echo $form_id; ?>-subscribe"
				       type="checkbox" <?php echo( $is_checked ? 'checked="checked"' : '' ); ?>/>
				<label for="klaviyo-for-give-<?php echo $form_id; ?>-subscribe">
					<?php echo $label; ?>
				</label>
			</p>
		</fieldset>
		<?php
		echo ob_get_clean();
	}

	/**
	 * This function is used to subscribe donor to Klaviyo List.
	 *
	 * @param int   $donation_id   Donation ID.
	 * @param array $donation_data Donation Data.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function subscribe_to_klaviyo( $donation_id, $donation_data ) {

		$post_data     = give_clean( $_POST );
		$is_subscribed = give_is_setting_enabled( $post_data['klaviyo_for_give_subscribe'] );

		// Bailout, if not subscribed.
		if ( ! $is_subscribed ) {
			return;
		}

		$form_id  = $donation_data['give_form_id'];
		$email    = $donation_data['user_info']['email'];
		$list_id  = Helpers::get_list_id( $form_id );
		$profiles = apply_filters( 'klaviyo_for_give_update_profiles', [
			[
				'email'         => $email,
				'email_consent' => true,
			]
		] );

		$response = Helpers::subscribe_to_list( $list_id, $profiles );
		$response_code = wp_remote_retrieve_response_code( $response );

		if ( 200 !== $response_code ) {
			$response_message = wp_remote_retrieve_response_message( $response );

			// Log error.
			give_record_gateway_error( "Klaviyo for Give: {$response_code}", $response_message );
		}
	}
}

