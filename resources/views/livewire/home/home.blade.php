<div class="mt-3 ">
    <button wire:click='tes'>klik</button>
    @foreach ($posts as $post)
        <livewire:home.card-post :post='$post' wire:key='postId.{{ $post->id }}'>
    @endforeach
    @include('component.home.button-open-modal-create-post')
    @include('component.home.modal-create-post')
    @error('img.*')
        @include('component.home.error-validation-new-post', ['message'])
    @enderror
    @error('caption')
        @include('component.home.error-validation-new-post', ['message'])
    @enderror
</div>
