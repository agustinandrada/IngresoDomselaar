<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    @include('modules.nav')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="container-fluid" style="margin-top: 42px;">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h1 style="font-family: Montserrat, sans-serif;font-size: 28px;font-weight: bold;">Agregar Propietario
                </h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('store-owner') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="margin-bottom: 25px;text-align: left;">
                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2"
                            style="display: inline;text-align: center;margin-bottom: 25px;">
                            <img class="rounded-circle mb-3 mt-4 img-fluid" src="assets/img/user.jpg"
                                style="display: inline;max-height: 110px;">
                            <br>
                            <button class="btn btn-primary btn-sm" id="photoBtn" type="button"
                                style="background: rgb(177,155,118);">Agregar Foto
                            </button>
                        </div>

                        <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                            <div class="row">
                                <div class="col-md-12 text-start">
                                    <div class="mb-3">
                                        <label class="form-label" for="email"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;">
                                            <strong>NOMBRE</strong>
                                        </label>
                                        <input class="form-control" type="text" name="name"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;">
                                    </div>
                                </div>
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label" for="username"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>APELLIDO</strong></label><input
                                            class="form-control" type="text" name="last_name"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-start">
                            <div class="mb-3"><label class="form-label" for="username"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>DNI</strong></label><input
                                    class="form-control" type="number" name="dni"></div>
                        </div>
                        <div class="col-md-6 text-start">
                            <div class="mb-3"><label class="form-label" for="username"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>LOTE</strong></label><input
                                    class="form-control" type="text" name="lot"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="first_name"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>EMAIL</strong></label><input
                                    class="form-control" type="email" name="email"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="last_name"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>TELEFONO</strong></label><input
                                    class="form-control" type="number" name="phone"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="country"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>VEHÍCULO
                                        MARCA</strong></label><input class="form-control" type="text" name="vehicle">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="city"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>MODELO</strong></label><input
                                    class="form-control" type="text" name="model"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="city"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>PATENTE</strong></label><input
                                    class="form-control" type="text" name="plate"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="address"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>COLOR</strong></label><input
                                    class="form-control" type="text" name="color"></div>
                        </div>
                        <div class="col">
                            <div class="mb-3"><label class="form-label" for="city"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>OBSERVACIONES</strong></label>
                                <textarea class="form-control" style="height: 130px;" name="observations"></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" id="submitBtn" name="submitBtn"
                        value="submitBtn" style="background: rgb(177,155,118);">Guardar</button>
                </form>
            </div>
        </div>
    </div>
    @include('modules.footer')
</body>

</html>
