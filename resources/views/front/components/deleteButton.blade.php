<form method="POST" action="{{ $action }}">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>