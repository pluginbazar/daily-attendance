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

?>

    <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
			<?php dailyattendance_render_data_table( 'dailyattendance-table-users', 'Staffs', $table_data ); ?>
        </div>
    </div>


<?php