<div class="modal fade {{ $additionalClass or NULL }}" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title or 'UNTITLED' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                @foreach($buttons as $button)
                    <button type ="{{ $button['type'] or NULL }}" class="btn {{ $button['class'] or NULL }}">{{ $button['title'] }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @endforeach
            </div>
        </div>
    </div>
</div>