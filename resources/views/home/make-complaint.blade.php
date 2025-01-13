@extends('layouts/start_html')
@include('layouts/components/navbar')

<section class="my-top-aduan flex flex-col items-center justify-center pb-12 px-[5%] md:px-[10%] lg:px-[10%]">
    <form id="aduan-form" class="gap-4 mt-8 bg-customgray w-full rounded-[16px] shadow-md p-[5%]">
        <h1 class="text-3xl font-bold font-inter text-blue-500 text-center mb-8">Form Aduan</h1>
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
                <div class="flex flex-col items-center justify-center w-full p-6 border-2 border-dashed border-blue-500 rounded-xl bg-gray-50 hover:bg-blue-50 transition duration-300 mt-2">
                    <label for="file-upload" class="cursor-pointer text-center">
                        <div class="text-4xl mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3"></path>
                            </svg>
                        </div>
                        <span class="block text-lg font-semibold text-blue-600">Upload a file or drag and drop</span>
                        <span class="block text-sm text-gray-500 mt-2">JPEG, JPG, PNG, PDF (5MB, Maksimal 3 Gambar/File)</span>
                    </label>
                    <input id="file-upload" type="file" accept="image/jpeg, image/png, application/pdf" multiple class="hidden">
                </div>
            </div>
            <div class="form-components mb-6">
                <label for="" class="text-blue-500 font-bold font-inter mb-2">Isi Aduan</label>
                <textarea id="file-upload" placeholder="Tuliskan deskripsi gambar atau upload detail lainnya..."
                    class="mt-2 w-full h-32 p-4 border-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-700 placeholder-gray-400 resize-none"></textarea>
            </div>
            <div class="form-components mb-6">
                <label for="lokasi-aduan" class="text-blue-500 font-bold font-inter mb-2">Lokasi Aduan</label>
                <select id="lokasi-aduan" class="mt-2 w-full h-12 px-4 border-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-700 placeholder-gray-400">
                    <option value="" disabled selected>Pilih Lokasi Aduan</option>
                    <option value="">Aula</option>
                    <option value="">Kantin</option>
                    <option value="">Toilet</option>
                    <option value="">Lainnya</option>
                </select>
            </div>
            <div class="form-components mb-6">
                <label for="lokasi-aduan" class="text-blue-500 font-bold font-inter mb-2">Jenis Aduan</label>
                <select id="lokasi-aduan" class="mt-2 w-full h-12 px-4 border-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-700 placeholder-gray-400">
                    <option value="" disabled selected>Pilih Jenis Aduan</option>
                    <option value="">Private</option>
                    <option value="">Public</option>
                </select>
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
                <p class="text-gray-700">Berikut adalah kebijakan pengaduan yang harus Anda setujui sebelum melanjutkan.</p>
                <p class="text-gray-700 mt-4">1. Pengaduan harus disertai bukti gambar atau dokumen pendukung.<br>2. Pengaduan tidak mengandung unsur SARA atau fitnah.</p>
                <button type="submit" class="mt-6 w-full py-3 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Kirim Pengaduan
                </button>
            </div>
        </div>
    </form>
</section>

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
</script>
