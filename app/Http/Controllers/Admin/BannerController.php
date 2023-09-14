<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index(){
        $banners = Banner::latest()->get();
        return view('Admin.banners.index', compact('banners'));
    }

    public function create(){
        return view('Admin.banners.create');
    }

    public function store(Request $request){
        $request->validate([
            'image' => 'required'
        ]);
        // image
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $filename = uniqid('banner') . '.' . $ext; // Generate a unique filename
        $image->move(public_path('assets/img/banners/'), $filename); // Save the file to the pub

        Banner::create([
            'image' => $filename
        ]);

        return redirect('/admin/banners/')->with('success', "Banner Created.");
    }

    public function view($id){
        $banner = Banner::find($id);
        return view('Admin.banners.view', compact('banner'));
    }

    public function edit($id){
        $banner = Banner::find($id);
        return view('Admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'image' => 'required'
        ]);

        $banner = Banner::find($id);
        if(!$banner){
            return redirect()->back()->with('error', "Banner Not Found!");
        }

        //image delelte
        File::delete(public_path('assets/img/banners/' . $banner->image));
        // image
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $filename = uniqid('banner') . '.' . $ext; // Generate a unique filename
        $image->move(public_path('assets/img/banners/'), $filename); // Save the file to the pub

        $banner->update([
            'image' => $filename
        ]);

        return redirect('/admin/banners/')->with('success', "Banner Updated.");
    }

    public function statusChange(Request $request, $id){
        $request->validate([
            'status' => 'required'
        ]);
        $banner = Banner::find($id);
        if(!$banner){
            return redirect()->back()->with('error', "Banner Not Found!");
        }
        $banner->update([
            'status' => $request->status
        ]);
        return redirect('/admin/banners/')->with('success', "Banner Status Updated.");
    }

    //delete
    public function delete(Request $request){
        $id = $request->id;
        $banner = Banner::find($id);
        if(!$banner){
            return redirect()->back()->with('error', "Banner Not Found!");
        }
        //image delelte
        File::delete(public_path('assets/img/banners/' . $banner->image));
        Banner::destroy($id);
        return redirect()->back()->with('success', 'Banner Removed.');
    }
}
