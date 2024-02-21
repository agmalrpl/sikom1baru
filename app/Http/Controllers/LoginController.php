<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session; 
use App\Models\User; // MENGARAH KE MODEL USER 
 
class LoginController extends Controller 
 
{ 
    public function login() 
    { 
        return view('auth.login'); 
    } 
 
 
    public function auth(Request $request) 
    { 
 
        // VALIDASI DATA YANG MASUK 
        $validasi = $request->validate( 
            [ 
                'email' => 'required|email', 
                'password' => 'required|min:5', 
            ], 
            [ 
                'email.required' => 'Email harus di isi', 
                'password.required' => 'Password harus di isi dan minimal 5 karekter', 
            ], 
        ); 
 
        // PROSES AUTHTENTICATION 
        if (Auth::attempt($validasi)) { 
            $request->session()->regenerate(); 
 
            // KALO DATA NYA SAMA MAKA ARAHKAN KE DASHBOARD 
        return redirect('buku')->with('success', 'Berhasil login'); 
         
             
        } else { 
            return redirect('/')->withErrors('Email atau password yang di masukan tidak sesuai'); 
        } 
 
        //KALO DATANYA TIDAK SAMA MAKA KEMBALI KE HALAMAN SEMULA 
        return back(); 
    } 

    public function logout() 
    { 
        Auth::logout(); // PROSES LOGOUT 
        return redirect('/')->with('success', 'Berhasil logout'); // KALO BERHASIL LOGOUT KE HALAMAN LOGIN 
    } 
 
}
