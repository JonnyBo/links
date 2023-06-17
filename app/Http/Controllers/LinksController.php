<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class LinksController extends Controller
{
    public function index() {
        return response()->json(['success' => Link::getLastSlugs()]);
    }

    public function store(Request $request) {
        try {
            $model = new Link();
            $model->link = $request->link;
            $model->slug = $model->getSlug();
            $model->save();
            return response()->json(['success' => Link::getLastSlugs()]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

}
