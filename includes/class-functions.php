<?php
/**
 * Class Functions
 *
 * @author Pluginbazar
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'DAILYATTENDANCE_Functions' ) ) {
	/**
	 * Class DAILYATTENDANCE_Functions
	 */
	class DAILYATTENDANCE_Functions {


		/**
		 * Return signature key
		 *
		 * @return string
		 */
		function get_signature_key() {

			$signature_key = $this->get_option( 'signature_key' );

			if ( empty( $signature_key ) ) {
				$signature_key = hash( 'sha512', site_url() . current_time( 'U' ) );
				update_option( 'signature_key', $signature_key );
			}

			return $signature_key;
		}


		/**
		 * Return users as array
		 *
		 * @param $args
		 *
		 * @return array
		 */
		function get_users( $args = array() ) {

			$all_users = array();

			foreach ( get_users( $args ) as $wp_user ) {

				if ( ! $wp_user instanceof WP_User ) {
					continue;
				}

//				delete_user_meta( $wp_user->ID, 'secret_key' );

				$user_roles      = array_map( function ( $role_string ) {
					$wp_role = get_role( $role_string );

					return ucwords( $wp_role->name );
				}, $wp_user->roles );
				$user_roles      = implode( ', ', $user_roles );
				$user_secret_key = get_user_meta( $wp_user->ID, 'secret_key', true );
				$user_secret_key = empty( $user_secret_key ) ? hash( 'md5', $wp_user->user_email . current_time( 'U' ) ) : $user_secret_key;
				$all_users[]     = array(
					'id'         => $wp_user->ID,
					'name'       => sprintf( '<a class="font-medium underline focus:outline-none focus:shadow-none focus:ring-0" href="%s" target="_blank">#%s - %s</a>', admin_url( 'user-edit.php?user_id=' . $wp_user->ID ), $wp_user->ID, $wp_user->display_name ),
					'email'      => $wp_user->user_email,
					'roles'      => $user_roles,
					'secret_key' => $user_secret_key,
					'added_on'   => date( 'jS M Y, g:ia', strtotime( $wp_user->user_registered ) ),
				);

				update_user_meta( $wp_user->ID, 'secret_key', $user_secret_key );
			}

			return $all_users;
		}

		/**
		 * Return Post Meta Value
		 *
		 * @param bool $meta_key
		 * @param bool $post_id
		 * @param string $default
		 * @param bool $single
		 *
		 * @return mixed|string|void
		 */
		function get_meta( $meta_key = false, $post_id = false, $default = '', $single = true ) {

			if ( ! $meta_key ) {
				return '';
			}

			$post_id    = ! $post_id ? get_the_ID() : $post_id;
			$meta_value = get_post_meta( $post_id, $meta_key, $single );
			$meta_value = empty( $meta_value ) ? $default : $meta_value;

			return apply_filters( 'DAILYATTENDANCE/FILTERS/get_meta', $meta_value, $meta_key, $post_id, $default );
		}


		/**
		 * Return option value
		 *
		 * @param string $option_key
		 * @param string $default_val
		 *
		 * @return mixed|string|void
		 */
		function get_option( $option_key = '', $default_val = '' ) {

			if ( empty( $option_key ) ) {
				return '';
			}

			$option_val = get_option( $option_key, $default_val );
			$option_val = empty( $option_val ) ? $default_val : $option_val;

			return apply_filters( 'DAILYATTENDANCE/FILTERS/get_option', $option_val, $option_key, $default_val );
		}
	}
}

global $dailyattendance;

$dailyattendance = new DAILYATTENDANCE_Functions();