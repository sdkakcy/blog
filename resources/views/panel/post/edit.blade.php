@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h4>{{ __('Yazı Düzenle') }}</h4>
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

            <form action="{{ route('panel.posts.update', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group mb-3">
                    <label for="subject">{{ __('Başlık') }}</label>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ $post->subject }}" placeholder="{{ __('Başlık') }}" autofocus>
                    
                    @error('subject')
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
                            <x-category-select-option :category="$category" :level="0" :post="$post" />
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
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ $post->content }}</textarea>

                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Güncelle') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
