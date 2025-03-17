<!-- resources/views/livewire/confirmation-start.blade.php -->
<div>
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold mb-4">Konfirmasi Ujian</h1>
        <p class="mb-4">Selamat datang di ujian. Anda memiliki 60 menit untuk menyelesaikan ujian ini. Setiap soal harus dijawab dalam waktu 30 detik.</p>
        <div id="timer" class="text-lg font-semibold mb-4">Waktu Ujian: <span id="countdown">60:00</span></div>
        <button wire:click="startExam" class="bg-blue-500 text-white px-4 py-2 rounded">Mulai Ujian</button>
    </div>
</div>
