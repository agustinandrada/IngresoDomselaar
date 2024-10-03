<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    <div class="d-flex flex-column min-vh-100">
        @include('modules.nav')
        <div class="container-fluid" style="margin-top: 42px;">
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <h1 style="font-family: Montserrat, sans-serif;font-size: 28px;font-weight: bold;">Agregar Visita
                    </h1>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row" style="margin-bottom: 25px;text-align: left;">
                            <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center"
                                style="width: 100%;">
                                <div class="row">
                                    <div class="col-md-12 text-start">
                                        <div class="mb-3"><label class="form-label" for="email"
                                                style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>NOMBRE</strong></label><input
                                                class="form-control" type="text" name="nombre"
                                                style="font-family: Montserrat, sans-serif;font-size: 13px;"></div>
                                    </div>
                                    <div class="col-md-12 text-start">
                                        <div class="mb-3"><label class="form-label" for="username"
                                                style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>APELLIDO</strong></label><input
                                                class="form-control" type="text" name="apellido"></div>
                                    </div>
                                    <div class="col-md-12 text-start">
                                        <div class="mb-3"><label class="form-label" for="username"
                                                style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>DNI</strong></label><input
                                                class="form-control" type="number" name="dni"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-start">
                                <div class="mb-3"><label class="form-label" for="username"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>PROPIETARIO
                                            QUE
                                            AUTORIZA LA VISITA</strong></label><select class="form-select">
                                        <optgroup label="This is a group">
                                            <option value="12" selected="">This is item 1</option>
                                            <option value="13">This is item 2</option>
                                            <option value="14">This is item 3</option>
                                        </optgroup>
                                    </select></div>
                            </div>
                            <div class="col-md-6 text-start">
                                <div class="mb-3"><label class="form-label" for="username"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>LOTE</strong></label><input
                                        class="form-control" type="text" name="lote"></div>
                            </div>
                            <div class="col-md-6 text-start">
                                <div class="mb-3"><label class="form-label" for="username"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>VEHÍCULO
                                            MARCA</strong></label><input class="form-control" type="text"
                                        name="vehiculo marca"></div>
                            </div>
                            <div class="col-md-6 col-xl-2 text-start">
                                <div class="mb-3"><label class="form-label" for="username"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>MODELO</strong></label><input
                                        class="form-control" type="text" name="modelo"></div>
                            </div>
                            <div class="col-md-6 col-xl-2">
                                <div class="mb-3"><label class="form-label" for="first_name"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>PATENTE</strong></label><input
                                        class="form-control" type="text" name="patente"></div>
                                <div class="mb-3"></div>
                            </div>
                            <div class="col"><label class="form-label" for="first_name"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>COLOR</strong></label><input
                                    class="form-control" type="text" name="color"></div>
                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label" for="city"
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>VISITA DEL
                                            DÍA
                                            (24 HS)</strong></label><select class="form-select">
                                        <option value="12" selected="">SI</option>
                                        <option value="13">NO</option>
                                    </select></div>
                            </div>
                            <div class="col"><label class="form-label" for="address"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>INICIO DE
                                        VISITA</strong></label><input class="form-control" type="date"
                                    name="fecha inicio visita"></div>
                            <div class="col"><label class="form-label" for="address"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;"><strong>FINALIZACIÓN
                                        DE
                                        VISITA</strong></label><input class="form-control" type="date"
                                    name="fecha fin visita"></div>
                            <div class="col-md-6 col-xl-12" style="width: 100%;">
                                <div class="mb-3"></div><label class="form-label" for="city"
                                    style="font-family: Montserrat, sans-serif;font-size: 13px;margin-bottom: -4px;"><strong>OBSERVACIONES</strong></label>
                                <textarea class="form-control" style="height: 130px;width: 100%;" name="observaciones visita"></textarea>
                            </div>
                        </div>
                    </form><button class="btn btn-primary" type="button"
                        style="background: rgb(177,155,118);">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    @include('modules.footer')
</body>

</html>
