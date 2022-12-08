<?php

namespace App\Http\Livewire\Component;

use App\Models\Conversation;
use App\Models\Messages;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Nav extends Component
{
    protected function getListeners()
    {
        return [
            "echo-private:userChatTo." . Auth()->id() . ",MessageCreated" => 'receiveMessageOnChatPage'
        ];
    }

    public $newMessageCount = 0, $urlName, $newNotificationsCount = 0;
    public function render()
    {

        return view('livewire.component.nav');
    }

    public function mount()
    {
        $this->urlName = Route::current()->getName();
        $this->getMessageCount();
        $this->getNotificationsCount();
    }

    public function receiveMessageOnChatPage($data)
    {
        $this->newMessageCount++;
        $this->emitTo('chat.chat-page', 'updateListConversation', $data['data']);
    }

    public function receiveNotification()
    {
        if ($this->urlName != 'notification') {
            $this->getNotificationsCount();
        }
        $this->emitTo('notification.notification-page', 'refreshNotificationPage');
    }

    public function getMessageCount()
    {

        $messages = Messages::with('conversation')
            ->where([
                ['send_to', Auth()->id()],
                ['status', 'un_read'],
                ['deleted_at', '!=', Auth()->id()]
            ])->get();
        // dd($messages);
        $this->newMessageCount = $messages->count();
    }

    public function getNotificationsCount()
    {
        $notifications = Notification::with('post')
            ->where([
                ['send_by', '!=', Auth()->id()],
                ['send_to', Auth()->id()],
                ['status', 'un_read']
            ])
            ->get();
        // dd($notifications);
        $this->newNotificationsCount = $notifications->count();
    }
}
