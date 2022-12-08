<div class="flex justify-between items-center bg-white shadow-xl px-4 w-2/3 py-2 rounded-lg mb-4">
    <div class="flex items-center">
        <a href="/profile/{{ $slug }}">
            <img src="{{ auth()->user()->profile_photo_path == null ? asset('assets/img/profile-' . auth()->user()->gender . '.jpg') : asset('storage/' . auth()->user()->profile_photo_path) }}"
                class="w-20 rounded-full mr-3" alt="">
        </a>
        <div class="">
            <a href="/profile/{{ $slug }}">

                <h1>{{ $name }}</h1>
            </a>
            {{-- <h5>{{ $jmlTeman }} teman yang sama</h5> --}}
        </div>
    </div>
    @switch($url)
        @case('friend')
            <button x-data="{ text: 'Hapus Teman' }" @click="text = 'Dihapus'" class="text-lg bg-primary px-2 py-1 rounded-lg text-white"
                wire:click="$emit('hapusTeman',{{ $idUser }})"x-text="text"></button>
        @break

        @case('saran-teman')
            <button x-data="{ text: 'Tamabah Teman' }" @click="text = 'Permintaa dikirim'"
                class="text-lg bg-primary px-2 py-1 rounded-lg text-white"
                wire:click="$emit('tambahTeman',{{ $idUser }})"x-text="text"></button>
        @break

        @case('permintaan-teman')
            <button x-data="{ text: 'Terima Teman' }" @click="text = 'Diterima'"
                class="text-lg bg-primary px-2 py-1 rounded-lg text-white"
                wire:click="$emit('terimaTeman',{{ $idUser }})"x-text="text"></button>
        @break

        @default
    @endswitch

</div>
