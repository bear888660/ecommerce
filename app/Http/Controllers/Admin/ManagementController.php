<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Management;
class ManagementController extends Controller
{
    public function index()
    {
        $managements = Management::orderBy('index_id', 'asc')->paginate(10);
        return view('admin.managements.index', compact('managements'));
    }

    public function create()
    {
        return view('admin.managements.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        Management::create($validated);


        $redirect_url = route('managements.index') . '?' . $request->input('redirect_val');
        return redirect($redirect_url);
    }



    public function edit(Management $management)
    {
        return view('admin.managements.edit', compact('management'));
    }

    public function update(Request $request, Management $management)
    {
        $validated = $this->validateRequest($request);
        $management->name = $validated['name'];
        $management->resource = $validated['resource'];
        $management->index_id = $validated['index_id'];
        $management->save();

        $redirect_url = route('managements.index') . '?' . $request->input('redirect_val');
        return redirect($redirect_url);
    }

    public function destroy(Management $management)
    {
        $management->delete();
        return redirect()->back();
    }

    protected function validateRequest(Request $request)
    {
        return request()->validate([
            'name' => ['required'],
            'resource' => ['required'],
            'index_id' => ['required', 'integer']
        ]);
    }
}
