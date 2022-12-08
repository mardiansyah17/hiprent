<div class=" mx-2 mb-5 bg-white shadow-sm border border-gray-200 rounded-lg p-3 sm:w-10/12 sm:mx-auto lg:w-3/4">
    {{-- header --}}
    <header class="flex items-center justify-between mb-3">
        <div class="flex items-center">
            <img src="{{ $profile_photo_path == null ? asset('assets/img/profile-' . $userGender . '.jpg') : asset('storage/' . $profile_photo_path) }}"
                alt="user-profile-photo" class="w-1h-12 h-12 rounded-full">
            <div class="leading-3 ml-2 ">
                <a href="/profile/{{ $userSlug }}" class="text-lg font-semibold">{{ $userName }}</a>
                <small class="font-thin block">{{ $created_at->diffForHumans() }}</small>
            </div>
        </div>
        @if (auth()->id() == $userId)
            <div class="dropdown dropdown-end">
                <label tabindex="0"> <i class="fa-solid fa-ellipsis-vertical btn btn-ghost btn-circle"></i></label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100  w-40">
                    <li onclick="document.activeElement.blur()"
                        class=" mb-2 rounded-lg border-gray-200 p-2 btn btn-ghost btn-sm" wire:click='showEdit'>
                        Edit
                    </li>
                    <li onclick="document.activeElement.blur()"
                        class="rounded-lg border-gray-200  p-2 btn btn-ghost btn-sm"
                        wire:click='deletePost({{ $postId }})'>Hapus</li>

                </ul>
            </div>
        @endif
    </header>
    {{-- end header --}}

    {{-- caption --}}
    @if (!$edit)

        <main class="px-3">
            <div class=" leading-4">
                {!! $caption !!}
            </div>

            <div class="carousel w-full">
                @for ($i = 0; $i < $postPhotos->count(); $i++)
                    <div id="{{ 'slide' . $postId . '-' . $i + 1 }}" class="carousel-item relative w-full">
                        <img src="{{ asset('storage/' . $postPhotos[$i]->url_photo) }}" class="mx-auto"
                            style="max-height: 488px;max-height: 385px" />
                        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                            <a href="#{{ 'slide' . $postId . '-' . $i }}" class="btn btn-circle">❮</a>
                            <a href="#{{ 'slide' . $postId . '-' . $i + 2 }}" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                @endfor

            </div>
        </main>
    @else
        <div class="flex items-center ">
            <textarea style="resize: none" wire:model='caption'
                class="border-blue-400 w-full  rounded-lg  active:border-blue-600 text-lg "></textarea>
            <div class="flex flex-col items-center">
                <button wire:click='editPost({{ $postId }})' class=" btn btn-ghost btn-circle text-blue-700">
                    <i class="fa-solid fa-paper-plane fa-lg"></i>
                </button>
                <button class=" btn btn-ghost btn-circle text-blue-700">
                    <i class="fa-solid fa-xmark fa-lg" wire:click='showEdit'></i>
                </button>
            </div>
        </div>
    @endif
    {{-- end caption --}}

    {{-- footer --}}
    <div class="flex justify-around mt-4 mb-2 w-60 mx-auto">
        <div class="flex items-center">
            <span class="mr-3">{{ $likeCount }}</span>
            <i wire:loading.attr='disabled' wire:target='setLike' wire:click='setLike({{ $postId }})'
                class="fa-solid fa-thumbs-up fa-xl {{ $isLike ? 'text-blue-500' : '' }} cursor-pointer"></i>
        </div>
        <div class="flex items-center">
            <span class="mr-3">{{ $comentCount }}</span>
            <i class="fa-solid fa-comment fa-xl cursor-pointer" wire:click='toggleComent'></i>
        </div>
    </div>
    {{-- end footer --}}
    @if ($showComent)
        <div wire:loading.remove wire:target='toggleComent'>
            <div class="border-t-2 border-gray-300 mb-3"></div>
            <div class=" flex items-center
            justify-between
            ">
                <input wire:model='newComent' type="text" placeholder="Tulis Komentar"
                    class=" w-full mr-2 border-blue-400 rounded-lg">
                <i wire:click='addComent({{ $postId }})'
                    class="fa-solid fa-paper-plane cursor-pointer text-blue-700 basis-10 fa-lg"></i>
            </div>
            <div class=" overflow-y-auto overflow-x-hidden p-3 min-h-fit max-h-72">
                @foreach ($coments as $coment)
                    <livewire:coment.coment-card wire:key="comentKey.{{ $coment->id }}" :coment="$coment" />
                @endforeach

                @if ($comentCount > 3)
                    <p wire:click='showMore' class="text-blue-400">Tampilkan lagi</p>
                @endif
            </div>
        </div>
    @endif
</div>
