@extends('layouts/main')

@section('container')

    @if($banyak>0)
        <?php $showName = 'true' ?>
        @foreach ($posts as $post)
            @if($post->author->name != $posts->first()->author->name)
                <?php $showName = 'false' ?>
            @endif
        @endforeach
        @if($showName == 'true')
            <h2 class="mb-3 text-center">Posts by {{ $posts[0]->author->name }}</h2>
        @elseif(isset($categorytitle))
            @if($categorytitle != '')
                <h2 class="mb-3 text-center">All Posts on {{ $categorytitle }}</h2>
            @endif
        @else
            <h2 class="mb-3 text-center">All Posts</h2>
        @endif

        {{-- Search --}}
        <div class="row mb-3 justify-content-center">
            <div class="col-md-6">
                <form action="/blog/search">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <div class="input-group mb-3">
                        <input value="{{ request("keyword") }}" type="text" name="keyword" class="form-control clearInput" placeholder="Tekan / untuk mencari" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-dark" type="submit" id="cari">Search</button>
                        <button class="btn btn-dark clearBtn" type="button">Clear</button>
                      </div>
                </form>
            </div>
        </div>
        {{-- End Search --}}

        <div class="card mb-5">
            <div style="height:300px; width:100%; overflow:hidden;" class="d-flex align-items-center justify-content-center">
                @if($posts[0]->image!=null)
                    <img src="{{ asset('storage/'.$posts[0]->image) }}" class="card-img-top" title="{{ $posts[0]->title }}" style="max-height:100%;max-width:100%;height:auto;width:auto;">
                @else
                    <img src="{{ asset('storage/gambar/null.png') }}" class="card-img-top" title="{{ $posts[0]->title }}" style="height:100px;width:100px;">
                @endif
            </div>
            
            <div class="card-body">
            <h3 class="card-title"><a href="/blog/post/{{ $posts[0]->slug }}" class="text-dark">{{ $posts[0]->title }}</a></h5>
            <p>
                <small>
                    By <a href="/blog?author={{ strtolower($posts[0]->author->username) }}">{{ $posts[0]->author->name }}</a> in category <a class="text-decoration-none" href="/blog?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a>
                    {{ $posts[0]->created_at->diffForHumans() }}
                </small>
            </p>
            <p class="card-text">{{ $posts[0]->excerpt }}</p>

            <a href="/blog/post/{{ $posts[0]->slug }}" class="btn btn-primary readmore">Readmore</a>
            </div>
        </div>
    
        <div class="container-fluid px-0">
            <div class="row d-flex align-items-stretch justify-content-center">
                @foreach ($posts->skip(1) as $post)
                <div class="col-md-4 my-3 d-flex align-items-stretch justify-content-center patch">
                    <div class="card bg-dark text-light" style="width:100%;">
                        <a href="/blog?category={{ $post->category->slug }}" class="position-absolute bg-dark text-light px-3 py-2 category-name">
                            <div>{{ $post->category->name }}</div>
                        </a>
                        
                        <div style="height:250px; width:100%; overflow:hidden;" class="d-flex align-items-center justify-content-center bg-white">
                            @if($post->image!=null)
                                <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" title="{{ $post->title }}" style="width:100%;height:auto;">
                            @else
                                <img src="{{ asset('storage/gambar/null.png') }}" class="card-img-top" title="{{ $post->title }}"  style="height:100px;width:100px;">
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column align-items-center justify-content-start" style="height: 250px;position:relative;">
                            <h3 style="height: 15% !important; overflow:hidden !important; ">
                                <a href="/blog/post/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a>
                            </h3>
                            
                            <p style="height: 10% !important; overflow:hidden !important;">
                                <small>
                                    By <a href="/blog?author={{ strtolower($post->author->username) }}">{{ $post->author->name }}</a> 
                                    {{ $post->created_at->diffForHumans() }}
                                </small>
                            </p>

                            <p style="height: 20% !important; overflow:hidden !important;">{{ $post->excerpt }}</p>
                            
                            <a href="/blog/post/{{ $post->slug }}" class="readmore text-white d-flex align-items-center justify-content-center" style="height:30%;width:80%; position:absolute; bottom:13px;">
                                <div class="readmore p-0 btn btn-primary " style="height:70%;width:100%;display:flex; align-items:center; justify-content:center;">
                                    Readmore
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="container-pagination">
            {{ $posts->links() }}
        </div>
    @else
        <h2 class="mb-3 text-center">Posts</h2>
        <div class="row mb-3 justify-content-center">
            <div class="col-md-6">
                <form action="/blog/search">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <div class="input-group mb-3">
                        <input value="{{ request("keyword") }}"  type="text" name="keyword" class="form-control clearInput" placeholder="Tekan / untuk mencari" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-dark" type="submit" id="cari2">Search</button>
                        <button class="btn btn-dark clearBtn" type="button">Clear</button>
                    </div>                                             
                </form>
            </div>
        </div>

        <p>No post found</p>
    @endif
    
    <script src="/js/script.js"></script>
@endsection