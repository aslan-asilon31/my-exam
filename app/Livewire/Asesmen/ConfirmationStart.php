<?php

namespace App\Livewire\Asesmen;

use Livewire\Component;
use App\Models\Asesmen;

class ConfirmationStart extends Component
{

    public string $title = 'Confirmation Start '; 

    #[\Livewire\Attributes\Locked]
    public string $id = '';


    public $asesmen =[];
    public $assesmentList = false;
    public $assesmentQuestion = false;
    public $assesmentStarted = false;
    public $assesmentFinished = false;
    public $assesmentTimer;
    public $questionTimer;
    public $questionTimers = [];

    public function mount()
    {

        $this->initialize();
    }

    public function initialize()
    {
        $this->asesmen = Asesmen::where('id', $this->id)->firstOrFail()->toArray();
        // $this->questionTimers = array_column($this->questions, 'timer');
        // $this->asesmens = Asesmen::where('apa_aktif', true)->get();
    }

    
    public function render()
    {

        return view('livewire.asesmen.confirmation-start')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
