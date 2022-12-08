<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfilePage extends Component
{
    public function render()
    {
        $user = User::with('posts')->where('slug', $this->slug)->first();

        // dd($user->allFriend->find(2) == null);
        if ($user->id != Auth()->id()) {
            if ($user->allFriend->find(Auth()->id()) != null) {
                $posts = $user->posts->whereIn('privacy', ['public', 'friend'])->values()->all();
            } else {
                $posts = $user->posts->whereIn('privacy', ['public'])->values()->all();
            }
        } else {
            $posts = $user->posts;
        }
        // $post = Post::with('user')->where('privacy', 'public')->orWhere('privacy', 'friend')->get();
        // dd($post);
        return view('livewire.user.user-profile-page', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public $slug, $editMode = false, $stayIn = null, $date = null, $gender = null, $relationship = null;

    public function mount($slug)
    {
        // dd($slug);
        $this->slug = $slug;
    }

    public function toggleEditMode()
    {
        if ($this->editMode) {
            $this->editMode = false;
        } else {
            $this->editMode = true;
        }
    }

    public function editStayIn()
    {
        if ($this->stayIn != null) {
            $this->stayIn = null;
        } else {
            $this->stayIn = true;
        }
    }
    public function toggleDate()
    {
        if ($this->date != null) {
            $this->date = null;
        } else {
            $this->date = true;
        }
    }
}
