<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Customer;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class AuthLoginController extends Controller
{
    public function __construct()
    {
        $types = Type::all();
        View::share('types', $types);
    }

    // Logout web
    public function destroy(): RedirectResponse
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }

    // trang login
    public function login()
    {
        return view('pages.login');
    }

    // post login
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->attempt($this->credentials($request))) {
            return redirect()->back()->with('error', 'Đăng nhập thất bại!');
        }

        return redirect()->intended('/');
    }

    // Login username hoặc email
    protected function credentials(Request $request)
    {
        $login = $request->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $field => $login,
            'password' => $request->input('password'),
        ];
    }

    // trang register
    public function register()
    {
        return view('pages.register');
    }

    // post register
    public function postRegister(RegisterCustomerRequest $request)
    {
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        Auth::guard('web')->login($customer, true);

        return redirect('/');
    }
}
