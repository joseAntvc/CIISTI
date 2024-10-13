<div class="d-flex justify-content-center align-items-center m-0 p-0">
    <div class="container-fluid py-3 m-0 p-0">
        <h5 class="custom-title mb-4">{{ $action == 'update' ? 'Actualización de usuario' : 'Registro de usuario' }}</h5>
        <form method="POST" role="form text-left">
            @csrf
            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="name" class="form-control-label">Nombre</label>
                    <input class="form-control form-control-user" type="text" placeholder="Nombre" id="name" name="name">
                </div>
            </div>
            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="last_name" class="form-control-label">Apellidos</label>
                    <input class="form-control form-control-user" type="text" placeholder="Apellidos" id="last_name" name="last_name">
                </div>
            </div>
            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="email" class="form-control-label">Correo</label>
                    <input class="form-control form-control-user" type="email" placeholder="ejemplo@ejemplo.com" id="email" name="email">
                </div>
            </div>
            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="password" class="form-control-label">Contraseña</label>
                    <input class="form-control form-control-user" value="" type="password" placeholder="****" id="password"
                        name="password">
                </div>
            </div>
            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="phone" class="form-control-label">Teléfono</label>
                    <input class="form-control form-control-user" value="" type="tel" placeholder="### ### ####" id="phone"
                        name="phone">
                </div>
            </div>
            <!-- Se va a modificar cuando se maneje lo del login con secciones -->
            @if(1 == '1')
                <div class="col-md-9 mb-3 mx-auto">
                    <div class="form-user">
                        <label for="rol" class="form-control-label">Rol</label>
                        <select class="form-control form-control-user" id="rol" name="rol">
                            <option value="0">Selecciona un Rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Staff</option>
                            <option value="3">Moderador</option>
                        </select>
                    </div>
                </div>
            @endif
            <div class="d-flex justify-content-center">
                <button type="submit" style="background-color: rgb(4, 163, 86)"
                    class="btn btn-md mt-4 mb-2 text-white">{{ $action == 'update' ? 'Actualizar' : 'Registrar' }}</button>
            </div>
        </form>

    </div>
</div>
