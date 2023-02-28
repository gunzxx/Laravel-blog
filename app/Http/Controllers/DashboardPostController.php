<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use WithFileUploads;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->user_id;
        $posts = Posts::where('user_id','=',$id)
        ->latest()
        ->with('category',fn($q)=>$q->limit(25))
        ->paginate(25);
        return view('dashboard.posts.index',[
            'posts'=>$posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::get(['name','category_id']);
        return view('dashboard.posts.create',[
            'categories'=>$categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|max:255|unique:posts',
            'category_id'=>'required',
            'image'=>'image|file|max:1024',
            'content'=>'required',
        ]);
        
        if($request->file('image'))
        {
            $validatedData['image'] = $request->file('image')->store('gambar');
        }
        
        $validatedData['user_id']=auth()->user()->user_id;
        $validatedData['excerpt']=Str::limit(strip_tags($validatedData['content']),100);
        
        dd($validatedData);
        
        // Posts::create($validatedData);
        // return redirect('/dashboard/posts')->with('sukses','Data has been added') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $post)
    {
        if($post->user_id != auth()->user()->user_id)
        {
            return abort(403);
        }
        
        return view('dashboard.posts.post',[
            'post'=>$post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        if($post->user_id != auth()->user()->user_id)
        {
            return abort(403);
        }

        $categories = Categories::get(['name','category_id']);
        return view('dashboard.posts.edit',[
            'post'=>$post,
            'categories'=>$categories,
            'category'=>Categories::where('category_id','=',$post->category_id)->get(['name','category_id'])->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $post)
    {
        if($post->user_id != auth()->user()->user_id)
        {
            return abort(403);
        }

        $rules = ([
            'title'=>'required|max:255',
            'category_id'=>'required',
            'image'=>'image|file|max:1024',
            'content'=>'required',
        ]);

        if($request->slug != $post->slug){
            $rules['slug']='required|unique:posts';
        }
        
        $validatedData = $request->validate($rules);
        
        if($request->file('image'))
        {
            $rules['image']='image|file|max:1024';
            if($request->oldImg){
                Storage::delete($request->oldImg);
            }
            $validatedData['image'] = $request->file('image')->store('gambar');
        }

        $validatedData['user_id']=auth()->user()->user_id;
        $validatedData['excerpt']=Str::limit(strip_tags($validatedData['content']),100);
        
        Posts::where('post_id',$post->post_id)
        ->update($validatedData);
        return redirect('/dashboard/posts')->with('sukses','Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        if($post->user_id != auth()->user()->user_id)
        {
            return abort(403);
        }
        if($post->image){
            Storage::delete($post->image);
        }
        Posts::destroy($post->post_id);
        return redirect('/dashboard/posts')->with('sukses','Data has been delete') ;
    }

    // public function checkSlug(Request $request)
    // {
    //     $slug = SlugService::createSlug(Posts::class, 'slug', $request->title);
        
    //     return response()->json(['slug' => $slug]);
    // }
}
