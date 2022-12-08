<?php

namespace App\Http\Livewire\Notification;

use Livewire\Component;

class NotificationCard extends Component
{
    public function render()
    {
        return view('livewire.notification.notification-card');
    }
    public $body, $bodyPost, $created_at, $slug, $photo, $gender;

    public function mount($notifications)
    {
        // dd($notifications);
        $this->body = strlen($notifications->body) > 100 ? substr($notifications->body, 0, 90) . '∙∙∙' : $notifications->body;
        $this->created_at = $notifications->created_at;
        $this->slug = $notifications->post->slug;
        $this->photo = $notifications->user->profile_photo_path;
        $this->gender = $notifications->user->gender;
    }
}
