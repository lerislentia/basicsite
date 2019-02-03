<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="order">
            id (atribute)
            </label>
            <input id="Idattrid" type="text" name="attrid" value="{{ isset($entity['array_data']['attrid']) ? $entity['array_data']['attrid'] : old('attrid') }}">
        </div>

        <div class="form-group">
            <label for="order">
            class (atribute)
            </label>
            <input id="Idattrclass" type="text" name="attrclass" value="{{ isset($entity['array_data']['attrclass']) ? $entity['array_data']['attrclass'] : old('attrclass') }}">
        </div>

        <div class="form-group">
            <label for="order">
            with header
            </label>
            <input id="IdattrWithheader" type="checkbox" name="attrheader" value="{{ isset($entity['array_data']['attrheader']) ? $entity['array_data']['attrheader'] : old('attrheader') }}">
        </div>

        <div class="form-group">
            <label for="order">
                header title
            </label>
            <input id="Idattrheadertitle" type="text" name="attrheadertitle" value="{{ isset($entity['array_data']['attrheadertitle']) ? $entity['array_data']['attrheadertitle'] : old('attrheadertitle') }}">
        </div>

        <div class="form-group">
            <label for="order">
                with row inside
            </label>
            <input id="Idattrrow" type="checkbox" name="attrrow" value="{{ isset($entity['array_data']['attrrow']) ? $entity['array_data']['attrrow'] : old('attrrow') }}">
        </div>

        <div class="form-group">
            <label for="order">
            with footer
            </label>
            <input id="IdattrWithFooter" type="checkbox" name="attrfooter" value="{{ isset($entity['array_data']['attrfooter']) ? $entity['array_data']['attrfooter'] : old('attrfooter') }}">
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

    $("#IdattrWithheader").change(function() {
        
        LoadPreview(type);
    });

    $("#Idattrheadertitle").change(function() {
        LoadPreview(type);
    });
    
    $("#Idattrrow").change(function() {
        LoadPreview(type);
    });

    $("#IdattrWithFooter").change(function() {
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
                "attrheader": $('#IdattrWithheader').is(':checked'),
                "attrheadertitle": $('#Idattrheadertitle').val(),
                "attrrow": $('#Idattrrow').is(':checked'),
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
            "attrheader": $('#IdattrWithheader').is(':checked'),
            "attrheadertitle": $('#Idattrheadertitle').val(),
            "attrrow": $('#Idattrrow').is(':checked'),
        },
        function(data, status){
            if(status=='success'){
                alert("propiedades guardadas exitosamente");
            }else{
                alert('no se pudo guardar');                    
            }
        });
    }); 


</script>

