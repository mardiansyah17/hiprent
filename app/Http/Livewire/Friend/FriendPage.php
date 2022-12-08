<?php

namespace App\Http\Livewire\Friend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class FriendPage extends Component
{
    use WithPagination;
    protected $listeners = ['terimaTeman', 'hapusTeman', 'tambahTeman'];
    public $data = [], $url, $searchName = '', $lists = 'userRecomendation';
    public function render(Request $request)
    {

        $user = User::with(['teman', 'temanDua', 'pendingTeman'])->get();
        if ($this->lists == 'friend') {
            $result = $user->find(Auth()->id())->allFriend->where('pivot.status', true);
            $users =  collect($result)->filter(function ($val) {
                return stristr($val['name'], $this->searchName);
            });
        }
        if ($this->lists == 'userRecomendation') {
            $result = $user
                ->whereNotIn('id', $user->find(Auth()->id())->allFriend->pluck('id')->merge(auth()->user()->id));
            $users =  collect($result)->filter(function ($val) {
                return stristr($val['name'], $this->searchName);
            });
        }
        if ($this->lists == 'pendingUser') {
            $result = $user->find(Auth()->id())->pendingTeman;
            $users =  collect($result)->filter(function ($val) {
                return stristr($val['name'], $this->searchName);
            });
        }

        return view('livewire.friend.friend-page', [
            'users' => $users
        ]);
    }

    public function changeList($category)
    {
        $this->lists = $category;
    }

    public function addFriend($id)
    {
        $user = User::all();
        // dd($user->find($id)->allFriend);
        $user->find(Auth()->id())->teman()->attach($id);
    }
    public function deleteFriend($id)
    {
        User::find(Auth()->id())->teman()->detach($id);
        User::find(Auth()->id())->temanDua()->detach($id);
    }

    public function accFriend($id)
    {
        // dd(->get());
        DB::table('friend')->where('user_id', $id)->where('friend_id', Auth()->user()->id)->update([
            'status' => true,
        ]);
    }
}
