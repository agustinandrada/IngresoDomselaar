<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-warning" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <section class="register-photo" style="background-color: transparent;padding-top: 0px;">
        <div class="form-container" style="margin-top: 40px;">
            <div class="image-holder"
                style="background: url({{ asset('img/login-estancias.jpg') }}) left / cover no-repeat;"></div>
            <form method="post" style="height: 525px;" action="{{ route('login') }}">
                @csrf
                <h2 class="text-center" style="margin-top: 9px;">Control de Ingreso</h2>
                <div class="form-group mb-3"><input class="form-control" type="text" name="user"
                        placeholder="Usuario">
                    @error('user')
                        <div class="text-danger h6"><em>{{ $message }}</em></div>
                    @enderror
                </div>

                <div class="form-group mb-3"><input class="form-control" type="password" id="password" name="password"
                        placeholder="Contraseña">
                    @error('password')
                        <div class="text-danger h6"><em>{{ $message }}</em></div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    @if (session('error'))
                        <div class="text-danger h6">
                            <em>{{ session('error') }}</em>
                        </div>
                    @endif
                </div>

                <p style="font-size: 14px;"><a href="{{ route('password.request') }}">Olvide mi Contraseña</a></p>

                <div class="form-group mb-3">
                    <button class="btn btn-primary d-block w-100" role="button" id="submitButton" type="submit"
                        style="color: rgb(255,255,255);background: #b19b76;">Ingresar</button>
                </div>

                <p style="font-family: Montserrat, sans-serif;font-size: 11px;text-align: center;">
                    <img class="img-fluid" src="{{ asset('img/favicon.png') }}" style="width: 25px;">Desarrollo: <a
                        href="https://www.argdg.com" target="_blank">ArgDG.com</a>
                </p>
            </form>
        </div>
    </section>
    @include('layouts.bodyScripts')
</body>

</html>
