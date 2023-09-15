<form id="{{ $formId }}" method="post" action="{{ $actionUrl }}">
    @csrf
    @method('delete')
</form>
