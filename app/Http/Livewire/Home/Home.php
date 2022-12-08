<?php

namespace App\Http\Livewire\Home;

use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;


class Home extends Component
{
    use WithFileUploads;
    protected $listeners = ['refreshHome' => '$refresh'];
    public function render()
    {
        $post = Post::with(['user', 'photos', 'likes'])->get();
        // dd($post->likes->where('user_id', 49));
        $userPost = $post->whereIn('user_id', auth()->user()->allFriend->pluck('id'));
        $allPost = $userPost->merge($post->where('user_id', Auth()->id()))->sortByDesc('created_at');
        // dd($allPost->first());
        return view('livewire.home.home', [
            'posts' => $allPost,
        ]);
    }
    public $caption, $proses = [], $img = [], $privacy = "public";

    public function tes()
    {
    }

    public function updatingImg($val)
    {
        // dd($val);
        $this->validate([
            'img.*' => ['image', 'mimes:png,jpg']
        ]);
    }

    public function post(Request $request)
    {
        // ddd()
        $this->validate(
            [
                'caption' => 'required_without:img',
                'img.*' => 'image|mimes:png,jpg',
            ],
            [
                'caption.required_without' => 'Caption tidak boleh kosong jika tidak ada gambar',
                'img.*.mimes' => 'Format gambar hanya boleh png atau jpg',
                'img.*.image' => 'Hanya boleh gambar'
            ]
        );

        $slug = SlugService::createSlug(Post::class, 'slug', uniqid());
        $post = Post::create(['slug' => $slug, 'user_id' => Auth()->id(), 'caption' => $this->caption, 'privacy' => $this->privacy]);
        if ($this->img != null) {

            $imgUrl = [];
            foreach ($this->img as $i => $photo) {
                array_push($imgUrl, [
                    'url_photo' => $photo->store('post-photo'),
                    'post_id' => $post->id,
                    'user_id' => Auth()->id()
                ]);
                $post->photos()->create($imgUrl[$i]);
            }
        }
        $this->emit('closeModalCreatPost');
        $this->caption = '';
        $this->img = null;
    }

    public function cancelUploadPhoto()
    {
        // dd($this->img);
        $this->img = null;
    }

    public function deleteOnePhoto($index)
    {

        unset($this->img[$index]);
        $this->img = collect($this->img)->values()->all();
    }


    public $count = 0;

    public function increment()
    {
        $this->count++;
    }
    public function decrement()
    {
        $this->count--;
    }
}
