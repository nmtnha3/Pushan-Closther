<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Products;
use App\Models\Cart;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function validateEmail($email)
    {
        $patternEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($patternEmail, $email);
    }

    public function calculateAge($birthdate)
    {
        $birthday = new DateTime($birthdate);
        $minAge = new DateTime('-14 years');
        return ($birthday <= $minAge);
    }
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->birth = $request->birth;
        $user->gender = $request->gender;
        $user->room_id = Str::random(10);

        $err = [];

        if (empty($user->name) || empty($user->email) || empty($user->password) || empty($user->birth) || empty($user->gender)) {
            $err[] = 'Please enter all required information!';
        } else {
            if (!$this->validateEmail($user->email)) {
                $err['email'] = 'Please enter a valid email address!';
            }

            if (!$this->calculateAge($user->birth)) {
                $err['birth'] = 'You must be at least 14 years old to create an account!';
            }

            $emailExists = User::where('email', $user->email)->exists();
            if ($emailExists) {
                $err['email'] = 'Account already in use!';
            }
        }

        if (empty($err)) {
            $user->save();
            return redirect()->route('show-register')->with('success', 'Registered successfully');
        } else {
            return redirect()->route('show-register')->withErrors($err)->withInput();
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $cartItems = session('cart', []);

            if (!empty($cartItems)) {
                $userId = Auth::user()->id;
                foreach ($cartItems as $cartItem) {
                    $cart = new Cart();
                    $cart->user_id = $userId;
                    $cart->product_id = $cartItem['product_id'];
                    $cart->quantity = $cartItem['quantity'];
                    $cart->size = $cartItem['size'];
                    $cart->save();
                }
                session()->forget('cart');
            }

            return redirect()->route('show-home');
        }

        return redirect()->route('show-login')->withInput()->with('error', 'Incorrect account or password!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show-login');
    }
}
