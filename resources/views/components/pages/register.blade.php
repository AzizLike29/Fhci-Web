@extends('app')

@section('content')
    <div class="bg-gray-100 flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-96 animate__animated animate__fadeIn">
            <div class="flex justify-center mb-6">
                <img src="{{ URL::asset('assets/img/logo_fhci.png') }}" alt="Logo" class="h-16">
            </div>
            <h2 class="text-base font-bold text-center text-red-500 mb-6">Selangkah Lebih Dekat Dengan Suksesmu</h2>
            <form method="POST" action="{{ route('register.action') }}">
                {{ csrf_field() }}
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" id="nama" placeholder="Masukan nama"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500"
                        name="name" value="{{ old('name') }}" required>
                    <small id="dangerName" class="text-red-500"></small>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" placeholder="Masukan Email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500"
                        name="email" value="{{ old('email') }}" required>
                    <small id="dangerEmail" class="text-red-500"></small>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" placeholder="Masukan Password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500"
                        name="password" required>
                    <small id="dangerPassword" class="text-red-500"></small>
                </div>
                <div class="mb-6">
                    <label for="password_confirm" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                        Password</label>
                    <input type="password" id="password_confirm" placeholder="Masukan Konfirmasi Password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500"
                        name="password_confirm" required>
                    <small id="dangerConfirmationPassword" class="text-red-500"></small>
                </div>
                <button id="daftarBtn" type="submit"
                    class="w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-600 transition duration-300">
                    Daftar
                </button>
            </form>
            <p class="text-center mt-4 text-sm">
                Sudah ada akun? <a href="{{ route('login') }}" class="text-red-500 hover:underline">Masuk</a>
            </p>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("daftarBtn").addEventListener("click", function(event) {
                event.preventDefault();

                const nama = document.getElementById('nama');
                const email = document.getElementById('email');
                const password = document.getElementById('password');
                const password_confirm = document.getElementById('password_confirm');

                let isValid = true;

                if (nama.value.trim() === '') {
                    document.getElementById('dangerName').textContent = 'Silakan isi nama anda!';
                    isValid = false;
                } else {
                    document.getElementById('dangerName').textContent = '';
                }

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

                if (password_confirm.value.trim() === '') {
                    document.getElementById('dangerConfirmationPassword').textContent =
                        'Silakan isi konfirmasi password anda!';
                    isValid = false;
                } else {
                    document.getElementById('dangerConfirmationPassword').textContent = '';
                }

                if (isValid) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Register berhasil!",
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

            document.getElementById('nama').addEventListener('input', function() {
                document.getElementById('dangerName').textContent = '';
            });

            document.getElementById('email').addEventListener('input', function() {
                document.getElementById('dangerEmail').textContent = '';
            });

            document.getElementById('password').addEventListener('input', function() {
                document.getElementById('dangerPassword').textContent = '';
            });

            document.getElementById('password_confirm').addEventListener('input', function() {
                document.getElementById('dangerConfirmationPassword').textContent = '';
            });
        });
    </script>
@endsection
