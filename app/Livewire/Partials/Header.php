<?php

namespace App\Livewire\Partials;

use Livewire\Component;

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


    public function mount()
    {
        $this->examTimer = 3600; 
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
