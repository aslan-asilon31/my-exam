<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmationStart extends Component
{

    public string $title = 'Confirmation Start '; 


    public function startExam()
    {
        // Pindah ke komponen Exam
        return redirect()->route('exam');
        $this->dispatch('exam-started'); 
    }
    
    public function render()
    {

        return view('livewire.confirmation-start')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
