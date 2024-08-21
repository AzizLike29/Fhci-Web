@extends('app')

@section('content')
    <div class="flex flex-col md:flex-row items-center justify-between p-4 md:p-6 bg-white shadow-md">
        <div class="flex items-center">
            @php
                $hash = crc32($user->name);
                $seed = $hash % 100;
                $gender = ['men', 'women'][$hash % 2];
            @endphp
            <img class="w-12 h-12 md:w-16 md:h-16 rounded-full"
                src="https://randomuser.me/api/portraits/{{ $gender }}/{{ $seed }}.jpg"
                alt="{{ $user->name }}">
            <div class="ml-4">
                <h2 class="text-lg md:text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
        </div>
        <a href="{{ route('logout') }}">
            <button
                class="mt-4 md:mt-0 px-3 py-2 md:px-4 md:py-2 font-semibold text-white bg-red-600 rounded hover:bg-red-500 flex items-center space-x-2">
                <span>Logout</span>
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </a>
    </div>

    <div class="flex flex-col lg:flex-row mt-6 space-y-6 lg:space-y-0 lg:space-x-6">
        <div class="bg-white p-4 md:p-6 shadow-md w-full lg:w-1/3 rounded-lg">
            <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-4">Presensi</h3>
            <p class="text-sm md:text-base text-gray-600">Lakukan Check in dan Check out untuk melengkapi daftar hadir
                harian anda</p>
            <hr class="mt-2">
            <p class="text-center mt-2 text-sm font-bold text-red-600" id="currentDate">Selasa, 26 Maret 2024</p>
            <p class="text-center text-base font-bold text-black-600" id="currentTime">07:00:00</p>
            <div class="flex justify-center mt-4 md:mt-6 space-x-4 md:space-x-6">
                <!-- Check-In Button -->
                <form action="{{ route('presensi.checkIn') }}" method="POST" class="inline">
                    @csrf
                    <button
                        class="w-36 pt-7 pb-7 h-16 md:w-44 md:h-20 text-white rounded-lg focus:outline-none flex flex-col items-center justify-center bg-gradient-to-r from-pink-500 to-red-500 transition-transform duration-300 transform hover:scale-105 shadow-lg"
                        type="submit" name="check_in">
                        <span class="text-base md:text-lg font-semibold">Check-In</span>
                        <i class="fa-solid fa-arrow-right-to-bracket mt-1"></i>
                        <span id="checkInTime" class="text-sm mt-1"></span>
                    </button>
                </form>

                <!-- Check-Out Button -->
                <form action="{{ route('presensi.checkOut') }}" method="POST" class="inline">
                    @csrf
                    <button
                        class="w-36 pt-7 pb-7 h-16 md:w-44 md:h-20 text-gray-800 bg-gray-200 rounded-lg focus:outline-none flex flex-col items-center justify-center transition-transform duration-300 transform hover:scale-105 shadow-lg"
                        type="submit" name="check_out">
                        <span class="text-base md:text-lg font-semibold">Check-Out</span>
                        <i class="fa-solid fa-arrow-right-to-bracket mt-1"></i>
                        <span id="checkOutTime" class="text-sm mt-1"></span>
                    </button>
                </form>
            </div>
            <div class="flex items-center justify-center mt-3">
                <p class="font-semibold text-sm md:text-base">Tidak hadir? <a href="{{ route('absence.form') }}"
                        class="mt-2 text-red-600 hover:underline cursor-pointer">Klik Disini</a></p>
            </div>
        </div>

        <div class="w-full lg:w-2/3">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-4 md:px-6 py-3 md:py-4 bg-gray-50">
                    <h4 class="text-base md:text-lg font-semibold text-gray-800">Riwayat Presensi</h4>
                </div>
                <table class="min-w-full text-left text-xs md:text-sm text-gray-600">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 md:px-6 py-3">No</th>
                            <th class="px-4 md:px-6 py-3">Tanggal</th>
                            <th class="px-4 md:px-6 py-3">Waktu Check In</th>
                            <th class="px-4 md:px-6 py-3">Waktu Check Out</th>
                            <th class="px-4 md:px-6 py-3">Status</th>
                            <th class="px-4 md:px-6 py-3">Alasan</th>
                            <th class="px-4 md:px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($attendances as $attendance)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 md:px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-4 md:px-6 py-4">{{ $attendance->date }}</td>
                                <td class="px-4 md:px-6 py-4">{{ $attendance->check_in }}</td>
                                <td class="px-4 md:px-6 py-4">{{ $attendance->check_out }}</td>
                                <td class="px-4 md:px-6 py-4">{{ $attendance->status }}</td>
                                <td class="px-4 md:px-6 py-4">{{ $attendance->notes }}</td>
                                <td class="px-4 md:px-6 py-4">
                                    <form class="inline-block" action="{{ route('presensi.delete', $attendance->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 md:py-2 md:px-4 rounded inline-flex items-center"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus form ini?')">
                                            <i class="fa-solid fa-trash-can mr-2"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateDateTime() {
            // Mendapatkan tanggal dan waktu sekarang
            var now = new Date();

            // Opsi untuk format tanggal
            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            // Format tanggal menjadi string
            var dateString = now.toLocaleDateString('id-ID', options);

            // Format waktu menjadi jam:menit:detik
            var timeString = now.toLocaleTimeString('id-ID', {
                hour12: false
            });

            // Menampilkan tanggal dan waktu di elemen HTML
            document.getElementById('currentDate').innerText = dateString;
            document.getElementById('currentTime').innerText = timeString;
        }

        // Panggil fungsi setiap 1 detik
        setInterval(updateDateTime, 1000);

        // Panggilan awal agar langsung tampil tanpa menunggu interval
        updateDateTime();

        // time pada button
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const timeString = `${hours}:${minutes}`;

            document.getElementById('checkInTime').textContent = timeString;
            document.getElementById('checkOutTime').textContent = timeString;
        }

        // perbarui waktu saat load
        window.onload = updateTime;
    </script>
@endsection
