<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    @include('modules.nav')
    <div class="container-fluid" style="margin-top: 42px;">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h1 style="font-family: Montserrat, sans-serif;font-weight: bold;">PROPIETARIO<br>DNI:
                    {{ $owner->dni }}</h1>
                <button class="btn btn-primary" style="background: rgb(177,155,118); border-width: 0px" type="button"
                    onclick="window.history.back();"><i class="fas fa-arrow-left"></i>
                    Regresar</button>
            </div>
            <div class="card-body">
                <form action="{{ route('entry-store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="owner">
                    <input type="hidden" name="dni" value="{{ $owner->dni }}">

                    <div class="row" style="margin-bottom: 25px;text-align: left;">
                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2"
                            style="display: inline;text-align: center;margin-bottom: 25px;"><img
                                class="rounded-circle mb-3 mt-4 img-fluid"
                                src="{{ $owner->photo ?? asset('img/user.jpg') }}"
                                style="display: inline;max-height: 110px;"><br></div>
                        <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                            <div class="row">
                                <div class="col"><label class="form-label" for="name"
                                        style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>NOMBRE</strong></label>
                                    <p>{{ $owner->name }}</p>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="last_name"
                                            style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>APELLIDO</strong></label>
                                        <p>{{ $owner->last_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-start">
                            <div class="mb-3"><label class="form-label" for="dni"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>DNI</strong></label>
                                <p>{{ $owner->dni }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-start">
                            <div class="mb-3"><label class="form-label" for="lot"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>LOTE</strong></label>
                                <p>{{ $owner->lot }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="vehicle"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>VEHÍCULO
                                        MARCA</strong></label>
                                <input type="text" class="form-control" name="vehicle" value="{{ $owner->vehicle }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="model"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>MODELO</strong></label>
                                <input type="text" class="form-control" name="model" value="{{ $owner->model }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="plate"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>PATENTE</strong></label>
                                <input type="text" class="form-control" name="plate" value="{{ $owner->plate }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="color"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>COLOR</strong></label>
                                <input type="text" class="form-control" name="color" value="{{ $owner->color }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label" for="patente"
                                style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>REGISTRO</strong></label><select
                                class="form-select" style="margin-bottom: 19px;" name="entry" required>
                                @if ($lastEntry == 'Ingreso')
                                    <option value="1" selected="">Salida</option>
                                @else
                                    <option value="0" selected="">Ingreso</option>
                                @endif

                            </select>
                            @foreach ($authorizeds as $key => $authorized)
                                <div class="form-check mx-auto">
                                    <input class="form-check-input" type="checkbox" id="formCheck-1"
                                        name='with-{{ $key }}' value="{{ $authorized->id }}">
                                    <label class="form-check-label" for="formCheck-1">{{ $authorized->name }}
                                        {{ $authorized->last_name }} - {{ $authorized->dni }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col"><label class="form-label" for="patente"
                                style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>FECHA</strong></label>
                            <?php
                            $date = new DateTime();
                            $hour = $date->format('H:i');
                            ?>
                            <input type="date" name="date" class="form-control" id="date"
                                value="{{ $date->format('Y-m-d') }}" readonly>
                        </div>
                        <div class="col"><label class="form-label" for="patente"
                                style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>HORA</strong></label>
                            <input type="time" name="hour" class="form-control" id="hour"
                                value="{{ $hour }}" readonly>
                        </div>
                        <div class="col-md-6 col-xl-12" style="margin-top: 26px;"><label class="form-label"
                                for="patente"
                                style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>Observaciones</strong></label>
                            <textarea class="form-control" style="height: 124px;" name="observations"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" style="background: #b19b76;">Guardar
                        Registro</button>
                </form>
            </div>
        </div>
    </div>
    @include('modules.footer')
    @include('layouts.bodyScripts')
</body>

</html>
