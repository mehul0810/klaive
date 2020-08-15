<?php
/**
 * Klaive | Admin Actions
 *
 * @since 1.0.0
 */
namespace Klaive\Admin;

use Klaive\Includes\Helpers;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Actions
 *
 * @since 1.0.0
 *
 * @package Klaive\Admin
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
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ], 10 );
		add_action( 'give_admin_field_klaviyo_select_list', [ $this, 'klaviyo_select_list_admin_field' ], 10, 2 );
		add_action( 'wp_ajax_klaive_refresh_lists', [ $this, 'refresh_klaviyo_list' ] );
	}

	/**
	 * This function is used to load the select field with klaviyo lists for admin field.
	 *
	 * @param string $field Field.
	 * @param string $value Value.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void|mixed
	 */
	public function klaviyo_select_list_admin_field( $field, $value ) {
		ob_start();
		?>
		<tr valign="top" class="<?php echo esc_attr( $field['wrapper_class'] ); ?>">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $field['id'] ); ?>">
				   <?php echo esc_attr( $field['name'] ); ?>
				</label>
			</th>
			<td scope="row">
			   <?php Helpers::prepare_list_html( $field, $value ); ?>
				<p class="give-description"><?php echo esc_html( $field['desc'] ); ?></p>
			</td>
		</tr>
		<?php
		echo ob_get_clean();
	}

	/**
	 * This function is used to load the select field with klaviyo lists for metabox field.
	 *
	 * @param string $field Field.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void|mixed
	 */
	public function klaviyo_select_list_metabox_field( $field ) {
		ob_start();

		$value = give_get_meta( get_the_ID(), 'klaive_selected_list_per_form', true );
		?>
		<fieldset class="give-field-wrap <?php echo esc_attr( $field['wrapper_class'] ); ?>">
			<span class="give-field-label">
				<?php echo esc_attr( $field['name'] ); ?>
			</span>
			<legend class="screen-reader-text">
				<?php echo esc_attr( $field['name'] ); ?>
			</legend>
			<?php Helpers::prepare_list_html( $field, $value ); ?>
			<p class="give-field-description"><?php echo esc_html( $field['desc'] ); ?></p>

		</fieldset>
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
			'klaive-admin',
			KLAIVE_PLUGIN_URL . 'assets/dist/css/admin.css'
		);

		wp_enqueue_script(
			'klaive-admin',
			KLAIVE_PLUGIN_URL . 'assets/dist/js/admin.js',
			'',
			KLAIVE_VERSION
		);
	}

	/**
	 * This function will be used to refresh klaviyo list.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function refresh_klaviyo_list() {
		// Bailout, if the current user is not administrator.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error();
		}

		$final_list = '';
		$lists      = Helpers::get_all_lists();

		if ( is_array( $lists ) && count( $lists ) > 0 ) {
			foreach ( $lists as $list ) {
				$final_list .= sprintf(
					'<option value="%1$s">%2$s</option>',
					$list->list_id,
					$list->list_name
				);
			}
		}

		wp_send_json_success( $final_list );
		give_die();
	}
}
