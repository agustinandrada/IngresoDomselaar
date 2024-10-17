<!DOCTYPE html>
<html data-bs-theme="light" lang="es">
@include('layouts.head')

<body>
    <div class="d-flex flex-column min-vh-100">
        @include('modules.nav')
        <div class="container-fluid">
            <div class="card shadow mb-3" style="margin-top: 35px;">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 25px;text-align: left;">
                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2"
                            style="display: inline;text-align: center;margin-bottom: 25px;">
                            <img id="profileImage" class="rounded-circle mb-3 mt-4 img-fluid"
                                src="{{ asset($user->photo) === asset('/') ? asset('img/user.jpg') : asset($user->photo) }}"
                                style="display: inline;max-height: 110px;">
                            <br>
                        </div>

                        <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                            <div class="row">
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label"
                                            for="email"><strong>Email&nbsp;</strong></label><input
                                            class="form-control" type="email" id="email"
                                            value="{{ $user->email }}" placeholder="Ingresa tu email" name="email"
                                            required="" disabled></div>
                                </div>
                                <div class="col-md-12 text-start">
                                    <div class="mb-3"><label class="form-label" for="username"><strong>Usuario
                                            </strong></label><input class="form-control" type="text"
                                            placeholder="Tu usuario es tu DNI" name="user"
                                            value="{{ $user->user }}" required="" disabled></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3" style="border-style: none;"><label class="form-label"
                                    for="first_name"><strong>Nombre</strong></label><input class="form-control"
                                    type="text" name="name" required="" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label"
                                    for="last_name"><strong>Apellido</strong></label><input class="form-control"
                                    type="text" name="last_name" required="" value="{{ $user->last_name }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label"
                                    for="phone"><strong>Telefono</strong></label><input class="form-control"
                                    type="number" name="phone" value="{{ $user->phone }}" disabled></div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label"
                                    for="role"><strong>Rol</strong></label><input class="form-control"
                                    type="text" name="role"
                                    value="{{ $user->role === '1' ? 'Administrador' : 'Usuario' }}" disabled>
                            </div>
                        </div>

                        <div class="col">
                            <p id="emailErrorMsg" class="text-danger" style="display:none;"></p>
                            <p id="passwordErrorMsg" class="text-danger" style="display:none;"></p>
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
