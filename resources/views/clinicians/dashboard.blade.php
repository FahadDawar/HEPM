<x-clinicians.app-layout :notifications="$notifications">
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
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Assigned Images</h2>
                </div>
                <div
                    class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                    <div class="flex flex-1 items-center space-x-4">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    #
                                </th>
                                <th scope="col" class="px-4 py-3">Assigned Image</th>
                                <th scope="col" class="px-4 py-3">Notes</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($assignedImages as $assignedImage)
                                <tr class="border-b hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">
                                    <td class="w-4 px-4 py-3">
                                        <div class="flex items-center">
                                            {{ $loop->iteration }}
                                        </div>
                                    </td>
                                    <th scope="row"
                                        class="flex items-center whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <img src="{{ route('clinician.images.show', $assignedImage->filename) }}"
                                            alt="Clinic Image" class="max-w-52 myImg mr-3 h-auto">

                                    </th>

                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <span class="ml-1 text-gray-500 dark:text-gray-400">
                                            {{ $assignedImage->note }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            @if ($assignedImage->status == 'complete' || $assignedImage->status == 'normal')
                                                <span
                                                    class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">

                                                    {{ ucwords($assignedImage->status) }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-medium text-orange-800 dark:bg-orange-900 dark:text-orange-300">

                                                    {{ ucwords($assignedImage->status) }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            <button type="button" data-image-id="{{ $assignedImage->id }}"
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'annotateImageModal')"
                                                class="innotate-image-button mb-2 me-2 rounded-lg bg-gradient-to-r from-green-400 via-green-500 to-green-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-green-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-green-300 dark:shadow-lg dark:shadow-green-800/80 dark:focus:ring-red-800">Annotate</button>

                                            <a href="{{ route('clinician.images.download', $assignedImage->filename) }}"
                                                class="mb-2 me-2 rounded-lg bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-blue-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-blue-300 dark:shadow-lg dark:shadow-blue-800/80 dark:focus:ring-red-800">Download</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty

                                <div class="ml-2 flex items-center justify-center text-red-800">
                                    No assigned image found.
                                </div>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                {{ $assignedImages ? $assignedImages->onEachSide(5)->links() : '' }}
            </div>
        </div>
    </section>
    {{-- Table end --}}

    {{-- Annotation Modal --}}
    <x-modal title="Annotate Image" name="annotateImageModal">
        <form action="" method="POST" id="annotateImageForm">
            @csrf
            <div class="space-y-4">
                <div class="center flex items-center justify-center pt-5">
                    <div class="items center flex space-x-4">
                        <label for="normal" class="inline-flex items-center">
                            <input type="radio" name="status" id="normal" value="normal" required>
                            <span class="ml-2">Normal</span>
                        </label>
                        <label for="abnormal" class="inline-flex items-center">
                            <input type="radio" name="status" id="abnormal" value="abnormal" required>
                            <span class="ml-2">Abnormal</span>
                        </label>
                    </div>
                </div>
                <input type="hidden" name="image_id" id="image_id">
                <input type="hidden" name="notification_id" id="notification_id">
                <div>
                    <input id="note" class="mx-1 mt-1 w-full" placeholder="Write some note here" type="text"
                        name="note" required />
                </div>
                <div class="items center flex justify-center space-x-4">
                    <button
                        class="mb-2 me-2 rounded-lg bg-gradient-to-r from-green-400 via-green-500 to-green-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-green-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-green-300 dark:shadow-lg dark:shadow-green-800/80 dark:focus:ring-red-800">Annotate</button>
                </div>
            </div>
        </form>
    </x-modal>

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

                // innotate-image-button onclick put data-image-id to annotateImageForm
                const innotateImageButton = document.querySelectorAll('.innotate-image-button');
                innotateImageButton.forEach(button => {
                    button.addEventListener('click', function() {
                        console.log('button clicked');
                        const imageId = this.getAttribute('data-image-id');
                        const imageIdInput = document.querySelector('input[name="image_id"]');
                        imageIdInput.value = imageId;
                    });
                });

                // Innotate image using axios updating image status and optional note
                const annotateImageForm = document.getElementById('annotateImageForm');
                annotateImageForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const formData = new FormData(annotateImageForm);
                    const imageId = formData.get('image_id');
                    const notificationId = formData.get('notification_id');
                    const status = formData.get('status');
                    const note = formData.get('note');
                    console.log(imageId, notificationId, status, note);
                    try {
                        const response = await axios.post(`/clinician/images/${imageId}/innotate`, {
                            status,
                            note,
                            notification_id: notificationId
                        });

                        if (response.status === 200) {
                            window.location.reload();
                        }
                    } catch (error) {
                        console.error(error);
                    }
                });
            });
        </script>
    @endpush
</x-clinicians.app-layout>
