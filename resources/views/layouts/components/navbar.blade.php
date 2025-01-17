@php
    use Illuminate\Support\Facades\Request;
@endphp

<section class="my-nav w-full flex justify-center position-sticky top-0 z-50 {{ Request::is('/') ? 'mt-20' : '' }}" style="position:sticky; top:1%;">
    <nav class="flex lg:w-fit md:w-fit bg-customblue p-1 items-center justify-between rounded-[12px] py-3 px-5 gap-4 w-[95%]">
        <div class="logo w-[30px] h-[30px] overflow-hidden rounded-full cursor-pointer" id="logo">
            <img class="w-full h-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTABSta4ztO2Z73YCEvZDFgCPesndhqt-seBg&s" alt="Logo">
        </div>

        <div class="text-white text-bold gap-5 font-inter font-bold hidden md:flex">
            <a href="/" class="{{ Request::is('/') ? 'text-green-400' : '' }}">Beranda</a>
            <a href="/buat-aduan" class="{{ Request::is('buat-aduan') ? 'text-green-400' : '' }}">Buat Aduan</a>
            <a href="/aduanku" class="{{ Request::is('aduanku') || Request::is('aduan-didukung') ? 'text-green-400' : '' }}">Aduanku</a>
            <a href="/jelajahi-aduan" class="{{ Request::is('jelajahi-aduan') ? 'text-green-400' : '' }}">Jelajahi Aduan</a>
        </div>

        <a class="logo w-[30px] h-[30px] overflow-hidden rounded-full" href="{{ auth()->check() ? route('profile') : route('login') }}">
            <img class="w-full h-full object-cover" src="https://cdn-icons-png.flaticon.com/512/9815/9815472.png" alt="Logo">
        </a>
    </nav>

    <div id="side-menu" class="fixed top-0 left-0 w-2/3 h-full bg-customblue p-6 transform -translate-x-full transition-transform ease-in-out duration-300">
        <div class="flex flex-col text-white font-inter font-bold gap-4">
            <a href="/" class="{{ Request::is('/') ? 'text-green-400' : '' }}">Beranda</a>
            <a href="/buat-aduan" class="{{ Request::is('buat-aduan') ? 'text-green-400' : '' }}">Buat Aduan</a>
            <a href="/aduanku" class="{{ Request::is('aduanku') ? 'text-green-400' : '' }}">Aduanku</a>
            <a href="/jelajahi-aduan" class="{{ Request::is('jelajahi-aduan') ? 'text-green-400' : '' }}">Jelajahi Aduan</a>
        </div>
    </div>
</section>

<script>
   const logo = document.getElementById('logo');
const sideMenu = document.getElementById('side-menu');
const body = document.body;

function isMobile() {
    return window.innerWidth < 1024; 
}

logo.addEventListener('click', function(event) {
    if (!isMobile()) return; 
    
    event.stopPropagation(); 
    const isOpen = sideMenu.classList.contains('translate-x-0');
    
    if (isOpen) {
        sideMenu.classList.remove('translate-x-0');
        sideMenu.classList.add('-translate-x-full');
    } else {
        sideMenu.classList.remove('-translate-x-full');
        sideMenu.classList.add('translate-x-0');
    }
});

body.addEventListener('click', function(event) {
    if (!sideMenu.contains(event.target) && !logo.contains(event.target)) {
        sideMenu.classList.remove('translate-x-0');
        sideMenu.classList.add('-translate-x-full');
    }
});

</script>