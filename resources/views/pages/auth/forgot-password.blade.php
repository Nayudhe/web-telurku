<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Telurku - Lupa Password</title>
</head>

<body>
    <section class="min-vh-100 d-flex align-items-center" style="background-color: #508bfc;">
        <div class="container py-5 px-4 h-100">
            @if ($status)
                <div class="alert alert-success">
                    {{ $status }}
                </div>
            @endif
            @if ($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-6">
                    <div class="card shadow-lg" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form method="POST" action="{{ route('Auth.ForgotPassword') }}">
                                        @csrf
                                        <div class="d-flex flex-column align-items-center">
                                            <h3 class="fw-bold mb-4">Lupa Password</h3>
                                            <p class="fw-normal mb-2 pb-3 text-center" style="letter-spacing: 1px;">
                                                Masukkan alamat
                                                email anda untuk menerima link reset password.</p>
                                        </div>

                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-floating">
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
                                            </div>

                                            <button class="col btn btn-primary" type="submit">Submit</button>
                                        </div>
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
