<div>
    <span id="asesmen-durasi" class="font-bold text-orange-900"></span>


    <script>
        // Set the countdown time in seconds
        let countdownAssesmentTime = {{ $asesmenDurasi }}; 
        // let countdownAssesmentTime = {{ $asesmenDurasi }}; 
        // Update the exam countdown every second
        const examInterval = setInterval(() => {
            // Calculate minutes and seconds for exam timer
            const minutes = Math.floor(countdownAssesmentTime / 60);
            const seconds = countdownAssesmentTime % 60;

            // Format the time as MM:SS
            const formattedTime = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            
            // Display the formatted time
            document.getElementById('asesmen-durasi').textContent = formattedTime;

            // Decrease the countdown time
            countdownAssesmentTime--;

            // Check if the exam countdown is finished
            if (countdownAssesmentTime < 0) {
                clearInterval(examInterval);
                document.getElementById('asesmen-durasi').textContent = "EXPIRED";
                alert('Durasi untuk soal ini selesai    !');
                // Emit finishExam event here if using Livewire
                // Livewire.emit('finishExam');
            }
        }, 1000);
    </script>

</div>