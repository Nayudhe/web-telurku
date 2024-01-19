<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Telurku - Registrasi Akun</title>
</head>

<body>


    <!-- Section: Design Block -->
    <section class="">
        <!-- Jumbotron -->
        <div class="min-vh-100 d-flex align-items-center px-4 py-5 px-md-5 text-center text-lg-start"
            style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="p-3 rounded-circle bg-warning d-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" height="45" width="45" fill="#fff"
                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M192 496C86 496 0 394 0 288C0 176 64 16 192 16s192 160 192 272c0 106-86 208-192 208zM154.8 134c6.5-6 7-16.1 1-22.6s-16.1-7-22.6-1c-23.9 21.8-41.1 52.7-52.3 84.2C69.7 226.1 64 259.7 64 288c0 8.8 7.2 16 16 16s16-7.2 16-16c0-24.5 5-54.4 15.1-82.8c10.1-28.5 25-54.1 43.7-71.2z" />
                            </svg>
                        </div>
                        <h1 class="my-4 display-3 fw-bold ls-tight">
                            beli telur <br />
                            <span class="text-primary">dengan mudah</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Dengan website telurku, anda bisa membeli telur secara mudah dan praktis. Anda dapat memilih
                            berbagai macam jenis telur yang tersedia sesuai dengan kebutuhan anda!
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card shadow-lg rounded-4">
                            <div class="card-body py-5 px-md-5">
                                <form method="POST" action="{{ route('Auth.Register') }}">
                                    @csrf
                                    <h2 class="fw-bold mb-3">Registrasi</h2>

                                    <p class="mb-4" style="letter-spacing: .5px;">Isi form berikut untuk membuat akun
                                        baru.</p>
                                    <!-- 2 column grid layout with text inputs for the first and last names -->
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">
                                                <input name="first_name" type="text" id="inputFirstName"
                                                    class="form-control  @if ($errors->has('first_name')) is-invalid @endif"
                                                    value="{{ old('first_name') }}" placeholder="Nama depan" />
                                                <label class="form-label" for="inputFirstName">Nama depan</label>
                                                @if ($errors->has('first_name'))
                                                    <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                                                        {{ $errors->first('first_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">
                                                <input name="last_name" type="text" id="inputLastName"
                                                    class="form-control" value="{{ old('last_name') }}"
                                                    placeholder="Nama belakang" />
                                                <label class="form-label" for="inputLastName">Nama belakang</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email input -->
                                    <div class="form-floating mb-4">
                                        <input name="email" type="email" id="inputEmail"
                                            class="form-control @if ($errors->has('email')) is-invalid @endif"
                                            value="{{ old('email') }}" placeholder="Alamat Email" />
                                        <label class="form-label" for="inputEmail">Alamat Email</label>
                                        @if ($errors->has('email'))
                                            <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>


                                    <!-- Password input -->
                                    <div class="form-floating mb-4">
                                        <input name="password" type="password" id="inputPass"
                                            class="form-control  @if ($errors->has('password')) is-invalid @endif"
                                            value="{{ old('password') }}" placeholder="Password" />
                                        <label class="form-label" for="inputPass">Password</label>
                                        @if ($errors->has('password'))
                                            <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-floating mb-4">
                                        <input name="password_confirmation" type="password" id="inputPassConfirm"
                                            class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                            value="{{ old('password_confirmation') }}"
                                            placeholder="Konfirmasi Password" />
                                        <label class="form-label" for="inputPassConfirm">Konfirmasi Password</label>
                                        @if ($errors->has('password_confirmation'))
                                            <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                                                {{ $errors->first('password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4">
                                        Daftar
                                    </button>
                                    <p class="pb-lg-2 mb-0" style="color: #393f81;">Sudah punya akun? <a
                                            href="{{ route('Auth.LoginView') }}" style="color: #393f81;">Login
                                            di sini!</a></p>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
