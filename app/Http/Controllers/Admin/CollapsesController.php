<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\Collapse;
use App\Models\TextBookPart;
use App\NadConsole\Models\Setting;
use App\NadConsole\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class CollapsesController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->nameSlug = 'collapses';
    }

    public function postSave($collapse, $data)
    {
        $media = json_decode($data['media']);
        $collapse->media()->sync($media);
        return $collapse;
    }

    public function postUpdate($collapse, $data)
    {
        $media = json_decode($data['media']);
        $collapse->media()->sync($media);
        return $collapse;
    }

    public function buildAboutUsForm(FormBuilder $fb)
    {
        $image = Setting::where(['name' => 'site.about_us_page_image'])->first()->value;
        $about_us_page_description = Setting::where(['name' => 'site.about_us_page_description'])->first()->value;
        $our_vision_about_us_page = Setting::where(['name' => 'site.our_vision_about_us_page'])->first()->value;
        $our_mission_about_us_page = Setting::where(['name' => 'site.our_mission_about_us_page'])->first()->value;
        $about_us_image_home_page = Setting::where(['name' => 'site.about_us_image_home_page'])->first()->value;
        $gallery = Setting::where(['name' => 'site.about_us_gallery'])->first()->value;

        $fb->media('site_about_us_gallery', ['label' => 'gallery', 'required' => true, 'rules' => 'required', 'multiple' => true, 'saveField' => 'id', 'ignored' => true, 'default' => $gallery]);

        $fb->media('site_about_us_page_image', ['label' => 'image', 'file_type' => 'image', 'required' => true, 'rules' => 'required', 'multiple' => false, 'saveField' => 'id', 'ignored' => true, 'default' => $image]);
        $fb->media('site_about_us_image_home_page', ['label' => 'video_in_homepage', 'file_type' => 'video', 'required' => true, 'rules' => 'required', 'multiple' => false, 'saveField' => 'id', 'default' => $about_us_image_home_page]);
        $fb->hidden('tabName', ['value' => 'site']);
        $fb->textarea('site.about_us_page_description', ['label' => 'description', 'required' => true, 'rules' => 'required', 'default' => $about_us_page_description]);
        $fb->textarea('site.our_vision_about_us_page', ['label' => 'our_vision', 'required' => true, 'rules' => 'required', 'default' => $our_vision_about_us_page]);
        $fb->textarea('site.our_mission_about_us_page', ['label' => 'our_mission', 'required' => true, 'rules' => 'required', 'default' => $our_mission_about_us_page]);

        $action = route('admin.about.update');

        return $fb->render($action);
    }

    public function updateAboutUsSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_about_us_page_image' => 'required',
            'site_about_us_page_description' => 'required',
            'site_our_vision_about_us_page' => 'required',
            'site_our_mission_about_us_page' => 'required',
            'site_about_us_image_home_page' => 'required'
        ]);

        if ($validator->fails()) {
            session()->flash('error_message', __('admin.please_fill_all_fields'));
            return redirect()->back();
        }
        $setting = Setting::where('name', 'site.about_us_gallery')->firstOrFail();
        $setting->value = json_decode($request->site_about_us_gallery);
        $setting->save();
        $setting = Setting::where('name', 'site.about_us_image_home_page')->firstOrFail();
        $setting->value = $request->site_about_us_image_home_page;
        $setting->save();
        $setting = Setting::where('name', 'site.about_us_page_image')->firstOrFail();
        $setting->value = $request->site_about_us_page_image;
        $setting->save();
        $setting = Setting::where('name', 'site.about_us_page_description')->firstOrFail();
        $setting->value = $request->site_about_us_page_description;
        $setting->save();
        $setting = Setting::where('name', 'site.our_vision_about_us_page')->firstOrFail();
        $setting->value = $request->site_our_vision_about_us_page;
        $setting->save();
        $setting = Setting::where('name', 'site.our_mission_about_us_page')->firstOrFail();
        $setting->value = $request->site_our_mission_about_us_page;
        $setting->save();

        Artisan::call('optimize:clear');

        session()->flash('success_message', __('admin.updated_successfully'));
        return redirect()->back();
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
            'routeSlug' => 'blogs',
            'data' => [
                'relationships' => [
                    'images' => 'media'
                ],
                'modelName' => 'Collapse',
                'searchCol' => 'title',
            ],
            'columns' => ['title', 'description', 'images'],
            'id' => 'about-us-collapses-datatable',
            'popup' => [
                'edit_form' => 'createForm',
                'create_form' => 'createForm',
                'update_action' => 'admin.about-us-collapses.update',
                'store_action' => 'admin.about-us-collapses.store',
            ]
        ];

        $form = $this->buildAboutUsForm($fb);

        $grid = Collapse::renderGrid($dataTableRequest);
        return view('admin.dashboard.about.index')->with([
            'nameSlug' => $this->nameSlug,
            'grid' => $grid,
            'form' => $form
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
        $form = Collapse::createForm($fb);
        return parent::store($request, $form);
    }

    public function createForPart(Request $request, FormBuilder $fb)
    {
        $part = TextBookPart::find($request->text_book_part_id);
        $form = Collapse::createForm($fb);
        $response = parent::store($request, $form);
        $responseData = $response->getData();
        if (isset($responseData->errors)) {
            return $response;
        }
        return response()->json([
            'html' => view('admin.text-books.components.part-collapses')->with('part', $part)->render(),
        ]);
    }

    public function updateForPart(Request $request, FormBuilder $fb, $id)
    {
        $part = TextBookPart::find($request->text_book_part_id);
        $form = Collapse::createForm($fb);
        parent::update($request, $form, $id);
        return response()->json([
            'html' => view('admin.text-books.components.part-collapses')->with('part', $part)->render(),
        ]);
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
        $form = Collapse::createForm($fb);
        return parent::update($request, $form, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collapse = Collapse::find($id);
        $collapse->delete();
        return response()->json([
            'html' => view('admin.text-books.components.part-collapses')->with('part', $collapse->part)->render(),
        ]);
    }
}
