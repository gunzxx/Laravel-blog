@extends('../layouts/main')

@section('container')
    <link rel="stylesheet" href="/css/sign-in.css">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <main class="form-registration w-100 m-auto">
                <form method="POST" action="/register">
                    @csrf
                    <div class="img-container">
                        <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                    </div>
                    <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
                
                    <div class="form-floating">
                        <input required value="{{ old('name') }}" type="text" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name">
                        <label for="name">Name : </label>
                        @error('name')
                        <div class="invalid-feedback mb-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input required value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username">
                        <label for="username">Username : </label>
                        @error('username')
                        <div class="invalid-feedback mb-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input required value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email">
                        <label for="email">Email : </label>
                        @error('email')
                        <div class="invalid-feedback mb-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input required value="{{ old('password') }}" type="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                        <label for="password">Password :</label>
                        @error('password')
                        <div class="invalid-feedback mb-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button class="w-100 my-3 btn btn-lg btn-primary" type="submit">Register</button>
                </form>

                <small class="d-flex justify-content-end">
                    All ready register? &nbsp;<a href="/login">Login</a>
                </small>
            </main>
        </div>
    </div>

@endsection