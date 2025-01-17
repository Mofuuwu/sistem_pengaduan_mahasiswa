@extends('layouts/start_html')
@include('layouts/components/navbar')

@if (!auth()->check())
@include('layouts/components/need-login')
@else
<section class="my-top-aduan flex flex-col items-center justify-center pb-12 px-[5%] md:px-[10%] lg:px-[10%]">
    <form enctype="multipart/form-data" action="" method="post" id="aduan-form" class="gap-4 mt-8 bg-customgray w-full rounded-[16px] shadow-md p-[5%]">
        @csrf
        <!-- Header -->
        <h1 class="text-3xl font-bold font-inter text-blue-500 text-center mb-8">Form Aduan</h1>

        <!-- Nav Content -->
        <div class="flex justify-around bg-customblue py-[3%] px-[10%] rounded-[16px] mb-8">
            <button id="btnFormAduan" type="button" onclick="showFormAduan()" class="text-white font-inter font-bold flex flex-col justify-center items-center">
                <div class="p-3 md:p-5 lg:p-5 bg-orange-400 text-[28px] rounded-full mb-2">
                    <ion-icon name="document"></ion-icon>
                </div>
                <p>Form Aduan</p>
            </button>
            <div class="text-orange-400 font-bold font-inter flex justify-center items-center text-[20px]">
                <ion-icon name="remove"></ion-icon>
                <ion-icon name="remove"></ion-icon>
                <ion-icon name="arrow-forward"></ion-icon>
            </div>
            <button id="btnKebijakan" type="button" onclick="showKebijakan()" class="text-white font-inter font-bold flex flex-col justify-center items-center opacity-50">
                <div class="p-3 md:p-5 lg:p-5 bg-orange-400 text-[28px] rounded-full mb-2">
                    <ion-icon name="checkmark-circle-outline"></ion-icon>
                </div>
                <p>Kebijakan</p>
            </button>
        </div>

        <!-- Modal 1 (Form Aduan) -->
        <div id="modal-1" class="modal-1">
            <div class="form-components mb-6">
                <label for="" class="text-blue-500 font-bold font-inter">Lampirkan Gambar</label>
                <div class="flex flex-col items-center justify-center w-full p-6 border-2 border-dashed border-blue-500 rounded-xl bg-gray-50 hover:bg-blue-50 transition duration-300 mt-2" id="file-upload-container">
                    <label for="file-upload" class="cursor-pointer text-center" id="file-upload-label">
                        <div class="text-4xl mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3"></path>
                            </svg>
                        </div>
                        <span class="block text-lg font-semibold text-blue-600">Upload a file or drag and drop</span>
                        <span class="block text-sm text-gray-500 mt-2">JPEG, JPG, PNG, PDF (3MB / Gambar, 5MB / Pdf, Maksimal 3 Gambar / 1 Pdf)</span>
                    </label>
                    <input id="file-upload" name="attachments[]" type="file" accept="image/jpeg, image/png, application/pdf" multiple class="hidden" onchange="handleFileUpload()">
                    <!-- Tempat untuk menampilkan daftar file yang diunggah -->
                    <div id="file-list" class="hidden mt-4 w-full text-left text-gray-700"></div>
                    <!-- Tombol Batal -->
                </div>
                @error('attachments')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <button id="cancel-upload" class="hidden mt-2 px-4 py-2 bg-red-500 text-white hover:bg-red-600 rounded-md w-full mb-6" onclick="cancelUpload()">Batal</button>

            <div class="form-components mb-6">
                <label for="" class="text-blue-500 font-bold font-inter mb-2">Isi Aduan</label>
                <textarea id="file-upload" name="description" placeholder="Tuliskan deskripsi gambar atau upload detail lainnya..."
                    class="mt-2 w-full h-32 p-4 border-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-700 placeholder-gray-400 resize-none"></textarea>
                    @error('description')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
            </div>
            <div class="form-components mb-6">
                <label for="lokasi-aduan" class="text-blue-500 font-bold font-inter mb-2">Lokasi Aduan</label>
                <select id="lokasi-aduan" name="location_id" class="mt-2 w-full h-12 px-4 border-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-700 placeholder-gray-400">
                    <option value="" disabled selected>Pilih Lokasi Aduan</option>
                    <option value="1">Aula</option>
                    <option value="2">Kantin</option>
                    <option value="3">Toilet</option>
                    <option value="4">Lainnya</option>
                </select>
                @error('location_id')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-components mb-6">
                <label for="kategori-aduan" class="text-blue-500 font-bold font-inter mb-2">Kategori Aduan</label>
                <select id="kategori-aduan" name="category_id" class="mt-2 w-full h-12 px-4 border-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-700 placeholder-gray-400">
                    <option value="" disabled selected>Pilih Kategori Aduan</option>
                    <option value="1">Kategori 1</option>
                    <option value="2">Kategori 2</option>
                </select>
                @error('category_id')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-components mb-6">
                <button type="button" onclick="showKebijakan()" class="w-full py-3 mt-4 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Lanjutkan
                </button>
            </div>
        </div>

        <!-- Modal 2 (Kebijakan) -->
        <div id="modal-2" class="modal-2 hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-blue-500 mb-4">Kebijakan Pengaduan</h2>
                @foreach ($rules as $rule)
                    <p class="text-gray-700 mt-4">{{$loop->iteration}}. {{$rule->description}}</p>
                @endforeach
                <button type="submit" class="mt-6 w-full py-3 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Kirim Pengaduan
                </button>
            </div>
        </div>
        
    </form>
</section>
@include('/layouts/components/footer')
@endif

@extends('layouts/end_html')

<script>
    // Fungsi untuk menampilkan modal kebijakan
    function showKebijakan() {
        document.getElementById('modal-1').classList.add('hidden');
        document.getElementById('modal-2').classList.remove('hidden');
        document.getElementById('btnFormAduan').classList.add('opacity-50');
        document.getElementById('btnKebijakan').classList.remove('opacity-50');
    }

    // Fungsi untuk kembali ke form aduan
    function showFormAduan() {
        document.getElementById('modal-2').classList.add('hidden');
        document.getElementById('modal-1').classList.remove('hidden');
        document.getElementById('btnFormAduan').classList.remove('opacity-50');
        document.getElementById('btnKebijakan').classList.add('opacity-50');
    }

    function cancelUpload() {
        const fileInput = document.getElementById('file-upload');
        const fileListContainer = document.getElementById('file-list');
        const cancelButton = document.getElementById('cancel-upload');
        const uploadLabel = document.getElementById('file-upload-label');

        fileInput.value = '';
        fileListContainer.innerHTML = '';

        uploadLabel.style.display = 'block';
        fileListContainer.style.display = 'none';
        cancelButton.style.display = 'none';
    }

    function handleFileUpload() {
        const fileInput = document.getElementById('file-upload');
        const fileListContainer = document.getElementById('file-list');
        const cancelButton = document.getElementById('cancel-upload');
        const uploadLabel = document.getElementById('file-upload-label');

        const files = fileInput.files;
        const maxImageFiles = 3; // Batasi maksimal 3 gambar
        const maxPdfFiles = 1; // Batasi maksimal 1 PDF
        const maxImageSize = 3 * 1024 * 1024; // Maksimal 3 MB per gambar (dalam bytes)
        const maxPdfSize = 5 * 1024 * 1024; // Maksimal 5 MB per PDF (dalam bytes)

        let imageFiles = [];
        let pdfFiles = [];

        // Pisahkan file berdasarkan jenisnya (gambar atau PDF)
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const fileType = file.type;
            const fileSize = file.size;

            // Periksa ukuran file gambar
            if (fileType.includes('image')) {
                if (fileSize > maxImageSize) {
                    alert(`Ukuran gambar ${file.name} melebihi batas maksimal 3MB.`);
                    fileInput.value = ''; // Kosongkan input file
                    return;
                }
                imageFiles.push(file);
            }
            // Periksa ukuran file PDF
            else if (fileType === 'application/pdf') {
                if (fileSize > maxPdfSize) {
                    alert(`Ukuran PDF ${file.name} melebihi batas maksimal 5MB.`);
                    fileInput.value = ''; // Kosongkan input file
                    return;
                }
                pdfFiles.push(file);
            }
        }

        // Cek jika foto dan PDF ada bersamaan
        if (imageFiles.length > 0 && pdfFiles.length > 0) {
            alert("Anda hanya bisa mengunggah gambar atau PDF, tidak keduanya sekaligus.");
            fileInput.value = ''; // Kosongkan input file
            return;
        }

        // Validasi jumlah file gambar dan PDF
        if (imageFiles.length > maxImageFiles) {
            alert(`Anda hanya dapat mengunggah maksimal ${maxImageFiles} file gambar.`);
            fileInput.value = '';
            return;
        }

        if (pdfFiles.length > maxPdfFiles) {
            alert(`Anda hanya dapat mengunggah maksimal ${maxPdfFiles} file PDF.`);
            fileInput.value = '';
            return;
        }

        // Hapus konten sebelumnya
        fileListContainer.innerHTML = '';

        if (files.length > 0) {
            // Menyembunyikan label dan menampilkan daftar file
            uploadLabel.style.display = 'none';
            fileListContainer.style.display = 'block';

            // Loop melalui file gambar dan tampilkan nama file
            imageFiles.forEach(file => {
                const fileItem = document.createElement('div');
                fileItem.textContent = `Gambar: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                fileListContainer.appendChild(fileItem);
            });

            // Loop melalui file PDF dan tampilkan nama file
            pdfFiles.forEach(file => {
                const fileItem = document.createElement('div');
                fileItem.textContent = `PDF: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                fileListContainer.appendChild(fileItem);
            });

            // Tampilkan tombol batal
            cancelButton.style.display = 'inline-block';
        } else {
            // Jika tidak ada file, tampilkan label upload lagi
            uploadLabel.style.display = 'block';
            fileListContainer.style.display = 'none';
            cancelButton.style.display = 'none';
        }
    }
</script>