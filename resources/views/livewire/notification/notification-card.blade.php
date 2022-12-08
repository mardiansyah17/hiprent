<a href="/post/{{ $slug }}"
    class="bg-white w-3/4 max-w-screen-sm flex p-3 items-center rounded-md shadow-md mb-3 mx-auto">

    <img class="w-16 h-16 rounded-full mr-3"
        src="{{ $photo == null ? asset('assets/img/profile-' . $gender . '.jpg') : asset('storage/' . $photo) }}" />

    <div class="flex justify-between w-full">
        <span class="basis-full">
            {{ $body }}
        </span>
        <span class=" basis-2/6">{{ $created_at->diffForHumans() }}</span>
    </div>
</a>
