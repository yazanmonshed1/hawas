<?php

namespace App\Http\Controllers\Admin\NadConsole;

use App\Http\Controllers\Controller;
use App\NadConsole\Models\Media;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->name = ['singular' => __('ميديا'), 'plural' => __('ميديا')];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataTableRequest = [
            'processing' => true,
            'serverSide' => true,
            'name' => $this->name,
            'ajax' => [
                'url' => route('admin.get-data.datatable'),
                'data' => [
                    'modelName' => 'NadConsole.Models.Media',
                    'searchCol' => 'path',
                ]
            ],
            'columns' => ['path'],
            'id' => 'media-datatable',
            'popup' => true,
            'form_options' => [
                'edit_form' => 'editForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.media.update',
                'store_action' => 'admin.media.store',
            ],
            'permissions_slug' => 'media'
        ];
        $grid = Media::renderGrid($dataTableRequest, 'media');
        return view('admin.general.index')->with([
            'routeSlug' => 'blogs',
            'name' => $this->name,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NadConsole\Services\FormBuilder  $fb
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $fb)
    {
        // @TODO Get model then get form then get allowed types of the field

        $validatorArr = [];
        $fileValidatorKey = 'media';
        $fileValidatorKey .= is_array($request->media) ? '.*' : '';
        $validatorArr[$fileValidatorKey] = 'required|file|mimes:jpeg,png,gif,webp,doc,docx,pdf,ppt,pptx,xls,mp4,amv';

        $validator = Validator::make($request->all(), $validatorArr);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'error in request',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle Validation success
        $stored = $this->upload($request->media);

        return response()->json([
            'message' => 'successfully uploaded',
            'stored' => $stored
        ], 201);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NadConsole\Services\FormBuilder  $fb
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormBuilder $fb, $id)
    {
        //
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

    private function upload($media)
    {
        if (is_array($media)) {
            $stored = [];
            foreach ($media as $mediaItem) {
                $path = $mediaItem->store('media', ['disk' => 'public']);
                $media = new Media();
                $media->path = $path;
                $media->type = 'image';
                $media->save();
                $stored[] = $media;
            }
        } else {
            $path = $media->store('media', ['disk' => 'public']);
            $media = new Media();
            $media->path = $path;
            $media->type = 'image';
            $media->save();
            $stored = $media;
        }
        return $stored;
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('pages'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('pages/' . $fileName);
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";
            echo $response;
        }
    }
}
