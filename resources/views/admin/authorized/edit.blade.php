<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')
<script src="{{ asset('js/profilePhoto.js') }}"></script>

<body>
    <div class="d-flex flex-column min-vh-100">
        @include('modules.nav')
        @if (Session::has('errors'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('errors') }}
            </div>
        @endif
        <div class="container-fluid" style="margin-top: 42px;">
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <h1 style="font-family: Montserrat, sans-serif;font-size: 28px;font-weight: bold;">Editar
                        Autorizado Permanente</h1>
                    <button class="btn btn-primary" style="background: rgb(177,155,118); border-width: 0px"
                        type="button" onclick="window.history.back();"><i class="fas fa-arrow-left"></i>
                        Regresar</button>
                </div>
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
                    <form method="POST" action="{{ route('update-authorized', $authorized->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="margin-bottom: 25px;text-align: left;">
                            <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2"
                                style="display: inline;text-align: center;margin-bottom: 25px;">
                                <img id="profileImage" class="rounded-circle mb-3 mt-4 img-fluid"
                                    src="{{ asset($authorized->photo) === asset('/') ? asset('img/user.jpg') : asset($authorized->photo) }}"
                                    style="display: inline;max-height: 110px;">
                                <br>
                                <label for="photoInput" class="btn btn-primary btn-sm"
                                    style="background: #b19b76;border-width: 0px;">
                                    Cambiar Foto
                                </label>
                                <input type="file" id="photoInput" name="photo" style="display: none;"
                                    accept="image/*" onchange="onLoad(event)">
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
                                                style="font-family: Montserrat, sans-serif;"
                                                value="{{ $authorized->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-start">
                                        <div class="mb-3"><label class="form-label" for="username"
                                                style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>APELLIDO</strong></label><input
                                                class="form-control" type="text" name="last_name"
                                                value="{{ $authorized->last_name }}" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-start">
                                <div class="mb-3"><label class="form-label" for="username"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>DNI</strong></label><input
                                        class="form-control" type="number" name="dni"
                                        value="{{ $authorized->dni }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 text-start">
                                <div class="mb-3"><label class="form-label" for="first_name"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>EMAIL</strong></label><input
                                        class="form-control" type="email" name="email" required
                                        value="{{ $authorized->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label" for="username"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>PERSONA
                                            AUTORIZADA
                                            DE</strong></label>
                                    <select class="form-select" name="owner" required id="owner">
                                        @foreach ($owners as $key => $value)
                                            <option value="{{ $value['id'] }}" data-lot="{{ $value['lot'] }}"
                                                {{ $authorized->owner == $value['id'] ? 'selected' : '' }} selected>
                                                {{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label" for="username"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>LOTE</strong></label><input
                                        class="form-control" type="text" name="lot"
                                        value="{{ $authorized->lot }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label" for="country"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>VEHÍCULO
                                            MARCA</strong></label><input class="form-control" type="text"
                                        name="vehicle" required value="{{ $authorized->vehicle }}"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label" for="city"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>MODELO</strong></label><input
                                        class="form-control" type="text" name="model" required
                                        value="{{ $authorized->carModel }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label" for="city"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>PATENTE</strong></label><input
                                        class="form-control" type="text" name="plate" required
                                        value="{{ $authorized->plate }}"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label" for="address"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>COLOR</strong></label><input
                                        class="form-control" type="text" name="color" required
                                        value="{{ $authorized->color }}"></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="city"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>OBSERVACIONES</strong></label>
                                    <textarea class="form-control" style="height: 130px;" name="observation">{{ $authorized->observation }}</textarea>
                                </div>
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
</body>

</html>
