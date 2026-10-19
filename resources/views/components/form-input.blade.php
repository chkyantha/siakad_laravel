@props(['label', 'name', 'type' => 'text', 'value' => ''])

<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
       value="{{ old($name, $value) }}"
       {{ $attributes->merge(['class' => 'form-control']) }}>