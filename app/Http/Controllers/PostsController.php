<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\PostImage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin',['except' => ['show', 'post']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->flash();
        $keyword = $request->get('search');
        $location = $request->input('location');
        $perPage = 15;

        if (!empty($keyword)) {
            $posts = Post::where('title', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        // }elseif (!empty($location)) {
        //     $posts = Post::where('location_id', $location)->latest()->paginate($perPage);
        }else {
            $posts = Post::latest()->paginate($perPage);
        }

        // $posts = Post::paginate($perPage);

        return view('manage.posts.index', compact('posts'));
    }

    public function posts(Request $request, Post $posts)
    {
        $keyword = $request->get('search');
        // $date = $request->input('end_date');
        $location = $request->input('location');
        // $to = $request->input('to');
        
        $perPage = 15;

        if (!empty($location)) {
            $posts = Post::sortable()->where('location', 'LIKE', "%$location%")
                ->open()->latest()->paginate($perPage);
        }else {
            $posts = Post::open()->sortable()->latest()->paginate($perPage);
        }
        
        return view('posts.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // auth()->user()->posts()->create($request->all());

        $post = new Post();

        if ($request->has('image'))
        {
            $filename = $request->image->getClientOriginalName();

            $post_image = $request->image->storeAs('images/posts', $filename, 'public');
            $post->img = $filename;
            // dd($post_image);
            $image = Image::make(public_path('storage/'.$post_image))->fit(1280, 720);
            $image->save();

            // 1:1
            // $image_1_1 = Image::make(public_path('storage/'.$post_image.'ratio1:1'))->fit(1080, 1080);
            // $image_1_1->save();

            // 4:3
            // $image_4_3 = Image::make(public_path('storage/'.$post_image.'ratio4:3'))->fit(1024, 768);
            // $image_4_3->save();

        }

        $post->user_id = auth()->user()->id;
        $post->location_id = $request->location_id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->keywords = $request->keywords;
        // $post->slug = Str::slug($request->name, '-');
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->published = $request->published;

        $post->save();

        if ($request->has('post_multiple_images'))
        {
            foreach ($request->file('post_multiple_images') as $file) {
                $postImage = new PostImage;
                $postImage->post_id = $post->id;

                $name = $file->getClientOriginalName();
                $post_postImage = $file->storeAs('images/posts/'.$post->id, $name, 'public');
                
                $postImage->file_name = $name;
                $postImage->type = $file->extension();
                $postImage->size = $file->getSize();
    
                $postImage->save();
            }
        }

        return redirect('administration/content/posts/'.$post->id.'/edit')->with('flash_message', __('Post added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post_id = Post::value('id');

        return view('manage.posts.show', compact('post')); 
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('pages.post', compact('post')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->flash();

        $post = Post::findOrFail($id);

        return view('manage.posts.edit', compact('post')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            if ($post->img)
            {
                Storage::delete('/public/images/posts/' . $post->img);
            }
            $post_image = $request->image->storeAs('images/posts', $filename, 'public');
            $post->img = $filename;

            $image = Image::make(public_path('storage/'.$post_image))->fit(1200, 800);
            $image->save();

        }

        if ($request->has('post_multiple_images'))
        {
            foreach ($request->file('post_multiple_images') as $file) {
                $postImage = new PostImage;
                $postImage->post_id = $post->id;
    
                $name = $file->getClientOriginalName();
                $post_postImage = $file->storeAs('images/posts/'.$post->id, $name, 'public');
                
                $postImage->file_name = $name;
                $postImage->type = $file->extension();
                $postImage->size = $file->getSize();
    
                $postImage->save();
            }
        }

        $post->location_id = $request->location_id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->keywords = $request->keywords;
        // $post->slug = Str::slug($request->name, '-');
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->published = $request->published;

        $post->save();

        return back()->with('flash_message', __('Post updated'));
        // return redirect('administration/posts')->with('flash_message', __('Post updated'));
    }

    public function deleteImage($id)
    {
        PostImage::findOrFail($id)->delete();

        return back()->with('flash_message', 'Imagen deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return back()->with('flash_message', 'Post deleted!');
    }
}
