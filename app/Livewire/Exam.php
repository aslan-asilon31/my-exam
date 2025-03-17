<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On; 
use Mary\Traits\Toast;

class Exam extends Component
{
    use Toast;
    public string $title = 'Ujian '; 

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
        // Initialize questions with different timers and points
        $this->questions = [
            [
                'no' => 1, // Nomor urut
                'ask' => "Apa yang Anda ketahui tentang product A?",
                'timer' => 2,
                'points' => 5,
                'img_url' => 'https://umedalife.jp/files/images/sliders/genki/umeda-genki-slider-04.webp'
            ],
            [
                'no' => 2, // Nomor urut
                'ask' => "Jelaskan keunggulan produk B.",
                'timer' => 5,
                'points' => 10,
                'img_url' => 'https://umedalife.jp/files/images/sliders/bru/umeda-bru-slider-01.webp'
            ],
            [
                'no' => 3, // Nomor urut
                'ask' => "Apa yang harus dilakukan jika produk A?",
                'timer' => 60,
                'points' => 8,
                'img_url' => 'https://umedalife.jp/files/images/sliders/genki/umeda-genki-slider-04.webp'
            ],
            [
                'no' => 4, // Nomor urut
                'ask' => "Jika produk C mengalami henti mesin maka , apa yang harus dilakukan ?.",
                'timer' => 50,
                'points' => 7,
                'img_url' => 'https://umedalife.jp/files/images/sliders/genki/umeda-genki-slider-04.webp'
            ],
            [
                'no' => 5, // Nomor urut
                'ask' => "Apa keunggulan dari produk D?",
                'timer' => 40,
                'points' => 6,
                'img_url' => 'https://umedalife.jp/files/images/sliders/genki/umeda-genki-slider-04.webp'
            ],
        ];

        $this->questionTimers = array_column($this->questions, 'timer');

        // // Initialize answers array
        // $this->answers = array_fill(0, count($this->questions), '');

        // // Initialize question timers
        // $this->questionTimers = array_fill(0, count($this->questions), $this->questionTimer);
    }

    public function confirmStartExam()
    {
        $this->examList = false;
        $this->examQuestion = false;
        $this->examStarted = true;
        $this->examFinished = false;
        $this->examTimer = 3600; 

        $this->startExam();
    }

    public function startExam()
    {

        $this->examTimer = 3600; 
        $this->examStarted = false;
        $this->examQuestion = true;
        $this->examList = false;
        $this->currentQuestionIndex = 0;
        $this->examFinished = false;
        $this->questionTimers[$this->currentQuestionIndex] = $this->questionTimer;
        $this->dispatch('start-timers');
    }



    public function examNow()
    {

        $this->examStarted = false;
        $this->examQuestion = true;
        $this->examList = false;
        $this->examFinished = false;
        // Start the exam timer
        $this->examTimer = 3600; // Reset to 60 minutes

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
            $this->finishExam();

        }

    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function finishExam()
    {
        $this->examFinished = true;
        $this->examStarted = false;
    }

    public function render()
    {

        return view('livewire.exam')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
