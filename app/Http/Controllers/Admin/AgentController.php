<?php

namespace App\Http\Controllers\Admin;


use App\Models\Agent;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $agents = Agent::all();

        return view('admin.agent.index', [
            'agents' => $agents,
        ]);
    }


    public function create()
    {
        return view('admin.agent.add');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required', 'string', 'max:50', 'unique:agents',
        ]);



        $input = $request->all();

        $agents = Agent::create($input);

        $ActivityLog = new ActivityLog();
            $ActivityLog->admin = Auth::user()->username;
            $ActivityLog->title = "Create Agent" . " " . $input['name'];
            $ActivityLog->user = "";
            $ActivityLog->before = "";
            $ActivityLog->after = "" ;
            $ActivityLog->save();

        $flashMsg = "Agent" . " " . $input['name'] . " " . "Created!";
        return redirect('/agents')->with('success', $flashMsg);

    }


    public function edit($id)
    {
        $agent = Agent::where('id', $id)->first();
        return view('admin.agent.edit', [
            'agent' => $agent,
        ]);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required', 'string', 'max:25', 'unique:products'. $id,
        ]);

        $input = $request->all();

        $agent = Agent::where('id', $id)->first();
        // $product->code = $input["code"];
        // $product->name = $input["name"];
        // $product->save();


        $ActivityLog = new ActivityLog();
        $ActivityLog->admin = Auth::user()->username;
        $ActivityLog->title = "Update agent";
        $ActivityLog->user = "";
        $ActivityLog->before = "";
        $ActivityLog->after = "";
        $ActivityLog->save();



        $agent->update($request->all());

        $flashMsg = 'Agent' . " " .  $request['name'] . " " . "Updated!";

        return redirect('/agents')->with('success', $flashMsg);

    }


    public function destroy($id)
    {
        // $agent = Agent::findOrFail($id);
        // $agent->delete();


        // DB::table("agents")->where('id', $id)->delete();
        Agent::destroy($id);
        return redirect('/agents')->with('success', 'agent Deleted!');
    }
}
