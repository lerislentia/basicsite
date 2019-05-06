
<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
<div class="form-group">
        <label for="name">
        {{ __('back.name') }}
    </label>
        <input type="text" name="name" class="form-control" value="{{ isset($element['name_value']['lang'][$locale]['text']) ? $element['name_value']['lang'][$locale]['text'] : old('name') }}">
    </div>
    <div class="form-group">
        <label for="description">
        {{ __('back.description') }}
                </label>
        <textarea name="description" id="IdDescription" rows="10" cols="60">
        {{ isset($element['description_value']['lang'][$locale]['text']) ? $element['description_value']['lang'][$locale]['text'] : old('description') }}
        </textarea>
    </div>


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

if(isset($element['array_data'][$locale]['works'])){
    $workcount = count($element['array_data'][$locale]['works']);
}else{
    $workcount = 0;
}
@endphp

var workquetity = "{{$workcount}}";

$(document).ready(function () {

    $("#IdSaveProperties").click(function(){

        for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();

        var data = $('#MyForm').serialize();

        $.post("{{route('admin.products.properties.update.ajax')}}",
        data,
        function(data, status){
            if(status=='success'){
                alert("propiedades guardadas exitosamente");
            }else{
                alert('no se pudo guardar');                    
            }
        });
    });

    CKEDITOR.replace( 'description' );

});

</script>