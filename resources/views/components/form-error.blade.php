@props(['name'])

@error($name)
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
