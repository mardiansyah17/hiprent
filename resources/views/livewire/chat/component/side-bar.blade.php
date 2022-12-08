<div class="flex justify-between items-center px-4 py-2">
    <input type="text" placeholder="Cari Percakapan" class="rounded-lg border-primary ">
    @if (!$list)
        <i wire:click='toggleList' class="fa fa-plus fa-lg btn btn-ghost btn-circle"></i>
    @else
        <i wire:click='toggleList' class="fa fa-xmark fa-lg btn btn-ghost btn-circle"></i>
    @endif
</div>
<div class="overflow-y-auto w-full">
    @if (!$list)
        @foreach ($userList as $user)
            <livewire:chat.component.list-user-side-bar-chat-page wire:key='userListId.{{ $user->id }}'
                :user='$user'>
        @endforeach
    @else
        @foreach ($userList as $user)
            {{-- <h1>wkwk</h1> --}}
            <livewire:chat.component.list-friend wire:key='userListId.{{ $user->id }}' :user='$user' />
        @endforeach
    @endif

</div>
