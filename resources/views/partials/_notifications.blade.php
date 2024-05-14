@forelse ($notifications as $notification)
    <a data-image-filename="{{ $notification->data['filename'] }}" data-annotation-id="{{ $notification->id }}"
        data-modal-target="show-annotated-image" href="#"
        class="mark-as-read flex border-b px-4 py-3 hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-600">
        <div class="flex-shrink-0">
            <img class="h-11 w-11 rounded-full" src="{{ route('images.show', $notification->data['filename']) }}"
                alt="Report Image">

        </div>
        <div class="w-full pl-3">
            <div class="mb-1.5 text-sm font-normal text-gray-500 dark:text-gray-400">
                {{ $notification->data['message'] }} by <span
                    class="font-semibold text-gray-900 dark:text-white">{{ $notification->data['annotated_by'] }}</span>
            </div>
            <div class="text-xs font-medium text-primary-700 dark:text-primary-400">
                {{ $notification->created_at->diffForHumans() }}
            </div>
        </div>
    </a>
@empty
    <a data-modal-target="show-annotated-image" >

    </a>
@endforelse
