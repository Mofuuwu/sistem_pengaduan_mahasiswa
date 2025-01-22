<x-filament-panels::page>
@vite('resources/css/app.css')
    <section class="w-full min-h-screen px-[1%]">
        <div class="bg-gray-600 bg-opacity-30 min-w-full min-h-screen rounded-[16px] p-10">
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
                <div>
                    <p class="font-extrabold text-xl">{{$complaint->id}}</p>
                </div>
                <div class="flex gap-2 text-sm items-center">
                    <p class="bg-green-500 px-3 py-1 rounded-md">{{$complaint->category->name}}</p>
                    <p class="bg-blue-500 px-3 py-1 rounded-md">{{$complaint->location->name}}</p>
                    <p class="bg-red-500 px-3 py-1 rounded-md">{{$complaint->supports->count()}} Dukungan</p>
                    <div onclick="showProfileModal()" class="text-sm text-gray-400 cursor-pointer">Lihat Detail Pengirim..</div>
                </div>
                <div class="mt-4">
                    <p class="font-bold">Isi Aduan : </p>
                    <p>{{$complaint->description}}</p>
                </div>
            </div>
        </div>
    </section>
    <div onclick="closeProfileModal()" id="profile_overlay" class="fixed inset-0 hidden w-full h-screen flex justify-center items-center font-inter bg-black bg-opacity-70">
        <div id="profile_modal" class="w-[50%] bg-gray-500 p-[3%] rounded-xl">
            <div class="flex gap-2">
                <p class="font-bold">Nama : </p>
                <p>{{$complaint->user->name}}</p>
            </div>
            <div class="flex gap-2">
                <p class="font-bold">Nim : </p>
                <p>{{$complaint->user->college_student->nim}}</p>
            </div>
            <div class="flex gap-2">
                <p class="font-bold">Program Studi : </p>
                <p>{{$complaint->user->college_student->study_program->name}}</p>
            </div>
            <div class="flex gap-2">
                <p class="font-bold">Fakultas : </p>
                <p>{{$complaint->user->college_student->faculty->name}}</p>
            </div>
            <div class="flex gap-2">
                <p class="font-bold">Email : </p>
                <p>{{$complaint->user->email}}</p>
            </div>
            <div class="flex gap-2">
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
    <script>
        function showImageModal(image) {
        const modalImage = document.getElementById('modal-image');
        const modalOverlay = document.getElementById('modal-overlay');
        modalImage.src = image.src;
        modalOverlay.classList.remove('hidden');
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

    function closeImageModal() {
        const modalOverlay = document.getElementById('modal-overlay');
        modalOverlay.classList.add('hidden');
    }
    </script>
</x-filament-panels::page>
