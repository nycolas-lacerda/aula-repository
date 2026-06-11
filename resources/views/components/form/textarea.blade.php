<div class="mb-3">
    <label class="form-label" for="{{ $name }}">
        {{ $label }}
    </label>

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        class="form-control"
        rows="{{ $rows ?? 4 }}"
    >{{ old($name, $value ?? '') }}</textarea>

    @error($name)
        <div class="text-danger small mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
