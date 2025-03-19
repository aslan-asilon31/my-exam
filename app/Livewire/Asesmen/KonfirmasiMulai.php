<?php

namespace App\Livewire\Asesmen;

use Livewire\Component;
use App\Models\Asesmen;
use Livewire\Attributes\On;


class KonfirmasiMulai extends Component
{

    public string $title = 'Confirmation Start '; 

    #[\Livewire\Attributes\Locked]
    public string $id = '';


    public $asesmen =[];
    public $assesmentList = false;
    public $assesmentQuestion = false;
    public $assesmentStarted = false;
    public $assesmentFinished = false;
    public $asesmenDurasi;
    public $questionTimer;
    public $questionTimers = [];

    public function mount()
    {

        $this->initialize($this->id);
    }

    #[On('asesment-durasi-id')] 
    public function initialize($asesmenId)
    {
        $this->id = $asesmenId;
        $this->asesmen = Asesmen::where('id', $this->id)->firstOrFail()->toArray();
        $this->asesmenDurasi = $this->id;

        // $this->questionTimers = array_column($this->questions, 'timer');
        // $this->asesmens = Asesmen::where('apa_aktif', true)->get();
    }

    
    public function render()
    {

        return view('livewire.asesmen.konfirmasi-mulai')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
