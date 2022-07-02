@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h4>{{ __('Tüm Kategoriler') }}</h4>
        </div>
        <div class="d-flex">
            <a type="button" href="{{ route('panel.categories.create') }}" class="btn btn-primary">{{ __('Yeni Ekle') }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Adı') }}</th>
                            <th>{{ __('Oluşturma') }}</th>
                            <th>{{ __('Güncelleme') }}</th>
                            <th>{{ __('İşlemler') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <x-category-table-row :category="$category" :level="0" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
