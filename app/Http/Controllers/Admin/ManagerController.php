<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{

    public function index()
    {
        $managers = Manager::orderBy('id', 'desc')->paginate();
        return view('admin.managers.index', compact('managers'));
    }

    public function create()
    {
        return view('admin.managers.create');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:managers'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:managers'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validator($request->all())->validate();

        Manager::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $redirect_url = route('managers.index') . '?' . $request->input('redirect_val');
        return redirect($redirect_url);
    }

    public function edit(Manager $manager)
    {
        return view('admin.managers.edit', compact('manager'));
    }


    public function update(Request $request, Manager $manager)
    {
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);

        $manager->name = $validated['name'];
        $manager->password = Hash::make($validated['password']);
        $manager->save();

        $redirect_url = route('managers.index') . '?' . $request->input('redirect_val');
        return redirect($redirect_url);
    }

    public function destroy(Manager $manager)
    {
        $manager->delete();
        return redirect()->back();
    }
}
