<div class="flex" x-data>

    <div class="sidebar bg-white basis-4/12 p-5 min-h-screen border-r border-gray-200">
        <h1 class="font-bold text-xl">Teman</h1>
        <input type="text" wire:model='searchName' class="input border-blue-500 w-full h-10 my-5" placeholder="Cari Teman">
        <ul>
            <li class="flex justify-between items-center">
                <a href="/permintaan-teman" class="font-semibold text-lg @if ($url == 'permintaan-teman') text-blue-500 @endif">Permintaan
                    Pertemanan</a>
                {{-- <span class="badge badge-primary badge-outline">200</span> --}}
            </li>
            <li class="flex justify-between items-center">
                <a href="/friend" class="font-semibold text-lg @if ($url == 'friend') text-blue-500 @endif">Semua Teman</a>
                {{-- <span class="badge badge-primary badge-outline">200</span> --}}
            </li>
            <li class="flex justify-between items-center">
                <a href="/saran-teman" class="font-semibold text-lg @if ($url == 'saran-teman') text-blue-500 @endif">Saran Teman</a>
            </li>
        </ul>
    </div>

    <div class="content w-full mt-10">
        <div class="flex  w-full flex-col  items-center">
            @if (count($users) != 0)
            @foreach ($users as $user)
            <livewire:friend.card-friend :name='$user->name' idUser='{{ $user->id }}' wire:key='id.{{ $user->id }}' url="{{ $url }}" jmlTeman="{{ 0 }}" slug="{{ $user->slug }}" />
            @endforeach
            {{-- {{ $data->paginate(2)->links('component.paginate') }} --}}
            @else
            <h1 class="font-semibold text-lg">Tidak ada</h1>
            @endif

        </div>
    </div>
    <!-- The button to open modal -->

</div>