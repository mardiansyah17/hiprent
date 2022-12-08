<div class="p-4 ">
    @include('livewire.friend.component.header')

    <div class="w-full sm:w-4/5 mx-auto lg:w-4/6">
        @foreach ($users as $user)
            @include('livewire.friend.component.card-user', [
                'id' => $user->id,
                'name' => $user->name,
                'slug' => $user->slug,
                'photo' => $user->profile_photo_path,
                'gender' => $user->gender,
            ])
        @endforeach
    </div>
</div>
