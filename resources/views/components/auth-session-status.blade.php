@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-' . ($status['success'] ? 'success' : 'danger'), 'role' => 'alert']) }}>
        {{ $status['message'] }}
    </div>
@endif
