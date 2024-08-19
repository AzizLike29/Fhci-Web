@extends('app')

@section('content')
    <div class="flex items-center justify-between p-6 bg-white shadow-md">
        <div class="flex items-center">
            <img class="w-16 h-16 rounded-full" src="https://randomuser.me/api/portraits/men/9.jpg" alt="{{ $user->name }}">
            <div class="ml-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
        </div>
        <a href="{{ route('logout') }}">
            <button class="px-4 py-2 font-semibold text-white bg-red-600 rounded hover:bg-red-500">Logout</button>
        </a>
    </div>

    <div class="flex mt-6 space-x-6">
        <div class="bg-white p-6 shadow-md w-1/3 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Presensi</h3>
            <p class="text-gray-600">Lakukan Check in dan Check out untuk melengkapi daftar hadir harian anda</p>
            <hr class="mt-2">
            <p class="text-center mt-2 text-sm font-bold text-red-600" id="currentDate">Selasa, 26 Maret 2024</p>
            <p class="text-center text-base font-bold text-black-600" id="currentTime">07:00:00</p>
            <div class="flex justify-center mt-6 space-x-6">
                <!-- Check-In Button -->
                <form action="{{ route('presensi.checkIn') }}" method="POST" class="inline">
                    @csrf
                    <button
                        class="w-44 h-20 text-white rounded-lg focus:outline-none flex flex-col items-center justify-center bg-gradient-to-r from-pink-500 to-red-500 transition-transform duration-300 transform hover:scale-105"
                        type="submit" name="check_in">
                        <span class="text-lg font-semibold">Check-In</span>
                        <i class="fa-solid fa-arrow-right-to-bracket mt-1"></i>
                        <span class="text-sm mt-1">07:00:00</span>
                    </button>
                </form>

                <!-- Check-Out Button -->
                <form action="{{ route('presensi.checkOut') }}" method="POST" class="inline">
                    @csrf
                    <button
                        class="w-44 h-20 text-gray-800 bg-gray-200 rounded-lg focus:outline-none flex flex-col items-center justify-center transition-transform duration-300 transform hover:scale-105"
                        type="submit" name=check_out>
                        <span class="text-lg font-semibold">Check-Out</span>
                        <i class="fa-solid fa-arrow-right-to-bracket mt-1"></i>
                        <span class="text-sm mt-1">00:00:00</span>
                    </button>
                </form>
            </div>
            <div class="flex items-center justify-center mt-3">
                <p class="font-semibold">Tidak hadir? <a href="{{ route('absence.form') }}"
                        class="mt-2 fw-normal text-sm text-red-600 hover:underline cursor-pointer">Klik Disini</a></p>
            </div>
        </div>

        <div class="w-2/3">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50">
                    <h4 class="text-lg font-semibold text-gray-800">Riwayat Presensi</h4>
                </div>
                <table class="min-w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Waktu Check In</th>
                            <th class="px-6 py-3">Waktu Check Out</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Alasan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($attendances as $attendance)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $attendance->date }}</td>
                                <td class="px-6 py-4">{{ $attendance->check_in }}</td>
                                <td class="px-6 py-4">{{ $attendance->check_out }}</td>
                                <td class="px-6 py-4">{{ $attendance->status }}</td>
                                <td class="px-6 py-4">{{ $attendance->notes }}</td>
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
    </script>
@endsection
