@props(['active' => false])

<a class="{{ $active ? 'selected' : '' }}" aria-current="{{ $active ? 'page': 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a>
