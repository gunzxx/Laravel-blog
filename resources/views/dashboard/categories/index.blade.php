{{-- {{ dd($categories) }} --}}
@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Posts Categories</h1>
    </div>

    <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Add category</a>

    @if(session()->has('sukses') )
        <p class="alert alert-success mb-3 alert-dismissible col-lg-6">{{ session('sukses'); }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </p>
    @endif

    <div class="table-responsive col-lg-6 mb-5">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Categori Name</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category['name'] }}</td>
                        <td style="display: flex; padding:10px;">
                            <a href="/dashboard/categories/{{ $category->slug }}" class="badge bg-info text-light" style="text-decoration:none;" title="Detail">
                                <span data-feather="eye"></span>
                            </a>
                            
                            <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge btn-warning ms-2" title="Edit">
                                <span data-feather="edit"></span>
                            </a>

                            <div class="col-lg-8 d-flex">
                                <form action="/dashboard/categories/{{ $category->slug }}" method="POST" class="ms-2">
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

    <div class="col-lg-8">
        {{ $categories->links() }}
    </div>
@endsection