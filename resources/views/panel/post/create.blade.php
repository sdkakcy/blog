@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h4>{{ __('Yeni Yazı Ekle') }}</h4>
        </div>
        <div class="d-flex">
            <a type="button" href="{{ route('panel.posts.index') }}" class="btn btn-primary">{{ __('Tüm Yazılar') }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('panel.posts.store') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="subject">{{ __('Başlık') }}</label>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" placeholder="{{ __('Başlık') }}" autofocus>
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="category">{{ __('Kategori') }}</label>
                    <select multiple class="form-control @error('category') is-invalid @enderror" id="category" name="category[]">
                        <option value="">{{ __('Seçiniz') }}</option>
                        @foreach ($categories as $category)
                            <x-category-select-option :category="$category" :level="0" />
                        @endforeach
                    </select>

                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="category">{{ __('Yazı içeriği') }}</label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>

                    @error('content')
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
