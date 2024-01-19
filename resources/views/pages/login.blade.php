<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Telurku - Login</title>
</head>

<body>
    <section class="min-vh-100 d-flex align-items-center" style="background-color: #508bfc;">
        <div class="container py-5 px-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow-lg" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block ">
                                <img src="https://images.unsplash.com/photo-1590005031487-03c7f56ef7d3?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="login form"
                                    style="height: 100%; width: 100%; object-fit: cover; border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form method="POST" action="{{ route('Auth.Login') }}">
                                        @csrf
                                        <div class="d-flex flex-column align-items-center align-items-lg-start">

                                            <div class="mb-3 p-3 rounded-circle bg-warning d-inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="45" width="45"
                                                    fill="#fff"
                                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path
                                                        d="M192 496C86 496 0 394 0 288C0 176 64 16 192 16s192 160 192 272c0 106-86 208-192 208zM154.8 134c6.5-6 7-16.1 1-22.6s-16.1-7-22.6-1c-23.9 21.8-41.1 52.7-52.3 84.2C69.7 226.1 64 259.7 64 288c0 8.8 7.2 16 16 16s16-7.2 16-16c0-24.5 5-54.4 15.1-82.8c10.1-28.5 25-54.1 43.7-71.2z" />
                                                </svg>
                                            </div>
                                            <h1 class="fw-bold mb-3">Login</h1>
                                            <p class="fw-normal mb-2 pb-3" style="letter-spacing: 1px;">Masuk ke dalam
                                                akun
                                                anda.</p>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input name="email" type="email" id="inputEmail"
                                                class="form-control @if ($errors->has('email')) is-invalid @endif"
                                                value="{{ old('email') }}" placeholder="nama@email.com" />
                                            <label class="form-label" for="inputEmail">Alamat Email</label>
                                            @if ($errors->has('email'))
                                                <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-floating mb-4">
                                            <input name="password" type="password" id="inputPass"
                                                class="form-control @if ($errors->has('password')) is-invalid @endif"
                                                value="{{ old('password') }}" placeholder="password anda" />
                                            <label class="form-label" for="inputPass">Password</label>
                                            @if ($errors->has('password'))
                                                <div class="text-start ms-2 mt-2 text-danger fw-semibold">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-primary btn-block" type="submit">Login</button>
                                        </div>

                                        <p class="pb-lg-2 mb-0" style="color: #393f81;">Belum punya akun? <a
                                                href="{{ route('Auth.RegisterView') }}" style="color: #393f81;">Daftar
                                                di sini!</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
