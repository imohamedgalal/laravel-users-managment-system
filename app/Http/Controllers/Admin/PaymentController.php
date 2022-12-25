<?php

namespace App\Http\Controllers\Admin;


use App\Models\Payment;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $payments = Payment::all();

        return view('admin.payment.index', [
            'payments' => $payments,
        ]);
    }


    public function create()
    {
        return view('admin.payment.add');
    }


    public function store(Request $request)
    {

        $request->validate([
            'pay_method' => 'required', 'string', 'max:100', 'unique:payments',
        ]);



        $input = $request->all();

        $payments = Payment::create($input);

        $ActivityLog = new ActivityLog();
            $ActivityLog->admin = Auth::user()->username;
            $ActivityLog->title = "Create payment" . " " . $input['pay_method'];
            $ActivityLog->user = "";
            $ActivityLog->before = "";
            $ActivityLog->after = "" ;
            $ActivityLog->save();

        $flashMsg = "payment" . " " . $input['pay_method'] . " " . "Created!";
        return redirect('/payments')->with('success', $flashMsg);

    }


    public function edit($id)
    {
        $payments = Payment::where('id', $id)->first();
        return view('admin.payment.edit', [
            'payments' => $payments,
        ]);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'pay_method' => 'required', 'string', 'max:100', 'unique:payments'. $id,
        ]);

        $input = $request->all();

        $payment = Payment::where('id', $id)->first();
        // $product->code = $input["code"];
        // $product->name = $input["name"];
        // $product->save();


        $ActivityLog = new ActivityLog();
        $ActivityLog->admin = Auth::user()->username;
        $ActivityLog->title = "Update Payment";
        $ActivityLog->user = "";
        $ActivityLog->before = "";
        $ActivityLog->after = "";
        $ActivityLog->save();



        $payment->update($request->all());

        $flashMsg = 'Payment' . " " .  $request['pay_method'] . " " . "Updated!";

        return redirect('/payments')->with('success', $flashMsg);

    }


    public function destroy($id)
    {
        // $payment = payment::findOrFail($id);
        // $payment->delete();


        // DB::table("payments")->where('id', $id)->delete();
        Payment::destroy($id);
        return redirect('/payments')->with('success', 'Payment Deleted!');
    }
}
