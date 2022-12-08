<div>
    <div class="w-4/5 mx-auto bg-white p-3">
        <header class="flex justify-between items-center border-b-2 border-gray-200 p-2 mb-3 ">
            <div class="flex items-center   basis-3/4 h-full">
                <div class=" w-40 basis-1/5">
                    <img src="{{ auth()->user()->profile_photo_path == null ? asset('assets/img/profile-' . auth()->user()->gender . '.jpg') : asset('storage/' . auth()->user()->profile_photo_path) }}"
                        alt="{{ $user->name }}" class="rounded-full h-20 w-20 object-cover">

                </div>
                <div class=" basis-full ">
                    <h1 class="text-2xl  font-bold ">{{ $user->name }}</h1>
                </div>
            </div>
        </header>

        {{-- about --}}
        <div class="flex justify-between border-b-2 border-gray-200 mb-3">
            <div class="basis-2/4 ">
                <h1 class="text-xl font-bold">Tentang</h1>
                <ul class="text-lg font-semibold">

                    <li class="space-x-2 border-b-2 border-gray-200 p-2">
                        <i class="fa-solid fa-house-chimney"></i>
                        <span>{{ $user->stay_in }}</span>
                    </li>
                    <li class="space-x-2 border-b-2 border-gray-200 p-2">
                        <i class="fa-solid fa-cake-candles"></i>
                        <span>{{ \Carbon\Carbon::parse($user->date_of_birth)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}</span>
                    </li>
                    <li class="space-x-2 border-b-2 border-gray-200 p-2">
                        <i class="fa-solid fa-toolbox"></i>
                        <span>{{ $user->job }}</span>
                    </li>
                    <li class="space-x-2 border-b-2 border-gray-200 p-2">
                        <i class="fa-solid fa-venus-mars"></i>
                        <span>{{ $user->gender }}</span>
                    </li>
                    <li class="space-x-2 border-b-2 border-gray-200 p-2">
                        <i class="fa-solid fa-heart"></i>
                        <span>{{ $user->relationship }}</span>
                    </li>



                </ul>
            </div>
            <div class=" basis-3/4 p-2">
                <h1 class="text-xl font-bold">Bio</h1>
                <span>
                    {{ $user->bio }}
                </span>
            </div>
        </div>
        {{-- end about --}}
        @if (!$editMode)
            {{-- list post --}}
            <div class="w-4/5 mx-auto">
                @foreach ($posts as $post)
                    <livewire:home.card-post :userId="$post->user->id" :postId="$post->id" wire:key="id.{{ $post->id }}" />
                @endforeach
            </div>
            {{-- end list post --}}
        @endif

    </div>
</div>
