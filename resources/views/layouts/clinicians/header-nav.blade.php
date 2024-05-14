@props(['notifications'])
<header class="antialiased">
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex justify-start items-center">
                {{-- <button data-collapse-toggle="navbar-default" type="button" class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                  <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
                  <span class="sr-only">Toggle sidebar</span>
                </button> --}}
                <a href="{{ route('clinician.dashboard') }}" class="flex mr-4">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                  <span class="self-center text-2xl ms-3 font-semibold whitespace-nowrap dark:text-white">HEPMS</span>
                </a>

            </div>
            <div class="flex items-center lg:order-2">
                <!-- Notifications -->
                <button type="button" data-dropdown-toggle="notification-dropdown" class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                    <span class="sr-only">View notifications</span>
                    <!-- Bell icon -->
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20"><path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/></svg>
                    <!-- Notification count -->

                    <span id="notification_count" class="absolute  inline-flex items-center justify-center px-1 py-0.5 text-xs font-semibold leading-none text-white transform translate-x-1/3 -translate-y-5 bg-red-500 rounded-full dark:bg-red-400"></span>


                </button>
                <!-- Dropdown notifications menu -->
                <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700" id="notification-dropdown">
                    <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        Notifications
                    </div>
                    <div id="notifications">
                       @include('clinicians.partials._notifications')
                    </div>
                    {{-- View all --}}
                    <a href="/clinician" class="block py-2 text-base font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:underline">
                        <div class="inline-flex items-center ">
                        <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                        View all
                        </div>
                    </a>
                </div>

                <button type="button" class="flex mx-3 text-sm rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="data:image/png;base64,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" alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
                    <div class="py-3 px-4">
                        <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                        <li>
                            <a href="{{ route('clinician.profile.edit') }}" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My profile</a>
                        </li>
                        <li>
                            <form action="{{ route('clinician.logout') }}" method="post" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                @csrf
                            <button type="submit" class="">Sign out</button>
                            </form>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </nav>

  </header>


  @push('scripts')
    <script id="scripts">
      document.addEventListener('DOMContentLoaded', function() {

            // notification button onclick put data-image-id to annotateImageForm
            const notificationImageButton = document.querySelectorAll('.notification_button');

            notificationImageButton.forEach(btn => {
                btn.addEventListener('click', function() {
                    console.log('top btn clicked');
                    const notificationId = this.getAttribute('data-notification-id');
                    const imageId = this.getAttribute('data-image-id');

                    const imageIdInput = document.querySelector('input[name="image_id"]');
                    const notificationIdInput = document.querySelector(
                        'input[name="notification_id"]');

                    imageIdInput.value = imageId;
                    notificationIdInput.value = notificationId;
                });
            });

            // fetch notifications
            let timerId;
            async function fetchNotifications() {
                const notification_count = document.querySelector('#notification_count');
                const notifications = document.querySelector('#notifications');

                try {
                    const response = await axios.get('{{ route("clinician.notifications") }}');
                    const data = response.data;

                    notifications.innerHTML = '';

                    // now loop through the notifications and append them to the notifications div
                    data.notifications.forEach(notification => {
                        const notificationElement = document.createElement('a');
                        notificationElement.classList.add('flex', 'py-3', 'px-4', 'border-b',
                            'hover:bg-gray-100', 'dark:hover:bg-gray-600', 'dark:border-gray-600',
                            'notification_button');
                        notificationElement.setAttribute('data-image-id', notification.data
                            .image_id);
                        notificationElement.setAttribute('data-notification-id', notification.id);
                        notificationElement.setAttribute('x-data', '');
                        notificationElement.setAttribute('x-on:click.prevent', "$dispatch('open-modal', 'annotateImageModal')");

                        // that we have added onclick attribute we need to create this function as well and append to the script with id="scripts"
                        notificationElement.addEventListener('click', function() {
                            const notificationId = this.getAttribute('data-notification-id');
                            const imageId = this.getAttribute('data-image-id');

                            const imageIdInput = document.querySelector('input[name="image_id"]');
                            const notificationIdInput = document.querySelector(
                                'input[name="notification_id"]');

                            imageIdInput.value = imageId;
                            notificationIdInput.value = notificationId;
                            console.log('notification button clicked', imageId, notificationId);

                        });


                        notificationElement.setAttribute('href', '#');
                        const imageElement = document.createElement('div');
                        imageElement.classList.add('flex-shrink-0');

                        const image = document.createElement('img');
                        image.classList.add('w-11', 'h-11', 'rounded-full');
                        image.src = `/clinician/images/${notification.data.filename}`;
                        image.alt = 'Report Image';

                        imageElement.appendChild(image);

                        const contentElement = document.createElement('div');
                        contentElement.classList.add('pl-3', 'w-full');

                        const messageElement = document.createElement('div');
                        messageElement.classList.add('text-gray-500', 'font-normal', 'text-sm',
                            'mb-1.5', 'dark:text-gray-400');
                        messageElement.textContent = `${notification.data.message} by `;

                        const clerkElement = document.createElement('span');
                        clerkElement.classList.add('font-semibold', 'text-gray-900',
                            'dark:text-white');
                        clerkElement.textContent = notification.data.assigned_by;

                        messageElement.appendChild(clerkElement);

                        const timeElement = document.createElement('div');
                        timeElement.classList.add('text-xs', 'font-medium', 'text-primary-700',
                            'dark:text-primary-400');
                        timeElement.textContent = notification.data.assigned_at;

                        contentElement.appendChild(messageElement);
                        contentElement.appendChild(timeElement);

                        notificationElement.appendChild(imageElement);
                        notificationElement.appendChild(contentElement);

                        notifications.appendChild(notificationElement);

                    });

                    total_count = data.notification_count;

                    notification_count.innerHTML = total_count;

                    if(total_count === 0){
                        console.log('no notifications');
                        notification_count.style.display = 'none';
                    } else {
                        notification_count.removeAttribute('style');
                    }

                } catch (error) {
                    console.log(error);
                } finally {
                    // Schedule the next update after 7 seconds
                    timerId = setTimeout(fetchNotifications, 7000);

                }

            }

            fetchNotifications();
        });
    </script>
@endpush

