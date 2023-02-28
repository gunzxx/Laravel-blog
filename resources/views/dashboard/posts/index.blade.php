@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h1">My Posts</h1>
    </div>

    <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new posts</a>

    @if(session()->has('sukses') )
        <p class="alert alert-success mb-3 alert-dismissible col-lg-8">{{ session('sukses'); }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </p>
    @endif

    <div class="table-responsive col-lg-8 mb-5">
        <table class="table table-striped table-sm" style="height:100%;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post->category['name'] }}</td>
                        <td style="display: flex; height:100%; overflow:hidden;" class="align-items-center justify-content-center">
                            <a href="/dashboard/posts/{{ $post->slug }}" style="height: 25px;" class="d-flex align-items-center justify-content-center badge bg-info" title="Detail">
                                <span data-feather="eye"></span>
                            </a>
                            
                            <a href="/dashboard/posts/{{ $post->slug }}/edit" style="height: 25px;" class="d-flex align-items-center justify-content-center badge btn-warning ms-2" title="Edit">
                                <span data-feather="edit"></span>
                            </a>

                            <div class="d-flex align-items-center justify-content-center">
                                <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="ms-2">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure to delete?')" title="Delete">
                                        <span data-feather="x-circle"></span>
                                    </button>
                                </form>
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container-pagination">
        {{ $posts->links() }}
    </div>
@endsection