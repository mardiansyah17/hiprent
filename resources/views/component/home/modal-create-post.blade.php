<input type="checkbox" id="modal-create-posting" class="modal-toggle" />
<label for="modal-create-posting" class="modal cursor-pointer">
    <label class="modal-box relative" for="">
        <div class="">
            <h1 class="text-center font-bold text-xl">Buat Postingan</h1>
            <header class="flex items-center mb-3">
                <img src="{{ asset('assets/img/profile-male.jpg') }}" class="w-10 h-10 rounded-full " alt="">
                <span class="text-lg ml-3">Muhammad Mardiansyah</span>
            </header>

            <div class="flex items-center space-x-3">
                <label for="photo-input">
                    <i class="fa-regular fa-image fa-lg"></i>
                </label>
                <div x-data="{ open: false, text: 'Dilihat oleh publik', privacy: @entangle('privacy') }" class="flex">
                    <button @click="open = true" x-text="text"></button>

                    <ul class="ml-4 bg-white shadow-lg rounded-lg top-0 left-16 border border-gray-200 p-3"
                        x-show="open" @click.outside="open = false">
                        <li @click="open =false,text='Dilihat oleh publik',privacy='public'">
                            <i class="fa-solid fa-earth-asia"></i>
                            <span>Publik</span>
                        </li>
                        <li @click="open =false,text='Dilihat oleh teman',privacy='friend'">
                            <i class="fa-regular fa-user"></i>
                            <span>Hanya teman</span>
                        </li>
                        <li @click="open =false,text='Dilihat oleh diri sendiri',privacy='private'">
                            <i class="fa-solid fa-lock"></i>
                            <span>Diri sendiri</span>
                        </li>
                    </ul>
                </div>
            </div>

            <input type="file" wire:model="img" multiple id="photo-input" accept="image/*" class="hidden">
            <input type="hidden" wire:model="privacy" x-text="privacy">
            <textarea wire:model="caption" style="resize:none" placeholder="Caption" class="w-full border-primary rounded-lg  mb-3"></textarea>

            @if ($img)
                <div class="flex px-3 space-x-6 w-full overflow-x-auto mb-3">
                    @for ($i = 0; $i < count($img); $i++)
                        <div class="relative max-w-1/2">
                            <img src="{{ $img[$i]->temporaryUrl() }}" class="w-full" alt="">
                            <i wire:click="deleteOnePhoto({{ $i }})"
                                class="btn btn-ghost btn-circle btn-lg fa-solid fa-trash absolute top-1 right-1"></i>
                        </div>
                    @endfor

                </div>
            @endif

            <div class="modal-action">

                <label class="btn btn-primary " wire:click="post" wire:loading.attr="disabled"
                    wire:target='img'>Posting</label>
            </div>
            </form>
        </div>
    </label>
</label>
