<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Telurku - Reset Password</title>
</head>

<body>
    <section class="min-vh-100 d-flex align-items-center" style="background-color: #508bfc;">
        <div class="container py-5 px-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-6">
                    <div class="card shadow-lg" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf
                                        <div class="d-flex flex-column align-items-center">
                                            <h3 class="fw-bold mb-4">Reset Password</h3>
                                            <p class="fw-normal mb-2 pb-3 text-center" style="letter-spacing: .7px;">
                                                Isi form di bawah ini untuk melakukan reset password.</p>
                                        </div>

                                        <input type="hidden" value={{ $token }} name="token" readonly>
                                        <div class="form-floating mb-4">
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
                                        <button class="col btn btn-primary" type="submit">Submit</button>
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
