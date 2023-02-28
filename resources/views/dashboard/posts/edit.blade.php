<head>
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"]{
            display: none;
        }
    </style>
</head>
@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h1">Edit post</h2>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/posts/{{ $post->slug }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" autofocus required value="{{ old('title',$post->title) }}">
                @error('title')
                    <div class="invalid-feedback mb-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" readonly required value="{{ old('slug',$post->slug) }}">
                @error('slug')
                    <div class="invalid-feedback mb-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category_id">
                    @foreach($categories as $category2)
                        <option value="{{ $category2->category_id }}" {{ $category->category_id == $category2->category_id ? 'selected':'' }}>{{ $category2->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="oldImg" value="{{ $post->image }}">
            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                @if($post->image != null)
                    <img src="{{ asset('storage/'.$post->image) }}" alt="" class="img-preview img-fluid col-sm-5 d-block" id="imgP">
                @else
                    <img src="" alt="" class="img-preview img-fluid" id="imgP">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback mb-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                @error('content')
                    <p class="alert alert-danger mb-3 alert-dismissible">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </p>
                @enderror
                <input type="hidden" name="content" class="form-control" id="content" required  value="{{ old('title',$post->content)}}">
                <trix-editor input="content"></trix-editor>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="/js/abc.js"></script>
    <script>
        // Slug
        let tilte = document.getElementById('title');
        let slug = document.getElementById('slug');
        
        title.addEventListener("keyup", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g,"-");
            preslug = preslug.toLowerCase();
            slug.value = cekHurufkata(preslug);
        });

        // title.addEventListener('change',function(e){
        //     nilai = title.value;
        //     if(nilai == '' || nilai == null || nilai == undefined)
        //     {
        //         slug.value = "";
        //     }
        //     else{
        //         fetch('/dashboard/posts/checkSlug?title='+ nilai)
        //             .then(response => response.json())
        //             .then(data => slug.value = data.slug)
        //     }
        // });


        // Trix editor file upload
        document.addEventListener('trix-file-accept',(e)=>{e.preventDefault()})


        // Preview image
        function previewImage()
        {
            let image = document.getElementById('image')
            let imgP = document.getElementById('imgP')
            
            imgP.style.display = 'block';

            const fReader = new FileReader();
            fReader.readAsDataURL(image.files[0])
            
            // console.log(fReader.readAsDataURL(image.files));

            fReader.onload = function(e){
                imgP.src = e.target.result;
                if(imgP.classList.contains('col-sm-5')){
                    imgP.classList.remove('col-sm-5');
                }
                imgP.classList.add('col-sm-5');
            }
        }
    </script>
@endsection