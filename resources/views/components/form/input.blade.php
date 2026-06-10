<div class="mb-3">

    <label class="form-label">

        {{ $label }}

    </label>

    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" value="{{ old($name, $value ?? '') }}"
        class="form-control">

    @error($name)
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror

</div>
