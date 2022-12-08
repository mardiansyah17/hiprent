<div class="flex items-center leading-3">
    <img src="{{ asset('assets/img/profile-male.jpg') }}" class="w-10 h-10 rounded-full mr-3" alt="">

    <div class="bg-gray-200 px-3 py-2 rounded-lg">
        <div class="mb-2">
            <h1 class="font-semibold ">
                Muhammad Mardiansyah
            </h1>
            <small>{{ $coment->updated_at->diffForHumans() }}</small>
        </div>

        <div class="">
            {{ $coment->coment }}
        </div>
    </div>
</div>
