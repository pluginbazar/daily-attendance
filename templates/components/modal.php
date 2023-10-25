<?php
$class         = $class ?? '';
$modal_id      = $modal_id ?? '';
$modal_title   = $modal_title ?? '';
$modal_content = $modal_content ?? '';
$modal_icon    = $modal_icon ?? '';
$has_buttons   = $has_buttons ?? true;
$button_yes    = $button_yes ?? '';
$button_no     = $button_no ?? '';

?>

<div class="modal relative z-10 <?= $class; ?>" id="<?= $modal_id; ?>" aria-labelledby="<?= $modal_title ?>" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
						<?= $modal_icon; ?>
                        <div class="mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="<?= $modal_title ?>"><?= $modal_title ?></h3>
                            <div class="mt-2">
								<?= $modal_content; ?>
                            </div>
                        </div>
                    </div>
                </div>

				<?php if ( $has_buttons ) : ?>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <input type="hidden" name="object_id" class="object_id" value="">
                        <button type="button" class="confirm inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm"><?= $button_yes; ?></button>
                        <button type="button" class="cancel mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"><?= $button_no; ?></button>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>

