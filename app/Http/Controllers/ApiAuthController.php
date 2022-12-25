<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ApiAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',

        ]);


        $user = User::where('username', '=' , $request->username)
        ->orWhere('email', '=' ,  $request->username)
        //->orWhere('phone', $this->login)
        ->first();
        
        $product = Product::where('code', '=' , $request->product)->first()->version;
        
        if (!$user) {
            return response()->json([
                //"token" => $token,
                "success" => false,
                "msg" => "user not found",
                "status" => 400,
            ]);
        }


        if ($user && !Hash::check($request->password, $user->password) ) {
            //$token = $user->createToken('my-app-token')->plainTextToken;
            return response()->json([
                //"token" => $token,
                "success" => false,
                "msg" => "Wrong Password",
                "status" => 400,
            ]);
        }

        if ($user && Hash::check($request->password, $user->password)  && $user->status == '') {
            //$token = $user->createToken('my-app-token')->plainTextToken;
            //$token = $user->createToken($request->device, ['*']);
            return response()->json([
                //"tolen" => $token,
                "success" => false,
                "msg" => "Your Account Unconfirmed",
                "status" => 400,
            ]);
        }


        if ($user && Hash::check($request->password, $user->password)  && $user->status == "no" ) {
            //$token = $user->createToken('my-app-token')->plainTextToken;
            return response()->json([
                //"token" => $token,
                "success" => false,
                "msg" => "Your Account Suspended",
                "status" => 400,
            ]);
        }
        $new_val = "no";
        
        $collection = collect($user->product);
        if ($collection->contains($request->product)){
            $new_val = "yes";
        }
        //str_contains($user->product,$key );
        // foreach($user->product as $product){
        //     if($request->product == $product){
        //         $new_val = "yes";
        //     }
        // }


        //if user && password && active ok but time expired
        if ($user && Hash::check($request->password, $user->password)  && $user->status == "yes" &&  $user->active_for != null &&  $user->active_for <= Carbon::now()->toDateTimeString()){
            $user->status = 'no';
            $user->save();
            //$token = $user->createToken('my-app-token')->plainTextToken;
            //$token = $user->createToken($request->device, ['*']);
            return response()->json([
                //"token" => $token,
                "success" => false,
                "msg" => "Expird Account",
                "status" => 400,
            ]);
        }
        if ($user && Hash::check($request->password, $user->password)  && $user->status == "yes" &&  $new_val == "no") {
            //$token = $user->createToken('my-app-token')->plainTextToken;
            //$token = $user->createToken($request->device, ['*']);
            return response()->json([
                //"token" => $token,
                "success" => false,
                "msg" => "Wrong Tool",
                "status" => 400,
            ]);
        }
        
        if ($product != $request->version) {

            return response()->json([
                "success" => false,
                "msg" => "old version please update",
                "status" => 400,
            ]);
        }
        
        if ($request->do == 'check_login') {


            if ($user->tokens()->first()->token == $request->token && $user && Hash::check($request->password, $user->password)  && $user->status == "yes" &&  $new_val == "yes" ) {

                return response()->json([
                    "token" => $user->tokens()->first()->token,
                    "success" => true,
                    "msg" => "done",
                    "status" => 200,
                ]);
            }

        }

        if ($request->do == 'login') {

            if ($user && Hash::check($request->password, $user->password)  && $user->status == "yes" &&  $new_val == "yes" ) {

                $user->tokens()->where('name', $request->username)->delete();


                $token = $user->createToken($request->username)->plainTextToken;
                //$token = $user->createToken($request->device, ['*']);
                return response()->json([
                    "token" => $user->tokens()->first()->token,
                    "success" => true,
                    "msg" => "done",
                    "status" => 200,
                ]);
            }
        }


       // $user2 = auth()->user();
        //$token = $user2->createToken('logen');
       // return $token->plainTextToken;
       return response()->json([
        "success" => false,
        "msg" => $new_val,
        "status" => 400,
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
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
