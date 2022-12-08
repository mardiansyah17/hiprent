<header class="flex justify-between items-center mb-3">
    <div class="dropdown ">
        <label tabindex="0" class=" m-1 flex items-center">
            @if ($lists == 'friend')
                <h1 class="font-bold text-lg">Teman</h1>
            @endif
            @if ($lists == 'pendingUser')
                <h1 class="font-bold text-lg">Permintaan</h1>
            @endif
            @if ($lists == 'userRecomendation')
                <h1 class="font-bold text-lg">Rekomendasi</h1>
            @endif
            <i class="fa-sharp fa-solid fa-caret-down ml-2"></i>
        </label>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100  w-fit rounded-lg">
            <li wire:click="changeList('friend')" class="border-b-2 rounded-b-none border-gray-200 px-3 mb-3">
                Teman</li>
            <li wire:click="changeList('pendingUser')" class="border-b-2 rounded-b-none border-gray-200 px-3 mb-3">
                Permintaan</li>
            <li wire:click="changeList('userRecomendation')" class="border-b-2 rounded-b-none border-gray-200 px-3">
                Rekomendasi</li>
        </ul>
    </div>
    <div class="">
        @if ($lists == 'friend')
            <input wire:model='searchName' type="text" placeholder="Cari Teman"
                class="rounded-lg border-primary w-48 sm:w-56 lg:w-64">
        @endif
        @if ($lists == 'pendingUser')
            <input wire:model='searchName' type="text" placeholder="Cari Permintaan"
                class="rounded-lg border-primary w-64">
        @endif
        @if ($lists == 'userRecomendation')
            <input wire:model='searchName' type="text" placeholder="Cari Seseorang"
                class="rounded-lg border-primary w-64">
        @endif

        <i class="fa-solid fa-magnifying-glass btn btn-ghost btn-circle text-sm sm:text-lg"></i>
    </div>
</header>
