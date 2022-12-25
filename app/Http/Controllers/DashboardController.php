<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;


class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index ()
    {
        $users_chart = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->orderBy('id','ASC')
                    ->pluck('count', 'month_name');
 
        $labels = $users_chart->keys();
        $data = $users_chart->values();


        $users = User::count();
        $active_users = User::where('status','yes')->count();
        $disabled_users = User::where('status','no')->count();
        $unconfirmed_users = User::where('status',NULL)->count();
        return view('dashboard',compact('users','active_users','disabled_users','unconfirmed_users','labels', 'data'));
    }
}
