<?php
/**
 * Render Data table
 */

if ( empty( $table_name ) ) {
	return;
}

if ( isset( $title ) && ! empty( $title ) ) : ?>

    <div class="flex justify-between items-center mb-10">
        <h3 class="text-xl leading-none font-bold text-gray-900"><?php echo esc_html__( $title, 'daily-attendance' ); ?></h3>

		<?php if ( $table_name == 'dailyattendance-users' ): ?>
            <div id="btn-open-modal" data-target="modal-add-users" class="button justify-items-end" type="button"><?php echo esc_html__( 'Add Staff', 'daily-attendance' ); ?></div>
		<?php endif; ?>

		<?php if ( $table_name == 'dailyattendance-designations' ): ?>
            <div id="btn-open-modal" data-target="modal-add-designations" class="button justify-items-end" type="button"><?php echo esc_html__( 'Add Designation', 'daily-attendance' ); ?></div>
		<?php endif; ?>

	    <?php if ( $table_name == 'dailyattendance-leave-request' ): ?>
            <div id="btn-open-modal" data-target="modal-add-leave-request" class="button justify-items-end" type="button"><?php echo esc_html__( 'Leave', 'daily-attendance' ); ?></div>
	    <?php endif; ?>
    </div>

<?php endif; ?>


<?php if ( isset( $table_data ) && is_array( $table_data ) && ! empty( $table_data ) ) : ?>

    <div class="block w-full overflow-x-auto">

        <table id="<?= $table_name ?>" class="w-full stripe" style="width:100%">

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