<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->nameSlug = 'messages';
    }

    public function index()
    {
        $dataTableRequest = [
            'nameSlug' => $this->nameSlug,
            'routeSlug' => 'messages',
            'data' => [
                'modelName' => 'Message',
                'searchCol' => 'name',
            ],
            'columns' => ['name', 'email', 'phone_number', 'message'],
            'id' => 'messages-datatable',
            'popup' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.programs.update',
                'store_action' => 'admin.programs.store',
            ]
        ];
        $grid = Message::renderGrid($dataTableRequest);
        return view('admin.general.index')->with([
            'nameSlug' => $this->nameSlug,
            'grid' => $grid
        ]);
    }
}
