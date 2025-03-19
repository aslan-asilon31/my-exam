<div>
    @php
        // Set locale ke bahasa Indonesia
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class=" ">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-md shadow-lg ">
            <div class="">
                @if ($asesmen)
                    <div class="transform transition-transform duration-300 hover:shadow-2xl hover:scale-105 bg-gray-100 p-4 rounded-md shadow-md transform transition-transform duration-300 hover:shadow-lg hover:scale-105 " style="background-image: url({{ asset('bg-brown.png') }}); background-size: cover; background-position: center;">
                        <div class="absolute inset-0 bg-black opacity-50 rounded-md z-1"></div>
                        <div class="relative z-99">
                            <h2 class="text-sm md:text-md font-semibold text-white">{{ $asesmen['judul'] }}</h2>
                            <div class="py-4 flex flex-col md:flex-row justify-between">
                                <div class="flex flex-col">
                                    <p class="text-gray-100 text-xs">Waktu:</p>
                                    <p class="text-gray-100 text-[9px]">
                                        {{ \Carbon\Carbon::parse($asesmen['tgl_mulai'])->translatedFormat('l, d F Y') }} - {{ \Carbon\Carbon::parse($asesmen['tgl_selesai'])->translatedFormat('l, d F Y') }} WIB
                                    </p>
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-gray-100 text-xs">Durasi:</p>
                                    <p class="text-gray-100 text-[9px]">{{ $asesmen['durasi'] }} menit</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                @else
                    <div class="transform transition-transform duration-300 hover:shadow-2xl hover:scale-105 bg-gray-100 p-4 rounded-md shadow-md transform transition-transform duration-300 hover:shadow-lg hover:scale-105">
                        <h2 class="text-sm md:text-md font-semibold">-</h2>
                    </div>
                @endif
                
            </div>
            
            <div class="flex justify-center mt-2 gap-4">
                <a href="daftar-asesmen" class="text-xs md:text-sm bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Kembali
                </a>
                <a href="/soal-asesmen/{{ $asesmen['id'] }}" class="text-xs md:text-sm bg-orange-900 hover:bg-orange-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4">
                    Mulai Ujian
                </a>
            </div>
        </div>
    </div>

</div>

