<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Admin\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BannerResource;

class BannerApiController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return BannerResource::collection($banners);
    }

    public function show($id)
    {
        $banner = Banner::findOrFail($id);
        return new BannerResource($banner);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $banner = Banner::create($data);
        return new BannerResource($banner);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $banner = Banner::findOrFail($id);
        $banner->update($data);

        return new BannerResource($banner);
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return response()->json(['message' => 'Banner deleted'], 200);
    }
}