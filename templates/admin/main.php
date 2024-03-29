<?php
/**
 * Main
 */

?>


<div class="dailyattendance-container fixed inline-block w-full h-screen no-scrollbar bg-gray-50 ml-[-20px]">
    <nav class="dailyattendance-topbar border-b border-gray-200 bg-white z-30">
        <div class="px-3 py-3 w-full">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <div class="text-xl font-bold flex items-center lg:ml-2.5">
                        <span class="self-center whitespace-nowrap">Daily Attendance</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <a target="_blank" href="<?= DAILYATTENDANCE_PLUGIN_LINK ?>" class="ml-5 text-white inline-flex bg-cyan-600 hover:text-white focus:text-white hover:bg-cyan-700 focus:ring-0 font-medium rounded-md text-sm p-3 text-center items-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5l3 3m0 0l3-3m-3 3v-6m1.06-4.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/>
                        </svg>
                        <span class="uppercase ml-2">Free Download</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="flex">
        <aside class="dailyattendance-sidebar z-20 h-screen top-8 left-[162px] flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75">
            <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex-1 px-3 bg-white divide-y space-y-1">
                        <ul class="space-y-2 pb-2">

							<?php foreach ( dailyattendance()->get_panel_menu_items() as $item_key => $item ) : ?>

                                <li class="[&_.active]:bg-gray-100">
                                    <div data-target="<?= $item_key ?>" class="<?= 'dashboard' == $item_key ? 'active' : ''; ?> cursor-pointer text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
										<?= $item['icon'] ?? '' ?>
                                        <span class="ml-3 flex-1 whitespace-nowrap"><?= $item['label'] ?? '' ?></span>
                                    </div>
                                </li>

							<?php endforeach; ?>

                        </ul>
                        <div class="space-y-2 pt-2">
                            <a href="<?= DAILYATTENDANCE_PLUGIN_DOC_LINK ?>" target="_blank" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-3">Documentation</span>
                            </a>
                            <a href="<?= DAILYATTENDANCE_PLUGIN_SUPPORT_LINK ?>" target="_blank" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-3">Help</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <div class="dailyattendance-content-wrap bg-gray-50 relative overflow-y-auto">
            <div class="px-4">

				<?php foreach ( dailyattendance()->get_panel_menu_items() as $item_key => $item ) : ?>

                    <div class="<?= $item_key != 'dashboard' ? 'hidden' : '' ?> dailyattendance-content content-<?= $item_key ?>">
						<?php include DAILYATTENDANCE_PLUGIN_DIR . 'templates/admin/tab-' . $item_key . '.php'; ?>
                    </div>

				<?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
