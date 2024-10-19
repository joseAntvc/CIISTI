@extends('layouts.ciisti')

@section('main')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h2 class="text-info bordered-text-login">CIISTI 2024</h2>
                                    <p class="mb-0"><b>Congreso Internacional de Innovación en</b><br></p>
                                    <p class="mb-0"><b>Sistemas, Tecnología e Información</b></p>
                                </div>
                                <div class="card-body">
                                    <p class="mt-3"><b>Ingresa tus credenciales para acceder</b></p>
                                    <form role="form" method="POST" action="{{ route('login') }}" id="loginForm">
                                        @csrf
                                        <label for="email" style="font-size: 14px"><strong>Correo electrónico</strong></label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control form-control-login" name="email" id="email"
                                                placeholder="correo" aria-label="Email"
                                                aria-describedby="email-addon">
                                        </div>
                                        <label for="password" style="font-size: 14px">Contraseña</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-login" name="password" id="password"
                                                placeholder="contraseña" aria-label="Password"
                                                aria-describedby="password-addon">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn w-100 mt-4 mb-0 text-white" style="background: #2152FF">Iniciar sesión</button>
                                        </div>
                                    </form>
                                    <br><br><br><br><br><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n7">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-color: #33cc45;">
                                    <img src="{{ asset('assets/img/logociisti.png') }}" class="img-fluid overlay-image ms-n7" alt="CIISTI LOGO" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
