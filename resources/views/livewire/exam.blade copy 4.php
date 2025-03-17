<div>

    @script
    <script>
        $wire.on('exam-next-question', () => {
            // Ambil nilai dari textarea
            const answer = document.getElementById('answer-{{ $currentQuestionIndex }}').value;
    
            // Periksa apakah textarea sudah terisi
            if (answer.trim() === '') {
                alert('Silakan isi jawaban sebelum melanjutkan ke soal berikutnya.');
                return; // Hentikan eksekusi jika textarea kosong
            }else{
                // @this.nextQuestion(); 
            }
    
        });
    </script>
    @endscript
    


    @if (!$examStarted && !$examFinished && !$examQuestion)
        <!-- exam list -->
        <div class="w-full exam-list bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto mt-10">
            <h2 class="text-2xl font-bold text-center mb-4">Exam List</h2>
        
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($questions as $question)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h3 class="text-lg font-semibold">Soal {{ $question['no'] }}:</h3>
                        <p class="text-gray-700 mb-2">{{ $question['ask'] }}</p>
                     
                    </div>
                @endforeach
            </div>
        
            <div class="flex justify-center">
                <button wire:click="confirmStartExam" class="bg-blue-500 text-white px-4 py-2 rounded-md">Konfirmasi Ujian</button>
            </div>
        </div>
        

    @elseif (!$examFinished && !$examList && !$examFinished)
        <!-- Confirmation Start -->
        <div  class="w-full confirmation-start bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto mt-10">
            <h2 class="text-2xl font-bold text-center mb-4">Welcome to the Exam</h2>
            <p class="text-gray-700 text-center mb-6">Please read the instructions carefully before starting.</p>
            <div class="flex justify-center">
                <button wire:click="startExam" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Mulai Ujian</button>
            </div>
        </div>
        
    @elseif ($examStarted && !$examFinished && !$examList)
        <div class="exam-container">
            <h2 class="text-xl font-semibold mb-4 text-center">Pertanyaan {{ $currentQuestionIndex + 1 }} dari {{ count($questions) }}</h2>
            <p class="mb-4 text-gray-700">{{ $questions[$currentQuestionIndex]['ask'] }}</p>
            <textarea id="answer-{{ $currentQuestionIndex }}" wire:model="answers.{{ $currentQuestionIndex }}" 
                    class="form-control w-full h-24 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" 
                    placeholder="Ketik jawaban Anda di sini..."></textarea>
            <div class="flex justify-center">
                <button wire:click="nextQuestion" class="bg-blue-500 text-white px-4 py-2 rounded">Next Question</button>
            </div>
        </div>
        
    @elseif ($examFinished)
        <!-- Confirmation Finish -->
        <div class="confirmation-finish w-full bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto mt-10">
            <h2 class="text-2xl font-bold mb-4 text-center">Exam Completed</h2>
            <p class="text-gray-700 text-center mb-6">Thank you for completing the exam. Here are your answers:</p>
            <ul class="list-disc list-inside">
                @foreach ($answers as $index => $answer)
                    <li class="mb-2">
                        <strong>Question {{ $index + 1 }}:</strong> {{ $answer }}
                    </li>
                @endforeach
            </ul>
        </div>
        
    @endif


</div>



<script>


    function startQuestionTimer(value_timer) {
    
        let countdownQuestionTime = document.getElementById('question-timer'); 
        // let countdownQuestionTime = value_timer; 
        // Update the question countdown every second
        const questionInterval = setInterval(() => {
            // Display the remaining question time
            // document.getElementById('question-timer').textContent = countdownQuestionTime;
    
            // Decrease the question countdown time
            countdownQuestionTime--;
            // Check if the question countdown is finished
            if (countdownQuestionTime < 0) {
                clearInterval(questionInterval);
                // Reset question timer for the next question
                countdownQuestionTime = value_timer; 
                alert('Waktu untuk pertanyaan ini habis!');
                // Livewire.emit('nextQuestion');
                alert('Time for this question is up! Moving to the next question.');
             
                alert('cek previousQuestion!');

            }
        }, 1000);
    }

</script>


<script>


            // Set the countdown time in seconds
    let countdownExamTime = {{ $examTimer }}; // 1 hour
    // Update the exam countdown every second
    const examInterval = setInterval(() => {
        // Calculate minutes and seconds for exam timer
        const minutes = Math.floor(countdownExamTime / 60);
        const seconds = countdownExamTime % 60;

        // Format the time as MM:SS
        const formattedTime = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        
        // Display the formatted time
        document.getElementById('exam-timer').textContent = formattedTime;

        // Decrease the countdown time
        countdownExamTime--;

        // Check if the exam countdown is finished
        if (countdownExamTime < 0) {
            clearInterval(examInterval);
            document.getElementById('exam-timer').textContent = "EXPIRED";
            alert('Exam time is up!');
            // Emit finishExam event here if using Livewire
            // Livewire.emit('finishExam');
        }
    }, 1000);


</script>


