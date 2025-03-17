<div>

    @script
<script>
 
 

    document.addEventListener('livewire:init', () => {
        // Livewire.hook('request', ({ fail }) => {
        //     fail(({ status, preventDefault }) => {
        //         if (status === 419) {
        //             confirm('Your custom page expiration behavior...')
 
        //             preventDefault()
        //         }
        //     })
        // })
    })
</script>
@endscript 


    @if (!$examStarted && !$examFinished)
        <!-- Confirmation Start -->
        <div class="confirmation-start">
            <h2>Welcome to the Exam</h2>
            <p>Please read the instructions carefully before starting.</p>
            <button wire:click="startExam" class="bg-blue-500 text-white m-1 p-1 radius-sm">Start Exam</button>
        </div>
    @elseif ($examStarted && !$examFinished)
        <!-- Exam Questions -->
        <div class="exam-container">
            <h2 class="text-lg font-semibold">Pertanyaan {{ $currentQuestionIndex + 1 }} dari {{ count($questions) }}</h2>
            <p class="mb-2">{{ $questions[$currentQuestionIndex]['ask'] }}</p>
            <textarea wire:model="answers.{{ $currentQuestionIndex }}" class="form-control mb-4" placeholder="Ketik jawaban Anda di sini..."></textarea>


            <div class="timer">
                <p>Exam Time Remaining: <span id="exam-timer">{{ $examTimer }}</span></p>
                <p>Question Time Remaining: <span id="question-timer">{{ $questions[$currentQuestionIndex]['timer'] }}</span> detik</p>
            </div>
    
            <button onclick="startQuestionTimer()" wire:click="previousQuestion" class="bg-blue-500 m-1 p-1 radius-md text-white">Previous</button>
            <button onclick="startQuestionTimer()" wire:click="nextQuestion" class="bg-blue-500 m-1 p-1 radius-md text-white" >Next</button>

            <div class="navigation-buttons">
                @if ($currentQuestionIndex > 0)
                    <button wire:click="previousQuestion" class="bg-blue-500 m-1 p-1 radius-md text-white">Previous</button>
                @endif
                @if ($currentQuestionIndex < count($questions) - 1)
                    <button wire:click="nextQuestion" class="bg-blue-500 m-1 p-1 radius-md text-white" {{ empty($answers[$currentQuestionIndex]) ? 'disabled' : '' }}>Next</button>
                @else
                    <button wire:click="finishExam" class="bg-blue-500 m-1 p-1 radius-md text-white" {{ empty($answers[$currentQuestionIndex]) ? 'disabled' : '' }}>Finish Exam</button>
                @endif
            </div>
            
        </div>
    @elseif ($examFinished)
        <!-- Confirmation Finish -->
        <div class="confirmation-finish">
            <h2>Exam Completed</h2>
            <p>Thank you for completing the exam. Here are your answers:</p>
            <ul>
                @foreach ($answers as $index => $answer)
                    <li><strong>Question {{ $index + 1 }}:</strong> {{ $answer }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>



<script>


    function startQuestionTimer() {
    
        let countdownQuestionTime = {{ $questions[$currentQuestionIndex]['timer'] }}; 
        // Update the question countdown every second
        const questionInterval = setInterval(() => {
            // Display the remaining question time
            document.getElementById('question-timer').textContent = countdownQuestionTime;
    
            // Decrease the question countdown time
            countdownQuestionTime--;
            // Check if the question countdown is finished
            if (countdownQuestionTime < 0) {
                clearInterval(questionInterval);
                // Reset question timer for the next question
                countdownQuestionTime = {{ $questions[$currentQuestionIndex]['timer'] }}; 
                alert('Waktu untuk pertanyaan ini habis!');
                // Livewire.emit('nextQuestion');
                alert('Time for this question is up! Moving to the next question.');
 
            }
        }, 1000);
    }

</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        startQuestionTimer(0); // Mulai timer untuk pertanyaan pertama
    });

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


