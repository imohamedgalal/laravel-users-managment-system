<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Agent;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Reseller;
use App\Models\ActivityLog;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        $users = User::where('roles_name', '=', null)->get();


        // foreach ($users as $user)
        // {
        //     if($user->status == 'yes' && $user->active_for != null &&  $user->active_for <= Carbon::now()) {
        //         $user->status = 'no';
        //         $user->save();

        //         $ActivityLog = new ActivityLog();
        //         $ActivityLog->admin = "Expired";
        //         $ActivityLog->title = "Disable";
        //         $ActivityLog->user = $user->username;
        //         $ActivityLog->before = "";
        //         $ActivityLog->after = "";
        //         $ActivityLog->save();
        //     }
        // }


        $products = Product::pluck('code','name')->toArray();

        return view('admin.users.index', [
            'users' => $users,
            'products' => $products,

        ]);
    }
    
    public function show_active_users()
    {
        // $users = User::all();
        $users = User::where('status', '=', 'yes')->get();

        $products = Product::pluck('code','name')->toArray();

        return view('admin.users.activeusers', [
            'users' => $users,
            'products' => $products,

        ]);
    }
    
    
    public function show_disabled_users()
    {
        // $users = User::all();
        $users = User::where('status', '=', 'no')->get();

        $products = Product::pluck('code','name')->toArray();

        return view('admin.users.disabledusers', [
            'users' => $users,
            'products' => $products,

        ]);
    }
    
    public function show_unconfirmed_users()
    {
        // $users = User::all();
        $users = User::where('status', '=', null)->get();

        $products = Product::pluck('code','name')->toArray();

        return view('admin.users.unconfirmed', [
            'users' => $users,
            'products' => $products,

        ]);
    }
    public function showAdmins()
    {
        $users = User::where('roles_name', '!=', null)->get();
        $products = Product::pluck('code','name')->toArray();

        return view('admin.admins.index', [
            'users' => $users,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::pluck('code','name')->toArray();
        $agents = Agent::pluck('id','name')->toArray();
        $resellers = Reseller::pluck('id','name')->toArray();
        $payments = Payment::pluck('id','pay_method')->toArray();
        $roles = Role::pluck('name', 'name')->all();



        return view('admin.users.add', [
            'products' => $products,
            'agents' => $agents,
            'payments' => $payments,
            'roles' => $roles,
            'resellers' => $resellers,



        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required', 'string', 'max:255',
            'username' => 'required', 'string', 'max:25', 'unique:users',
            'email' => 'required', 'unique:users', 'email',
            'password' => ['required', Password::defaults(Password::min(5))],
        ]);



        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $ActivityLog = new ActivityLog();
            $ActivityLog->admin = Auth::user()->username;
            $ActivityLog->title = "Create New";
            $ActivityLog->user = $input['username'];
            $ActivityLog->before = "";
            $ActivityLog->after = "";
            $ActivityLog->save();

        $flashMsg = $user->username . " " . "Created!";
        return  redirect('/dashboard')->with('success', $flashMsg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $products = Product::pluck('code','name')->toArray();
        $agents = Agent::pluck('id','name')->toArray();
        $resellers = Reseller::pluck('id','name')->toArray();
        $payments = Payment::pluck('id','pay_method')->toArray();
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('admin.users.edit', [
            'user' => $user,
            'products' => $products,
            'roles' => $roles,
            'userRole' => $userRole,
            'agents' => $agents,
            'payments' => $payments,
            'resellers' => $resellers,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required', 'string', 'max:255',
            'username' => 'required', 'string', 'max:25', 'unique:users' . $id,
            'email' => 'required', 'unique:users', 'email' . $id,
            'password' => [Password::defaults(Password::min(5))],
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input,array('password'));
        }
        $user = User::find($id);

        $ActivityLog = new ActivityLog();
        $ActivityLog->admin = Auth::user()->username;

        if($request->has('product')){
            if ($input['product'] !== $user->product) {
                $ActivityLog->title = "Update Product";
                $ActivityLog->user = $user->username;
                $ActivityLog->before = $user->product;
                $ActivityLog->after = $input['product'];
            } else {
                $ActivityLog->title = "Update Info";
                $ActivityLog->user = $user->username;
                $ActivityLog->before = "";
                $ActivityLog->after = "";

            }

        } else {
            $ActivityLog->title = "Update Info";
            $ActivityLog->user = $user->username;
            $ActivityLog->before = "";
            $ActivityLog->after = "";

        }

        $ActivityLog->save();




        // $user = User::findOrFail($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles_name'));

        $flashMsg = $user->username . " " . "Updated!";

        return  redirect('/dashboard')->with('success', $flashMsg);

    }

    public function activeOrDisable(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->status != 'yes') {

            $ActivityLog = new ActivityLog();
            $ActivityLog->admin = Auth::user()->username;
            $ActivityLog->title = "Active";
            $ActivityLog->user = $user->username;
            $ActivityLog->before = "";
            $ActivityLog->after = "";
            $ActivityLog->save();


            $user->status = 'yes';
            $user->save();
            $flashMsg = $user->username . " " . "Activated";

        } else {


            $ActivityLog = new ActivityLog();
            $ActivityLog->admin = Auth::user()->username;
            $ActivityLog->title = "Disable";
            $ActivityLog->user = $user->username;
            $ActivityLog->before = "";
            $ActivityLog->after = "";
            $ActivityLog->save();


            $user->status = 'no';
            $user->save();
            $flashMsg = $user->username . " " . "Disabled";
        }




        return  back()->with('success', $flashMsg);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $flashMsg = $user->username . " " . "Deleted!";
        User::destroy($id);
        return  redirect('/dashboard')->with('success', $flashMsg);
    }
}
