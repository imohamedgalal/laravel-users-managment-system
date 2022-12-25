<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();

        return view('admin.product.index', [
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
        return view('admin.product.add');
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

            'code' => 'required', 'string', 'max:25', 'unique:products',
            'name' => 'required', 'string', 'max:25', 'unique:products',
        ]);



        $input = $request->all();

        $product = Product::create($input);

        $ActivityLog = new ActivityLog();
            $ActivityLog->admin = Auth::user()->username;
            $ActivityLog->title = "Create Product" . " " . $input['name'];
            $ActivityLog->user = "";
            $ActivityLog->before = "";
            $ActivityLog->after = "" ;
            $ActivityLog->save();

        $flashMsg = "Product" . " " . $input['name'] . " " . "Created!";
        return redirect('/products')->with('success', $flashMsg);

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
        $product = Product::where('code', $id)->first();
        return view('admin.product.edit', [
            'product' => $product,
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

            'code' => 'required', 'string', 'max:25', 'unique:products'. $id,
            'name' => 'required', 'string', 'max:25', 'unique:products'. $id,
        ]);

        $input = $request->all();

        $product = Product::where('code', $id)->first();
        // $product->code = $input["code"];
        // $product->name = $input["name"];
        // $product->save();


        $ActivityLog = new ActivityLog();
        $ActivityLog->admin = Auth::user()->username;
        $ActivityLog->title = "Update Product";
        $ActivityLog->user = "";
        $ActivityLog->before = "";
        $ActivityLog->after = "";

        $ActivityLog->save();



        $product->update($request->all());

        $flashMsg = 'Product' . " " .  $request['name'] . " " . "Updated!";

        return redirect('/products')->with('success', $flashMsg);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/products')->with('success', 'user Deleted!');
    }
}
