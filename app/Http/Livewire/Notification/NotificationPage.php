<?php

namespace App\Http\Livewire\Notification;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationPage extends Component
{
    protected $listeners = ['refreshNotificationPage' => '$refresh'];


    public function render()
    {
        $notifications = Notification::with(['post', 'user'])->where([['send_to', Auth()->id()], ['send_by', '!=', Auth()->id()]])->get();
        // dd($notifications);
        return view('livewire.notification.notification-page', [
            'notifications' => $notifications
        ]);
    }

    public function mount()
    {
        Notification::where([
            ['send_to', Auth()->id()],
            ['status', 'un_read']
        ])->update(['status' => 'read']);
    }
}
