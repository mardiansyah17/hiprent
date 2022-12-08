<x-jet-form-section submit="updateProfileInformation">


    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-full">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />
                {{-- {{ dd($this->user->profile_photo_path === 'NULL') }} --}}
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    @if ($this->user->profile_photo_path === null)
                        @if ($this->user->gender == 'Laki - Laki')
                            <img src="{{ asset('assets/img/profile-male.jpg') }}" alt="{{ $this->user->name }}"
                                class="rounded-full h-20 w-20 object-cover">
                        @else
                            <img src="{{ asset('assets/img/profile-female.jpg') }}" alt="{{ $this->user->name }}"
                                class="rounded-full h-20 w-20 object-cover">
                        @endif
                    @else
                        <img src="{{ asset('storage/' . $this->user->profile_photo_path) }}"
                            alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                    @endif
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block  rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Email -->
        <div class="">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        {{-- birth day --}}
        <div class="">
            <x-jet-label for="date_of_birth" value="{{ __('Tanggal Lahir') }}" />
            <x-jet-input id="date_of_birth" type="date" class="mt-1 block w-full"
                wire:model.defer="state.date_of_birth" autocomplete="date_of_birth" />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>

        <!--Full Name -->
        <div class="">
            <x-jet-label for="name" value="{{ __('Nama Depan') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        {{-- stay in --}}
        <div class="">
            <x-jet-label for="stay_in" value="{{ __('Tempat tinggal') }}" />
            <x-jet-input id="stay_in" type="text" class="mt-1 block w-full" wire:model.defer="state.stay_in"
                autocomplete="stay_in" />
            <x-jet-input-error for="stay_in" class="mt-2" />
        </div>

        {{-- Gender --}}
        <div class="">
            {{-- <h1 wire:model.defer="state.gender" autocomplete="gender"></h1> --}}
            <x-jet-label for="gender" value="{{ __('Jenis Kelamin') }}" />
            <select id="gender" class="mt-1 block w-full" wire:model.defer="state.gender" autocomplete="gender">
                <option selected>Jenis Kelamin</option>
                <option value="male">Laki - Laki</option>
                <option value="female">Perempuan</option>
            </select>
            <x-jet-input-error for="gender" class="mt-2" />
        </div>

        {{-- Job --}}
        <div class="">
            <x-jet-label for="job" value="{{ __('Pekerjaan') }}" />
            <x-jet-input id="job" type="text" class="mt-1 block w-full" wire:model.defer="state.job"
                autocomplete="job" />
            <x-jet-input-error for="job" class="mt-2" />
        </div>

        {{-- Relationship --}}
        <div class="">
            <x-jet-label for="relationship" value="{{ __('Status Hubungan') }}" />
            <select id="relationship" class="mt-1 block w-full" wire:model.defer="state.relationship"
                autocomplete="relationship">
                <option value="">Status Hubungan</option>
                <option value="Jomblo">Jomblo</option>
                <option value="Berpacaran">Berpacaran</option>
                <option value="Menikah">Menikah</option>
            </select>
            <x-jet-input-error for="relationship" class="mt-2" />
        </div>

        {{-- bio --}}
        <div class="">
            <x-jet-label for="bio" value="{{ __('Bio') }}" />
            <textarea id="bio"
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm min-h-full max-h-20"
                wire:model.defer="state.bio" autocomplete="bio" cols="60" rows="10"></textarea>
            <x-jet-input-error for="bio" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
