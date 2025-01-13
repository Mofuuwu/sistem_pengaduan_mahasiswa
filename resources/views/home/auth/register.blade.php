@extends('layouts/start_html')

@include('layouts/components/navbar')

<h1 class="text-3xl font-bold font-inter text-customblue text-center mt-20">Register</h1>

<section class="mt-8 mb-20 px-[10%]">
    <form id="registration-form" class="w-full max-w-md mx-auto bg-customgray p-6 rounded-lg shadow">
        <!-- Step 1 -->
        <div id="step-1" class="form-step">
            <div class="mb-4">
                <label for="name" class="block text-customblue font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" class="w-full p-3 rounded bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-customblue">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-customblue font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 rounded bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-customblue">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-customblue font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 rounded bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-customblue">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-customblue font-bold mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 rounded bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-customblue">
            </div>
            <button type="button" id="next-button" class="w-full bg-customblue text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">Next</button>
            <p class="text-customblue font-medium text-center mt-2">sudah memiliki akun? silahkan <a class="font-bold" href="/login">login</a></p>
        </div>

        <!-- Step 2 -->
        <div id="step-2" class="form-step hidden">
            <div class="mb-4">
                <label for="student_id" class="block text-customblue font-bold mb-2">Student ID</label>
                <input type="text" id="student_id" name="student_id" class="w-full p-3 rounded bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-customblue">
            </div>
            <div class="mb-4">
                <label for="department" class="block text-customblue font-bold mb-2">Department</label>
                <input type="text" id="department" name="department" class="w-full p-3 rounded bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-customblue">
            </div>
            <div class="mb-4">
                <label for="semester" class="block text-customblue font-bold mb-2">Semester</label>
                <input type="number" id="semester" name="semester" class="w-full p-3 rounded bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-customblue">
            </div>
            <div class="flex justify-between">
                <button type="button" id="back-button" class="bg-gray-500 text-white font-bold py-3 px-5 rounded-lg hover:bg-gray-700 transition">Back</button>
                <button type="submit" class="bg-customblue text-white font-bold py-3 px-5 rounded-lg hover:bg-blue-700 transition">Submit</button>
            </div>
        </div>
    </form>
</section>

@include('layouts/components/footer')

@extends('layouts/end_html')

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nextButton = document.getElementById('next-button');
        const backButton = document.getElementById('back-button');
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');

        nextButton.addEventListener('click', () => {
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
        });

        backButton.addEventListener('click', () => {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
        });
    });
</script>
