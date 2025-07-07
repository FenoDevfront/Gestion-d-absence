@props(['status'])

@php
    $class = '';
    switch ($status) {
        case 'en_attente':
            $class = 'bg-warning text-dark';
            break;
        case 'approuve':
            $class = 'bg-success text-white';
            break;
        case 'refuse':
            $class = 'bg-danger text-white';
            break;
        default:
            $class = 'bg-secondary text-white';
            break;
    }
@endphp

<span class="badge rounded-pill {{ $class }}">
    {{ ucfirst(str_replace('_', ' ', $status)) }}
</span>
