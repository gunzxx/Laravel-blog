@extends('dashboard.layouts.main')
<?php

// dd(auth()->user()->user_id);
// dd($posts);

?>
@section('container')
    <div class="container my-3">
        <?php $author = $post->author; $category = $post->category; ?>
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <h3 class="mb-3">{{ $post->title }}</h3>

                <div class="col-lg-8 d-flex">
                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge btn-warning" title="Edit">
                        <span data-feather="edit"></span>
                    </a>

                    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="ms-2">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure to delete?')" title="Delete">
                            <span data-feather="x-circle"></span>
                        </button>
                    </form>
                </div>

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
                
                <a href="/dashboard/posts" class="btn btn-success d-flex align-items-center my-4">
                    <span data-feather="arrow-left"></span>
                    Back
                </a>
            </div>
        </div>
    </div>
@endsection