<?php

namespace App\Http\Livewire\Chat;

use App\Events\MessageCreated;
use App\Models\Conversation;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class ChatPage extends Component
{
    protected function getListeners()
    {
        return [
            'deleteConversation', 'refreshChatPage' => '$refresh', 'showConversation', 'putMessagesToContentChat', 'showConversation', 'updateListConversation'
        ];
    }
    public $proses = [], $queryUser = [], $list = false;
    public function render()
    {

        $this->proses[] = 'di render';
        if (!$this->list) {
            $this->showAllConversation();
        } else {
            $this->showAllFriend();
        }
        return view('livewire.chat.chat-page', [
            'userList' => $this->queryUser
        ]);
    }

    public $searchName = "";
    public function showAllConversation()
    {

        $user = User::with(['conversations1', 'conversations2']);
        $lists = collect($user->find(Auth()->id())->append('conversations')->conversations)->filter(function ($val) {
            return stristr($val['name'], $this->searchName);
        });
        $this->queryUser = $lists->sortByDesc('pivot.updated_at')->values()->all();
    }

    public function toggleList()
    {

        if (!$this->list) {
            $this->list = true;
        } else {
            $this->list = false;
        }
    }
    public function showAllFriend()
    {
        $user = User::with(['teman', 'temanDua', 'conversations1', 'conversations2']);
        $lists = collect($user->find(Auth()->id())->append(['allFriend', 'conversations'])->allFriend)->filter(function ($val) {
            return stristr($val['name'], $this->searchName);
        });
        $this->queryUser = $lists->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->values()->all();
        // '$emit($refresh)';
    }
    public function deleteConversation($conversationId)
    {
        $conversation = Conversation::with('messages')->find($conversationId);
        if ($conversation->deleted_at == 0) {
            $conversation->messages()->update(['deleted_at' => Auth()->id()]);
            $conversation->update(['deleted_at' => Auth()->id()]);
        } else {
            Conversation::with('messages')->find($conversationId)->delete();
        }
        $this->closeAfterDelete($conversationId);
        $this->emitTo('component.nav', 'getMessageCount');
    }

    // content chat

    public   $conversationId, $conversationDeletedAt, $userId, $userName, $photo, $gender, $chats, $message, $user, $showChatSection;

    public function showConversation($userId)
    {
        $conversation = Conversation::with('messages')
            ->where([['user_one', '=', Auth()->id()], ['user_two', '=', $userId]])
            ->orWhere([['user_one', '=', $userId], ['user_two', '=', Auth()->id()]])->first();
        $user = User::find($userId);
        $this->userId = $user->id;
        $this->userName = $user->name;
        $this->photo = $user->profile_photo_path;
        $this->gender = $user->gender;
        $this->showChatSection = true;
        if (!empty($conversation)) {
            if ($conversation->user_one == Auth()->id()) {
                $conversation->update(['unread_one' => 0]);
            }
            if ($conversation->user_two == Auth()->id()) {
                $conversation->update(['unread_two' => 0]);
            }
            $this->emitTo('sidebar.list-user', 'setUnread.' . $conversation->id);
            $this->conversationDeletedAt = $conversation->deleted_at;
            $this->conversationId = $conversation->id;
            $conversation->messages()->where([['status', 'un_read'], ['send_by', '!=', Auth()->id()]])->update(['status' => 'read']);
            $this->chats = $conversation->messages()->with('user')->get()->where('deleted_at', '!=', Auth()->id());
        } else {
            $this->chats = [];
        }
        $this->loading = false;
        $this->emitTo('component.nav', 'getMessageCount');
        $this->emit('scrollContenChat');
    }

    public function closeConversation()
    {
        $this->showChatSection = false;

        $this->userId = null;
        $this->userName = null;
        $this->photo = null;
        $this->gender = null;
        $this->conversationDeletedAt = null;
        $this->conversationId = null;
        $this->chats = [];
    }

    public function putMessages($chat)
    {
        $this->chats =   $this->chats->put($this->chats->count() + 1, $chat);
        $this->emit('scrollContenChat');
    }

    public function sendChat()
    {

        $this->validate([
            'message' => 'required'
        ]);
        $chat = null;
        if (empty($this->conversationId)) {

            $conversationCreate =   Conversation::with('messages')->create(['user_one' => Auth()->id(), 'user_two' => $this->userId, 'deleted_at' => 0, 'last_message' => $this->message]);

            $newChat = $conversationCreate->messages()->create(['body' => $this->message, 'send_by' => Auth()->id(), 'send_to' => $this->userId]);

            if ($conversationCreate->user_one == $newChat->send_to) {
                $conversationCreate->update(['unread_one' => $conversationCreate->unread_one += 1]);
            }
            if ($conversationCreate->user_two == $newChat->send_to) {
                $conversationCreate->update(['unread_two' => $conversationCreate->unread_two += 1]);
            }

            // load ulang conversation list

            $this->message = '';
            $chat = $newChat;
            $this->chats = $conversationCreate->messages;
        } else {

            $conversation =   Conversation::with('messages')->find($this->conversationId);

            if ($this->conversationDeletedAt == Auth()->id()) {
                $conversation->update(['deleted_at' => 0]);
            }


            $newChat = $conversation->messages()->create(['conversation_id' => $this->conversationId, 'send_by' => Auth()->id(), 'body' => $this->message, 'send_to' => $this->userId]);
            $conversation->update(['last_message' => $this->message]);

            if ($conversation->user_one == $newChat->send_to) {
                $conversation->update(['unread_one' => $conversation->unread_one += 1]);
            }
            if ($conversation->user_two == $newChat->send_to) {
                $conversation->update(['unread_two' => $conversation->unread_two += 1]);
            }
            $this->emit('setLastMessageConversation.' . $this->conversationId, $this->message);
            $chat = $newChat;
            $this->message = '';
            $this->putMessages($newChat);
        }
        $this->emitTo('chat.component.list-user-side-bar-chat-page', 'setLastMessage.' . $chat->conversation_id, $chat);
        MessageCreated::dispatch($chat, $chat->send_to);
        $this->showAllConversation();
    }


    public function putMessagesToContentChat($data)
    {
        if ($this->conversationId == $data['conversation_id']) {
            $message =      Messages::find($data['id']);
            $this->putMessages($message);
        }
    }

    public function updateListConversation($data)
    {
        // dd($data['conversation_id']);
        if (!$this->list) {
            $conversation = collect($this->queryUser)->pluck('pivot');
            $resConversation =   $conversation->where('id', $data['conversation_id']);
            if ($resConversation->isEmpty()) {
                $this->showAllConversation();
            } else {
                $this->emit('setLastMessageConversation.' . $data['conversation_id'], $data['body']);
                if ($this->showChatSection && $this->conversationId === $data['conversation_id']) {
                    $this->putMessagesToContentChat($data);
                }
            }
        }
        // if($this->showChatSection){
        //     $this->emitTo('')
        // }
    }
}
