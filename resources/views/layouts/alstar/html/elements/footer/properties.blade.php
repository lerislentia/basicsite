<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <fieldset>
            <legend>Properties:</legend>

            <div class="form-group">
                <label for="Copyright ">
                    Copyright 
                </label>
                <input id="IdCopyright" type="text" name="Copyright" class="form-control" value="{{ isset($element['array_data'][$locale]['Copyright']) ? $element['array_data'][$locale]['Copyright'] : old('Copyright') }}">
            </div>

            <div class="form-group">
                <label for="Designed">
                    Designed by
                </label>
                <input id="IdDesigned" type="text" name="Designed" class="form-control" value="{{ isset($element['array_data'][$locale]['Designed']) ? $element['array_data'][$locale]['Designed'] : old('MainTitle') }}">
            </div>

            <div class="form-group">
                <label for="Designed">
                    Designed by link
                </label>
                <input id="IdDesignedLink" type="text" name="DesignedLink" class="form-control" value="{{ isset($element['array_data'][$locale]['DesignedLink']) ? $element['array_data'][$locale]['DesignedLink'] : old('MainTitle') }}">
            </div>

        </fieldset>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="hidden" id="IdEntityId" name="entity_id" value="{{$element['id']}}">
        <input id="IdSaveProperties" type="button" class="btn btn-primary" value="{{ __('back.save') }}">
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