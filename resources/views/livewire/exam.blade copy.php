<!-- resources/views/livewire/exam.blade.php -->
<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>
    
    <div class="mb-4">
        
            <h2 class="text-lg font-bold">Waktu Tersisa:</h2>

            <div class="text-lg font-semibold">Waktu Ujian: <span id="total-timer">20</span></div>
            <div class="text-lg font-semibold">Waktu Soal: <span id="question-timer">{{ $questionTime }}</span></div>
        
    </div>
    <div id="timer">5</div>

    <div class="mb-4">
        <h2 class="text-xl font-semibold">Soal {{ $currentQuestionIndex + 1 }}:</h2>
        <p>{{ $questions[$currentQuestionIndex]['question'] }}</p>
        <textarea wire:model="answers.{{ $currentQuestionIndex }}" class="w-full h-24 border rounded mt-2" placeholder="Tulis jawaban Anda di sini..."></textarea>
    </div>

    <div class="flex justify-between">
        <button wire:click="nextQuestion" class="bg-blue-500 text-white px-4 py-2 rounded">Next</button>
    </div>




        <button wire:click="showAlert" class="bg-blue-500 text-white px-4 py-2 rounded">
            Tampilkan Timer
        </button>
    
    <script>
 
    </script>

    @script
    <script>
        alert({{ $questionTime }})
        console.log({{ $questionTime }})
    </script>
    @endscript

    <script>
        const timerElement = document.getElementById('total-timer');
        const timerQuestionElement = document.getElementById('question-timer');

        let timeLeft = 20;
        let timeLeftQuestion = {{ $questionTime }};
    
        // Fungsi untuk mengupdate waktu
        function updateTimer() {
            // Mengurangi waktu yang tersisa
            if (timeLeft > 0) {
                timeLeft--;
                timerElement.textContent = timeLeft;
            } else {
                clearInterval(countdownInterval);
                timerElement.textContent = "Selesai!";
            }

            if (timeLeftQuestion > 0) {
                timeLeftQuestion--;
                timerQuestionElement.textContent = timeLeftQuestion;
            } else {
                clearInterval(countdownInterval);
                timerQuestionElement.textContent = "Selesai!";
            }
        }
    
        // Memulai countdown dengan interval 1 detik (1000 ms)
        const countdownInterval = setInterval(updateTimer, 1000);
    </script>





<script>
    // Mendapatkan elemen dengan id 'timer'
    const timerElement = document.getElementById('total-timer');
    // Mengatur waktu awal menjadi 5 detik
    alert({{ $questionTime }})
    let timeLeft = 20;

    // Fungsi untuk mengurangi waktu dan memperbarui tampilan
    const countdown = () => {
        // Mengurangi waktu yang tersisa
        timeLeft--;
        // Memperbarui tampilan dengan waktu yang tersisa
        timerElement.textContent = timeLeft;

        // Jika waktu habis, hentikan countdown
        if (timeLeft <= 0) {
            clearInterval(interval);
            timerElement.textContent = "Selesai!";
        }
    };

    // Menjalankan fungsi countdown setiap 1000 ms (1 detik)
    const interval = setInterval(countdown, 1000);
</script>
    


</div>
