<?php

namespace App\Http\Controllers;

use App\Models\Posts;

class PostsController extends Controller
{
    public function index()
    {
        $categorytitle = '';

        $post = Posts::
            with([
                'category' => function($query){
                    $query
                    ->limit(10);
                },
                'author' => function($query){
                    $query
                    ->limit(10);
                }
                ])
            ->filter(request(['keyword','category','author']))->latest()->paginate(10)->withQueryString();
        
        $categorytitle .= Posts::cekTitle();
        $banyak = $post->count();
        
        if($banyak<=0){
            return view('blog',[
                "title"=>'Blog',
                'posts'=>[],
                'active'=>'posts',
                'banyak' => $banyak,
            ]);
        }else if($banyak>0){
            return view('blog',[
                "title"=>'Blog',
                'active'=>'posts',
                'posts'=> $post,
                'banyak' => $banyak,
                'categorytitle' => $categorytitle
            ]);
        }
    }

    public function single($slug)
    {
        $post = Posts::where('slug','=',$slug)->limit(1)->get();
        $banyak = $post->count();
        if($banyak>0){
            return view('post',[
                'title'=>'Single Post',
                'post'=>$post->first(),
                'active'=>'posts'
            ]);
        }
        else{
            return view('post',[
                'title'=>'Single Post'
            ]);
        }
    }
}
