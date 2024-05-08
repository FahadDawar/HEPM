 <!-- Register Clinician modal -->
 <x-modal name="upload-image">
    <div class="flex items-center justify-between border-b p-4 dark:border-gray-600">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Upload Clinic Image</h2>
        <button type="button"
            class="text-gray-500 hover:text-gray-900 focus:outline-none dark:text-gray-400 dark:hover:text-white"
            aria-label="Close modal" x-on:click="$dispatch('close')">
            <svg class="h-5 w-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.354 5.354a2 2 0 00-2.828 0L10 7.172 7.172 5.354a2 2 0 10-2.828 2.828L7.172 10 5.354 12.828a2 2 0 102.828 2.828L10 12.828l2.828 1.818a2 2 0 102.828-2.828L12.828 10l1.818-2.828a2 2 0 000-2.828z" />
            </svg>
        </button>
    </div>
    <div>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" id="image"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                required />
    </div>

    <button type="button" id="uploadImage"
        class="my-3 w-full rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700">Upload</button>
    <span class="image_error hidden items-center py-4 pl-7 text-red-500">Something went wrong</span>
    </form>
</x-modal>
