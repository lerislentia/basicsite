

<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <fieldset>
        <div class="form-group">
                <label for="HeadingLine">
                    Link
                </label>
                <textarea id="IdLink" rows="10" cols="80" name="Link">
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

    
    var type        = "{{$element['type_id']}}";
    var data        = "{{$data}}";

    if(data==1){
        LoadPreview(type, entityid);
    }

    $("#IdImage").change(function() {
        
        LoadPreview(type);
    });

    $("#IdHeader").change(function() {
        
        LoadPreview(type);
    });

    $("#IdParagraph").change(function() {
        
        LoadPreview(type);
    });

    $("#IdActionHref").change(function() {
        LoadPreview(type);
    });
    
    $("#IdActionText").change(function() {
        LoadPreview(type);
    });

});

function LoadPreview(type, entityid = null){
    $( "#preview" ).html("");
    $( "#preview" ).load( 
        "{{route('admin.type.preview.ajax')}}", 
            { 
                "type"                      : type , 
                "entity_id"                 : entityid , 
                "_token"                    : $('meta[name="csrf-token"]').attr('content'),
            } 
        );
    }


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

</script>