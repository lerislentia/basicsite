

<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <fieldset>
        <div class="form-group">
                <label for="HeadingLine">
                    Link
                </label>
                <textarea id="IdLink" rows="10" cols="80" name="Link" class="form-control">
                {!! isset($element['array_data'][$locale]['Link']) ? $element['array_data'][$locale]['Link'] : old('Link') !!}
                </textarea>
            </div>
        </fieldset>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="hidden" id="IdEntityId" name="entity_id" value="{{$element['id']}}">
        <input id="IdSaveProperties" type="button" value="{{ __('back.save') }}">
</form>

<script type="text/javascript">
@php
    $data = 0;
if(isset($entity['data'])){
    $data = 1;
}

@endphp

$(document).ready(function () {
    
    $("#IdSaveProperties").click(function(){

    var data = $('#MyForm').serialize();

    $.post("{{route('admin.type.properties.update.ajax')}}",
    data,
    function(data, status){
        if(status=='success'){
            alert("propiedades guardadas exitosamente");
        }else{
            alert('no se pudo guardar');                    
        }
    });
    });


});

</script>