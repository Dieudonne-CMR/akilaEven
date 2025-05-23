@props(['disabled' => false, "type" => "text", "placeholder" => null])

<input
@disabled($disabled)
{{ $attributes->merge(['class' => 'default-input']) }}
placeholder="{{ $placeholder }}" type="{{ $type }}" class=" default-input" />
