<?php
/**
 * Main
 */

$users_list = dailyattendance()->get_users();
$users_list = array_map( function ( $user_data ) {

	$user_data['secret_key'] = sprintf( '<span id="user-secret-key" aria-label="Copy Code" class="hint--top hint--rounded bg-gray-100 border border-gray-300 px-2 py-2 rounded-md text-gray-700 cursor-pointer w-[280px] block text-center"><span>%s</span></span>', $user_data['secret_key'] );

	return $user_data;
}, $users_list );
$table_data = array(
	'headers' => array(
		'id'         => esc_html__( 'ID', 'daily-attendance' ),
		'name'       => esc_html__( 'Name', 'daily-attendance' ),
		'email'      => esc_html__( 'Email Address', 'daily-attendance' ),
		'roles'      => esc_html__( 'Roles', 'daily-attendance' ),
		'secret_key' => esc_html__( 'Secret Key', 'daily-attendance' ),
		'added_on'   => esc_html__( 'Joined', 'daily-attendance' ),
	),
	'body'    => $users_list,
);


$username   = isset( $_POST['user_name'] ) ? $_POST['user_name'] : '';
$email      = isset( $_POST['email'] ) ? $_POST['email'] : '';
$fname      = isset( $_POST['first_name'] ) ? $_POST['first_name'] : '';
$lname      = isset( $_POST['last_name'] ) ? $_POST['last_name'] : '';
$role       = isset( $_POST['user_role'] ) ? $_POST['user_role'] : '';
$pass       = isset( $_POST['password'] ) ? $_POST['password'] : '';
$submission = isset( $_POST['submission'] ) ? $_POST['submission'] : '';

if ( $submission == 'yes' ) {

	if ( ! empty( $username ) && ! empty( $email ) && ! empty( $fname ) && ! empty( $lname ) && ! empty( $role ) && ! empty( $pass ) ) {
		if ( username_exists( $username ) == null && email_exists( $email ) == false ) {
			$user_id = wp_create_user( $username, $pass, $email );
			$user    = get_user_by( 'id', $user_id );
			$user->set_role( $role );
			$args               = array();
			$args['ID']         = $user_id;
			$args['first_name'] = $fname;
			$args['last_name']  = $lname;
			wp_update_user( $args );

		}
	}
}

?>

<div class="grid grid-cols-1 xl:gap-4 my-4">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
		<?php dailyattendance_render_data_table( 'dailyattendance-table-users', 'Staffs', $table_data ); ?>
    </div>
</div>


<div class="modal add-user hidden relative z-[99999] " id="modal-website-form" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="modal-bg-overlay"></div>
    <div class="modal-box-wrap">
        <div class="modal-box">
            <div class="modal-content w-full max-w-md max-h-full rounded">
                <form class="modal-content-wrap website-add-form" method="post">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <p class="response notice hidden"></p>
                        <div class="mt-4 space-y-6 space-y-6 bg-white">
                            <div class="form-control">
                                <label for="user_name">User Name</label>
                                <div class="field-wrap">
                                    <input type="text" class="block w-full rounded-md" name="user_name" id="user_name" placeholder="username" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="email">Email</label>
                                <div class="field-wrap">
                                    <input type="text" name="email" id="email" placeholder="email" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="first_name">First Name</label>
                                <div class="field-wrap">
                                    <input type="text" name="first_name" id="first_name" placeholder="first name" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="last_name">Last Name</label>
                                <div class="field-wrap">
                                    <input type="text" name="last_name" id="last_name" placeholder="last name" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="user_role">User Role</label>
                                <div class="field-wrap">
                                    <select name="user_role" id="user_role">
                                        <option value="">Choose...</option>
                                        <option value="administrator">Administrator</option>
                                        <option value="subscriber">Subscriber</option>
                                        <option value="editor">Editor</option>
                                        <option value="author">Author</option>
                                        <option value="contributor">Contributor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="password">Password</label>
                                <div class="field-wrap">
                                    <input type="text" name="password" id="password" placeholder="c54a#be@c43$9%901c6*98" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="submission" class="ml-2" value="yes"><span class="button">Submit</span></button>
                        <button type="button" class="cancel close-popup"><span class="button outlined">Cancel</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
