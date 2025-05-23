
@props(['disabled' => false, "checked" => false, "name" => null, "id" => null])
<input   type="checkbox" class="default-checkbox" name="{{ $name }}" id="{{ $id }}" 
{{ $attributes->merge([
  /*   'disabled' => $disabled,
    'checked' => $checked, */
    'class' => 'default-checkbox'
]) }}

 />