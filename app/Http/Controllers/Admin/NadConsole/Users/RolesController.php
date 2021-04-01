<?php

namespace App\Http\Controllers\Admin\NadConsole\Users;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Http\Controllers\Controller;
use App\NadConsole\Models\Permission;
use App\NadConsole\Models\Role;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->nameSlug = 'roles';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormBuilder $fb)
    {
        $dataTableRequest = [
            'nameSlug' => $this->nameSlug,
            'routeSlug' => 'roles',
            'data' => [
                'modelName' => 'NadConsole.Models.Role',
                'searchCol' => 'name'
            ],
            'columns' => ['name', 'guard_name', 'created_at', 'updated_at'],
            'id' => 'roles-datatable'
        ];
        $grid = Role::renderGrid($dataTableRequest);
        return view('admin.general.index')->with([
            'nameSlug' => $this->nameSlug,
            'grid' => $grid
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('table_name');
        return view('admin.roles.create')->with([
            'allPermissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $fb)
    {
        $this->validateRequest($request);
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = $request->has('guard_name') ? $request->guard_name : 'admin';
        $role->save();
        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.roles.index');
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
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy('table_name');
        $selectedPermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.roles.edit')->with([
            'role' => $role,
            'allPermissions' => $permissions,
            'selectedPermissions' => $selectedPermissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormBuilder $fb, $id)
    {
        $this->validateRequest($request, $id);
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        $request->session()->flash('message', 'haahahaha');
        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::firstOrFail($id);
        $role->delete();
        return redirect()->back();
    }

    private function validateRequest(Request $request, $id = null)
    {
        $unique = 'unique:roles,name';
        $unique .= $id ? ',' . $id : '';
        $request->validate([
            'name' => 'required|' . $unique,
            'guard_name' => 'required|in:web,admin',
            'permissions.*' => 'numeric|exists:permissions,id'
        ]);
    }

    public function getPermissions($guardName, $id = null)
    {
        $allPermissions = Permission::where('guard_name', $guardName)->get()->groupBy('table_name');
        $selectedPermissions = null;
        if ($id) {
            $role = Role::findOrFail($id);
            $selectedPermissions = $role->permissions->pluck('id')->toArray();
        }
        $html = view('admin.roles.permissions-checkboxes')->with([
            'allPermissions' => $allPermissions,
            'selectedPermissions' => $selectedPermissions
        ])->render();
        return response()->json(['html' => $html]);
    }
}
