<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class Admins extends Controller
{

    public function index($id = null) {
        if ($id == null) {
            return Admin::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    public function store(Request $request) {
        $admin = new Admin;

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = $request->input('password');
        $admin->save();

        return 'Employee record successfully created with id ' . $admin->id;
    }

    public function show($id) {
        return Admin::find($id);
    }

    public function update(Request $request, $id) {
        $admin = Admin::find($id);

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = $request->input('password');
        $admin->save();

        return "Success updating user #" . $admin->id;
    }

    public function destroy(Request $request, $id) {
        $admin = Admin::find($id);

        $admin->delete();

        return "true";
    }
}
