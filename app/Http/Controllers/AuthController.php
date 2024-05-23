<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

  public function index()
  {
    return view('login');
  }

  public function authenticate(Request $request)
  {
    try {
      $credentials = $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required'
      ]);

      if (Auth::attempt($credentials)) {
        $user = Auth::user();

        $existingSession = Cache::get('user-session-' . $user->id);
        if ($existingSession) {
          Auth::logout();
          $request->session()->invalidate();
          $request->session()->regenerateToken();
          return redirect()->route('login')->with('error', 'Kamu sudah login di perangkat lain.');
        }

        Cache::put('user-session-' . $user->id, true, now()->addMinutes(5));

        return redirect()->route('karyawan.index')->with('success', 'Berhasil login');
      }

      return redirect()->route('login')->with('error', 'Email atau password salah');
    } catch (ValidationException $th) {
      return back()->withErrors($th->validator?->errors())->withInput();
    }
  }

  public function logout(Request $request)
  {
    $user = Auth::user();
    Cache::forget('user-session-' . $user->id);

    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
  }

  public function register()
  {
    return view('register');
  }

  public function registerPost(Request $request)
  {
    try {
      DB::beginTransaction();

      $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required'
      ]);

      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
      ]);

      DB::commit();
      return redirect()->route('register')->with('success', 'Berhasil terdaftar');
    } catch (ValidationException $th) {
      DB::rollBack();
      return back()->withErrors($th->validator?->errors())->withInput();
    }
  }

  public function profile()
  {
    return view('change-password');
  }

  public function profilePost(Request $request, $id)
  {
    try {
      DB::beginTransaction();

      $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
      ]);

      $user = User::find($id);

      if ($request->has('password')) {
        if (Hash::check($request->password, $user->password)) {
          throw ValidationException::withMessages(['password' => 'Password baru tidak boleh sama dengan password lama']);
        } else {
          $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
          ]);
        }
      }

      DB::commit();
      return redirect()->route('profile')->with('success', 'Berhasil merubah password');
    } catch (ValidationException $th) {
      DB::rollBack();
      return back()->withErrors($th->validator?->errors())->withInput();
    }
  }
}
