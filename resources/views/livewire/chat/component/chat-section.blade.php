<div class=" flex-1 flex justify-between flex-col h-full">
    <header class="w-full px-3 space-x-2 h-14 py-3 flex items-center bg-white border-b-2 border-gray-200 shadow-sm">
        <i wire:click='closeConversation' class="fa-solid fa-arrow-left fa-lg  btn btn-ghost btn-circle"></i>
        <img src="{{ $photo == null ? asset('assets/img/profile-' . $gender . '.jpg') : asset('storage/' . $photo) }}"
            alt="avatar" class="w-10 h-10 rounded-full" />
        <span id="btn">{{ $userName }}</span>
    </header>

    <div class="bg-gray-750 flex-1 flex flex-col h-5/6 justify-between font-chat text-gray-200">

        <div class="text-sm text-gray-400   overflow-y-auto" id="contentChat">
            @if ($chats)

                @foreach ($chats as $chat)
                    <livewire:chat.chat-card wire:key="{{ $chat['id'] }}" :chat="$chat" />
                @endforeach
            @endif
        </div>

        <form action="" wire:submit.prevent='sendChat'>
            <div class=" h-24 flex items-center pb-5 mx-3 ">
                <button class="px-2 py-2 h-10  text-blue-500">
                    <i class="fa-solid fa-face-smile"></i>
                </button>

                <div class="flex-1">
                    <input wire:model='message' type="text" placeholder="Kirim pesan"
                        class="w-full border-blue-400 rounded-lg text-black" autofocus>
                </div>

                <div class="px-2 py-2  rounded-r flex items-center h-10">
                    {{-- @if ($message > 0) --}}
                    <button type="submit" class="h-10  rounded-l text-blue-500">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                    {{-- @endif --}}

                    {{-- <button class="h-10  rounded-l text-blue-500  ml-3">
                        <i class="fa-solid fa-microphone"></i>
                    </button> --}}
                </div>
            </div>
        </form>
    </div>
</div>
