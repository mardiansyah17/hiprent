<div class=" flex overflow-y-hidden h-full">
    @slot('style', 'h-screen')

    <div
        class="bg-white flex flex-col w-full lg:w-3/12 sm:w-2/5  @if ($showChatSection) hidden sm:block @endif">
        @include('livewire.chat.component.side-bar')
    </div>
    <div class=" flex-auto ">
        @if ($showChatSection)
            @if ($loading)
                <h1>lagi loading</h1>
            @else
                @include('livewire.chat.component.chat-section')
            @endif
        @endif

    </div>
</div>
