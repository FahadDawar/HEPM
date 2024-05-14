@forelse ($notifications as $notification)

<a
data-image-id="{{ $notification->data['image_id'] }}"
data-notification-id="{{ $notification->id }}"
x-data=""
x-on:click.prevent="$dispatch('open-modal', 'annotateImageModal')"
href="#"
 class="notification_button flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600 ">
    <div class="flex-shrink-0">
    <img class="w-11 h-11 rounded-full" src="{{ route('clinician.images.show', $notification->data['filename']) }}" alt="Report Image">

    </div>
    <div class="pl-3 w-full">
        <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">{{ $notification->data['message'] }} by <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->data['assigned_by'] }}</span></div>
        <div class="text-xs font-medium text-primary-700 dark:text-primary-400">
            {{ $notification->created_at->diffForHumans() }}
        </div>
    </div>
</a>
@empty
<a x-data=""
x-on:click.prevent="$dispatch('open-modal', 'annotateImageModal')"
onclick="putImageId(0)"></a>
@endforelse
