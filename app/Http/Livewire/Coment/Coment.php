<?php

namespace App\Http\Livewire\Coment;

use App\Models\Coment as ModelsComent;
use Livewire\Component;

class Coment extends Component
{
    protected $listeners = ['refreshComent' => '$refresh'];
    public function render()
    {
        $coments =  ModelsComent::find($this->postId);
        dd($coments);
        return view('livewire.coment.coment', [
            'coments' => $coments,
        ]);
    }
    public  $postId;

    public function mount($postId)
    {
        // dd($comentPost);
    }
    public $limitComent = 3;
    public function showMore()
    {
        $this->limitComent += 3;
    }
}
