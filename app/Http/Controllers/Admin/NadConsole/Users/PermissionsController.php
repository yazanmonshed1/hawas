<?php

namespace App\Http\Controllers\Admin\NadConsole\Users;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Http\Controllers\Controller;
use App\NadConsole\Models\Permission;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionsController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->routeSlug = 'permissions';
        $this->viewSlug = 'permissions';
        $this->name = ['singular' => __('صلاحية'), 'plural' => __('الصلاحيات')];
        $this->nameSlug = 'permissions';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataTableRequest = [
            'nameSlug' => $this->nameSlug,
            'routeSlug' => 'permissions',
            'data' => [
                'modelName' => 'NadConsole.Models.Permission',
                'searchCol' => 'name'
            ],
            'columns' => ['name', 'guard_name', 'created_at', 'updated_at'],
            'id' => 'permissions-datatable',
        ];
        $grid = Permission::renderGrid($dataTableRequest);
        return view('admin.permissions.index')->with([
            'routeSlug' => 'permissions',
            'name' => $this->name,
            'grid' => $grid
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, FormBuilder $fb)
    {
        $action = route('admin.' . $this->routeSlug . '.store');
        $form = Permission::defaultForm($fb);
        return view('admin.' . $this->viewSlug . '.create')->with([
            'form' => $form->render($action)
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
        $form = Permission::defaultForm($fb);
        return parent::store($request, $form);
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
        //
    }

    public function update(Request $request, FormBuilder $form, $id)
    {
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

    public function generator()
    {
        $tables = array_map('reset', DB::select('SHOW TABLES'));
        $allPermissions = Permission::all()->groupBy('table_name');
        return view('admin.permissions.generate')->with([
            'name' => $this->name,
            'tables' => $tables,
            'allPermissions' => $allPermissions
        ]);
    }

    public function generate(Request $request, $tableName = null)
    {
        $request->validate([
            'tables' => 'required'
        ]);
        foreach ($request->tables as $tableName) {
            $permissions = [
                'edit' => 'edit ' . $tableName,
                'delete' => 'delete ' . $tableName,
                'add' => 'add ' . $tableName,
                'browse' => 'browse ' . $tableName,
            ];
            foreach ($permissions as $permissionName) {
                $data = ['name' => $permissionName, 'guard_name' => 'admin', 'table_name' => $tableName];
                $permission = Permission::firstOrNew($data);
                if (!$permission->exists) {
                    $permission->fill($data)->save();
                }
            }
        }

        return redirect()->back();
    }
}
