<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Asesmen;


class Header extends Component
{

    public string $title = ''; 

    public $currentQuestionIndex = 0;
    public $questions = [];
    public $answers = [];
    public $examList = false;
    public $examQuestion = false;
    public $examStarted = false;
    public $examFinished = false;
    public $examTimer = 3600; // 60 minutes in seconds
    public $questionTimer = 10; // 10 seconds per question
    public $questionTimers = [];
    public $asesmenDurasi;

    public $asesmen =[];
    public $assesmentList = false;
    public $assesmentQuestion = false;
    public $assesmentStarted = false;
    public $assesmentFinished = false;

    #[\Livewire\Attributes\Locked]
    public string $id = '';

    public function mount()
    {
        $this->initialize($this->id);
    }


    #[On('asesment-durasi-id')] 
    public function initialize($asesmenId)
    {
        $this->id = $asesmenId;
        $this->asesmen = Asesmen::where('id', $asesmenId)->firstOrFail()->toArray();
        $this->asesmenDurasi = $this->id;
    }

    public function startExam()
    {
        return redirect()->route('exam');
        $this->dispatch('exam-started');
    }
    
    public function render()
    {
        return view('livewire.partials.header')
        ->title($this->title);
    }

}
