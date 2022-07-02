@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h4>{{ __('Kategori Düzenle') }}</h4>
        </div>
        <div class="d-flex">
            <a type="button" href="{{ route('panel.categories.index') }}" class="btn btn-primary">{{ __('Tüm Kategoriler') }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            <form action="{{ route('panel.categories.update', ['category' => $category->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group mb-3">
                    <label for="name">{{ __('Adı') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $category->name }}" placeholder="{{ __('Adı') }}" autofocus>
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="parent_id">{{ __('Ebeveyn') }}</label>
                    <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                        <option value="">{{ __('Yok') }}</option>
                        @foreach ($categories as $item)
                            <x-category-select-option :category="$item" :level="0" :categoryModel="$category" />
                        @endforeach
                    </select>

                    @error('parent_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Kaydet') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
