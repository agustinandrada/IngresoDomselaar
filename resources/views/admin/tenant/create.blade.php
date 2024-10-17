<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')
<script src="{{ asset('js/authorized.js') }}"></script>

<body>
    <div class="d-flex flex-column min-vh-100">
        @include('modules.nav')
        <div class="container-fluid" style="margin-top: 42px;">
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <h1 style="font-family: Montserrat, sans-serif;font-size: 28px;font-weight: bold;">Agregar Inquilino
                    </h1>
                    <button class="btn btn-primary" style="background: rgb(177,155,118); border-width: 0px" type="button"
                        onclick="window.history.back();"><i class="fas fa-arrow-left"></i>
                        Regresar</button>
                </div>
                @if (Session::has('errors'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('errors') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store-tenant') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="margin-bottom: 25px;text-align: left;">
                            <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center"
                                style="width: 100%;">
                                <div class="row">
                                    <div class="col-md-12 text-start">
                                        <div class="mb-3"><label class="form-label" for="email"
                                                style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>NOMBRE</strong></label><input
                                                class="form-control" type="text" name="name" required
                                                style="font-family: Montserrat, sans-serif;font-size: 13px;"></div>
                                    </div>
                                    <div class="col-md-12 text-start">
                                        <div class="mb-3"><label class="form-label" for="username"
                                                style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>APELLIDO</strong></label><input
                                                class="form-control" type="text" name="last_name" required></div>
                                    </div>
                                    <div class="col-md-12 col-xl-6 text-start">
                                        <div class="mb-3"><label class="form-label" for="username"
                                                style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>DNI</strong></label><input
                                                class="form-control" type="number" name="dni" required></div>
                                    </div>
                                    <div class="col"><label class="form-label" for="username"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>TELEFONO</strong></label><input
                                            class="form-control" type="number" name="phone" required></div>
                                </div>
                            </div>
                            <div class="col-md-6 text-start">
                                <div class="mb-3">
                                    <label class="form-label" for="owner"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>PROPIETARIO
                                            LOCADOR</strong>
                                    </label>
                                    <select class="form-select" name="owner" required id="owner">
                                        @foreach ($owners as $key => $value)
                                            <option value="{{ $value['id'] }}" data-lot="{{ $value['lot'] }}"
                                                {{ old('owner') == $value['id'] ? 'selected' : '' }} selected>
                                                {{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 text-start">
                                <div class="mb-3"><label class="form-label" for="lot"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>LOTE</strong></label>
                                    <input class="form-control" type="text" name="lot"
                                        value="{{ old('lot') }}" id="lot" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6 text-start">
                                <div class="mb-3"><label class="form-label" for="vehicle"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>VEHÍCULO
                                            MARCA</strong></label><input class="form-control" type="text"
                                        name="vehicle" required></div>
                            </div>
                            <div class="col-md-6 col-xl-2 text-start">
                                <div class="mb-3"><label class="form-label" for="model"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>MODELO</strong></label><input
                                        class="form-control" type="text" name="model" required></div>
                            </div>
                            <div class="col-md-6 col-xl-2">
                                <div class="mb-3"><label class="form-label" for="plate"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>PATENTE</strong></label><input
                                        class="form-control" type="text" name="plate" required></div>
                                <div class="mb-3">

                                </div>
                            </div>
                            <div class="col"><label class="form-label" for="color"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>COLOR</strong></label><input
                                    class="form-control" type="text" name="color" required>
                            </div>

                            <div class="col"><label class="form-label" for="since"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>INICIO DE
                                        ALQUILER</strong></label><input class="form-control" type="date"
                                    name="since"></div>
                            <div class="col"><label class="form-label" for="until"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>FINALIZACIÓN
                                        DE
                                        ALQUILER</strong></label><input class="form-control" type="date"
                                    name="until" required></div>
                            <div class="col-md-6 col-xl-12" style="width: 100%;">
                                <div class="mb-3"></div><label class="form-label" for="observations"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;margin-bottom: -4px;"><strong>OBSERVACIONES</strong></label>
                                <textarea class="form-control" style="height: 130px;width: 100%;" name="observations"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" id="submitBtn" name="submitBtn"
                            value="submitBtn" style="background: rgb(177,155,118);">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('modules.footer')
    @include('layouts.bodyScripts')
</body>

</html>
