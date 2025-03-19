<?php

namespace App\Livewire\Asesmen;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On; 
use Mary\Traits\Toast;
use App\Models\Pertanyaan;


class SoalAsesmen extends Component
{
    use Toast;
    public string $title = 'Ujian '; 

    public $currentQuestionIndex = 0;
    public $questions = [];
    public $answers = [];
    public $pertanyaans = [];
    public $examList = false;
    public $examQuestion = false;
    public $examStarted = false;
    public $examFinished = false;
    public $examTimer = 3600; // 60 minutes in seconds
    public $questionTimer = 10; // 10 seconds per question
    public $questionTimers = [];

    #[\Livewire\Attributes\Locked]
    public string $id = '';

    public function mount()
    {
        
        $this->initialize();
        $this->questionTimers = array_column($this->questions, 'timer');

        // // Initialize answers array
        // $this->answers = array_fill(0, count($this->questions), '');

        // // Initialize question timers
        // $this->questionTimers = array_fill(0, count($this->questions), $this->questionTimer);
    }

    public function initialize()
    {

        $this->pertanyaans = Pertanyaan::where('asesmen_id', $this->id)->get();
    }

    public function confirmStartTest()
    {
        $this->testList = false;
        $this->testQuestion = false;
        $this->testStarted = true;
        $this->testFinished = false;
        $this->testTimer = 3600; 

        $this->startTest();
    }

    public function startTest()
    {

        $this->testTimer = 3600; 
        $this->testStarted = false;
        $this->testQuestion = true;
        $this->testList = false;
        $this->currentQuestionIndex = 0;
        $this->testFinished = false;
        $this->questionTimers[$this->currentQuestionIndex] = $this->questionTimer;
        $this->dispatch('start-timers');
    }



    public function examNow()
    {

        $this->testStarted = false;
        $this->testQuestion = true;
        $this->testList = false;
        $this->testFinished = false;
        // Start the exam timer
        $this->testTimer = 3600; // Reset to 60 minutes

        // Start the question timer
        $this->questionTimers[$this->currentQuestionIndex] = $this->questionTimer;

        // Use JavaScript to update timers
        $this->dispatch('start-timers');
        return;
    }

    public function nextQuestion()
    {
        // Cek apakah ada jawaban untuk soal saat ini
        if (empty($this->answers[$this->currentQuestionIndex])) {
            $this->toast(
                type: 'error',
                title: 'Failed',
                description: "Silakan isi jawaban sebelum melanjutkan ke soal berikutnya",               
                position: 'toast-top toast-end',    
                icon: 'o-information-circle',      
                css: 'alert-info',                  
                timeout: 3000,                      
                redirectTo: null                    
            );
            Session::flash('status', 'Silakan isi jawaban sebelum melanjutkan ke soal berikutnya');

            // Jika tidak ada jawaban, Anda bisa memberikan notifikasi atau pesan
            return; // Hentikan eksekusi jika tidak ada jawaban
        }

        // Logika untuk berpindah ke soal berikutnya
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
            $this->currentQuestionTime = $this->questions[$this->currentQuestionIndex]['timer'];

            $this->dispatch('exam-next-question');

        } else {
            // Logika jika sudah mencapai akhir soal
            $this->finishTest();

        }

    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function finishTest()
    {
        $this->testFinished = true;
        $this->testStarted = false;
    }

    public function render()
    {
        return view('livewire.asesmen.halaman-soal-asesmen')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
