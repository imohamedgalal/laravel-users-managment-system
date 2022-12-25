<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
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
        return view('admin.settings.index');

    }


    public function create()
    {
        //
    }


    public function store_app_image(Request $request)
    {
        $image = $request->file('photo')->storeAs('applogo','applogo.jpg','mg');
        return view('admin.settings.index');

    }

    public function store_admin_image(Request $request)
    {
        $admin_name = Auth::user()->username . ".jpg";
        $image = $request->file('photo')->storeAs('applogo',$admin_name,'mg');
        return view('admin.settings.index');

    }


    public function show(ActivityLog $activityLog)
    {
        //
    }


    public function edit(ActivityLog $activityLog)
    {
        //
    }


    public function update(Request $request, ActivityLog $activityLog)
    {
        //
    }


    public function destroy($id)
    {

    }
}
