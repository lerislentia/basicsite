<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="order">
            attrid
            </label>
            <input id="Idattrid" type="text" name="attrid" value="{{ isset($entity['array_data']['attrid']) ? $entity['array_data']['attrid'] : old('attrid') }}">
        </div>

        <div class="form-group">
            <label for="order">
            attrclass
            </label>
            <input id="Idattrclass" type="text" name="attrclass" value="{{ isset($entity['array_data']['attrclass']) ? $entity['array_data']['attrclass'] : old('attrclass') }}">
        </div>

        <div class="form-group">
            <label for="order">
            attrheader
            </label>
            <input id="Idattrheader" type="text" name="attrheader" value="{{ isset($entity['array_data']['attrheader']) ? $entity['array_data']['attrheader'] : old('attrheader') }}">
        </div>

        <div class="form-group">
            <label for="order">
            attrheadertitle
            </label>
            <input id="Idattrheadertitle" type="text" name="attrheadertitle" value="{{ isset($entity['array_data']['attrheadertitle']) ? $entity['array_data']['attrheadertitle'] : old('attrheadertitle') }}">
        </div>

        <div class="form-group">
            <label for="order">
                attrrow
            </label>
            <input id="Idattrrow" type="text" name="attrrow" value="{{ isset($entity['array_data']['attrrow']) ? $entity['array_data']['attrrow'] : old('attrrow') }}">
        </div>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="hidden" id="IdEntityId" name="entity_id" value="{{$entity['id']}}">
        <input id="IdSaveProperties" type="button" value="save">
</form>

<script type="text/javascript">
@php
    $data = 0;
if(isset($entity['data'])){
    $data = 1;
}
@endphp
$(document).ready(function () {

    var type = "{{$entity['type_id']}}";
    var data = "{{$data}}";

    if(data==1){
        LoadPreview(type);
    }

    $("#Idattrid").change(function() {
        
        LoadPreview(type);
    });

    $("#Idattrclass").change(function() {
        
        LoadPreview(type);
    });

    $("#Idattrclass").change(function() {
        
        LoadPreview(type);
    });

    $("#Idattrheader").change(function() {
        
        LoadPreview(type);
    });

    $("#Idattrheadertitle").change(function() {
        LoadPreview(type);
    });
    
    $("#Idattrrow").change(function() {
        LoadPreview(type);
    });


});

function LoadPreview(type){
    $( "#preview" ).html("");
    $( "#preview" ).load( 
        "{{route('admin.type.preview.ajax')}}", 
            { 
                "type": type , 
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "attrid": $('#Idattrid').val(),
                "attrclass": $('#Idattrclass').val(),
                "attrheader": $('#Idattrheader').val(),
                "attrheadertitle": $('#Idattrheadertitle').val(),
                "attrrow": $('#Idattrrow').val(),
            } 
        );
    }


    $("#IdSaveProperties").click(function(){

        $.post("{{route('admin.type.properties.update.ajax')}}",
        {
            "_token"    : $('meta[name="csrf-token"]').attr('content'),
            "entity_id" : $('#IdEntityId').val(),
            "attrid": $('#Idattrid').val(),
            "attrclass": $('#Idattrclass').val(),
            "attrheader": $('#Idattrheader').val(),
            "attrheadertitle": $('#Idattrheadertitle').val(),
            "attrrow": $('#Idattrrow').val(),
        },
        function(data, status){
            if(status=='success'){
                alert("propiedades guardadas exitosament");
            }else{
                alert('no se pudo guardar');                    
            }
        });
    }); 


</script>

