<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    @include('modules.nav')
    <div class="container-fluid" style="margin-top: 42px;">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h1 style="font-family: Montserrat, sans-serif;font-weight: bold;">INQUILINO<br>DNI: {{ $tenant->dni }}
                </h1>
                <button class="btn btn-primary" style="background: rgb(177,155,118); border-width: 0px" type="button"
                    onclick="window.history.back();"><i class="fas fa-arrow-left"></i>
                    Regresar</button>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('entry-store') }}">
                    @csrf
                    <input type="hidden" name="type" value="tenant">
                    <input type="hidden" name="dni" value="{{ $tenant->dni }}">

                    <div class="row" style="margin-bottom: 25px;text-align: left;">
                        <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                            <div class="row">
                                <div class="col"><label class="form-label" for="name"
                                        style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>NOMBRE</strong></label>
                                    <p>{{ $tenant->name }}</p>
                                </div>
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="last_name"
                                            style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>APELLIDO</strong></label>
                                        <p>{{ $tenant->last_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-start">
                            <div class="mb-3"><label class="form-label" for="dni"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>DNI</strong></label>
                                <p>{{ $tenant->dni }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-start">
                            <div class="mb-3"><label class="form-label" for="lot"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>LOTE</strong></label>
                                <p>{{ $tenant->lot }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="vehicle"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>VEHÍCULO
                                        MARCA</strong></label>
                                <p>{{ $tenant->vehicle }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="model"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>MODELO</strong></label>
                                <p>{{ $tenant->carModel }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="plate"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>PATENTE</strong></label>
                                <p>{{ $tenant->plate }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="color"
                                    style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>COLOR</strong></label>
                                <p>{{ $tenant->color }}</p>
                            </div>
                        </div>
                        <div class="col-xl-6"><label class="form-label" for="patente"
                                style="font-family: Montserrat, sans-serif;font-size: 14px;"><strong>REGISTRO</strong></label><select
                                class="form-select" style="margin-bottom: 19px;" name="entry" required>
                                @if ($lastEntry == 'Ingreso')
                                    <option value="1" selected="">Salida</option>
                                @else
                                    <option value="0" selected="">Ingreso</option>
                                @endif

                            </select>
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
