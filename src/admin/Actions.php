<?php
/**
 * Klaviyo for Give | Admin Actions
 *
 * @since 1.0.0
 */
namespace KlaviyoForGive\Admin;

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
 * @package KlaviyoForGive\Admin
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
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ), 10 );
		add_action( 'give_admin_field_klaviyo_select_list', array( $this, 'klaviyo_select_list' ), 10, 2 );
	}

	/**
	 * This function is used to load the select field with klaviyo lists.
	 *
	 * @param string $field Field.
	 * @param string $value Value.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void|mixed
	 */
	public function klaviyo_select_list( $field, $value ) {

		ob_start();
		$id    = esc_attr( $field['id'] );
		$lists = Helpers::get_all_lists();
		?>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo $id; ?>">
					<?php echo esc_attr( $field['name'] ); ?>
				</label>
			</th>
			<td scope="row">
				<select class="klaviyo-for-give-select-list" name="<?php echo $id; ?>" id="<?php echo $id; ?>">
					<?php
                    if ( is_array( $lists ) && count( $lists ) > 0 ) {
                        foreach ( $lists as $list ) {
                            echo sprintf(
                                '<option value="%1$s">%2$s</option>',
	                            $list->list_id,
                                $list->list_name,
                            );
                        }
                    }
                    ?>
				</select>

				<button class="klaviyo-for-give-refresh-button button-secondary" data-action="klaviyo_for_give_refresh_lists">
					<?php echo esc_html__( 'Refresh Lists', 'klaviyo-for-give' ); ?>
				</button>
				<span class="give-spinner spinner"></span>
				<p class="give-description"><?php echo esc_html( $field['desc'] ); ?></p>
			</td>
		</tr>
		<?php
		echo ob_get_clean();
	}

	/**
	 * Enqueue Admin Assets.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function enqueue_admin_assets() {

		wp_enqueue_style(
			'klaviyo-for-give-admin',
			KLAVIYO_FOR_GIVE_PLUGIN_URL . 'assets/dist/css/admin.css'
		);

		wp_enqueue_script(
			'klaviyo-for-give-admin',
			KLAVIYO_FOR_GIVE_PLUGIN_URL . 'assets/dist/js/admin.js',
			'',
			KLAVIYO_FOR_GIVE_VERSION
		);
	}


}

