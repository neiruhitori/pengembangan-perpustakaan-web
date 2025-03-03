<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use illuminate\Support\Facades\Validator;
// use illuminate\Support\Facades\Hash;
use illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerSave(Request $request)
    {

        $this->validate($request, [
            'perpustakaan_id' => 'required|min:10|max:10',
            'name' => 'required|min:1|max:50',
            // 'email' => 'required|min:1|max:50',
            'password' => 'required|min:5|max:50',
        ]);

        User::create([
            'perpustakaan_id' => $request->perpustakaan_id,
            'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => $request->password,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        if (Auth::attempt($request->only('perpustakaan_id', 'password'))) {
            return redirect('/dashboard');
        }
        return redirect('/login')->with('error', 'Username atau password yang anda masukkan salah');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    // public function profile()
    // {
    //     $iduser = Auth::id();
    //     $profile = User::where('id',$iduser)->first();
    //     return view('profile', compact('profile'));
    // }

    // public function updateProfile(Request $request) {

    //     $user = Auth::user();

    //     if ($request->has('nip', 'name', 'email', 'password')) {           
    //         $user->nip = ($request->input('nip'));
    //         $user->name = ($request->input('name'));
    //         $user->email = ($request->input('email'));
    //         $user->password = bcrypt($request->input('password'));

    //     } else {

    //     }
    //     // $user->save();

    //     return redirect('/dashboard')->with('success', 'Password berhasil diubah.');
    // }
    public function profile()
    {
        $iduser = Auth::id();
        $profile = User::where('id', $iduser)->first();
        return view('profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        // Validasi yang lebih fleksibel
        $request->validate([
            'nip' => 'required|string',
            'name' => 'required|string',
            'email' => 'nullable|email',  // Email bisa kosong
            'current_password' => 'required|string',  // Tetap wajib untuk keamanan
            'password' => 'nullable|string|min:5'  // Password baru opsional
        ], [
            // Custom error messages
            'nip.required' => 'NIP wajib diisi',
            'name.required' => 'Nama wajib diisi',
            'current_password.required' => 'Password saat ini wajib diisi',
            'password.min' => 'Password baru minimal 6 karakter',
        ]);

        $user = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Password saat ini tidak sesuai!')
                ->withInput();
        }

        // Prepare update data
        $updateData = [
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now()
        ];

        // Add new password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        // Perform update
        try {
            // Update langsung ke database
            $updated = DB::table('users')
                ->where('id', $user->id)
                ->update($updateData);

            if ($updated) {
                // Clear any cached user data
                Auth::logout();
                $updatedUser = User::find($user->id);
                Auth::login($updatedUser);

                return redirect()->route('profile')
                    ->with('success', 'Profile berhasil diperbarui!');
            }

            return redirect()->back()
                ->with('error', 'Gagal mengupdate profile!')
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
