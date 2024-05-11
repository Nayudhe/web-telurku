@extends('layouts.admin')

@section('body')

    <body class="bg-gradient-primary">
        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">

                                        <div class="mb-4">
                                            <div class="mb-4 d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="60" width="60"
                                                    fill="#4e73df"
                                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path
                                                        d="M192 496C86 496 0 394 0 288C0 176 64 16 192 16s192 160 192 272c0 106-86 208-192 208zM154.8 134c6.5-6 7-16.1 1-22.6s-16.1-7-22.6-1c-23.9 21.8-41.1 52.7-52.3 84.2C69.7 226.1 64 259.7 64 288c0 8.8 7.2 16 16 16s16-7.2 16-16c0-24.5 5-54.4 15.1-82.8c10.1-28.5 25-54.1 43.7-71.2z" />
                                                </svg>
                                            </div>

                                            <h2 class="text-center">Telurku - Admin</h2>
                                        </div>
                                        <hr>
                                        <div class="text-center mb-4 mt-4">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        <form class="user" method="POST" action="{{ route('Auth.Login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input required type="email" name="email"
                                                    class="form-control form-control-user @if ($errors->has('email')) is-invalid @endif"
                                                    value="{{ old('email') }}" id="inputEmail" aria-describedby="emailHelp"
                                                    placeholder="Email">
                                                @if ($errors->has('email'))
                                                    <div class="text-start px-4 mt-2 text-danger fw-semibold">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input required type="password" name="password"
                                                    class="form-control form-control-user @if ($errors->has('password')) is-invalid @endif"
                                                    value="{{ old('password') }}" id="inputPass" placeholder="Password">
                                                @if ($errors->has('password'))
                                                    <div class="text-start px-4 mt-2 text-danger fw-semibold">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <button type="submit" class="mt-4 btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </body>
@endsection
