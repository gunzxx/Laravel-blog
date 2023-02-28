@extends('layouts.main')

@section('container')
    @if (isset($post))
    <?php $author = $post->author; $category = $post->category; ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3 class="mb-4">{{ $post->title }}</h3>
        
                    <p>By <a href="/blog?author={{ strtolower($author->username) }}">{{ $author->name }}</a> in category <a href="/blog?category={{ $category->slug }}">{{ $category->name }}</a></p>
                    
                    <div style="height: 150px;width:100%;overflow:hidden;" class="d-flex my-2 align-items-stretch justify-content-center">
                        @if($post->image!=null)
                        <img style="height: auto;width:auto;" src="{{ asset('storage/'.$post->image) }}" class="card-img-top my-3" title="{{ $post->title }}">
                        @else
                        <img style="height: 100px;width:100px;" src="{{ asset('storage/gambar/null.png') }}" class="card-img-top my-3" title="{{ $post->title }}">
                        @endif
                    </div>
                    
                    <article>
                        {!! $post->content !!}
                    </article>
                    <a class="mt-5" href="/blog">Back to blog</a>
                </div>
            </div>
        </div>
    @else
        <p>Postingan tidak ditemukan.</p>
    @endif

    <br>
    
@endsection
