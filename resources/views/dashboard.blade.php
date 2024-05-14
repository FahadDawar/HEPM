<x-app-layout :notifications="$notifications">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Table --}}
    <section class="bg-gray-50 py-12 dark:bg-gray-900 sm:py-5">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex items-center justify-between border-b p-4 dark:border-gray-600">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Pending Assigned images</h2>
                </div>
                <div
                    class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                    <div class="flex flex-1 items-center space-x-4">

                    </div>
                    <div
                        class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                        <a type="button"
                            class="flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            href="{{ route('clinicians.index') }}">
                            <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Add new Clinician
                        </a>

                        <a href="{{ route('images') }}"
                            class="flex flex-shrink-0 items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                            <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            Upload Clinic Image
                        </a>

                        {{-- bulk download --}}
                        <form id="bulk_download_form" action="/images/download" method="post"
                            class="flex justify-center">
                            @csrf
                            <button id="downloadSelectedImages" type="button"
                                class="items-space flex flex-shrink-0 justify-between rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                <svg class="mr-3 h-4 w-4 text-gray-900 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                    <path
                                        d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                </svg>
                                Download Bulk </button>

                            <input type="hidden" name="images[]">
                        </form>

                        {{-- bulk delete --}}
                        <form id="bulk_delete_form" action="{{ route('images.delete-all') }}" method="post"
                            class="flex justify-center">
                            @csrf
                            <button id="deleteSelectedImages" type="button"
                                class="items-space flex flex-shrink-0 justify-between rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-red-700 dark:hover:text-white dark:focus:ring-gray-700">
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
                                <th scope="col" class="px-4 py-3">Image Assigned</th>
                                <th scope="col" class="px-4 py-3">Clinician</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Online</th>
                                <th scope="col" class="px-4 py-3">Notes</th>
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
                                        <img src="{{ route('images.show', $image->filename) }}" alt="Clinic Image"
                                            class="myImg mr-3 h-40 w-auto">

                                    </th>
                                    <td class="px-4 py-2">
                                        <span
                                            class="rounded bg-primary-100 px-2 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">{{ $image->clinician->name }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            {{ $image->clinician->email }}
                                        </div>
                                    </td>
                                    <td
                                        class="items-center justify-between whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            @if ($image->clinician->is_online)
                                                <span
                                                    class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                                    <span class="me-1 h-2 w-2 rounded-full bg-green-500"></span>
                                                    Online
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                                    <span class="me-1 h-2 w-2 rounded-full bg-red-500"></span>
                                                    Offline
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <span class="ml-1 text-gray-500 dark:text-gray-400">
                                            {{ $image->note }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            @if ($image->status == 'complete')
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
                                            <button type="button" data-image-id="{{ $image->id }}"
                                                class="delete-assigned-image mb-2 me-2 rounded-lg bg-gradient-to-r from-red-400 via-red-500 to-red-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-red-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-red-300 dark:shadow-lg dark:shadow-red-800/80 dark:focus:ring-red-800">Delete</button>

                                            <a href="{{ route('images.download', $image->filename) }}"
                                                class="mb-2 me-2 rounded-lg bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-blue-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-blue-300 dark:shadow-lg dark:shadow-blue-800/80 dark:focus:ring-red-800">Download</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="ml-2 flex items-center justify-center text-red-800">
                                    No pending image found.
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
            document.addEventListener("DOMContentLoaded", function(event) {
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

                // Delete assigned-image
                const deleteAssignedImage = document.querySelectorAll('.delete-assigned-image');
                deleteAssignedImage.forEach((btn) => {
                    btn.addEventListener('click', async (e) => {
                        e.preventDefault();
                        if (confirm('Are you sure you want to delete this image?') === false) {
                            return;
                        }
                        const imageId = e.target.getAttribute('data-image-id');
                        const url = "images/" + imageId;
                        const response = await axios.delete(url);
                        if (response.status === 200) {
                            window.location.reload();
                        }
                    });
                });

                // Select all checkboxes
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
            });
        </script>
    @endpush
</x-app-layout>
