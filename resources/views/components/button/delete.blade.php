<form action="{{ $action }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" type="submit">DELETE</button>
</form>
