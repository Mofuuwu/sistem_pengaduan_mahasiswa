<?php

namespace App\Http\Controllers;

use App\Models\CollegeStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirecResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_admin(){
        return view('home.auth.login-admin');
    }
    public function doLoginAdmin(Request $request)
{
    // Validasi input email dan password
    $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
        $user = Auth::user(); 
        if ($user->role_id == 1) {
            return redirect('admin');
        } elseif ($user->role_id == 2) {
            return redirect('employee');
        } else {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke sistem');
        }
    }

    // Jika login gagal, kembali ke halaman login dengan pesan error
    return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
}


    public function register()
    {
        return view('home.auth.register');
    }

    public function login()
    {
        return view('home.auth.login');
    }
    public function doRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nim' => 'required|string|size:10|unique:college_students,nim',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'dob' => 'required|date|before:today',
        ], [
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
            'nim.unique' => 'NIM sudah terdaftar, silakan gunakan NIM lain.',
            'nim.min' => 'NIM harus terdiri dari minimal 10 karakter.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role_id' => '3',
        ]);

        $college_student = CollegeStudent::create([
            'nim' => $validatedData['nim'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'dob' => $validatedData['dob'],
            'user_id' => $user->id,
        ]);

        return redirect('/login')->with('success', 'Registrasi Berhasil, Silahkan Login');
    }
    public function doLogin(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Coba login dengan email dan password
        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            // Login berhasil
            $request->session()->regenerate(); // Mencegah session fixation
            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email'); // Agar email tetap terisi di form
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil!');
    }

    public function profile() {
        $profile = Auth::user();
        $college_profile = CollegeStudent::where('user_id', $profile->id)->first();
        return view('home.profile', ['profile' => $profile, 'copr' => $college_profile]);
    }

    public function editProfile(Request $request) {
        $user = User::find(Auth::user()->id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'min:8|string|nullable',
        ],[
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
        ]);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if(!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        };
        $user->save();
        return redirect('/profile')->with('success', 'Profil Anda Berhasil Diperbarui');
    }
}
