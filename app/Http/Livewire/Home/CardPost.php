<?php

namespace App\Http\Livewire\Home;

use App\Events\PostNotification;
use App\Models\Coment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class CardPost extends Component
{
    protected $listeners = ['refresh' => '$refresh', 'refreshCardPost' => '$refresh', 'toggleEditComent'];
    public function render()
    {
        if ($this->showComent) {
            $coments =   Coment::with(['post', 'user'])->where('post_id', $this->post->id)->latest()->paginate($this->limitComent);
        }

        return view('livewire.home.card-post', [
            'coments' => $this->showComent ? $coments : [],
        ]);
    }

    public $caption,  $showComent = false, $edit = false,  $limitComent = 3, $post, $comentCount, $isLike, $likeCount, $postPhotos, $profile_photo_path, $userGender, $userSlug, $userName, $userId, $postId, $created_at;

    public function mount($post)
    {
        // dd($post->likes);
        $this->caption = $post->caption;
        $this->postId = $post->id;
        $this->created_at = $post->created_at;
        $this->isLike = $post->likes->where('user_id', Auth()->id())->count() != 0 ? true : false;
        $this->urlPhotos = [];
        $this->likeCount = $post->like_count;
        $this->comentCount = $post->coment_count;
        $this->postPhotos = $post->photos;
        $this->profile_photo_path = $post->user->profile_photo_path;
        $this->userGender = $post->user->gender;
        $this->userName = $post->user->name;
        $this->userId = $post->user->id;
    }

    public function deletePost($idPost)
    {
        $post = Post::with('photos')->find($idPost);
        if ($post->photos->count() != 0) {
            foreach ($post->photos->pluck('url_photo') as $item) {
                Storage::delete($item);
            }
            $post->photos()->delete();
        }
        $this->comentCount = null;
        $this->post = null;

        $post->delete();
        $this->emit('refreshHome');
        // dd($post);
    }

    public function setLike($postId)
    {
        $post = Post::with(['likes', 'notifications'])->find($postId);

        // die;
        // dd($post->notifications);
        if ($this->isLike) {
            $post->likes()->where('user_id', Auth()->id())->delete();
            $post->update(['like_count' => $post->like_count -= 1]);
            $post->notifications()->where('send_by', Auth()->id())->delete();
            $this->isLike = false;
            $this->likeCount = $post->like_count;
            // PostNotification::dispatch($post->user_id, $post);
        } else {
            $post->likes()->create(['user_id' => Auth()->id()]);
            $newNotif =     $post->notifications()->create(['send_by' => Auth()->id(), 'send_to' => $post->user_id, 'body' => auth()->user()->name . ' menyukai postingan ' . $post->caption]);
            $post->update(['like_count' => $post->like_count += 1]);
            $this->isLike = true;
            $this->likeCount = $post->like_count;
        }
        PostNotification::dispatch($post->user_id);
    }
    public function toggleComent()
    {
        // dd('halo');
        if ($this->showComent) {
            $this->showComent = false;
        } else {
            // $this
            $this->showComent = true;
        }
    }
    public function showMore()
    {
        $this->limitComent += 3;
    }
    public function showEdit()
    {
        if ($this->edit) {
            $this->edit = false;
        } else {
            $this->edit = true;
            $this->caption = str($this->caption)->replace('<br>', "\n");
        }
    }
    public function editPost($idPost)
    {
        // dd($this->caption);
        Post::where('id', $idPost)->update(['caption' => $this->caption]);
        $this->edit = false;
        '$emit($refresh)';
    }

    public $newComent;
    public function addComent($postId)
    {
        $this->validate([
            'newComent' => 'required',
        ]);
        $post = Post::with(['coments', 'notifications'])->find($postId);

        $post->coments()->create([
            'coment' => $this->newComent,
            'user_id' => Auth()->id(),
        ]);
        $post->notifications()->create(['send_by' => Auth()->id(), 'send_to' => $post->user_id, 'body' => auth()->user()->name . ' mengomentari postingan ' . $post->caption]);
        $post->update([['coment_count' => $post->coment_count += 1]]);
        $this->comentCount = $post->coment_count;
        $this->newComent = '';
        PostNotification::dispatch($post->user_id);
    }
}
