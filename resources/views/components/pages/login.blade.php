@extends('app')

@section('content')
    <div class="bg-gray-100 flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-80 animate__animated animate__fadeIn">
            <div class="flex justify-center mb-6">
                <img src="{{ URL::asset('assets/img/logo_fhci.png') }}" alt="Forum Human Capital Indonesia" class="h-16">
            </div>
            <h2 class="text-base font-bold text-center text-red-500 mb-6">Selangkah Lebih Dekat Dengan Suksesmu</h2>
            <form method="POST" action="{{ route('login.action') }}">
                {{ csrf_field() }}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" placeholder="Masukan Email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500"
                        name="email" required>
                    <small id="dangerEmail" class="text-red-500"></small>
                </div>
                <div class="mb-6 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" placeholder="Masukan Password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500"
                        name="password" required>
                    <small id="dangerPassword" class="text-red-500"></small>
                </div>
                <button type="submit" id="loginBtn"
                    class="w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-600 transition duration-300">Masuk</button>
            </form>
            <p class="text-center mt-4 text-sm">
                Belum ada akun? <a href="{{ route('register') }}" class="text-red-500 hover:underline">Daftar
                    disini</a>
            </p>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("loginBtn").addEventListener("click", function(event) {
                event.preventDefault();

                const email = document.getElementById('email');
                const password = document.getElementById('password');

                // validasi input tidak boleh kosong/wajib di isi
                let isValid = true;

                if (email.value.trim() === '') {
                    document.getElementById('dangerEmail').textContent = 'Silakan isi email anda!';
                    isValid = false;
                } else {
                    document.getElementById('dangerEmail').textContent = '';
                }

                if (password.value.trim() === '') {
                    document.getElementById('dangerPassword').textContent = 'Silakan isi password anda!';
                    isValid = false;
                } else {
                    document.getElementById('dangerPassword').textContent = '';
                }

                // menampilkan pesan sukses
                if (isValid) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Login berhasil!",
                        toast: true,
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'mt-6'
                        }
                    }).then(() => {
                        event.target.closest('form').submit();
                    });
                }
            });

            // validasi hilang disaat mengisi input
            document.getElementById('email').addEventListener('input', function() {
                document.getElementById('dangerEmail').textContent = '';
            });

            document.getElementById('password').addEventListener('input', function() {
                document.getElementById('dangerPassword').textContent = '';
            });
        });
    </script>
@endsection
