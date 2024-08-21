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
                        <option class="text-gray-500" value="" selected disabled>Pilih Keterangan</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                    </select>
                    <small id="dangerSelectReason" class="text-red-500"></small>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">
                        Catatan
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="notes" name="notes" required></textarea>
                    <small id="dangerFieldNotes" class="text-red-500"></small>
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
            event.preventDefault();

            const reason = document.getElementById('reason').value;
            const notes = document.getElementById('notes').value;

            document.getElementById('dangerSelectReason').textContent = '';
            document.getElementById('dangerFieldNotes').textContent = '';

            // validasi input tidak boleh kosong/wajib di isi
            let isValid = true;

            if (reason === '') {
                document.getElementById('dangerSelectReason').textContent = 'Pilih keterangan terlebih dahulu.';
                isValid = false;
            }

            if (notes.trim() === '') {
                document.getElementById('dangerFieldNotes').textContent = 'Catatan tidak boleh kosong.';
                isValid = false;
            }

            // validasi hilang disaat mengisi input
            document.getElementById('reason').addEventListener('input', function() {
                document.getElementById('dangerSelectReason').textContent = '';
            });

            document.getElementById('notes').addEventListener('input', function() {
                document.getElementById('dangerFieldNotes').textContent = '';
            });

            // menangkap validasi di backend
            if (isValid) {
                const form = event.target.closest('form');
                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: data.message,
                                toast: true,
                                showConfirmButton: false,
                                timer: 1500,
                                customClass: {
                                    popup: 'mt-6'
                                }
                            }).then(() => {
                                window.location.href = '{{ route('presensi.index') }}';
                            });
                        } else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: data.message,
                                toast: true,
                                showConfirmButton: false,
                                timer: 1500,
                                customClass: {
                                    popup: 'mt-6'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Terjadi kesalahan. Silakan coba lagi.",
                            toast: true,
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                popup: 'mt-6'
                            }
                        });
                    });
            }
        });
    </script>
@endsection
