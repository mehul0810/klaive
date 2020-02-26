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
}

