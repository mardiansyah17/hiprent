<x-guest-layout>
    <x-jet-authentication-card>
        <h1>{{ auth()->user() }}</h1>


        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class=" mt-4 flex">
                <label for="remember_me" class="flex items-center mr-3">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Lupa Password') }}
                </a>
            </div>


            <div class="flex items-center justify-end mt-4">
                {{-- @if (Route::has('password.request'))
                @endif --}}
                <span class="text-sm text-gray-600 hover:text-gray-900">
                    Belum punya akun?
                    <a class="underline " href="/register">
                        {{ __('daftar disini') }}
                    </a>
                </span>

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
