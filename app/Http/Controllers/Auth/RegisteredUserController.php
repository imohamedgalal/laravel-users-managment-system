<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $products = Product::pluck('code','name')->toArray();
        $payments = Payment::pluck('id','pay_method')->toArray();


        return view('auth.register',[
            'products' => $products,
            'payments' => $payments,

        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string','min:5', 'max:25', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults(Rules\Password::min(5))],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'product' => $request->product,
            'pay_method' => $request->pay_method,
            'eaemail' => $request->eaemail,
            'eapassword' => $request->eapassword,
            'eacode1' => $request->eacode1,
            'eacode2' => $request->eacode2,
            'eacode3' => $request->eacode3,
            'cash_number' => $request->cash_number,
            'paypal_email' => $request->paypal_email,

        ]);

        event(new Registered($user));
        // login after register
        // Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);
        return view('success');

    }
}
