<?php
/**
 * Render Data table
 */

if ( empty( $table_name ) ) {
	return;
}

if ( isset( $title ) && ! empty( $title ) ) { ?>
    <div class="flex justify-between items-center mb-10">
        <h3 class="text-xl leading-none font-bold text-gray-900"><?php echo $title; ?></h3>
		<?php if ( $title == 'Staffs' ) { ?>
            <div id="popup-btn" class="button justify-items-end " type="button">Add Staff</div>
		<?php } ?>
    </div>

<?php }

if ( isset( $table_data ) && is_array( $table_data ) && ! empty( $table_data ) ) :?>

    <div class="block w-full overflow-x-auto">

        <table id="dailyattendance-users" class="w-full stripe" style="width:100%">

			<?php if ( isset( $table_data['headers'] ) && is_array( $table_data['headers'] ) && ! empty( $table_data['headers'] ) ) : ?>
                <thead>
                <tr>
					<?php foreach ( $table_data['headers'] as $key => $label ) : ?>
                        <th data-key="<?= $key ?>"><?= $label ?></th>
					<?php endforeach; ?>
                </tr>
                </thead>
			<?php endif; ?>

			<?php if ( isset( $table_data['body'] ) && is_array( $table_data['body'] ) && ! empty( $table_data['body'] ) ) : ?>
                <tbody>
				<?php foreach ( $table_data['body'] as $index => $table_row ) : ?>

					<?php if ( is_array( $table_row ) && ! empty( $table_row ) ) : ?>
                        <tr>
							<?php foreach ( $table_row as $data_key => $data_value ) : ?>
                                <td><?= $data_value ?></td>
							<?php endforeach; ?>
                        </tr>
					<?php endif; ?>

				<?php endforeach; ?>
                </tbody>
			<?php endif; ?>


        </table>

    </div>

<?php endif;