<a href="/profile/{{ $slug }}"
    class="border border-gray-100 shadow-lg mb-3 bg-white rounded-lg flex items-center p-3 px-4">
    <img src="{{ $photo == null ? asset('assets/img/profile-' . $gender . '.jpg') : asset('storage/' . $photo) }}"
        class="w-12 h-12 rounded-full mr-3" alt="">
    <h1 class="font-semibold basis-full">{{ $name }}</h1>
    @if ($lists == 'friend')
        <i wire:click='deleteFriend({{ $id }})' class="fa-solid fa-user-minus btn btn-ghost btn-circle"></i>
    @endif
    @if ($lists == 'pendingUser')
        <i wire:click='accFriend({{ $id }})' class="fa-solid fa-user-check btn btn-ghost btn-circle"></i>
    @endif
    @if ($lists == 'userRecomendation')
        <i wire:click.prevent='addFriend({{ $id }})'
            class="fa-solid fa-user-plus btn btn-ghost btn-circle"></i>
    @endif
</a>
