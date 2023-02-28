@extends('../layouts/main')

@section('container')
    <link rel="stylesheet" href="/css/sign-in.css">

    <div class="row justify-content-center">
        <div class="col-lg-5">
            @if(session()->has('daftar'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('daftar') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! session('loginError') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <main class="form-signin w-100 m-auto">
                <form method="POST" action="/login">
                    @csrf
                    <div class="img-container">
                        <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                    </div>
                    <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>
                
                    <div class="form-floating">
                        <input value="{{ old('email') }}" name="email" required type="email" class="form-control @error('email') is-invalid @enderror" id="email" autofocus>
                        <label for="email">Email address</label>
                        @error('email')
                        <div class="invalid-feedback mb-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input name="password" type="password" class="form-control" id="password">
                        <label for="password">Password</label>
                    </div>
                    
                    <button class="w-100 my-3 btn btn-lg btn-primary" type="submit">Login</button>
                </form>

                <small class="d-flex justify-content-end">
                    Not register?&nbsp;<a href="/register">Register NOW!</a>
                </small>
            </main>
        </div>
    </div>

@endsection