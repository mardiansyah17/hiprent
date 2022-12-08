<div wire:click="$emitTo('chat.chat-page','showConversation',{{ $userId }})"
    class="flex items-center p-3 border-2 border-gray-100 shadow-sm bg-white  btn-ghost">
    <img src="{{ $photo == null ? asset('assets/img/profile-' . $gender . '.jpg') : asset('storage/' . $photo) }}"
        class="w-12 h-12 rounded-full mr-2" alt="">
    <div class="basis-full">
        <h1 class=" font-semibold">{{ $name }}</h1>
        <h5>{{ $lastMessage }}</h5>
    </div>
    <i class="fa-solid fa-ellipsis-vertical mr-5"></i>
</div>
