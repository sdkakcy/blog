@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h4>{{ __('Kullanıcı Düzenle') }}</h4>
        </div>
        @can('view user')
            <a type="button" href="{{ route('panel.users.index') }}" class="btn btn-primary">{{ __('Tüm Kullanıcılar') }}</a>
        @endcan
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            <form action="{{ route('panel.users.update', ['user' => $user->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group mb-3">
                    <label for="name">{{ __('Adı') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" placeholder="{{ __('Adı') }}" autofocus>
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email">{{ __('E-posta') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" placeholder="{{ __('E-posta') }}" autofocus>
                    
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
                            <option value="{{ $permission }}" @if($user->hasPermissionTo($permission)) selected @endif>{{ __($permission) }}</option>
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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
        
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
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Güncelle') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
