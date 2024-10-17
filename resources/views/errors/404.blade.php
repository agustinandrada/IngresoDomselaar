<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center"
                    style="font-family: Montserrat, sans-serif;font-weight: bold;font-size: 53.88px;margin-top: 45px;">
                    Error
                    404</h1>
                <p
                    style="font-family: Roboto, sans-serif;font-weight: bold;color: var(--bs-emphasis-color);font-size: 25px;text-align: center;">
                    No
                    se encontró el vinculo solicitado</p><a
                    class="d-flex d-lg-flex justify-content-center align-items-center mx-auto justify-content-lg-center"
                    href="/estancias/login"
                    style="text-align: center;color: var(--bs-emphasis-color);font-weight: bold;">VOLVER</a>
            </div>
        </div>
        <div class="row">
            <div class="col text-center mx-auto"><img class="img-fluid mx-auto" src="{{ asset('img/404.jpg') }}"
                    style="width: 426px;"></div>
        </div>
    </div>
    @include('layouts.bodyScripts')
</body>

</html>
