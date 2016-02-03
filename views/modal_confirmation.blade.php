<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{!! $modal_title !!}</h4>
</div>
<div class="modal-body">
    @if($error)
        <div>{{{ $error }}}</div>
    @else
        {{ $modal_message }}
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('menu-builder::menu-builder.cancel') !!}</button>
    @if(!$error)
        <a href="{{ $modal_route }}" type="button" class="btn btn-primary">{!! trans('menu-builder::menu-builder.ok') !!}</a>
    @endif
</div>
