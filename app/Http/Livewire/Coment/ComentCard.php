<?php

namespace App\Http\Livewire\Coment;

use App\Models\Coment;
use Livewire\Component;

class ComentCard extends Component
{
    public function render()
    {
        return view('livewire.coment.coment-card');
    }

    public $coment;
    public function mount($coment)
    {
        // dd($coment);
    }

    public function deleteComent($idComent)
    {
        $coment =  Coment::where('id', $idComent)->get()->first();
        $coment->delete();
        $coment->post()->update(['coment_count' => $coment->count()]);
        $this->emit('refreshCardPost');
    }

    // method untuk menampilkan input edit komentar'
    public $showEditComent;
    public function toggleEditComent()
    {
        if ($this->showEditComent) {
            $this->showEditComent = false;
        } else {
            $this->showEditComent = true;
        }
    }

    // method untuk update komentar

    public function updateComent()
    {

        $this->validate([
            'coment' => 'required',
        ]);
        Coment::find($this->comentId)->update(['coment' => $this->coment]);
        $this->showEditComent = false;
    }
}
