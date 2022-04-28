@props([
    'id' => 'modal',
    'action' => 'Envíar'
])
<button type="button" id="deleteUser" class="btn btn-danger" data-toggle="modal" data-target="#{{ $id }}">{{ $action }}</button>
<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3>{{ $slot }}</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">{{ $action }}</button>
            </div>
        </div>
    </div>
</div>
