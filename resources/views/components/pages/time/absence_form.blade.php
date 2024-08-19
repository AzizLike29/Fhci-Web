@extends('app')

@section('content')
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="absenceModal">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Lapor Ketidakhadiran</h3>
            <form action="{{ route('absence.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="reason">
                        Keterangan
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="reason" name="reason" required>
                        <option class="text-gray-500" value="">Pilih Keterangan</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">
                        Catatan
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="notes" name="notes" required></textarea>
                </div>
                <div class="mx-3 flex items-center justify-center space-x-4">
                    <a href="{{ route('presensi.index') }}">
                        <button
                            class="text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline bg-blue-500 hover:bg-blue-600"
                            type="button">
                            Batal
                        </button>
                    </a>
                    <button
                        class="bg-gradient-to-r from-pink-500 to-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:opacity-75"
                        type="submit" id="submitForm">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById("submitForm").addEventListener("click", function(event) {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Laporan Berhasil Terkirim!",
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
