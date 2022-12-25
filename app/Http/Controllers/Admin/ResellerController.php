<?php

namespace App\Http\Controllers\Admin;


use App\Models\Reseller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $resellers = Reseller::all();

        return view('admin.reseller.index', [
            'resellers' => $resellers,
        ]);
    }


    public function create()
    {
        return view('admin.reseller.add');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required', 'string', 'max:50', 'unique:resellers',
        ]);



        $input = $request->all();

        $resellers = Reseller::create($input);

        $ActivityLog = new ActivityLog();
            $ActivityLog->admin = Auth::user()->username;
            $ActivityLog->title = "Create Reseller" . " " . $input['name'];
            $ActivityLog->user = "";
            $ActivityLog->before = "";
            $ActivityLog->after = "" ;
            $ActivityLog->save();

        $flashMsg = "Reseller" . " " . $input['name'] . " " . "Created!";
        return redirect('/resellers')->with('success', $flashMsg);

    }


    public function edit($id)
    {
        $reseller = Reseller::where('id', $id)->first();
        return view('admin.reseller.edit', [
            'reseller' => $reseller,
        ]);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required', 'string', 'max:25', 'unique:products'. $id,
        ]);

        $input = $request->all();

        $reseller = Reseller::where('id', $id)->first();
        // $product->code = $input["code"];
        // $product->name = $input["name"];
        // $product->save();


        $ActivityLog = new ActivityLog();
        $ActivityLog->admin = Auth::user()->username;
        $ActivityLog->title = "Update Reseller";
        $ActivityLog->user = "";
        $ActivityLog->before = "";
        $ActivityLog->after = "";
        $ActivityLog->save();



        $reseller->update($request->all());

        $flashMsg = 'Reseller' . " " .  $request['name'] . " " . "Updated!";

        return redirect('/resellers')->with('success', $flashMsg);

    }


    public function destroy($id)
    {
        // $agent = Agent::findOrFail($id);
        // $agent->delete();


        // DB::table("agents")->where('id', $id)->delete();
        Reseller::destroy($id);
        return redirect('/resellers')->with('success', 'Reseller Deleted!');
    }
}
