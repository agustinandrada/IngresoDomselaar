<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    <div class="d-flex flex-column min-vh-100">
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
                    <h1 style="font-family: Montserrat, sans-serif;font-size: 28px;font-weight: bold;">
                        {{ $visitor->name }} {{ $visitor->last_name }}
                    </h1>
                    <button class="btn btn-primary" style="background: rgb(177,155,118); border-width: 0px"
                        type="button" onclick="window.history.back();"><i class="fas fa-arrow-left"></i>
                        Regresar</button>
                </div>
                <div class="card-body">
                    <div class="row" style="margin-bottom: 25px;text-align: left;">
                        <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                            <div class="row">
                                <div class="col-md-12 text-start">
                                    <div class="mb-3">
                                        <label class="form-label" for="email"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;">
                                            <strong>NOMBRE</strong>
                                        </label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $visitor->name }}" style="font-family: Montserrat, sans-serif;"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label" for="username"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>APELLIDO</strong></label><input
                                            class="form-control" type="text" name="last_name"
                                            value="{{ $visitor->last_name }}" readonly></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-start">
                            <div class="mb-3"><label class="form-label" for="username"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>DNI</strong></label><input
                                    class="form-control" type="number" name="dni" value="{{ $visitor->dni }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6 text-start">
                            <div class="mb-3"><label class="form-label" for="username"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>LOTE</strong></label><input
                                    class="form-control" type="text" name="lot" value="{{ $visitor->lot }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="country"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>VEHÍCULO
                                        MARCA</strong></label><input class="form-control" type="text" name="vehicle"
                                    value="{{ $visitor->vehicle }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="city"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>MODELO</strong></label><input
                                    class="form-control" type="text" name="model" value="{{ $visitor->carModel }}"
                                    readonly></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="city"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>PATENTE</strong></label><input
                                    class="form-control" type="text" name="plate" value="{{ $visitor->plate }}"
                                    readonly></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="address"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>COLOR</strong></label><input
                                    class="form-control" type="text" name="color" value="{{ $visitor->color }}"
                                    readonly></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="address"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>INICIO DE
                                        VISITA</strong></label><input class="form-control" type="text"
                                    name="color" value="{{ $visitor->since }}" readonly></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="address"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>FINALIZACIÓN
                                        DE VISITA</strong></label><input class="form-control" type="text"
                                    name="color" value="{{ $visitor->until }}" readonly></div>
                        </div>
                        <div class="col">
                            <div class="mb-3"><label class="form-label" for="city"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>OBSERVACIONES</strong></label>
                                <textarea class="form-control" style="height: 130px;" name="observation" readonly>{{ $visitor->observation }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modules.footer')
    @include('layouts.bodyScripts')
</body>

</html>
