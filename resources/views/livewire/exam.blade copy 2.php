<div>
    @if (!$examStarted && !$examFinished)
        <!-- Confirmation Start -->
        <div class="confirmation-start">
            <h2>Welcome to the Exam</h2>
            <p>Please read the instructions carefully before starting.</p>
            <button wire:click="startExam" class="btn btn-primary">Start Exam</button>
        </div>
    @elseif ($examStarted && !$examFinished)
        <!-- Exam Questions -->
        <div class="exam-container">
            <h2>Question {{ $currentQuestionIndex + 1 }} of {{ count($questions) }}</h2>
            <p>{{ $questions[$currentQuestionIndex] }}</p>
            <textarea wire:model="answers.{{ $currentQuestionIndex }}" class="form-control" placeholder="Type your answer here..."></textarea>

            <div class="timer">
                <p>Exam Time Remaining: <span id="exam-timer">{{ $examTimer }}</span> seconds</p>
                <p>Question Time Remaining: <span id="question-timer">{{ $questionTimers[$currentQuestionIndex] }}</span> seconds</p>
            </div>

            <div class="navigation-buttons">
                @if ($currentQuestionIndex > 0)
                    <button wire:click="previousQuestion" class="btn btn-secondary">Previous</button>
                @endif
                @if ($currentQuestionIndex < count($questions) - 1)
                    <button wire:click="nextQuestion" class="btn btn-primary" id="next-button" disabled>Next</button>
                @else
                    <button wire:click="finishExam" class="btn btn-success" id="finish-button" disabled>Finish Exam</button>
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
    let examTimer = {{ $examTimer }};
    let questionTimer = {{ $questionTimers[$currentQuestionIndex] }};
    let currentQuestionIndex = {{ $currentQuestionIndex }};
    const totalQuestions = {{ count($questions) }};
    const questionTimers = @json($questionTimers);

    // Update the exam timer every second
    const examInterval = setInterval(function() {
        if (examTimer <= 0) {
            clearInterval(examInterval);
            alert("Exam time is up!");
            document.getElementById("finish-button").click(); // Simulate finish exam button click
        } else {
            examTimer--;
            document.getElementById("exam-timer").innerText = examTimer;
        }
    }, 1000);

    // Update the question timer every second
    const questionInterval = setInterval(function() {
        if (questionTimer <= 0) {
            clearInterval(questionInterval);
            alert("Time for this question is up!");
            document.getElementById("next-button").click(); // Simulate next question button click
        } else {
            questionTimer--;
            document.getElementById("question-timer").innerText = questionTimer;
        }
    }, 1000);
</script>
