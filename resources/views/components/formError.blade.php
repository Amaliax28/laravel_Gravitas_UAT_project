<div {{ $attributes->merge(['class' => 'error-cont', 'id' => '']) }}>
    <object type="image/svg+xml" data="{{ asset('images/warning-symbol.svg') }}"></object>
    <p class="text-error">{{ $message }}</p>
</div>
