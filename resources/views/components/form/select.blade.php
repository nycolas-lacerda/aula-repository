<div class="mb-3">
    <label class="form-label" for="{{ $name }}">
        {{ $label }}
    </label>

    <select id="{{ $name }}" name="{{ $name }}" class="form-select">
        <option value="">Selecione</option>
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}" @selected(old($name, $value ?? '') == $option['value'])>
                {{ $option['label'] }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="text-danger small mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
