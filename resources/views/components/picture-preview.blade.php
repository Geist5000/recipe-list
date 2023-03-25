@props(["src","id"])

<div class="img-preview-container"  @isset($id)data-imgid="{{$id}}"@endisset>
    <img src="{{$src}}"/>
    <div class="img-preview-button-container">
        <button class="btn btn-danger">Entfernen</button>
    </div>
</div>
