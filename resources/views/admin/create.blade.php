<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')
<script src="{{ asset('js/profilePhoto.js') }}"></script>

<body>
    <div class="d-flex flex-column min-vh-100">
        @include('modules.nav')
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card shadow mb-3" style="margin-top: 35px;">
                <h1 style="font-size: 28px;margin-left: 23px;">Agregar Administrador / Usuario</h1>
                <div class="card-body">
                    <form method="POST" action="{{ route('store-user') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="margin-bottom: 25px;text-align: left;">

                            <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2"
                                style="display: inline;text-align: center;margin-bottom: 25px;">
                                <img id="profileImage" class="rounded-circle mb-3 mt-4 img-fluid"
                                    src="{{ asset('img/user.jpg') }}" style="display: inline;max-height: 110px;">
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
                                        <div class="mb-3"><label class="form-label"
                                                for="email"><strong>Email&nbsp;</strong></label><input
                                                class="form-control" type="email" id="email"
                                                placeholder="Ingresa tu email" name="email" required=""></div>
                                    </div>
                                    <div class="col-md-12 text-start">
                                        <div class="mb-3"><label class="form-label" for="username"><strong>Usuario (el
                                                    usuario debe ser el DNI)</strong></label><input class="form-control"
                                                type="text" placeholder="Tu usuario es tu DNI" name="user"
                                                required=""></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3" style="border-style: none;"><label class="form-label"
                                        for="first_name"><strong>Nombre</strong></label><input class="form-control"
                                        type="text" name="name" required=""></div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label"
                                        for="last_name"><strong>Apellido</strong></label><input class="form-control"
                                        type="text" name="last_name" required=""></div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label"
                                        for="phone"><strong>Telefono</strong></label><input class="form-control"
                                        type="number" name="phone" required=""></div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label"
                                        for="role"><strong>Rol</strong></label><select
                                        class="form-select states order-alpha" id="stateId" name="role"
                                        required="">
                                        <option value="0">Usuario</option>
                                        <option value="1">Administrador</option>
                                    </select></div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label"
                                        for="password"><strong>Contraseña</strong></label><input class="form-control"
                                        type="password" name="password" required></div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label" for="repeat_password"><strong>Repetir
                                            Contraseña</strong></label><input class="form-control" type="password"
                                        name="repeat_password" required></div>
                            </div>

                            <div class="col">
                                <p id="emailErrorMsg" class="text-danger" style="display:none;"></p>
                                <p id="passwordErrorMsg" class="text-danger" style="display:none;"></p>
                            </div>

                            <div class="col-md-12" style="text-align: right;margin-top: 5px;">
                                <p class="text-start" style="font-size: 14px;margin-top: 5px;">La contraseña debe
                                    tener 8
                                    caracteres mínimo, una mayúscula, un número y un caracter especial.</p><button
                                    class="btn btn-primary btn-sm" id="submitBtn" type="submit"
                                    style="background: #b19b76;border-width: 0px;">Guardar y Actualizar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('modules.footer')
</body>

</html>
