<?php

namespace App\Livewire\Asesmen;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Mary\Traits\Toast;
use App\Models\Asesmen;



class AsesmenList extends Component
{
    use Toast;

    public string $title = 'Assesment List '; 
    public $currentQuestionIndex = 0;
    public $questions = [];
    public $asesmens = [];
    public $answers = [];
    public $examList = false;
    public $examQuestion = false;
    public $examStarted = false;
    public $examFinished = false;
    public $examTimer = 3600; // 60 minutes in seconds
    public $questionTimer = 10; // 10 seconds per question
    public $questionTimers = [];


    #[\Livewire\Attributes\Locked]
    public string $id = '';


    public function startTest()
    {
        // Pindah ke komponen Test
        return redirect()->route('Test');
        $this->dispatch('test-started'); 
    }

    public function mount()
    {

        $this->initialize();
    }

    public function initialize()
    {

        $this->asesmens = Asesmen::where('apa_aktif', true)->get();
    }

    
    public function render()
    {
        return view('livewire.asesmen.asesmen-list')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
