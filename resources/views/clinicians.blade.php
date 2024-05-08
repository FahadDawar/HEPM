<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Table --}}
    <section class="bg-gray-50 py-12 dark:bg-gray-900 sm:py-5">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">

            <div id="toast-success" class="hidden items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">Clinician deleted successfully.</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>


            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex items-center justify-between border-b p-4 dark:border-gray-600">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Clinicians</h2>
                </div>
                <div
                    class="flex flex-col space-y-3 px-4 py-3 lg:flex-row lg:items-center lg:justify-between lg:space-x-4 lg:space-y-0">
                    <div class="flex flex-1 items-center space-x-4">

                    </div>
                    <div
                        class="flex flex-shrink-0 flex-col space-y-3 md:flex-row md:items-center md:space-x-3 md:space-y-0 lg:justify-end">
                        <button type="button"
                            class="flex items-center justify-center rounded-lg bg-primary-700 px-4 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            data-modal-target="custom_modal" data-modal-toggle="custom_modal">
                            <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Add new clinician
                        </button>

                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    #
                                </th>
                                <th scope="col" class="px-4 py-3">Clinician</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clinicians as $clinician)
                                <tr class="border-b hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">
                                    <td class="w-4 px-4 py-3">
                                        <div class="flex items-center">
                                            {{ $loop->iteration }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-2">
                                        <span
                                            class="rounded bg-primary-100 px-2 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">{{ $clinician->name }}</span>
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            {{ $clinician->email }}
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            <button data-clinician-id="{{ $clinician->id }}"
                                                data-modal-target="edit_clinician_modal"
                                                data-modal-toggle="edit_clinician_modal" type="button"
                                                class="edit-clinician mb-2 me-2 rounded-lg bg-gradient-to-r from-green-400 via-green-500 to-green-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-green-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-green-300 dark:shadow-lg dark:shadow-green-800/80 dark:focus:ring-green-800">
                                                Edit</button>
                                            <button id="deleteClinicianButton"

                                                data-clinician-id="{{ $clinician->id }}"
                                                data-modal-target="deleteClinicianModal" data-modal-toggle="deleteClinicianModal"
                                                type="button"
                                                class="delete-clinician mb-2 me-2 rounded-lg bg-gradient-to-r from-red-400 via-red-500 to-red-600 px-5 py-2.5 text-center text-sm font-medium text-white shadow-lg shadow-red-500/50 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-red-300 dark:shadow-lg dark:shadow-red-800/80 dark:focus:ring-red-800">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty

                                <div class="ml-2 flex items-center justify-center text-red-800">
                                    No clinician found.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $clinicians ? $clinicians->onEachSide(5)->links() : '' }}
            </div>
        </div>
    </section>
    {{-- Table end --}}

    <!-- Register Clinician modal -->
    <x-register-clinician-modal>
        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Clinician
                Name</label>
            <input type="name" id="name"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                placeholder="name@company.com" required />
        </div>
        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Clinician
                Email</label>
            <input type="email" name="email" id="email"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                placeholder="name@company.com" required />
        </div>
        <div>
            <label for="password"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                required />
        </div>
        <div>
            <label for="password_confirmation"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                required />
        </div>

        <button type="submit"
            class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
            account</button>
    </x-register-clinician-modal>

    {{-- Edit Clinician modal --}}
    <x-edit-clinician-modal>
        <div>
            <label for="edit_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Clinician
                Name</label>
            <input type="text" id="edit_name"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                placeholder="name@company.com" required />
        </div>
        <div>
            <label for="edit_email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Clinician
                Email</label>
            <input type="email" name="edit_email" id="edit_email"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                placeholder="name@company.com" required />
        </div>
        <div>
            <input type="hidden" id="clinicianId" value="">
            <label for="edit_password"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="edit_password" id="edit_password" placeholder="••••••••"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                required />
        </div>
        <div>
            <label for="edit_password_confirmation"
                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
            <input type="password" name="edit_password_confirmation" id="edit_password_confirmation"
                placeholder="••••••••"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                required />
        </div>

        <button type="submit"
            class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update
            account</button>
    </x-edit-clinician-modal>

    <!-- Delete Clinician modal -->
    <x-delete-modal :id="'deleteClinicianModal'"/>


    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {

                const form = document.querySelector('#custom_modal form');
                const editForm = document.querySelector('#edit_clinician_modal form');
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const name = form.querySelector('#name').value;
                    const email = form.querySelector('#email').value;
                    const password = form.querySelector('#password').value;
                    const password_confirmation = form.querySelector('#password_confirmation').value;

                    // disable the button
                    button = form.querySelector('button');
                    button.disabled = true;
                    button.innerHTML = 'Creating...';

                    try {
                        const response = await axios.post('/clinicians', {
                            name,
                            email,
                            password,
                            password_confirmation
                        });

                        // clear form
                        form.reset();
                        const modal = FlowbiteInstances.getInstance('Modal', 'custom_modal');
                        modal.hide();

                         // show the toast message
                         const toast = document.querySelector('#toast-success');
                        toast.classList.remove('hidden');
                        toast.classList.add('flex');
                        toast.querySelector('.font-normal').textContent = response.data.message;
                        button.disabled = false;
                        button.innerHTML = 'Create account';

                        setInterval(() => {
                            window.location.reload();
                        }, 2000);
                    } catch (error) {
                        button.disabled = false;
                        button.innerHTML = 'Create';
                        alert(error.response.data.message);
                    }
                });


                // onclick edit clinician button show modal with clinician details
                const editClinicianButtons = document.querySelectorAll('.edit-clinician');
                editClinicianButtons.forEach(button => {
                    button.addEventListener('click', async (e) => {
                        const clinicianId = button.getAttribute('data-clinician-id');
                        const response = await axios.get(`/clinicians/${clinicianId}`);
                        const clinician = response.data;
                        // populate form
                        editForm.querySelector('#edit_name').value = clinician.name;
                        editForm.querySelector('#edit_email').value = clinician.email;
                        editForm.querySelector('#clinicianId').value = clinicianId;

                    });
                });

                // update clinician
                const updateForm = document.querySelector('#edit_clinician_modal form');
                updateForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    console.log(e);
                    const clinicianId = updateForm.querySelector('#clinicianId').value;
                    console.log(clinicianId);
                    const name = updateForm.querySelector('#edit_name').value;
                    const email = updateForm.querySelector('#edit_email').value;
                    const password = updateForm.querySelector('#edit_password').value;
                    const password_confirmation = updateForm.querySelector('#edit_password_confirmation')
                        .value;

                    // disable the button
                    button = updateForm.querySelector('button');
                    button.disabled = true;
                    button.innerHTML = 'Updating...';

                    try {
                        const response = await axios.put(`/clinicians/${clinicianId}`, {
                            name,
                            email,
                            password,
                            password_confirmation
                        });

                        // clear form
                        updateForm.reset();
                        // show the toast message
                        const toast = document.querySelector('#toast-success');
                        toast.classList.remove('hidden');
                        toast.classList.add('flex');
                        toast.querySelector('.font-normal').textContent = response.data.message;
                        const modal = FlowbiteInstances.getInstance('Modal', 'edit_clinician_modal');
                        modal.hide();
                        setInterval(() => {
                            window.location.reload();
                        }, 3000);

                    } catch (error) {
                        button.disabled = false;
                        button.innerHTML = 'Update account';
                        alert(error.response.data.message);
                    }
                });


                // delete clinician
                const deleteButtons = document.querySelectorAll('.delete-clinician');
                const confirmDeleteButton = document.querySelector('#confirmDelete');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', async (e) => {
                        const clinicianId = button.getAttribute('data-clinician-id');
                      // set the id in the confirm delete button
                        confirmDeleteButton.setAttribute('data-id', clinicianId);
                    });
                });


                // confirm delete
                confirmDeleteButton.addEventListener('click', async (e) => {
                    const clinicianId = confirmDeleteButton.getAttribute('data-id');

                    try {
                        const response = await axios.delete(`/clinicians/${clinicianId}`);

                        // show the toast message
                        const toast = document.querySelector('#toast-success');
                        toast.classList.remove('hidden');
                        toast.classList.add('flex');
                        toast.querySelector('.font-normal').textContent = response.data.message;

                        setInterval(() => {
                            window.location.reload();
                        }, 2000);
                    } catch (error) {
                        alert(error.response.data.message);
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
