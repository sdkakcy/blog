@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="alert alert-danger">
            {{ __('İşleminiz gerçekleştirilemedi. Lütfen aşağıdaki alanları denetleyiniz.') }}
        </div>

        <ul class="mt-3 text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
