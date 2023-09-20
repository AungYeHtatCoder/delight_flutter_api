<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Admin\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Http\Resources\Admin\BlogPostResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Support\Facades\File;

class BlogPostApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('blog_post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogPostResource(Blog::with(['users'])->get());
    }

    public function store(StoreBlogPostRequest $request)
    {
        // $blogPost = Blog::create($request->all());

        // if ($request->input('image', false)) {
        //     $blogPost->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        // }
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $filename = uniqid('blog') . '.' . $ext; // Generate a unique filename
        $image->move(public_path('assets/img/blogs/'), $filename);

       $blogPost = Blog::create([
            'title' => $request->title,
            'image' => $filename,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);

        return (new BlogPostResource($blogPost))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Blog $blogPost)
    {
        //abort_if(Gate::denies('blog_post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogPostResource($blogPost->load(['users']));
    }
    public function showDetail(Blog $blogPost)
    {
        //abort_if(Gate::denies('blog_post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogPostResource($blogPost->load(['users']));
    }

    public function update(Request $request, $id)
    {
        
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
        return (new BlogPostResource($blog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Blog $blogPost)
    {
        abort_if(Gate::denies('blog_post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogPost->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}