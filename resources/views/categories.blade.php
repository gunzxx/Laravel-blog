@extends('layouts/main')

@section('container')

    @if($categories->count())
        <h1>{{ $title }}</h1>

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

        <div class="container" style="width:100%;">
            <div class="row category-container position-relative">
                @foreach ($categories as $category)
                <div class="d-flex my-3 categorys position-relative">
                    <a href="/blog?category={{ $category->slug }}" style="width: 100%;height:100%;">
                        <div class="card bg-dark text-white p-0" style="width: 100%;height:100%;">
                            <img src="{{ asset('storage/gambar/'.$category->slug.'.jpeg') }}"class="card-img" title="{{ $category->slug }}"  style="height:100%; width:100%;">
                            <div style="background-color: rgba(0, 0, 0, .5)" class="card-img-overlay d-flex justify-content-center align-items-center">
                                <h5 class="card-title">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
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
        <p>Kategori kosong.</p>
    @endif
@endsection

