<div class="d-flex justify-content-center align-items-center m-0 p-0">
    <div class="container-fluid py-3 m-0 p-0">
        <h5 class="custom-title mb-4">{{ $action == 'update' ? 'Actualización de usuario' : 'Registro de usuario' }}</h5>
        <form action="{{ $action == 'update' ? route('users.update', $user->id) : route('users.store') }}" method="POST" id="userForm">
            @csrf
            @if($action == 'update')
                @method('PUT')
            @endif

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="name" class="form-control-label">Nombre</label>
                    <input class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="text" placeholder="Nombre" id="name" name="name" value="{{ old('name', $user ? $user->name : '') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="last_name" class="form-control-label">Apellidos</label>
                    <input class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="text" placeholder="Apellidos" id="last_name" name="last_name" value="{{ old('last_name', $user ? $user->last_name : '') }}">
                    @if ($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="email" class="form-control-label">Correo</label>
                    <input class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="email" placeholder="ejemplo@ejemplo.com" id="email" name="email" value="{{ old('email', $user ? $user->email : '') }}">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="password" class="form-control-label">Contraseña</label>
                    <input class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="password" placeholder="****" id="password" name="password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-9 mb-3 mx-auto">
                <div class="form-user">
                    <label for="phone" class="form-control-label">Teléfono</label>
                    <input class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" type="tel" placeholder="### ### ####" id="phone" name="phone" value="{{ old('phone', $user ? $user->phone : '') }}">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div>

            @if(1 == '1')
                <div class="col-md-9 mb-3 mx-auto">
                    <div class="form-user">
                        <label for="rol" class="form-control-label">Rol</label>
                        <select class="form-control {{ $action == 'update' ? 'form-control-user-update' : 'form-control-user-add'}}" id="rol" name="rol">
                            <option value="0">Selecciona un Rol</option>
                            <option value="1" {{ ($user && $user->id_rol == 1) ? 'selected' : '' }}>Administrador</option>
                            <option value="2" {{ ($user && $user->id_rol == 2) ? 'selected' : '' }}>Staff</option>
                            <option value="3" {{ ($user && $user->id_rol == 3) ? 'selected' : '' }}>Moderador</option>
                        </select>
                        @if ($errors->has('rol'))
                            <span class="text-danger">{{ $errors->first('rol') }}</span>
                        @endif
                    </div>
                </div>
            @else
                <input id="rol" name="rol" type="hidden" value="3">
            @endif

            <div class="d-flex justify-content-center">
                <button id="submitUserForm"  type="submit" style="background-color: {{ $action == 'update' ?  '#ffab3c' : 'rgb(4, 163, 86)'}}"
                    class="btn btn-md mt-4 mb-2 text-white">{{ $action == 'update' ? 'Actualizar' : 'Registrar' }}</button>
            </div>
        </form>
    </div>
</div>
