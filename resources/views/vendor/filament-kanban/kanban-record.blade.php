<div
    id="{{ $record->getKey() }}"
    wire:click="recordClicked('{{ $record->getKey() }}', {{ @json_encode($record) }})"
    class="record bg-white dark:bg-gray-700 rounded-lg px-4 py-2 cursor-grab font-medium text-gray-600 dark:text-gray-200"
    @if($record->timestamps && now()->diffInSeconds($record->{$record::UPDATED_AT}) < 3)
        x-data
        x-init="
            $el.classList.add('animate-pulse-twice', 'bg-primary-100', 'dark:bg-primary-800')
            $el.classList.remove('bg-white', 'dark:bg-gray-700')
            setTimeout(() => {
                $el.classList.remove('bg-primary-100', 'dark:bg-primary-800')
                $el.classList.add('bg-white', 'dark:bg-gray-700')
            }, 1000)
        "
    @endif
>
    <span class="flex items-center">
        <img class="w-10 h-10 shrink-0 rounded-full bg-gray-300"
             src="{{ $record->avatar_url != null ? asset('storage') . '/' . $record->avatar_url : asset('img/no-avatar.png') }}"
             alt="">
        <span class="text-primary-900 ml-2">
            {{ $record->{static::$recordTitleAttribute} }}
        </span>
    </span>
</div>
