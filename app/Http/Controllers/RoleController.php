<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Resources\Roles\RoleResource;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        // $user = auth()->user();

        // if(in_array("Administrator", $user->roles->pluck("name")->toArray())){
            return RoleResource::collection(Role::orderBy('created_at', 'desc')->get());
        // };
    }

    public function store(Request $request)
    {
        $role = Role::where('name', $request->name)->first();

        if($role) return response()->json([
            'status' => 'error',
            'message' => 'Role already exists.',
        ]);

        Role::create([
            'name' => $request->name,
            'uuid' => Str::uuid()->toString()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully.',
            'name' => $request->name
        ]);
    }

    public function update(Request $request)
    {
        $role = Role::where("uuid", $request->uuid)->first();

        if(!$role) return response()->json([
            'status' => 'error',
            'message' => 'Role does not exists.',
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Role updated successfully.',
        ]);
    }

    public function destroy(Request $request)
    {
        $role = Role::where("uuid", $request->uuid)->first();
        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully.',
            'status' => 'success'
        ]);
    }
}
