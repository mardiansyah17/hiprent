<div>
    <div class="border-t-2 border-gray-300 mb-3"></div>
    <div class="">
        <input wire:model='coment' type="text" placeholder="Tulis Komentar" class="w-3/4 border-blue-400 rounded-lg">
        <i wire:click='addComent({{ $postId }})' class="fa-solid fa-paper-plane cursor-pointer text-blue-700"></i>
    </div>
    <div class="p-2">
        <div class="dropdown">
            <label tabindex="0" class="mr-1">filter</label>
            <i class="fa-solid fa-caret-down"></i>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                <li><a>Item 1</a></li>
                <li><a>Item 2</a></li>
            </ul>
        </div>
    </div>
    <div class="">
        @foreach ($coments as $coment)
            <livewire:coment.coment-card :coment='$coment->id' :name='$coment->user->name' :userId='$coment->user->id' :comentId='$coment->id'>
        @endforeach
        @if ($coments->count() > 3)
            <p wire:click='showMore' class="text-blue-400">Tampilkan lagi</p>
        @endif
    </div>
</div>
