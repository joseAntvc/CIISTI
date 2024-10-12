@extends('layouts.ciisti')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body pt-4 p-3">
                <form method="POST" role="form text-left">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Nombre</label>
                                <input class="form-control" type="text" placeholder="Nombre" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <input class="form-control" value="" type="email" placeholder="@example.com" id="user-email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label>
                                <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="tel" placeholder="40770888444" id="number" name="phone" value="">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="user.location" class="form-control-label">{{ __('Location') }}</label>
                                <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Location" id="name" name="location" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="about">{{ 'About Me' }}</label>
                        <div class="@error('user.about')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection
