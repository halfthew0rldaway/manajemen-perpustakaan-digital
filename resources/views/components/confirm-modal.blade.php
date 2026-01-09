<div x-data="{ 
    open: false, 
    title: 'Konfirmasi', 
    message: 'Apakah Anda yakin ingin melanjutkan tindakan ini?', 
    form: null,
    confirmText: 'Ya, Lanjutkan',
    cancelText: 'Batal',
    type: 'primary' // primary, danger, warning
}" @open-confirm-modal.window="
    open = true; 
    message = $event.detail.message; 
    form = $event.detail.form;
    title = $event.detail.title || 'Konfirmasi';
    confirmText = $event.detail.confirmText || 'Ya, Lanjutkan';
    cancelText = $event.detail.cancelText || 'Batal';
    type = $event.detail.type || 'primary';
" class="relative z-[60]" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="open" x-cloak>

    <!-- Backdrop -->
    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

            <!-- Modal Panel -->
            <div x-show="open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-xl bg-white dark:bg-slate-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100 dark:border-gray-700">

                <div class="bg-white dark:bg-slate-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10 transition-colors duration-200"
                            :class="{
                                'bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400': type === 'primary',
                                'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400': type === 'danger',
                                'bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400': type === 'warning'
                             }">
                            <!-- Heroicon: outline/exclamation-triangle -->
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white font-serif"
                                id="modal-title" x-text="title"></h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400 font-sans" x-text="message"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-slate-700/30 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                    <button type="button" @click="open = false; if(form) { form.submit(); }"
                        class="inline-flex w-full justify-center rounded-lg px-3 py-2 text-sm font-semibold text-white shadow-sm sm:w-auto transition-all duration-200 btn-shadow"
                        :class="{
                            'bg-teal-600 hover:bg-teal-500 shadow-[0_4px_0_#0f766e] hover:shadow-[0_6px_0_#0f766e] translate-y-0 hover:-translate-y-0.5 active:translate-y-1 active:shadow-[0_2px_0_#0f766e]': type === 'primary',
                            'bg-red-600 hover:bg-red-500 shadow-[0_4px_0_#991b1b] hover:shadow-[0_6px_0_#991b1b] translate-y-0 hover:-translate-y-0.5 active:translate-y-1 active:shadow-[0_2px_0_#991b1b]': type === 'danger',
                            'bg-orange-600 hover:bg-orange-500 shadow-[0_4px_0_#c2410c] hover:shadow-[0_6px_0_#c2410c] translate-y-0 hover:-translate-y-0.5 active:translate-y-1 active:shadow-[0_2px_0_#c2410c]': type === 'warning'
                        }" x-text="confirmText">
                    </button>
                    <button type="button" @click="open = false"
                        class="mt-3 inline-flex w-full justify-center rounded-lg bg-white dark:bg-slate-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto shadow-[0_4px_0_#e5e7eb] dark:shadow-[0_4px_0_#374151] hover:shadow-[0_6px_0_#e5e7eb] dark:hover:shadow-[0_6px_0_#374151] translate-y-0 hover:-translate-y-0.5 active:translate-y-1 active:shadow-[0_2px_0_#e5e7eb] dark:active:shadow-[0_2px_0_#374151] transition-all duration-200"
                        x-text="cancelText">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.confirmModal = function (event, message, title = 'Konfirmasi', type = 'primary') {
        event.preventDefault();
        window.dispatchEvent(new CustomEvent('open-confirm-modal', {
            detail: {
                message: message,
                form: event.target.closest('form'),
                title: title,
                type: type
            }
        }));
        return false;
    }
</script>