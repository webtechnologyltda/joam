<h3 class="mb-2 px-4 font-semibold text-lg text-gray-400">
    <span class="flex flex-col items-center justify-center">
        <img class="w-14 h-14 shrink-0 rounded-lg bg-gray-300"
             src="{{ $status['image_path'] != null ? asset('storage') . '/' . $status['image_path'] : asset('img/no-group.png') }}"
             alt="">
        <span class="text-primary-900 mt-2">
            {{ $status['title'] }}
        </span>
    </span>
</h3>
