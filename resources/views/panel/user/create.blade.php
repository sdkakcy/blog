@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h4>{{ __('Yeni Kullanıcı Ekle') }}</h4>
        </div>
        <div class="d-flex">
            @can('view user')
                <a type="button" href="{{ route('panel.users.index') }}" class="btn btn-primary">{{ __('Tüm Kullanıcılar') }}</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            <form action="{{ route('panel.users.store') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">{{ __('Adı') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Adı') }}" autofocus>
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email">{{ __('E-posta') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('E-posta') }}" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="permission">{{ __('Yetkiler') }}</label>
                    <select multiple class="form-control @error('permission') is-invalid @enderror" id="permission" name="permission[]">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission }}">{{ __($permission) }}</option>
                        @endforeach
                    </select>

                    @error('permission')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Kaydet') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
