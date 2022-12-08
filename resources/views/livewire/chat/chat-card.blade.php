<div class="flex @if ($sendByUser != false) flex-row-reverse @endif  mt-2 ">
    <div class="flex-none @if ($sendByUser != false) ml-5 @endif">
        <a href="# ">
            <img src="{{ $profile_photo_path == null ? asset('assets/img/profile-' . $gender . '.jpg') : asset('storage/' . $post->user->profile_photo_path) }}"
                alt="avatar" class="w-10 h-10 rounded-full" />
        </a>
    </div>
    <div
        class="ml-5 px-4 py-2  @if ($sendByUser != false) bg-blue-500 text-white @else bg-white text-black @endif  shadow-lg border border-gray-200 rounded ">

        <div>
            {{ $body }}
        </div>
    </div>
</div>
