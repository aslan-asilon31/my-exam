<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

class Exam extends Component
{
    public string $title = 'Ujian '; 

    public $timer;
    public $questions;
    public $currentQuestionIndex = 0;
    public $answers = [];
    public $remainingTime = 3600; // 60 menit dalam detik
    public $questionTime; // Durasi per soal
    public $currentQuestionTime; // Waktu tersisa untuk soal saat ini


    protected $listeners = ['timerFinished','exam-started'];

    public function timerFinished($remainingTime)
    {
        // Logika ketika timer selesai
        // Anda bisa melakukan sesuatu dengan $remainingTime jika perlu
        // Misalnya, menyimpan data atau mengarahkan pengguna
        session()->flash('message', 'Timer selesai!');
    }

    public function mount()
    {
        // Data dummy untuk pertanyaan dengan durasi yang berbeda
        $this->questions = [
            [
                'question' => 'Apa itu Livewire?',
                'answer' => '',
                'duration' => 30 // Durasi 30 detik
            ],
            [
                'question' => 'Jelaskan konsep MVC!',
                'answer' => '',
                'duration' => 20 // Durasi 20 detik
            ],
            [
                'question' => 'Apa itu Tailwind CSS?',
                'answer' => '',
                'duration' => 25 // Durasi 25 detik
            ],
        ];

        // Inisialisasi waktu untuk soal pertama
        $this->currentQuestionTime = $this->questions[$this->currentQuestionIndex]['duration'];
    }



    #[On('exam-started')] 
    public function startTimer()
    {
        $this->dispatch('exam-starting', ['remainingTime' => $this->remainingTime]);

        
        // Timer untuk soal
        $this->startQuestionTimer();
    }

    public function startQuestionTimer()
    {
        $this->currentQuestionTime = $this->questions[$this->currentQuestionIndex]['duration'];
        
        $this->dispatchBrowserEvent('start-question-timer', ['duration' => $this->currentQuestionTime]);
        
        // Timer untuk soal
        $this->timer = setInterval(function () {
            if ($this->currentQuestionTime > 0) {
                $this->currentQuestionTime--;
            } else {
                // Logika ketika waktu soal habis
                $this->nextQuestion();
            }
        }, 1000);
    }

    #[On('exam-next-question')]
    public function nextQuestion()
    {
        // Simpan jawaban untuk soal saat ini
        $this->answers[$this->currentQuestionIndex] = $this->questions[$this->currentQuestionIndex]['answer'];

        // Pindah ke soal berikutnya
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
            $this->currentQuestionTime = $this->questions[$this->currentQuestionIndex]['duration'];
            $this->startQuestionTimer(); // Mulai timer untuk soal baru
            $this->dispatch('exam-next-question');
        } else {
            // Jika sudah tidak ada soal lagi, akhiri ujian
            $this->endExam();
        }
        
    }

    public function endExam()
    {
        // Logika untuk mengakhiri ujian
        // Misalnya, simpan jawaban dan tampilkan hasil
        clearInterval($this->timer);
        // Tindakan lain setelah ujian selesai
    }

    public function render()
    {

        return view('livewire.exam')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
