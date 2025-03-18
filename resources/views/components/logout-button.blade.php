<button type="button" id="logout-button" class="text-sm md:text-md font-bold text-orange-900">
    Logout
</button>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('logout-button');

    logoutButton.addEventListener('click', function (event) {
        event.preventDefault(); // Mencegah tindakan default tombol

        // Tampilkan dialog konfirmasi
        if (confirm('Apakah Anda yakin ingin logout?')) {
            Livewire.emit('logout'); // Emit event logout jika pengguna mengkonfirmasi
        }
    });
});
</script>
@endpush
