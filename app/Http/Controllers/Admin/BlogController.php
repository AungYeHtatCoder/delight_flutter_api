<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::with('users')->latest()->get();
        // return $blogs;
        return view('Admin.blogs.index', compact('blogs'));
    }

    public function create(){
        return view('Admin.blogs.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $filename = uniqid('blog') . '.' . $ext; // Generate a unique filename
        $image->move(public_path('assets/img/blogs/'), $filename);

        Blog::create([
            'title' => $request->title,
            'image' => $filename,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/admin/blogs/')->with('success', "Blog Created.");
    }

    public function view($id){
        $blog = Blog::withCount(['likes', 'comments'])->where('id', $id)->first();
        // return $blog;
        return view('Admin.blogs.view', compact('blog'));
    }

    public function edit($id){
        $blog = Blog::find($id);
        return view('Admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $blog = Blog::find($id);
        if(!$blog){
            return redirect()->back()->with('error', "Blog Not Found!");
        }
        if(!$request->file('image')){
            $blog->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }else{
            // Delete old image
            File::delete(public_path('assets/img/blogs/' . $blog->image));

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid('blog') . '.' . $ext; // Generate a unique filename
            $image->move(public_path('assets/img/blogs/'), $filename);

            $blog->update([
                'title' => $request->title,
                'image' => $filename,
                'description' => $request->description,
                'user_id' => Auth::user()->id
            ]);

        }
        return redirect('/admin/blogs/')->with('success', "Blog Updated.");
    }

    public function delete(Request $request){
        $id = $request->id;
        $blog = Blog::find($id);
        if(!$blog){
            return redirect()->back()->with('error', "Blog Not Found!");
        }
        Blog::destroy($id);
        return redirect('/admin/blogs/')->with('success', "Blog Removed.");
    }
}
