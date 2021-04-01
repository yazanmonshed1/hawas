<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $tag = Tag::firstOrNew(['name' => $request->name]);
        if (!$tag->exists) {
            $tag->fill(['name' => $request->name])->save();
        }
        return response()->json([
            'id' => $tag->id,
            'text' => $tag->name,
        ]);
    }
}
