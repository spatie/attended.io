<form method="{{ $method ?? 'POST' }}" action="{{ $action }}">
    @csrf
    {{ $slot }}
</form>