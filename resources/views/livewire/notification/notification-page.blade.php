<div class="pt-5">

    @foreach ($notifications as $notif)
        <livewire:notification.notification-card :notifications='$notif' />
    @endforeach
</div>
