<x-filament-panels::page>
    @vite('resources/css/app.css')
    @if (session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif
    <section class="w-full px-[1%] font-inter">
        <div class="bg-gray-600 bg-opacity-30 min-w-full h-fit rounded-[16px] md:p-10 p-4">
            <div class="grid grid-cols-3 gap-4 mb-5">
                @foreach ($complaint->attachments as $attachment)
                @if ($attachment->file_type == 'pdf')
                <div class="w-24 h-auto bg-gray-200 rounded-lg overflow-hidden">
                    <!-- <embed src="{{ $attachment->path_file }}" type="application/pdf" class="w-full h-full" /> -->
                    <div class="flex flex-col justify-center items-center overflow-hidden">
                        <img src="https://cdn-icons-png.freepik.com/256/16425/16425681.png?semt=ais_hybrid" alt="">
                        <a href="{{ route('attachments.download', $attachment->id) }}" class="bg-blue-400 p-1 font-inter font-semibold text-white rounded-lg px-3 py-1">Download</a>
                    </div>
                </div>
                @else
                <img src="{{ $attachment->path_file }}" alt="Image" class="bg-red-500 w-full h-32 object-cover rounded-lg cursor-pointer hover:scale-105 transition-transform" onclick="showImageModal(this)">
                @endif
                @endforeach
            </div>
            <div class="font-inter">
                <div class="">
                    <p class="font-extrabold text-xl">{{$complaint->id}}</p>
                </div>
                <div class="flex gap-2 text-sm items-center flex-wrap">
                    <p class="bg-green-500 px-3 py-1 rounded-md">{{$complaint->category->name}}</p>
                    <p class="bg-blue-500 px-3 py-1 rounded-md">{{$complaint->location->name}}</p>
                    <p class="bg-red-500 px-3 py-1 rounded-md">{{$complaint->supports->count()}} Dukungan</p>
                </div>
                <p class="text-sm text-gray-400 mt-1">Dibuat pada {{ \Carbon\Carbon::parse($complaint->created_at)->translatedFormat('d F Y') }}</p>
                <div onclick="showProfileModal()" class="text-sm text-blue-400 cursor-pointer w-fit">Lihat Detail Pengirim..</div>


                <div class="mt-4 font-inter flex flex-col gap-1 bg-slate-900 p-2 md:p-5 rounded-md">
                    <div class="flex justify-between items-center md:mb-2">
                        <p class="font-bold">Riwayat Aduan</p>
                        <button id="toggle-btn" class="w-fit mb-1 md:p-2 p-1 bg-blue-500 rounded-full text-md font-bold">
                            <svg id="arrow-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>

                        </button>
                    </div>
                    <div id="logs-container" class=" flex flex-col gap-1">
                        @foreach($complaint->logs as $log)
                        @php
                        $bgColor = '';
                        $textColor = 'text-white';

                        switch ($log->name) {
                        case 'dikirim':
                        $bgColor = 'bg-blue-500';
                        $textColor = 'text-white';
                        break;
                        case 'diterima':
                        $bgColor = 'bg-green-500';
                        $textColor = 'text-white';
                        break;
                        case 'ditinjau':
                        $bgColor = 'bg-yellow-500';
                        $textColor = 'text-white';
                        break;
                        case 'diproses':
                        $bgColor = 'bg-orange-500';
                        $textColor = 'text-white';
                        break;
                        case 'selesai':
                        $bgColor = 'bg-teal-500';
                        $textColor = 'text-white';
                        break;
                        case 'ditolak':
                        $bgColor = 'bg-red-500';
                        $textColor = 'text-white';
                        break;
                        case 'dibatalkan':
                        $bgColor = 'bg-gray-500';
                        $textColor = 'text-white';
                        break;
                        case 'ditangguhkan':
                        $bgColor = 'bg-purple-500';
                        $textColor = 'text-white';
                        break;
                        default:
                        $bgColor = 'bg-white';
                        $textColor = 'text-white';
                        break;
                        }
                        @endphp

                        <div class="md:px-4 md:py-2 px-3 py-2 rounded-md bg-opacity-20 flex justify-between items-center {{$bgColor}}">
                            <div class="">
                                <div class="flex flex-col">
                                    <p class="font-semibold {{$textColor}}">{{ ucfirst($log->name) }}</p>
                                    <p onclick="toggleLogsModal({{ $log->id }})" id="log-detail-button-{{ $log->id }}" class="text-sm text-blue-400 cursor-pointer">Detail..</p>
                                </div>
                            </div>
                            @if (Auth::user()->role_id == 2)
                            <form action="{{ route('employee_del_logs', ['id' => $log->id]) }}" method="post" class="flex items-center gap-2">
                                @csrf
                                <p class="text-sm {{ $textColor }}">{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d F Y') }}</p>
                                <button type="submit" class="bg-red-500 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </div>

                        <!-- Modal -->
                        <div id="logs_modal_{{ $log->id }}" class="w-full bg-gray-800 p-[3%] rounded-xl flex-col flex gap-2 hidden">
                            <div class="flex justify-between items-center">
                                <div class="px-3 py-1 rounded-md flex gap-2 flex-wrap w-fit {{$bgColor}}">
                                    <p class="font-semibold">{{ ucfirst($log->name) }}</p>
                                </div>
                                <p class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d F Y') }}</p>
                            </div>
                            @if ($log->employee_id)
                            <div class="rounded-md flex gap-2 flex-wrap mt-2">
                                <p class="text-sm font-semibold">Nama Petugas :</p>
                                <p class="text-sm">{{$log->employee->user->name}}</p>
                            </div>
                            @endif
                            <div class="rounded-md flex flex-col mt-2">
                                <p class=" text-sm font-semibold">Deskripsi :</p>
                                @if ($log->description)
                                <div class="bg-slate-900 bg-opacity-50 p-2 rounded-md">
                                    <p class="text-sm text-gray-400">{{$log->description}}</p>
                                </div>
                                @else
                                <div class="bg-slate-900 bg-opacity-50 p-2 rounded-md">
                                    <p class="text-sm text-gray-400">Tidak ada deskripsi</p>
                                </div>
                                @endif
                            </div>
                            <p class="font-semibold mt-2 text-sm">Lampiran :</p>
                            @if ($log->path_file)
                            <div class="w-full h-24 overflow-hidden rounded-md flex justify-center items-center cursor-pointer">
                                <img onclick="showImageModal2(this)" src="{{Storage::url($log->path_file)}}" alt="">
                            </div>
                            @else
                            <div class="bg-slate-900 bg-opacity-50 p-2 rounded-md">
                                <p class="text-sm text-gray-400">Tidak ada Lampiran</p>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>



                </div>
                <div class="mt-4 bg-slate-900 p-2 md:p-5 rounded-md">
                    <p class="font-bold">Isi Aduan : </p>
                    <p class="text-sm md:text-md text-gray-400">{{$complaint->description}}</p>
                </div>
            </div>
        </div>
    </section>
    @if (Auth::user()->role_id == 2)
    <section class="w-full px-[1%] font-inter">
        <form action="{{route('employee_add_logs')}}" method="post" enctype="multipart/form-data" class="bg-gray-800 bg-opacity-70 min-w-full h-fit rounded-[16px] md:p-10 p-4">
            @csrf
            <p class="text-center font-bold text-white">Tambah Status</p>
            <div class="flex flex-col gap-4">
                <label for="name" class="text-white">Status</label>
                <select required id="name" name="name" class="bg-gray-700 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="" selected disabled>Silahkan Pilih Status</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditinjau">Ditinjau</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="ditolak">Ditolak</option>
                    <option value="dibatalkan">Dibatalkan</option>
                    <option value="ditangguhkan">Ditangguhkan</option>
                </select>
            </div>

            <div class="flex flex-col gap-4 mt-2">
                <label for="description" class="text-white">Deskripsi <span class="text-gray-400">(Opsional)</span></label>
                <input
                    type="text"
                    id="description"
                    name="description"
                    placeholder="Masukkan deskripsi"
                    class="bg-gray-700 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div class="flex flex-col gap-4 mt-2">
                <label for="attachment" class="text-white">Lampiran <span class="text-gray-400">(Opsional)</span></label>
                <input
                    type="file"
                    id="attachment"
                    name="attachment"
                    accept=".jpg, .jpeg, .png"
                    class="bg-gray-700 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <input type="hidden" name="employee_id" value="{{Auth::user()->employee->id}}">
            <input type="hidden" name="complaint_id" value="{{$complaint->id}}">

            <button type="submit" class="w-full mt-4 bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700 transition duration-300">
                Tambah Status Baru
            </button>
        </form>
    </section>

    @endif

    <div onclick="closeProfileModal()" id="profile_overlay" class="fixed inset-0 hidden w-full h-screen flex justify-center items-center font-inter bg-black bg-opacity-70">
        <div id="profile_modal" class="md:w-[50%] w-90% bg-gray-800 p-[3%] rounded-xl">
            <p class="text-center font-bold mb-4">Detail Pengirim</p>
            <div class="flex gap-2 flex-wrap">
                <p class="font-bold">Nama : </p>
                <p>{{$complaint->user->name}}</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <p class="font-bold">Nim : </p>
                <p>{{$complaint->user->college_student->nim}}</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <p class="font-bold">Program Studi : </p>
                <p>{{$complaint->user->college_student->study_program->name}}</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <p class="font-bold">Fakultas : </p>
                <p>{{$complaint->user->college_student->faculty->name}}</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <p class="font-bold">Email : </p>
                <p>{{$complaint->user->email}}</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <p class="font-bold">Nomor Telepon : </p>
                <p>{{$complaint->user->college_student->phone_number}}</p>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center" id="modal-overlay" onclick="closeImageModal()">
        <div class="p-4 rounded-lg shadow">
            <img src="" alt="Modal Image" id="modal-image" class="max-w-full max-h-screen">
        </div>
    </div>

    <div class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center" id="modal-overlay2" onclick="closeImageModal2()">
        <div class="p-4 rounded-lg shadow">
            <img src="" alt="Modal Image" id="modal-image2" class="max-w-full max-h-screen">
        </div>
    </div>

    <script>
        function showImageModal(image) {
            const modalImage = document.getElementById('modal-image');
            const modalOverlay = document.getElementById('modal-overlay');
            modalImage.src = image.src;
            modalOverlay.classList.remove('hidden');
        }

        function closeImageModal() {
            const modalOverlay = document.getElementById('modal-overlay');
            modalOverlay.classList.add('hidden');
        }

        function showImageModal2(image) {
            const modalImage = document.getElementById('modal-image2');
            const modalOverlay = document.getElementById('modal-overlay2');
            modalImage.src = image.src;
            modalOverlay.classList.remove('hidden');
        }

        function closeImageModal2() {
            const modalOverlay = document.getElementById('modal-overlay2');
            modalOverlay.classList.add('hidden');
        }

        function showProfileModal() {
            const modal = document.getElementById('profile_modal');
            const overlay = document.getElementById('profile_overlay');
            overlay.classList.remove('hidden');
        }

        function closeProfileModal() {
            const overlay = document.getElementById('profile_overlay');
            overlay.classList.add('hidden');
        }

        function showLogsModal() {
            const modal = document.getElementById('logs_modal');
            const overlay = document.getElementById('logs_overlay');
            overlay.classList.remove('hidden');
        }

        function closeModal() {
            const overlay = document.getElementById('logs_overlay');
            overlay.classList.add('hidden');
        }

        function openLogsModal(logId) {
            // Menyembunyikan semua modal
            const allModals = document.querySelectorAll('.logs_modal');
            allModals.forEach(modal => {
                modal.classList.add('hidden');
            });

            // Menampilkan modal spesifik yang dipilih
            const modal = document.getElementById('logs_modal_' + logId);
            if (modal) {
                modal.classList.remove('hidden');
            }

            const openButton = document.getElementById('log-detail-button-' + logId);
            const closeButton = document.getElementById('log-close-button-' + logId);

            if (openButton && closeButton) {
                openButton.classList.add('hidden');
                closeButton.classList.remove('hidden');
            }
        }

        function closeLogsModal(logId) {

            const modal = document.getElementById('logs_modal_' + logId);
            if (modal) {
                modal.classList.add('hidden');
            }

            const openButton = document.getElementById('log-detail-button-' + logId);
            const closeButton = document.getElementById('log-close-button-' + logId);

            if (openButton && closeButton) {
                openButton.classList.remove('hidden');
                closeButton.classList.add('hidden');
            }
        }

        function toggleLogsModal(logId) {
            const modal = document.getElementById('logs_modal_' + logId);
            const openButton = document.getElementById('log-detail-button-' + logId);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                openButton.textContent = 'Tutup..';
            } else {
                modal.classList.add('hidden');
                openButton.textContent = 'Detail..';
            }
        }
        const toggleBtn = document.getElementById('toggle-btn');
        const logsContainer = document.getElementById('logs-container');
        const arrowIcon = document.getElementById('arrow-icon');

        logsContainer.style.display = 'none';
        toggleBtn.addEventListener('click', () => {
            if (logsContainer.style.display === 'none') {
                logsContainer.style.display = 'flex';
                arrowIcon.classList.add('rotate-180');
            } else {
                logsContainer.style.display = 'none';
                arrowIcon.classList.remove('rotate-180');
            }
        });
    </script>
</x-filament-panels::page>