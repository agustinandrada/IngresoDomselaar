<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    @include('modules.nav')
    <div class="container">
        <section class="position-relative py-4 py-xl-5">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4" style="width: 100%;">
                        <div class="card mb-5">
                            <div class="card-body p-sm-5"
                                style="box-shadow: 0px 0px 0px;border: 1px solid rgb(177,155,118) ;">
                                <h2 class="text-center mb-4"
                                    style="font-family: Montserrat, sans-serif;font-weight: bold;font-size: 28px;">
                                    Contacto
                                    Soporte Tecnico</h2>
                                <form method="post">
                                    <div class="mb-3"><input class="form-control" type="text" id="name-2"
                                            name="name" placeholder="Usuario"
                                            style="font-family: Montserrat, sans-serif;color: var(--bs-emphasis-color);">
                                    </div>
                                    <div class="mb-3"><input class="form-control" type="email" id="email-2"
                                            name="email" placeholder="Email"
                                            style="color: var(--bs-emphasis-color);font-family: Montserrat, sans-serif;">
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" id="message-2" name="mensaje" rows="6" placeholder="Por favor describa el problema"
                                            style="font-family: Montserrat, sans-serif;color: var(--bs-emphasis-color);"></textarea>
                                    </div>
                                    <div><button class="btn btn-primary d-block w-100" type="submit"
                                            style="background: rgb(177,155,118);">Enviar</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('modules.footer')
    @include('layouts.bodyScripts')
</body>

</html>
