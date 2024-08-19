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
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" placeholder="Masukan Email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500"
                        name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" placeholder="Masukan Password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500"
                        name="password" required>
                </div>
                <div class="mb-6">
                    <label for="password_confirm" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                        Password</label>
                    <input type="password" id="password_confirm" placeholder="Masukan Konfirmasi Password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500"
                        name="password_confirm" required>
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
        document.getElementById("daftarBtn").addEventListener("click", function(event) {
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
                document.querySelector("form").submit();
            });
        });
    </script>
@endsection
