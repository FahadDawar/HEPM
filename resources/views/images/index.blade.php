<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Table --}}
    <section class="bg-gray-50 py-12 dark:bg-gray-900 sm:py-5">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">

            <div id="toast-success"
                class="mb-4 hidden w-full max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow dark:bg-gray-800 dark:text-gray-400"
                role="alert">
                <div
                    class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-500 dark:bg-green-800 dark:text-green-200">
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">Images deleted successfully.</div>
                <button type="button"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>


            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex items-center justify-between border-b p-4 dark:border-gray-600">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Images</h2>
                </div>
                <div
                    class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                    <div class="flex flex-1 items-center space-x-4">

                    </div>
                    <div
                        class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'upload-image')"
                            type="button"
                            class="flex flex-shrink-0 items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                            <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            Upload Clinic Image
                        </button>
                        {{-- bulk download --}}
                        <form id="bulk_download_form" action="/images/download" method="post" class="flex justify-center">
                            @csrf
                            <button id="downloadSelectedImages" type="button"
                                class="flex flex-shrink-0 items-space justify-between rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                <svg class="w-4 h-4 text-gray-900 dark:text-white mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                    <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                 </svg>
                                Download Bulk </button>

                            <input type="hidden" name="images[]">
                        </form>

                        {{-- bulk delete --}}
                        <form id="bulk_delete_form" action="{{ route('images.delete-all') }}" method="post" class="flex justify-center">
                            @csrf
                            <button id="deleteSelectedImages" type="button"
                                class="flex flex-shrink-0 items-space justify-between rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-red-700 dark:hover:text-white dark:focus:ring-gray-700">
                                <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5a1 1 0 011-1h16a1 1 0 011 1M9 16v4a1 1 0 001 1h4a1 1 0 001-1v-4m-7-5h14a1 1 0 011 1v8a1 1 0 01-1 1H3a1 1 0 01-1-1v-8a1 1 0 011-1z" />
                            </svg>
                                Delete Bulk </button>

                            <input type="hidden" name="deleteImages[]">
                        </form>

                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" type="checkbox"
                                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="p-4">
                                    #
                                </th>
                                <th scope="col" class="px-4 py-3">Clinic Image</th>
                                <th scope="col" class="px-4 py-3">Assigned Clinician</th>
                                <th scope="col" class="px-4 py-3">Note</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($images as $image)
                                <tr class="border-b hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input type="checkbox"
                                                class="checkbox-single h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
                                                data-image-filename="{{ $image->filename }}">
                                            <label class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="w-4 px-4 py-3">
                                        <div class="flex items-center">
                                            {{ $loop->iteration }}
                                        </div>
                                    </td>

                                    <th scope="row"
                                        class="flex items-center whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <img src="{{ route('images.show', $image->filename) }}" alt="iMac Front Image"
                                            class="max-w-52 myImg mr-3 h-auto">

                                    </th>

                                    <td class="w-4 px-4 py-3">
                                        <div class="flex items-center">
                                            <span
                                                class="text-{{ $image->clinician->name != 'Not Assigned' ? 'black' : 'red' }}-700 text-xl font-bold">{{ $image->clinician->name }}</span>
                                        </div>
                                    </td>
                                    <td class="w-4 px-4 py-3">
                                        <div class="flex items-center">
                                            <span
                                                class="text-black-700">{{ $image->note }}</span>
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            @if ($image->status == 'complete' || $image->status == 'normal')
                                                <span
                                                    class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">

                                                    {{ ucwords($image->status) }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-medium text-orange-800 dark:bg-orange-900 dark:text-orange-300">

                                                    {{ ucwords($image->status) }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            <button data-image-id="{{ $image->id }}"
                                                data-modal-target="assign_clinician_modal"
                                                data-modal-toggle="assign_clinician_modal" type="button"
                                                class="assign_image mb-2 me-2 rounded-lg bg-gradient-to-r from-green-400 via-green-500 to-green-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-green-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-green-300 dark:shadow-lg dark:shadow-green-800/80 dark:focus:ring-green-800">
                                                Assign Clinician</button>
                                            <button id="deleteImageButton" data-image-id="{{ $image->id }}"
                                                data-modal-target="deleteImageModal"
                                                data-modal-toggle="deleteImageModal" type="button"
                                                class="delete-image mb-2 me-2 rounded-lg bg-gradient-to-r from-red-400 via-red-500 to-red-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-red-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-red-300 dark:shadow-lg dark:shadow-red-800/80 dark:focus:ring-red-800">Delete</button>
                                            <a href="{{ route('images.download', $image->filename) }}"
                                                class="mb-2 me-2 rounded-lg bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-blue-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-blue-300 dark:shadow-lg dark:shadow-blue-800/80 dark:focus:ring-red-800">Download</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty

                                <div class="ml-2 flex items-center justify-center text-red-800">
                                    No image found.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $images ? $images->onEachSide(5)->links() : '' }}
            </div>
        </div>
    </section>
    {{-- Table end --}}

    <!-- Upload Image modal -->
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
                <input type="file" id="image" accept="image/png, image/jpg, image/jpeg" capture
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                    required />

                <button type="button" id="uploadImage"
                    class="my-3 w-full rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700">Upload</button>
                <span class="image_error hidden items-center py-4 pl-7 text-red-500">Something went wrong</span>
            </form>
        </div>
    </x-modal>

    @if ($images->count())

        <!-- Delete image modal -->
        <x-delete-modal :id="'deleteImageModal'" />

        <!-- Assign clinician modal -->
        <x-table-modal :id="'assign_clinician_modal'" :title="'Assign Clinician'" :header="['Clinician', 'Email', 'Action']">

            <input type="hidden" name="image_id" id="image_id" value="" />
            @forelse ($onlineClinicians as $clinician)
                <tr class="border-b hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">

                    <td class="px-4 py-2">
                        <span
                            class="rounded bg-primary-100 px-2 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-100 dark:text-primary-300">
                            <span class="text-lg text-green-500">●</span>
                            {{ $clinician->name }}</span>
                    </td>

                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                        <div class="flex items-center">
                            {{ $clinician->email }}
                        </div>
                    </td>

                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                        <div class="flex items-center">
                            <button data-clinician-id="{{ $clinician->id }}" type="button"
                                class="assign-clinician mb-2 me-2 rounded-lg bg-gradient-to-r from-green-400 via-green-500 to-green-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-green-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-green-300 dark:shadow-lg dark:shadow-green-800/80 dark:focus:ring-green-800">
                                Assign</button>

                        </div>
                    </td>
                </tr>
            @empty

                <div class="ml-2 flex items-center justify-center text-red-800">
                    No online clinician found.
                </div>
            @endforelse
        </x-table-modal>

        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
        <style>
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.9);
            }

            .modal-content {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
            }

            .close {
                position: absolute;
                top: 15px;
                right: 35px;
                color: #f1f1f1;
                font-size: 40px;
                font-weight: bold;
                transition: 0.3s;
            }

            .close:hover,
            .close:focus {
                color: #bbb;
                text-decoration: none;
                cursor: pointer;
            }
        </style>

        @push('scripts')
            <script>
                // get dom ready
                document.addEventListener('DOMContentLoaded', function() {

                    // Select all checkboxes on click checkbox-all id input
                    document.getElementById('checkbox-all').addEventListener('click', function() {
                        const checkboxes = document.querySelectorAll('.checkbox-single');
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                    });

                    // bulk download images
                    document.getElementById('downloadSelectedImages').addEventListener('click', async function() {
                        const checkboxes = document.querySelectorAll('.checkbox-single');
                        const selectedImages = [];
                        checkboxes.forEach(checkbox => {
                            if (checkbox.checked) {
                                selectedImages.push(checkbox.getAttribute('data-image-filename'));
                            }
                        });

                        if (selectedImages.length === 0) {
                            alert('Please select at least one image to download');
                            return;
                        }

                        // append the images to the hidden input of the form
                        document.querySelector('input[name="images[]"]').value = selectedImages;

                        // submit the form
                        document.getElementById('bulk_download_form').submit();
                    });

                    // bulk delete
                    document.getElementById('deleteSelectedImages').addEventListener('click', async function() {
                        const checkboxes = document.querySelectorAll('.checkbox-single');
                        const selectedImages = [];
                        checkboxes.forEach(checkbox => {
                            if (checkbox.checked) {
                                selectedImages.push(checkbox.getAttribute('data-image-filename'));
                            }
                        });

                        if (selectedImages.length === 0) {
                            alert('Please select at least one image to delete');
                            return;
                        }

                        // append the images to the hidden input of the form
                        document.querySelector('input[name="deleteImages[]"]').value = selectedImages;

                        // submit the form
                        document.getElementById('bulk_delete_form').submit();
                    });


                    var modal = document.getElementById("myModal");
                    var modalImg = document.getElementById("img01");
                    var captionText = document.getElementById("caption");

                    var imgs = document.querySelectorAll(".myImg");
                    imgs.forEach(img => {
                        img.onclick = function() {
                            modal.style.display = "block";
                            modalImg.src = this.src;
                            captionText.innerHTML = this.alt;
                        }
                    });

                    var span = document.getElementsByClassName("close")[0];

                    span.onclick = function() {
                        modal.style.display = "none";
                    }

                    // delete image
                    const deleteButtons = document.querySelectorAll('.delete-image');
                    const confirmDeleteButton = document.querySelector('#confirmDelete');
                    deleteButtons.forEach(button => {
                        button.addEventListener('click', async (e) => {
                            const imageId = button.getAttribute('data-image-id');
                            // set the id in the confirm delete button
                            confirmDeleteButton.setAttribute('data-id', imageId);
                        });
                    });

                    confirmDeleteButton.addEventListener('click', async (e) => {
                        const imageId = e.target.getAttribute('data-id');
                        try {
                            const response = await axios.delete(`/images/${imageId}`);
                            console.log(response.data);
                            // Hide modal and show success
                            alert(response.data.message);
                            window.location.reload();
                        } catch (error) {
                            console.log(error.response.data);
                        }
                    });

                    // assign_image click event
                    const assignImageButtons = document.querySelectorAll('.assign_image');

                    assignImageButtons.forEach(button => {
                        button.addEventListener('click', async (e) => {
                            const imageId = button.getAttribute('data-image-id');
                            // set the id in the hidden input
                            document.getElementById('image_id').value = imageId;
                        });
                    });

                    // assign clinician
                    const assignClinicianButtons = document.querySelectorAll('.assign-clinician');

                    assignClinicianButtons.forEach(button => {
                        button.addEventListener('click', async (e) => {
                            const clinicianId = button.getAttribute('data-clinician-id');
                            const imageId = document.getElementById('image_id').value;
                            try {
                                const response = await axios.post(
                                    `/images/${imageId}/assign-clinician`, {
                                        clinician_id: clinicianId,
                                        imageId: imageId
                                    });
                                console.log(response.data);
                                // Hide modal and show success
                                alert(response.data.message);
                                window.location.reload();
                            } catch (error) {
                                console.log(error.response.data);
                            }
                        });
                    });
                });
            </script>
        @endpush
    @endif
    @push('scripts')
        <script>
            document.getElementById('uploadImage').addEventListener('click', function() {
                // Disable the button after it has been clicked
                this.disabled = true;
                this.innerHTML = 'Uploading...';
                const imageError = document.querySelector('.image_error');

                imageError.classList.add('hidden');

                var image = document.getElementById('image').files[0];
                var formData = new FormData();
                formData.append('image', image);
                axios.post('/images', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.disabled = false;
                    this.innerHTML = 'Upload';
                    imageError.classList.add('hidden');
                    console.log(response.data);

                    // Hide modal and show success
                    alert(response.data.message);
                    window.location.reload();
                }).catch(error => {

                    this.disabled = false;
                    this.innerHTML = 'Upload';
                    imageError.classList.remove('hidden');
                    imageError.innerHTML = error.response.data.errors.image[0];
                    console.log(error.response.data);
                });
            });
        </script>
    @endpush
</x-app-layout>
